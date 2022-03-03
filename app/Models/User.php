<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
   /* use HasApiTokens, HasFactory, Notifiable;

    
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];*/
	
	  use Notifiable;


    protected $fillable = [
        'name', 'email', 'password', 'user_id', 'token_bot'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


     public function routeNotificationForTelegram()
    {
        /*  $idtelegram= config('telegram.bot_id');
        $users = User::where("user_id",$idtelegram)->get();
        $texto="";
       foreach ($users as $key => $user) {
          //config(['telegram.bot_id'=>$user->user_id]);
           //config(['telegram.bot_token'=>$user->token_bot]);
           $texto=$user->user_id;

       } */
      
      // dd(config('telegram.bot_id'));
        return $this->user_id;
       
       
    } 
    
}
