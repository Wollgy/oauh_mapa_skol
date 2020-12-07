<?php

namespace App\Http\Controllers;

use App\Models\Pocet;
use App\Models\Skola;
use App\Models\Obor;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pocet = Pocet::orderBy('id', 'asc')->paginate(10);
        $skola = Skola::orderBy('nazev', 'asc')->get();
        $obor = Obor::orderBy('nazev', 'asc')->get();
        $roky = Pocet::distinct()->get(['rok']);

        return view('index', compact('pocet', 'skola', 'obor', 'roky'));
    }

    /**
     * Display a filtered listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        // pocet
        $pocet = Pocet::orderBy('id', 'asc');
            if ($request->skola != '*') {
                $pocet = $pocet->where('skola', $request->skola); }
            if ($request->obor != '*') {
                $pocet = $pocet->where('obor', $request->obor); }
            if ($request->rok != '*') {
                $pocet = $pocet->where('rok', $request->rok); }

        // filtered skola
        $skolaids = $pocet->where('skola' , '>' , 0)->pluck('skola')->toArray();
        $filter_skola = Skola::orderBy('nazev', 'asc')->whereIn('id', $skolaids)->get();
        
        // paginated pocet (needed in filter_skola query before paginating)
        $pocet = $pocet->paginate(10);
        
        // skola, obor, roky
        $skola = Skola::orderBy('nazev', 'asc')->get();
        $obor = Obor::orderBy('nazev', 'asc')->get();
        $roky = Pocet::distinct()->get(['rok']);

        return view('filter', compact('pocet', 'skola', 'obor', 'request', 'roky', 'filter_skola'));
    }
}