<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            'emy',
            'mario',
            'admin',
            'emma',
            'marco'
        ];

        foreach ($users as $user) {
            $new_user = new User();
            $new_user->name = $user;
            $new_user->email = $user . '@' . $user . '.it';
            $new_user->password= Hash::make('12345678');
            $new_user->save();
        }
    }
}
