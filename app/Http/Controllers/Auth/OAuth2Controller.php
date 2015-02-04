<?php namespace Deck\Http\Controllers\Auth;

use Deck\Http\Controllers\Controller;
use Laravel\Socialite\Contracts\Factory;
use Laravel\Socialite\Two\AbstractProvider;

class OAuth2Controller extends Controller {

	/**
	 * @var AbstractProvider
	 */
	protected $facebook;

	public function __construct(Factory $socialize)
	{
		$this->facebook = $socialize->driver('facebook');
	}

	public function facebookAuthorize()
	{
		return $this->facebook->scopes(['email'])->redirect();
	}

	public function facebookCallback()
	{
		$user = $this->facebook->user();

		dd($user);
	}

}
