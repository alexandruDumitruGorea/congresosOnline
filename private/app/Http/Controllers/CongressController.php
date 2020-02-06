<?php

namespace App\Http\Controllers;

use App\Congress;
use Illuminate\Http\Request;

use App\Http\Requests\CongressRequest;

class CongressController extends Controller
{
    
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
    public function index(Request $request)
    {
        $congress = Congress::paginate(3);
        $datos = [
            'congress' => $congress,
        ];
        
        return view('admin.congress.index')->with($datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.congress.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CongressRequest $request)
    {
        $input = $request->validated();
        $congress = new Congress($input);
        try {
            $congress->save();
            $request->session()->flash('op', 'createCongress');
        } catch(\Exception $e) {
            $request->session()->flash('op', 'errorCreateCongress');
            return redirect(route('congress.create'))->withInput();
        }
        
        return redirect(route('congress.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Congress  $congress
     * @return \Illuminate\Http\Response
     */
    public function show(Congress $congress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Congress  $congress
     * @return \Illuminate\Http\Response
     */
    public function edit(Congress $congress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Congress  $congress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Congress $congress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Congress  $congress
     * @return \Illuminate\Http\Response
     */
    public function destroy(Congress $congress)
    {
        //
    }
}
