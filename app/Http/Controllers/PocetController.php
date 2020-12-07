<?php

namespace App\Http\Controllers;

use App\Models\Pocet;
use App\Models\Skola;
use App\Models\Obor;
use Illuminate\Http\Request;

class PocetController extends Controller
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
        $pocet = Pocet::orderBy('id', 'asc')->paginate(10);

        return view('admin.pocet.index', compact('pocet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $skola = Skola::orderBy('nazev', 'asc')->get();
        $obor = Obor::orderBy('nazev', 'asc')->get();
        return view('admin.pocet.create', compact('skola', 'obor'));
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
            'obor' => 'required',
            'skola' => 'required',
            'pocet' => 'required',
            'rok' => 'required',
        ]);

        Pocet::create($request->all());

        return redirect()->route('pocet.index')
            ->with('success', 'Záznam byl úspěšně přidán.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pocet  $pocet
     * @return \Illuminate\Http\Response
     */
    public function show(Pocet $pocet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pocet  $pocet
     * @return \Illuminate\Http\Response
     */
    public function edit(Pocet $pocet)
    {
        $skola = Skola::orderBy('nazev', 'asc')->get();
        $obor = Obor::orderBy('nazev', 'asc')->get();
        return view('admin.pocet.edit', compact('pocet', 'skola', 'obor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pocet  $pocet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pocet $pocet)
    {
        $request->validate([
            'obor' => 'required',
            'skola' => 'required',
            'pocet' => 'required',
            'rok' => 'required',
        ]);
        $pocet->update($request->all());

        return redirect()->route('pocet.index')
            ->with('success', 'Záznam byl úspěšně upraven.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pocet  $pocet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pocet $pocet)
    {
        $pocet->delete();

        return redirect()->route('pocet.index')
            ->with('success', 'Záznam byl úspěšně odstraněn.');
    }
}