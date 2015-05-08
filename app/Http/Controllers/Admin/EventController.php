<?php namespace DancerDeck\Http\Controllers\Admin;

use DancerDeck\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
use Facebook\Exceptions\FacebookSDKException;

class EventController extends AbstractController
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin/event-index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        dd(__FUNCTION__);
    }

    /**
     * Import a new event from Facebook.
     *
     * @param LaravelFacebookSdk $fb
     *
     * @return Response
     */
    public function import(LaravelFacebookSdk $fb)
    {
        $token = \Session::get('fb_user_access_token');
        $fb->setDefaultAccessToken($token);

        $eventId = '848252565231486';
        try {
            $response = $fb->get('/'.$eventId.'?fields=id,name,description,start_time,end_time,picture.type(large){url},owner,parent_group,place,ticket_uri,timezone,updated_time');
        } catch (FacebookSDKException $e) {
            dd($e->getMessage());
        }

        $node = $response->getGraphObject();

        dd($node);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        dd(__FUNCTION__);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        dd(__FUNCTION__, $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        dd(__FUNCTION__, $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        dd(__FUNCTION__, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        dd(__FUNCTION__, $id);
    }
}
