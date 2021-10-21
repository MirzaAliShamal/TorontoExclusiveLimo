<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('front.home', get_defined_vars());
    }
    public function airportLimo()
    {
        return view('front.airport_limousine', get_defined_vars());
    }
    public function casinoLimo()
    {
        return view('front.casino_limousine', get_defined_vars());
    }
    public function chaufferLimo()
    {
        return view('front.chauffeuring_limousine', get_defined_vars());
    }
    public function childseatLimo()
    {
        return view('front.child_seat', get_defined_vars());
    }
    public function funeralLimo()
    {
        return view('front.funeral_limousine', get_defined_vars());
    }
    public function niaggraLimo()
    {
        return view('front.niagaratour_limousine', get_defined_vars());
    }
    public function nightoutLimo()
    {
        return view('front.nightout_limousine', get_defined_vars());
    }
    public function promLimo()
    {
        return view('front.prom_limousine', get_defined_vars());
    }
}
