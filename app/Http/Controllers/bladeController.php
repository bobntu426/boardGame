<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class bladeController
{
    public function home(){
        return view(view: 'home');
    }
}
