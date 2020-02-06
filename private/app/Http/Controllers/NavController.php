<?php

namespace App\Http\Controllers;

use App\Presentation;

use Illuminate\Support\Facades\Auth;

use App\AssistantPresentation;

use App\User;

class NavController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['adminIndex']);
        $this->middleware('privilege')->only(['adminIndex']);
        $this->middleware('menssages');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $datos = [];
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->id_privilege === 4) {
                // $yourPresentations = AssistantPresentation::where('id_assistant', $user->id)->get();
                $yourPresentations = AssistantPresentation::where('id_assistant', $user->id)->paginate(3);
                if($yourPresentations->isEmpty()) {
                    $yourPresentations = null;
                }
            }
            if ($user->id_privilege === 3) {
                $yourPresentations = Presentation::where('id_speaker', $user->id)->paginate(3);
            }
            if ($user->id_privilege <= 2) {
                $yourPresentations = null;
            }
            $datos += [
                'yourPresentations' => $yourPresentations,
                'userPrivilege' => $user->id_privilege,
            ];
        }
        // $presentations = Presentation::all();
        $presentations = Presentation::paginate(3);
        $speakers = User::where('id_privilege', 3)->paginate(3);
        $datos += [
            'presentations' => $presentations,
            'speakers' => $speakers,
            'yourPresentations' => null,
            'userPrivilege' => null,
        ];
        return view('index')->with($datos);
    }
    
    public function adminIndex() {
        return view('admin.index');
    }
}