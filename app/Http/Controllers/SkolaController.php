<?php

namespace App\Http\Controllers;

use App\Models\Mesto;
use App\Models\Skola;
use Illuminate\Http\Request;

class SkolaController extends Controller
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
        $skola = Skola::orderBy('id', 'asc')->paginate(10);

        return view('admin.skola.index', compact('skola'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mesto = Mesto::orderBy('nazev', 'asc')->get();
        return view('admin.skola.create', compact('mesto'));
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
            'mesto' => 'required',
            'geo_lat' => 'required',
            'geo_long' => 'required',
        ]);

        Skola::create($request->all());

        return redirect()->route('skola.index')
            ->with('success', 'Záznam byl úspěšně přidán.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skola  $skola
     * @return \Illuminate\Http\Response
     */
    public function show(Skola $skola)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skola  $skola
     * @return \Illuminate\Http\Response
     */
    public function edit(Skola $skola)
    {
        $mesto = Mesto::orderBy('nazev', 'asc')->get();
        return view('admin.skola.edit', compact('skola', 'mesto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Skola  $skola
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skola $skola)
    {
        $request->validate([
            'nazev' => 'required',
            'mesto' => 'required',
            'geo_lat' => 'required',
            'geo_long' => 'required',
        ]);
        $skola->update($request->all());

        return redirect()->route('skola.index')
            ->with('success', 'Záznam byl úspěšně upraven.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skola  $skola
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skola $skola)
    {
        $skola->delete();

        return redirect()->route('skola.index')
            ->with('success', 'Záznam byl úspěšně odstraněn.');
    }
}