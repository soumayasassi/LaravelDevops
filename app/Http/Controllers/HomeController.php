<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function  index()
  {
      return view("welcome") ;
  }

    public function  welcome()
    {
        return response('Bonjour 5TWIN') ;
    }
    public function show()
    { $msg  = "Hello 5TWIN4" ;
return view('show', ["message"=>$msg]) ;
    }

    public function  trimstring()
    {
return view('trimstring');
    }

}
