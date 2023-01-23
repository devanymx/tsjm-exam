<?php

namespace App\Imports;

use App\Models\Question;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $team = Team::find(1);
        $types = [
            'penal' => '1',
            'civil' => '2',
            'extincion' => '3'
        ];
        foreach ($rows as $row)
        {
            $user = User::create([
                'name' => $row[1],
                'email' => $row[0],
                'password' => Hash::make($row[2]),
                'email_verified_at' => now(),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'remember_token' => Str::random(10),
                'profile_photo_path' => null,
                'current_team_id' => 1,
                'type' => $types[$row[5]],
            ]);
            $user->save();
            $user->teams()->attach($team, ['role' => 'user']);
        }
    }
}
