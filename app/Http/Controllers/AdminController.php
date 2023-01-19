<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Doctrine\DBAL\Driver\Middleware\AbstractConnectionMiddleware;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\Jetstream;
use Monolog\Handler\IFTTTHandler;


class AdminController extends Controller
{
    /*
     *
     * */
    public function showDashboard(Request $request){

        //Do the permission check to avoid forbidden consults.
        $token = $this->checkPermissions('dashboard.show.table');
        if (!$token) return redirect()->route('forbidden');

        $team = Team::find(1);
        $users = $team->users()->paginate(4);

        //Check if the table has filters
        $filters = false;
        $isActiveFilters = $request->query('filter');
        if ($isActiveFilters) {
            $users = $team->users;
            $filters = true;
            $users = $this->filterData($users,$request);
        }


        return view('dashboard',[
            'users' => $users,
            'filters' => $filters
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

    private function filterData($users,$request){
        $filterValues = $request->all();
        $filterKeys = array_keys($filterValues);
        foreach($filterKeys as $filterKey){
            if ($filterKey == 'score'){
                return $this->filterScore($users, $filterKey, $request);
            }
            if ($filterKey == 'text'){
                return $this->filterText($users, $filterKey, $request);
            }
        }
    }

    private function filterScore($users, $filterKey, $request){
        $filteredUsers = new Collection();
        foreach ($users as $user){
            if ($user->exam){
                if ($request->query($filterKey) == 'excellent'){
                    if ($user->exam->score >= 80){
                        $filteredUsers[] = $user;
                    }
                }
                if ($request->query($filterKey) == 'regular'){
                    if ($user->exam->score >= 60 && $user->exam->score <= 79){
                        $filteredUsers[] = $user;
                    }
                }
                if ($request->query($filterKey) == 'bad'){
                    if ($user->exam->score >= 0 && $user->exam->score <= 59){
                        $filteredUsers[] = $user;
                    }
                }
            }
        }
        return $filteredUsers;
    }

    private function filterText($users, $filterKey, $request){

        $filteredEmail = $users->where('email', $request->query($filterKey));
        if (count($filteredEmail) > 0) return $filteredEmail;

        $filteredName = $users->where('name', $request->query($filterKey));
        if (count($filteredName) > 0) return $filteredName;

        return [];

    }
}
