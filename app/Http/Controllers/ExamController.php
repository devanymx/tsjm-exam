<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{

    /*
     *
     * */
    public function showExam(){

        $user = Auth::user();

        //Do the permission check to avoid forbidden consults.
        $token = $this->checkPermissions('exam.show');
        if (!$token) return redirect()->route('forbidden');

        return view('exam.show',[

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
