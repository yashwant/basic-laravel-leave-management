<?php

class UsersController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Login User
     *
     * @return Response
     */
    public function login()
    {
        return View::make('users.login');
    }

    /**
     * Logout User
     *
     * @return Response
     */
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return Redirect::route('login');
    }

    /**
     * Login Handle
     *
     * @return Response
     */
    public function handleLogin()
    {
        $data = Input::only(['email', 'password']);

        $validator = Validator::make(
                        $data, [
                    'email' => 'required|email|min:8',
                    'password' => 'required',
                        ]
        );

        if ($validator->fails()) {
            return Redirect::route('login')->withErrors($validator)->withInput();
        }
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return Redirect::to('/profile');
        }

        return Redirect::route('login')->withInput();
    }

    /**
     * User Profile
     *
     * @return Response
     */
    public function profile()
    {
        return View::make('users.profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return View::make('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $data = Input::only(['first_name', 'last_name', 'email', 'password', 'password_confirmation']);

        $validator = Validator::make(
                        $data, [
                    'first_name' => 'required|min:2',
                    'last_name' => 'required|min:2',
                    'email' => 'required|email|unique:users,email|min:5',
                    'password' => 'required|min:5|confirmed',
                    'password_confirmation' => 'required|min:5'
                        ]
        );

        if ($validator->fails()) {
            return Redirect::route('user.create')->withErrors($validator)->withInput();
        }
        $password = Input::get('password_confirmation');
        $hashed = Hash::make($password);
        $data['password'] = $hashed;

//        echo '<pre>';        var_dump($data); exit();
        $newUser = User::create($data);
        if ($newUser) {
            Auth::login($newUser);
            return Redirect::route('profile');
        }

        return Redirect::route('user.create')->withInput();
    }

}
