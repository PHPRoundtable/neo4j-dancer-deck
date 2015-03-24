<?php namespace Deck\Http\Controllers;

class WelcomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('welcome');
    }
}
