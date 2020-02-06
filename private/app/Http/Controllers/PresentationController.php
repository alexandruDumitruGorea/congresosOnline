<?php

namespace App\Http\Controllers;

use App\Presentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\AssistantPresentation;
use App\Http\Requests\PresentationRequest;
use Illuminate\Support\Facades\Auth;

class PresentationController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth')->except(['show']);
        $this->middleware('privilege')->except(['show', 'edit', 'update', 'urlcertificate', 'certificate']);
        $this->middleware('menssages');
    }
    
    protected function validatorUrl(array $data)
    {
        return Validator::make($data,[
            'video_url' => ['required', 'string', 'max:255'],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presentations = Presentation::paginate(3);
        $datos = [
            'presentations' => $presentations,
        ];
        return view('admin.presentation.index')->with($datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $speakers = User::where('id_privilege', '3')->get();
        return view('admin.presentation.create')->with(['speakers' => $speakers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PresentationRequest $request)
    {
        // id_congress asignarlo automáticamente
        $input = $request->validated();
        $presentation = new Presentation($input);
        $presentation['id_congress'] = 1;
        try {
            $presentation->save();
            $request->session()->flash('op', 'createPresentation');
        } catch(\Exception $e) {
            $error = [
                'id_speaker' => 'Tiene que seleccionar un ponente',
            ];
            $request->session()->flash('op', 'errorCreatePresentation');
            return redirect(route('presentation.create'))->withErrors($error)->withInput();
        }
        
        return redirect(route('presentation.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function show(Presentation $presentation, Request $request)
    {
        $datos = [];
        if(Auth::check()) {
            $user = Auth::user();
            $yourPresentation = AssistantPresentation::where(['id_assistant' => $user->id, 'id_presentation' => $presentation->id])->get();
            if($yourPresentation->isEmpty()) {
                $yourPresentation = null;
            }
            $datos += [
                'yourPresentation' => $yourPresentation,
            ];
        }
        $datos += [
            'presentation' => $presentation,
            'request' => $request,
        ];
        return view('user.presentation.show')->with($datos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function edit(Presentation $presentation)
    {
        // ya encargarse de edited
        return view('user.presentation.edit')->with(['presentation' => $presentation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presentation $presentation)
    {
        $input = $this->validatorUrl($request->all())->validate();
        $presentation->video_url = $request->input('video_url');
        // $presentation->video_url = explode("/", $presentation->video_url)[3];
        $presentation->save();
        return redirect(url('/'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presentation $presentation)
    {
        //
    }
    
    public function urlcertificate(string $title) {
        $presentation = Presentation::where('title', $title)->get();
        $url = url('certificate');
        return response()->json(['url' => $url]);
    }
    
    public function certificate(Request $request) {
        $id_presentation = $request->session()->get('id_presentation');
        $request->session()->forget('id_presentation');
        $presentation = Presentation::where('id', $id_presentation)->get();
        $data = [
            'presentation' => $presentation,
        ];
        $pdf = \PDF::loadView('user.presentation.download', $data);
        return $pdf->download(Auth::user()->id . '-' . $id_presentation . '-certificate.pdf');
    }
}
