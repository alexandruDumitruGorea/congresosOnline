<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

use App\AssistantPresentation;
use App\Presentation;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function register(Request $request)
    {
        $request->session()->put('from_register', true);
        $id_presentation = $request->session()->get('id_presentation');
        $presentation = Presentation::where('id', $id_presentation)->get();
        // $request->session()->forget('id_presentation');
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $request->session()->flash('op', 'registered');
        $id_assistant = $user->id;
        $request->session()->put('id_assistant', $id_assistant);
        // $dataAsistant = [
        //     'id_assistant' => $id_assistant,
        //     'id_presentation' => $id_presentation,
        // ];
        // $assistant_presentation = new AssistantPresentation($dataAsistant);
        // $assistant_presentation->save();
        // return $this->registered($request, $user) ?: redirect($this->redirectPath());
        $datos = [
            'presentation' => $presentation,
            'request' => $request,
        ];
        // return view('user.assist.download')->with($datos);
        return view('user.assist.create')->with($datos);
        // return redirect(url('download'))->with(['id_presentation' => $id_presentation]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id_privilege' => 4,
        ]);
    }
}
