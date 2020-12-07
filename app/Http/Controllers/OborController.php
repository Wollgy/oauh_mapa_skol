<?php

namespace App\Http\Controllers;

use App\Models\Obor;
use Illuminate\Http\Request;

class OborController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obor = Obor::orderBy('id', 'asc')->paginate(10);

        return view('admin.obor.index', compact('obor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.obor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nazev' => 'required',
        ]);

        Obor::create($request->all());

        return redirect()->route('obor.index')
            ->with('success', 'Záznam byl úspěšně přidán.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Obor  $obor
     * @return \Illuminate\Http\Response
     */
    public function show(Obor $obor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Obor  $obor
     * @return \Illuminate\Http\Response
     */
    public function edit(Obor $obor)
    {
        return view('admin.obor.edit', compact('obor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Obor  $obor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Obor $obor)
    {
        $request->validate([
            'nazev' => 'required',
        ]);
        $obor->update($request->all());

        return redirect()->route('obor.index')
            ->with('success', 'Záznam byl úspěšně upraven.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Obor  $obor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Obor $obor)
    {
        $obor->delete();

        return redirect()->route('obor.index')
            ->with('success', 'Záznam byl úspěšně odstraněn.');
    }
}