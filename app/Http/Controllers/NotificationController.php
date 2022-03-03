<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\LaravelTelegramNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Notification;
use App\Models\User;


class NotificationController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $token_bot_new = "global";
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    { 
        return Validator::make($data, [        
            'user_id' => ['required', 'string', 'max:255'],       
        ]);        
    }


    
    
    public function index()
    {
        $notifications = Notification::paginate();

        return view('notification.index', compact('notifications'))
            ->with('i', (request()->input('page', 1) - 1) * $notifications->perPage());
    }

   
    
    public function create()
    {
        $notification = new Notification();
        return view('notification.create', compact('notification'));       
         
    }

    
    
    public function store(Request $request)
    {    //request()->validate(Notification::$rules);
        //$notification = Notification::create($request->all());
        $name_telegram="";        
        $user_id_telegram=""; 
        $token_bot=""; 

        $user_telegram = User::where("user_id",$request->get('user_id'))->get(); 
        foreach ($user_telegram as $key => $user) {
            // dd($user->name."--".$user->email."--".$user->user_id."--".$user->token_bot);
            $name_telegram = $user->name;        
            $user_id_telegram = $user->user_id;
            $token_bot = $user->token_bot;
         }
        /* $name_telegram="Carlitos jejeje";        
        $user_id_telegram=$request->get('user_id');
        $token_bot = $request->get('token_bot'); */
        config(['telegram.bot_token'=>$token_bot]);         

        $notification = Notification::create([
            'name' => $name_telegram,
            'user_id' => $user_id_telegram,
            'token_bot' => $token_bot,
        ]); 

        $texto="$name_telegram "."Se le Asigno un servicio \n"
        . "Respnsable: $notification->id\n"        
        . "$user_id_telegram\n"
        . "$token_bot\n"
        . "https://gem.9once.mx/";     
        $notification->notify(new LaravelTelegramNotification([        
            'text' =>  $texto      
        ]));  


        //dd($request->get('id')."=".$request->get('name')."=".$request->get('user_id')."=".$request->get('token_bot'));
        //dd($notification->id."=".$notification->name."=");

       /*  $token_bot = $notification->token_bot;
        config(['telegram.bot_token'=>$token_bot]);    */
       /*  $texto="$notification->name "."Se le Asigno un servicio \n"
        . "Respnsable: $notification->id\n"        
        . "$notification->user_id\n"
        . "$$notification->token_bot\n"
        . "https://gem.9once.mx/";     
        $notification->notify(new LaravelTelegramNotification([        
            'text' =>  $texto      
        ]));  
 */
        return redirect()->route('notifications.index')
            ->with('success', 'Notification created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = Notification::find($id);

        return view('notification.show', compact('notification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notification = Notification::find($id);

        return view('notification.edit', compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        request()->validate(Notification::$rules);

        $notification->update($request->all());

        return redirect()->route('notifications.index')
            ->with('success', 'Notification updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $notification = Notification::find($id)->delete();

        return redirect()->route('notifications.index')
            ->with('success', 'Notification deleted successfully');
    }
}
