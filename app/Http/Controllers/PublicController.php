<?php

namespace App\Http\Controllers;

use App\Imports\AnswersImport;
use App\Imports\QuestionsImport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PublicController extends Controller
{

    public $defaultRoutes = [
      'Users' => 'exam.show'
    ];

    public function defaultTemplate(Request $request){
        $user = Auth::user();

        if (isset($this->defaultRoutes[$user->currentTeam->name])){
            return redirect()->route('exam.show');
        }

        return view('errors.forbidden');

    }

    public function importViewa(Request $request){
        return view('import');
    }

    public function importa(Request $request){
        Excel::import(new AnswersImport(),
            $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function importViewq(Request $request){
        return view('importq');
    }

    public function importq(Request $request){
        Excel::import(new QuestionsImport(),
            $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function importViewu(Request $request){
        return view('importu');
    }

    public function importu(Request $request){
        Excel::import(new UsersImport(),
            $request->file('file')->store('files'));
        return redirect()->back();
    }
}
