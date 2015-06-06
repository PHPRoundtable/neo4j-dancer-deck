<?php namespace DancerDeck\Http\Controllers;

use Illuminate\View\View;
use DancerDeck\Facebook\FacebookUserNodeImporter;
use Facebook\GraphNodes\GraphUser;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return View
     */
    public function index(FacebookUserNodeImporter $facebookNodeManager)
    {
        /*
        $graphUser = new GraphUser([
            'id' => '12345',
            'name' => 'Bar Facebook User',
            'locale' => 'en-gb',
        ]);

        $inDb = true;
        if (!$foundUser = $facebookNodeManager->findNode($graphUser)) {
            $user = $facebookNodeManager->createNode($graphUser);
            $inDb=false;
        } else {
            $user = $facebookNodeManager->updateNode($foundUser, $graphUser);
        }
        dd($inDb, $graphUser, $foundUser, $user);
        */

        return view('index');
    }
}
