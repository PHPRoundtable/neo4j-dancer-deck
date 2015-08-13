<?php namespace DancerDeck\Http\Controllers\Auth;

use DancerDeck\Http\Controllers\BaseFrontEndController;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends BaseFrontEndController
{
    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');

        parent::__construct();
    }
}
