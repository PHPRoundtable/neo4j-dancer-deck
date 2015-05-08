<?php namespace DancerDeck\Services;

use Illuminate\Session\Store as Session;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
use Facebook\Exceptions\FacebookSDKException;

class FacebookNode
{
    /**
     * @var LaravelFacebookSdk
     */
    protected $fb;

    public function __construct(LaravelFacebookSdk $fb, Session $session)
    {
        $this->fb = $fb;

        $this->setFallbackAccessToken($session);
    }

    /**
     * Get an event node from Facebook.
     *
     * @param string $eventId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getEvent($eventId)
    {
        try {
            $response = $this->fb->get('/'.$eventId.'?fields=id,name,description,start_time,end_time,picture.type(large){url},owner,parent_group,place,ticket_uri,timezone,updated_time');
        } catch (FacebookSDKException $e) {
            dd($e->getMessage());
        }

        $node = $response->getGraphObject();
    }

    /**
     * @param Session $session
     */
    private function setFallbackAccessToken(Session $session)
    {
        $token = $session->get('fb_user_access_token');
        if ($token) {
            $this->fb->setDefaultAccessToken($token);
        }
    }
}
