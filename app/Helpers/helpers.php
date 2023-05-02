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
