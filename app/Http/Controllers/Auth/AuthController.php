<?php
    
    namespace App\Http\Controllers\Auth;
    
    use Auth;
    use App\User;
    use Validator;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Foundation\Auth\ThrottlesLogins;
    use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
    use Carbon\Carbon;
    
    class AuthController extends Controller
    {
        
        /*
        |--------------------------------------------------------------------------
        | Registration & Login Controller
        |--------------------------------------------------------------------------
        |
        | This controller handles the registration of new users, as well as the
        | authentication of existing users. By default, this controller uses
        | a simple trait to add these behaviors. Why don't you explore it?
        |
        */
        
        use AuthenticatesAndRegistersUsers, ThrottlesLogins;
        
        protected $redirectPath = '/admin';
        
        /**
         * Create a new authentication controller instance.
         *
         * @return void
         */
        public function __construct()
        {
            $this->middleware('guest', ['except' => 'getLogout']);
        }
        
        /**
         * Get a validator for an incoming registration request.
         *
         * @param  array $data
         *
         * @return \Illuminate\Contracts\Validation\Validator
         */
        protected function validator(array $data)
        {
            return Validator::make($data, [
                'firstName' => 'required|max:50|min:2',
                'lastName'  => 'required|max:50|min:2',
                'email'     => 'required|email|max:255|unique:users',
                'password'  => 'required|confirmed|min:6',
            ]);
        }
        
        public function postLogin(Request $request)
        {
            $this->validate($request, [
                $this->loginUsername() => 'required',
                'password'             => 'required',
            ]);
            
            // If the class is using the ThrottlesLogins trait, we can automatically throttle
            // the login attempts for this application. We'll key this by the username and
            // the IP address of the client making these requests into this application.
            $throttles = $this->isUsingThrottlesLoginsTrait();
            
            if ($throttles && $this->hasTooManyLoginAttempts($request)) {
                return $this->sendLockoutResponse($request);
            }
            
            $credentials = $this->getCredentials($request);
            
            if (Auth::attempt($credentials, $request->has('remember'))) {
                
                $user = Auth::user();
                if ($user->status == 1) {
                    /*
                     * user is active
                     */
                    $this->handleUserWasAuthenticated($request, $throttles);
                    
                    $user->lastLogin = Carbon::now();
                    $user->save();
                    /*
                     * Redirect user based on user type
                     */
                    if ($user->type == 'Admin') {
                        return redirect('admin/book/list');
                        
                    } elseif ($user->type == 'Member') {
                        return redirect('/');
                    }
                    
                } else {
                    
                    Auth::logout();
                    
                    return redirect($this->loginPath())
                        ->withInput($request->only($this->loginUsername(), 'remember'))
                        ->withErrors([
                            $this->loginUsername() => 'This user account is inactive!',
                        ]);
                    
                }
            }
            
            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            if ($throttles) {
                $this->incrementLoginAttempts($request);
            }
            
            return redirect($this->loginPath())
                ->withInput($request->only($this->loginUsername(), 'remember'))
                ->withErrors([
                    $this->loginUsername() => $this->getFailedLoginMessage(),
                ]);
        }
        
        /**
         * Create a new user instance after a valid registration.
         *
         * @param  array $data
         *
         * @return User
         */
        protected function create(array $data)
        {
            return User::create([
                'firstName'   => $data['firstName'],
                'lastName'    => $data['lastName'],
                'gender'      => $data['gender'],
                'dateOfBirth' => date('Y-m-d', strtotime($data['dateOfBirth'])),
                'status'      => USER_STATUS_ACTIVE,
                'type'        => USER_TYPE_MEMBER,
                'email'       => $data['email'],
                'lastLogin'   => Carbon::now(),
                'password'    => bcrypt($data['password']),
            ]);
        }
        
        
        /**
         * @param Request $request
         *
         * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
         *
         * @since  vx.x.x
         * @author Ariful Haque <arifulhb@gmail.com>
         */
        public function postRegister(Request $request)
        {
            
            $validator = $this->validator($request->all());
            
            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }
            
            Auth::login($this->create($request->all()));
            
            return redirect('/');
        }
    }
