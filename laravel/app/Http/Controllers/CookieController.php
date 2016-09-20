<?php

namespace testmiguel\Http\Controllers;

use Illuminate\Http\Request;
use testmiguel\Http\Requests;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    public function setCookie(Request $request){
      $minutes = 1;
      $response = new Response('Hello World Cookie');
      $response->withCookie(cookie('name', 'virat', $minutes));
      $response->withCookie(cookie()->forever('infi', 'infini'));
      return $response;
   }
   public function getCookie(Request $request){
      $value = $request->cookie('name');
      echo "<br> " . $value;

      echo "<br> " . $request->cookie('infi');
   }
}
