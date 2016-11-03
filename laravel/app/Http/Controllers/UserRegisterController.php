<?php

namespace testmiguel\Http\Controllers;

use Illuminate\Http\Request;

use testmiguel\CountryState;
use testmiguel\Http\Requests;
use DB;
use Hash;


use testmiguel\User;

class UserRegisterController extends Controller
{

    public function indexRegister()
    {
        return $this->redirectToLogin();
    }

    public function redirectToLogin()
    {
        $countryListName = CountryState::all()->pluck('name');
        $countryListName->prepend("ninguno");
        return view('login', ['stateList' => $countryListName]);
    }

    public function redirectToLoginPayment($email)
    {
        $countryListName = CountryState::all()->pluck('name');
        $countryListName->prepend("ninguno");
        return view('login', ['stateList' => $countryListName, 'email' => $email]);
    }

    public function postRegister(Request $request)
    {
        //Retrieve country state input field
        $countryListName = CountryState::all()->pluck('name');
        $countryListName->prepend("ninguno");

        $state = $request->input('state');
        echo 'State: ' . $state;
        echo '<br>';

        if ($state == '0') {
            echo 'must selecet a state';
            echo '<br>';
            return;
        }

        $stateSelected = $countryListName->get($state);
        if ($stateSelected == '') {
            echo 'must select a state';
            return;
        } else {
            echo $stateSelected;
            echo '<br>';
        }

        //Retrieve the country input field
        $country = $request->input('country');
        echo 'Country: ' . $country;
        echo '<br>';

        //Retrieve the $cellphone input field
        $cellphone = $request->input('cellphone');
        echo 'Cellphone: ' . $cellphone;
        echo '<br>';

        //Retrieve the name input field
        $name = $request->input('name');
        echo 'Name: ' . $name;
        echo '<br>';

        //Retrieve the username input field
        $lastname = $request->lastname;
        echo 'Username: ' . $lastname;
        echo '<br>';

        $address = $request->address;
        echo 'address: ' . $address;
        echo '<br>';

        $email = $request->email;
        echo 'email: ' . $email;
        echo '<br>';

        //Retrieve the password input field
        $password = $request->password;
        echo 'Password: ' . $password;
        echo '<br>';

        $password = Hash::make($password);

        $user = new User;
        $user->lastname = $lastname;
        $user->address = $address;
        $user->email = $email;
        $user->password = $password;
        $user->name = $name;
        $user->cellphone = $cellphone;
        $user->country = $country;
        $user->country_state = $stateSelected;
        $user->save();
        //DB::insert('insert into storeuser (name,lastname,address,email,password) values(?,?,?,?,?)',[$name,$lastname,$address,$email,$password]);


        echo "user registered";

    }

    public function insertTest(Request $request)
    {

        $user = new User;
        $user->name = "miguel";
        $lastname = "flores";
        $user->address = "bogota";
        $user->email = "miguel@abc.com";
        $user->password = Hash::make("123456");

        /*$name = "miguel";
        $lastname = "flores";
        $address = "bogota";
        $email = "miguel@abc.com";
        $password = Hash::make("123456");
        DB::insert('insert into storeuser (name,lastname,address,email,password) values(?,?,?,?,?)',[$name,$lastname,$address,$email,$password]);*/
        $user->save();
        echo "test insert db";
    }

}
