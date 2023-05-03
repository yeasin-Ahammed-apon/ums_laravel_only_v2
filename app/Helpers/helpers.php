<?php
if (! function_exists('fmassage')) {
    function fmassage($title = '',$text = '',$icon ='')
    {
        return session()->flash('alert',[
            'title' => $title,
            'text' => $text,
            'icon' => $icon,
        ]);
    }
}
if (! function_exists('validationError')) {
    function validationError($name,$message)
    {
        if ($message->has($name)) {
            return '<div class="text-danger">' . $message->first($name) . '</div>';
        }
        return '';
    }
}
