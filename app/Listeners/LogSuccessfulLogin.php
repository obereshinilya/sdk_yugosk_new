<?php

namespace App\Listeners;

use App\Models\Logs;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;

class   LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Logs $logs)
    {
        $this->Logs = $logs;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
     //   $user = LoginController::username();
//        $post = new Logs(array(
//            'description' => 'Пользователь вышел123 из системы',
//          'username' =>  $this->request->input('name'),
//          'ip' => $this->request->ip()
//        ));
//        $post->save();
        $this->Logs->setLogInLog();
    }


}
