<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use \App\User;
use App\Http\Classes\Constants;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->only(['edit', 'update'. 'password']);
        $this->middleware('menssages');
    }

    protected function validator(array $data)
    {
        return Validator::make($data,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'img' => ['nullable'],
        ]);
    }

    protected function passwordValidator(array $data)
    {
        return Validator::make($data,[
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'oldpassword' => ['required', 'string', 'min:8'],
        ]);
    }
    /**
     * Show the form for editing the specified resourse,
     * 
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request) {
        return view('auth.edit');
    }
    
    public function password(Request $request) {
        $this->passwordValidator($request->all())->validate();    
        $oldpassword = $request->input('oldpassword');
        $user = Auth::user();
        if(Hash::check($oldpassword, $user->password))
        {
            $password = $request->input('password');
            $user->password = Hash::make($password);
            $user->save();
            $request->session()->flash('op', 'passwordok');
        }
        else
        {
            $request->session()->flash('op', 'passwordko');
        }
        return redirect(url('user'));
    }

    /**
     * Show the form for editing the specified resourse,
     * 
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $input = $this->validator($request->all())->validate();
        $user = Auth::user();
        $file = $request->file('img');
        if($file !== null) {
            $name= $file->getClientOriginalName();
            $target = Constants::USER_FILE_PATH;
            $file->move($target, $name);
            $user->img = $name;
        }
        try {
            $user->save();
            if ($this->checkEmail($input['email'])) {
            }
        } catch(\Exception $e) {
            $request->session()->flash('op', 'emailExists');
            $error = ['email' => 'Correo duplicado'];
            return redirect('user')->withErrors($error)->withInput();
        }
        $request->session()->flash('op', 'useredit');
        return redirect(url('user'));
    }

    private function checkEmail(string $email) {
        return User::where('email', $email)->first() === null;
    }
    
    public function imagefile($userfile) {
        $user = Auth::user();
        $target = Constants::USER_FILE_PATH;
        $mostrar = $target . 'default.png';
        if(Auth::check()) {
            if (file_exists($target . $userfile)) {
                $mostrar = $target . $user->img;
            }
        }
        return response()->file($mostrar);
    }
    
    public function speakersajax() {
        $speakers = User::where('id_privilege', 3)
                        ->orderBy('id', 'desc')
                        ->get();
        return response()->json(['speakers' => $speakers]);
    }
}
