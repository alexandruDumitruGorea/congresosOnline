<?php

namespace App\Http\Controllers;

use App\Organizator;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class OrganizatorController extends Controller
{
    
    use RegistersUsers;
    
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('privilege');
        $this->middleware('menssages');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizators = User::where('id_privilege', 2)->paginate(3);
        
        return view('admin.organizator.index')->with(['organizators' => $organizators]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.organizator.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->createUser($request->all())));
        $request->session()->flash('op', 'registered');
        try {
            $this->registered($request, $user);
            $user->markEmailAsVerified();
            $request->session()->flash('op', 'createOrganizator');
        } catch(\Exception $e) {
            $request->session()->flash('op', 'errorCreateOrganizator');
            return redirect(route('organizator.create'))->withInput();
        }
        return redirect(route('organizator.index'));
    }
    
    private function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    private function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make('12345678'),
            'id_privilege' => 2,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organizator  $organizator
     * @return \Illuminate\Http\Response
     */
    public function show(Organizator $organizator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organizator  $organizator
     * @return \Illuminate\Http\Response
     */
    public function edit(Organizator $organizator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organizator  $organizator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organizator $organizator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organizator  $organizator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organizator $organizator)
    {
        //
    }
}
