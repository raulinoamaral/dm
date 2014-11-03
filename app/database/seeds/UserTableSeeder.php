<?php 
class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('user')->delete();

        User::create(array(
            'name'      =>  'Federico Maside',
        	'username'  =>  'fmaside',
            'email'     =>  'fmaside@decarlinimaside.com',
            'password'  => Hash::make('decarlinimaside2014')
        	));
        User::create(array(
            'name'      =>  'Ana Decarlini',
            'username'  =>  'adecarlini',
            'email'     =>  'adecarlini@decarlinimaside.com',
            'password'  => Hash::make('decarlinimaside2014')
            ));
        User::create(array(
            'name'      =>  'balloon',
            'username'  =>  'balloon',
            'email'     =>  'hola@balloon.com.uy',
            'password'  => Hash::make('decarlinimaside2014')
            ));
    }
}
?>