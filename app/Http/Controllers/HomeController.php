<?php namespace DancerDeck\Http\Controllers;

use Illuminate\View\View;
use DancerDeck\Facebook\FacebookUserNodeImporter;
use Facebook\GraphNodes\GraphUser;

class HomeController extends BaseFrontEndController
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        parent::__construct();
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
        $this->setOpenGraphTags(
          trans('share.home.facebook.title'),
          trans('share.home.facebook.description')
        );

        return view('index');
    }

    /**
     * Static pages
     *
     * @param string $page
     *
     * @return View
     */
    public function staticPage($page)
    {
        switch ($page)
        {
            case 'about':
                $this->setTitle('All about Dancer Deck');
                $this->setOpenGraphTags(
                  'All about Dancer Deck',
                  'All your dance event management in one place.'
                );
                break;
            case 'contact':
                $this->setTitle('Contact');
                $this->setOpenGraphTags(
                  'Contact Dancer Deck',
                  'Get in touch!'
                );
                break;
            case 'privacy':
                $this->setTitle('Privacy Policy');
                $this->setOpenGraphTags(
                  'Privacy Policy',
                  'The Dancer Deck privacy policy.'
                );
                break;
        }

        $this->globalViewVars->page = $page;

        return view($page);
    }
}
