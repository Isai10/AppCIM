<?php
use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Usuario alumno
        $user = new User();
        $user->name = "Betillo Tovar Martinez";
        $user->email = "betillo@mail.com";
        $user->password =  Hash::make('12345678');
        $user->save();
        $user->roles()->attach(Role::where ('nombre','alumno')->first());
        //Usuario profesor
        $user = new User();
        $user->name = "Luz Adriana Tovar Martinez";
        $user->email = "luz@mail.com";
        $user->password =  Hash::make('12345678');
        $user->save();
        $user->roles()->attach(Role::where ('nombre','profesor')->first());
        //Usuario admin
        $user = new User();
        $user->name = "German Isai Tovar Martinez";
        $user->email = "isai@mail.com";
        $user->password =  Hash::make('12345678');
        $user->save();
        $user->roles()->attach(Role::where ('nombre','admin')->first());
    }
}
