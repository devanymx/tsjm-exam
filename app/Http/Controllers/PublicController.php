<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
