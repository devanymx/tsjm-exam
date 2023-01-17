<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\User;
use App\Models\UserExam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{

    public function showExam(){
        $user = Auth::user();

        //Do the permission check to avoid forbidden consults.
        $token = $this->checkPermissions('exam.show');
        if (!$token) return redirect()->route('forbidden');

        if ($user->exam){
            if ($user->exam->score != null){
                return redirect()->route('exam.getFinished');
            }
        }

        return view('exam.show',[

        ]);

    }

    public function startExam(){
        $user = Auth::user();

        //Do the permission check to avoid forbidden consults.
        $token = $this->checkPermissions('exam.start');
        if (!$token) return redirect()->route('forbidden');

        if (count($user->questions) < 1){
            $questions = Question::all()->random(100);
            $user->questions()->saveMany($questions);
        }

        if (!$user->exam){
            $now = Carbon::now();
            $exam = new UserExam(['started_at' => $now, 'user_id' => $user->id]);
            $user->exam()->save($exam);
        }

        return redirect()->route('exam.answer', ['paginate' => 1]);

    }

    public function answerExam(Request $request){
        $user = Auth::user();
        //Do the permission check to avoid forbidden consults.
        $token = $this->checkPermissions('exam.answer');
        if (!$token) return redirect()->route('forbidden');

        $page = $request->query('page');
        if ($page == null) $page = 1;

        $userQuestions = $user->questions()->paginate(10);

        if ($page == 11){
            return view('exam.confirm_finish',[
                'questions' => $userQuestions,
                'user' => $user,
                'page' => $page
            ]);
        }

        return view('exam.answer',[
            'questions' => $userQuestions,
            'user' => $user,
            'page' => $page
        ]);
    }

    public function answerQuestions(Request $request){
        $user = Auth::user();
        //Do the permission check to avoid forbidden consults.
        $token = $this->checkPermissions('exam.questions.answer');
        if (!$token) return redirect()->route('forbidden');

        $answers = $request->all();
        $requestKeys = array_keys($answers);
        foreach ($requestKeys as $requestKey){
            if ($requestKey != '_token' && $requestKey != 'page'){
                $answer = QuestionAnswer::where('slug', $answers[$requestKey])->first();
                $prevRegister = $user->questionAnswers()->where('question_answer_user.question_id', $answer->question->id)->get();
                if ($prevRegister){
                    $user->questionAnswers()->detach($prevRegister);
                }
                $user->questionAnswers()->attach($answer, ['validity' => $answer->validity, 'question_id' => $answer->question->id]);
            }
        }

        return redirect()->route('exam.answer',['page' => $answers['page']+1]);

    }

    public function finishedExam(){
        $user = Auth::user();
        //Do the permission check to avoid forbidden consults.
        $token = $this->checkPermissions('exam.finish');
        if (!$token) return redirect()->route('forbidden');

        $exam = $user->exam;
        $now = Carbon::now();
        $exam->finished_at = $now;
        $totalDuration = $now->diffInSeconds($exam->started_at);
        $exam->time = gmdate('H:i:s', $totalDuration);;
        $score = 0;

        $userAnswers = $user->questionAnswers;
        foreach($userAnswers as $answer){
            if ($answer->validity){
                $score += 1;
            }
        }

        $exam->score = $score;
        $exam->save();

        return redirect()->route('exam.getFinished');
    }

    public function getFinished(){
        $user = Auth::user();
        $exam = $user->exam;

        $url = $_ENV['APP_URL'].'/verify/'.$exam->uuid;

        return view('exam.finished', [
            'user' => $user,
            'exam' => $exam,
            'url' => $url
        ]);
    }

    public function verifyExam($uuid){

        $exam = UserExam::where('uuid',$uuid)->with('user')->first();
        $url = $_ENV['APP_URL'].'/verify/'.$uuid;
        $user = $exam->user;
        $user = User::find($user->user_id);

        return view('exam.verify', [
            'user' => $user,
            'exam' => $exam,
            'url' => $url
        ]);
    }

    public function checkPermissions($permission){
        $user = Auth::user();
        $currentTeam = $user->currentTeam;
        $perms = explode('.', $permission);
        $wildcard = '';
        for ($i = 0; $i < count($perms); $i++)  if ($user->hasTeamPermission($currentTeam, $perms[$i].'.*')) return true;
        else{ $wildcard .= $perms[$i].'.'; if ($user->hasTeamPermission($currentTeam, $wildcard.'*')) return true;}
        return $user->hasTeamPermission($currentTeam, $permission);
    }

}
