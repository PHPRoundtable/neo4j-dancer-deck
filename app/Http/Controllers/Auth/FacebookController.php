<?php namespace DancerDeck\Http\Controllers\Auth;

use DancerDeck\Http\Controllers\BaseFrontEndController;
use DancerDeck\Facebook\FacebookUserNodeImporter;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
use Facebook\Exceptions\FacebookSDKException;

class FacebookController extends BaseFrontEndController
{
    /**
     * @var LaravelFacebookSdk
     */
    protected $fb;

    public function __construct(LaravelFacebookSdk $fb)
    {
        $this->fb = $fb;

        parent::__construct();
    }

    public function authorize()
    {
        $loginUrl = $this->fb->getLoginUrl(['email']);

        return redirect($loginUrl);
    }

    public function callback(FacebookUserNodeImporter $facebookNodeManager)
    {
        // Obtain an access token.
        try {
            $token = $this->fb->getAccessTokenFromRedirect();
        } catch (FacebookSDKException $e) {
            dd($e->getMessage());
        }

        // Access token will be null if the user denied the request
        // or if someone just hit this URL outside of the OAuth flow.
        if (!$token) {
            // Get the redirect helper
            $helper = $this->fb->getRedirectLoginHelper();

            if (!$helper->getError()) {
                abort(403, 'Unauthorized action.');
            }

            // User denied the request
            dd($helper->getError());
            /*
            dd(
              $helper->getError(),
              $helper->getErrorCode(),
              $helper->getErrorReason(),
              $helper->getErrorDescription()
            );
            */
        }

        if (!$token->isLongLived()) {
            // OAuth 2.0 client handler
            $oauthClient = $this->fb->getOAuth2Client();

            // Extend the access token.
            try {
                $token = $oauthClient->getLongLivedAccessToken($token);
            } catch (FacebookSDKException $e) {
                dd($e->getMessage());
            }
        }

        $this->fb->setDefaultAccessToken($token);

        // Save for later
        \Session::put('fb_user_access_token', (string)$token);

        // @todo Check permissions to make sure we have access to their email address (required)

        // Get basic info on the user from Facebook.
        try {
            $response = $this->fb->get('/me?fields=id,first_name,last_name,name,email,locale');
        } catch (FacebookSDKException $e) {
            dd($e->getMessage());
        }

        // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
        $facebookUser = $response->getGraphUser();

        if (!$foundUser = $facebookNodeManager->findNode($facebookUser)) {
            $user = $facebookNodeManager->createNode($facebookUser);
        } else {
            $user = $facebookNodeManager->updateNode($foundUser, $facebookUser);
        }

        // Log the user into Laravel
        \Auth::login($user);

        return redirect('/')->with('message', 'Successfully logged in with Facebook');
    }
}
