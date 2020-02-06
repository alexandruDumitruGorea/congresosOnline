<?php

namespace App\Http\Controllers;

use App\AssistantPresentation;
use Illuminate\Http\Request;
use App\Presentation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Http\Classes\Constants;

class AssistantPresentationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['download', 'store']);
        $this->middleware('menssages');
    }
    
    public function pdffile($pdffile) {
        $target = Constants::PDF_FILE_PATH;
        $mostrar = $target . $pdffile;
        return response()->file($mostrar);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assistantsPresentations = AssistantPresentation::paginate(3);
        
        return view('admin.assistantPresentation.index')->with(['assistantsPresentations' => $assistantsPresentations]);
    }
    
    protected function validatorDocument(array $data)
    {
        return Validator::make($data,[
            'document' => ['nullable'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id_presentation = $request->session()->get('id_presentation');
        $request->session()->forget('id_presentation');
        $presentation = Presentation::where('id', $id_presentation)->get();
        $datos = [
            'presentation' => $presentation,
            'request' => $request,
        ];
        return view('user.assist.create')->with($datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = [];
        $id_presentation = $request->session()->get('id_presentation');
        if($request->session()->get('from_register')) {
            $id_assistant = $request->session()->get('id_assistant');
            $request->session()->forget('id_assistant');
            $request->session()->forget('from_register');
            $input += [
                'id_assistant' =>  $id_assistant,
            ];
            // $assistantPresentation = AssistantPresentation::where(['id_assistant' => $id_assistant], ['id_presentation' => $id_presentation])->get();
            // $assistantPresentation->paid_out = 1;
        } else {
            $input += [
                'id_assistant' =>  Auth::user()->id,
            ];
        }
        $input += [
            'id_presentation' => $id_presentation,
            'paid_out' => 1,
        ];
        $datos = [
            'presentationid' => $id_presentation,
            'request' => $request,
        ];
        $assistantPresentation = new AssistantPresentation($input);
        // dd($assistantPresentation);
        $assistantPresentation->save();
        $request->session()->flash('op', 'paidok');
        // return redirect(url('presentation/' . $id_presentation));
        return view('user.assist.download')->with($datos);
    }
    
    public function download(Request $request) {
        $id_presentation = $request->session()->get('id_presentation');
        $request->session()->forget('id_presentation');
        $presentation = Presentation::where('id', $id_presentation)->get();
        $data = [
            'presentation' => $presentation,
        ];
        $pdf = \PDF::loadView('user.assist.getdownload', $data);
        if (Auth::check()) {
            $user = Auth::user()->id;
        } else {
            $user = 'new';
        }
        return $pdf->download($user . '-' . $id_presentation . '.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AssistantPresentation  $assistantPresentation
     * @return \Illuminate\Http\Response
     */
    public function show(AssistantPresentation $assistantPresentation)
    {
        return view('admin.assistantPresentation.show')->with(['assistantPresentation' => $assistantPresentation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AssistantPresentation  $assistantPresentation
     * @return \Illuminate\Http\Response
     */
    public function edit(AssistantPresentation $assistantPresentation)
    {
        return view('user.assist.edit')->with(['assistantPresentation' => $assistantPresentation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AssistantPresentation  $assistantPresentation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssistantPresentation $assistantPresentation)
    {
        $input = $this->validatorDocument($request->all())->validate();
        $file = $request->file('document');
        if($file !== null) {
            $name = $file->getClientOriginalName();
            $target = Constants::PDF_FILE_PATH;
            $file->move($target, $name);
            $assistantPresentation->document = $name;
        }
        $assistantPresentation->save();
        return redirect(url('presentation/' . $assistantPresentation->id_presentation));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AssistantPresentation  $assistantPresentation
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssistantPresentation $assistantPresentation)
    {
        //
    }
}
