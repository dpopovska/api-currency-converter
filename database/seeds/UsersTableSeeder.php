<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'first_name' => 'Dijana',
            'last_name' => 'Popovska',
            'password' => bcrypt('dijana1234'),
            'email' => 'najdovskadijana@gmail.com',
            'last_login_at' => Carbon::now()->minute(0)->second(0)->toDateTimeString(),
        ]);
    }
}
