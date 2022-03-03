<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Notification extends Model
{   
    
    use Notifiable;  

    static $rules = [
    ];

    protected $perPage = 20;

    protected $fillable = ['name','user_id','token_bot'];

    public function routeNotificationForTelegram()
    {
        return $this->user_id;     
    } 


    

}
