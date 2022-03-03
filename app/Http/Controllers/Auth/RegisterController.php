<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\LaravelTelegramNotification;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class RegisterController extends Controller
{
   

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;
    protected $token_bot_new = "global";

    public function __construct()
    {
        $this->middleware('guest');
    }

    /*     protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    } */

    protected function validator(array $data)
{
/*      return Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'user_id' => ['required', 'string', 'max:255'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);  */
    return Validator::make($data, [        
        'user_id' => ['required', 'string', 'max:255'],       
    ]); 

    
}

/* protected function create(array $data)
{
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'user_id' => $data['user_id'],
        'password' => Hash::make($data['password']),
    ]);
    $user->notify(new LaravelTelegramNotification([
        'text' => "Welcome to the application " . $user->name . "!"
    ]));

    return  $user;
} */


protected function create(array $data)
 {
   
       $user = User::create([
         'name' => $data['name'],
         'email' => $data['email'],
         'user_id' => $data['user_id'],
         'token_bot' => $data['token_bot'],
         'password' => Hash::make($data['password']),
     ]); 

/*      $idtelegram= $data['user_id'];
     config(['telegram.bot_token'=> $idtelegram]);

     $users = User::where("user_id",$idtelegram)->get();
     $texto="";
    foreach ($users as $key => $user) {
       // dd($user->name."--".$user->email."--".$user->user_id."--".$user->token_bot);
       //$token_bot = $data['token_bot'];
        //config(['telegram.bot_id'=>$user->user_id]);
        //config(['telegram.bot_token'=>$user->token_bot]);   

     $texto="$user->name "."Se le Asigno un servicio \n"
     . "Respnsable: \n"
     . "$user->name\n"
     . "Correo: \n"
     . "$user->token_bot\n"
     . "https://gem.9once.mx/";
    } */
     
     
     $token_bot = $data['token_bot'];
     config(['telegram.bot_token'=>$token_bot]);     
    /// $id_bot = $data['user_id'];
     ///config(['bot_id'=>$id_bot]);
/*       $token_bot = $users->token_bot;
     config(['telegram.bot_token'=>$token_bot]); */

     $texto="$user->name "."Se le Asigno un servicio \n"
     . "Respnsable: \n"
     . "$user->name\n"
     . "Correo: \n"
     . "$user->token_bot\n"
     . "https://gem.9once.mx/";  

     

     // $user->notify(new LaravelTelegramNotification([        
        // 'text' =>  $texto         
         /* 'latitude' => '14.820100',
         'longitude' => '74.182503',
         'photo' => 'https://codezen.io/wp-content/uploads/2020/03/Telegram-Notifications-In-Laravel.jpg',
         'photo_caption' => 'Telegram Notifications in Laravel' */
    // ])); 
      return  $user;       


 }





}
