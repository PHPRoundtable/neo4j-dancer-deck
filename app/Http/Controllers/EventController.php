<?php namespace DancerDeck\Http\Controllers;

use Illuminate\View\View;

class EventController extends BaseFrontEndController
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return View
     */
    public function browse()
    {
        return view('event-browse');
    }

    /**
     * @return View
     */
    public function show()
    {
        return view('event-show');
    }
}
