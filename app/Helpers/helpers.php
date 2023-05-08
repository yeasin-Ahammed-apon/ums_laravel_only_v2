<?php
//flash massage

use App\Models\EmployeesNotification;
use Illuminate\Support\Facades\Auth;

if (! function_exists('fmassage')) {
    function fmassage($title = '',$text = '',$icon =''){
        return session()->flash('alert',[
            'title' => $title,
            'text' => $text,
            'icon' => $icon,
        ]);
    }
}
// blade form validation error message showing
if (! function_exists('validationError')) {
    function validationError($name,$message){
        if ($message->has($name)) {
            return '<div class="text-danger">' . $message->first($name) . '</div>';
        }
        return '';
    }
}
//employees notifications notification
if (! function_exists('Enotifications')) {
    // dd(Auth::user()->role->name);
    function Enotifications($action,$description){
        $notification = new EmployeesNotification();
        $notification->user_id = Auth::user()->id;
        $notification->role = Auth::user()->role->name;
        $notification->action = $action;
        $notification->description = $description;
        $notification->save();

    }
}
