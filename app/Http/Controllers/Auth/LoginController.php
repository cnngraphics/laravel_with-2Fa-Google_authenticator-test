<?php
declare(strict_types=1);


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Sonata\src\GoogleAuthenticator;

include_once __DIR__.'/../src/FixedBitNotation.php';
include_once __DIR__.'/../src/GoogleAuthenticator.php';
include_once __DIR__.'/../src/GoogleQrUrl.php';


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function setG2FA (){
                
        
        

        $secret = 'XVQ2UIGO75XRUKJO';
        $code = '846474';

        $g = new GoogleAuthenticator();

        echo 'Current Code is: ';
        echo $g->getCode($secret);

        echo "\n";

        echo "Check if $code is valid: ";

        if ($g->checkCode($secret, $code)) {
            echo "YES \n";
        } else {
            echo "NO \n";
        }

        $secret = $g->generateSecret();
        echo "Get a new Secret: $secret \n";
        echo "The QR Code for this secret (to scan with the Google Authenticator App: \n";

        echo \Sonata\GoogleAuthenticator\GoogleQrUrl::generate('chregu', $secret, 'GoogleAuthenticatorExample');
        echo "\n";

    }
}
