<?php 
namespace App\Http\Controllers;

use App\User;
use Auth;
use Socialite;
use Debugbar;

class SocialController extends Controller
{

    public function __construct()
    {
    }

    /* Twitter Login */
    public function twitter()
    {

        return Socialite::driver('twitter')->redirect();
    }

    public function twitterAuth()
    {

        $twitter = Socialite::with('twitter')->user();

        $user = User::where('providerid', '=', $twitter->getId())->first();

        if (!$user) {
            $user = new User;
            $user->providerid = $twitter->getId();
            $user->name       = $twitter->getName();
            $user->username   = $twitter->getNickname();
            $user->email      = $twitter->getEmail();
            $user->avatar     = $twitter->getAvatar();
            $user->provider   = 'twitter';
            $user->save();
        }

        Auth::login($user);
        return redirect('/home');



    }

}
