<?php namespace DancerDeck\Facebook;

use Illuminate\Session\Store as Session;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
use SammyK\FacebookQueryBuilder\FQB;
use Facebook\Exceptions\FacebookSDKException;

class FacebookService
{
    /**
     * @const string The name of the access token key in the session.
     */
    const ACCESS_TOKEN = 'fb_user_access_token';

    /**
     * @var LaravelFacebookSdk
     */
    protected $fb;

    /**
     * @var FQB
     */
    protected $fqb;

    public function __construct(LaravelFacebookSdk $fb, FQB $fqb, Session $session)
    {
        $this->fb = $fb;
        $this->fqb = $fqb;

        $this->setFallbackAccessToken($session);
    }

    /**
     * Get an event node from Facebook.
     *
     * @param string $eventId
     *
     * @return \Facebook\GraphNodes\GraphEvent
     */
    public function getEvent($eventId)
    {
        $pictureEdge = $this->fqb
                    ->edge('picture')
                    ->fields('url')
                    ->modifiers(['type' => 'large']);

        $request = $this->fqb->node($eventId)
                       ->fields([
                         'id','name','description','start_time','end_time',
                         'owner','parent_group','place','ticket_uri','timezone',
                         'updated_time', $pictureEdge
                       ]);

        try {
            $response = $this->fb->get($request->asEndpoint());
        } catch (FacebookSDKException $e) {
            dd($e->getMessage());
        }

        return $response->getGraphEvent();
    }

    /**
     * @param Session $session
     */
    private function setFallbackAccessToken(Session $session)
    {
        $token = $session->get(static::ACCESS_TOKEN);
        if ($token) {
            $this->fb->setDefaultAccessToken($token);
        }
    }
}
