<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller{

  use AuthenticatesUsers;


  protected $redirectTo = '/';


  public function __construct(){
      $this->middleware('guest', ['except' => 'logout']);
  }

  protected function validator(array $data){
    return Validator::make($data, [
      'name' => 'required|max:255',
      'email' => 'required|email|max:255|unique:users',
      'password' => 'required|confirmed|min:6'
    ]);
  }

  public function getLogin(){
    return view('auth.login');
  }

  public function getRegister(){
    return view('auth.register');
  }

}
