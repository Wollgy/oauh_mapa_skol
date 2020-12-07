<?php

namespace App\Http\Controllers;

use App\Models\Mesto;
use Illuminate\Http\Request;

class MestoController extends Controller
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
        $mesto = Mesto::orderBy('id', 'asc')->paginate(10);

        return view('admin.mesto.index', compact('mesto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mesto.create');
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

        Mesto::create($request->all());

        return redirect()->route('mesto.index')
            ->with('success', 'Záznam byl úspěšně přidán.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mesto  $mesto
     * @return \Illuminate\Http\Response
     */
    public function show(Mesto $mesto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mesto  $mesto
     * @return \Illuminate\Http\Response
     */
    public function edit(Mesto $mesto)
    {
        return view('admin.mesto.edit', compact('mesto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mesto  $mesto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mesto $mesto)
    {
        $request->validate([
            'nazev' => 'required',
        ]);
        $mesto->update($request->all());

        return redirect()->route('mesto.index')
            ->with('success', 'Záznam byl úspěšně upraven.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mesto  $mesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mesto $mesto)
    {
        $mesto->delete();

        return redirect()->route('mesto.index')
            ->with('success', 'Záznam byl úspěšně odstraněn.');
    }
}