@extends('layouts.app')

@section('content')

    {{-- Title --}}
    <div class="row">
        <div class="col-md">
            <h2>{{ __('Nový záznam o počtu přijatých uchazečů') }}</h2>
        </div>
        <div class="col-md">
            <a class="btn btn-primary float-right" href="{{ route('pocet.index') }}" title="Zpět na přehled">
                <i class="fas fa-backward"></i> {{ __('Zpět na přehled')}}
            </a>
        </div>
    </div><br>

    {{-- Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Se zadanými informacemi něco není v pořádku.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Create form --}}
    <form action="{{ route('pocet.store') }}" method="post">
        @csrf

        {{-- skola --}}
        <div class="form-group row">
            <label for="skola" class="col-md-4 col-form-label text-md-right">{{ __('Škola') }}</label>
            <div class="col-md-6">
                <select name="skola" id="skola" class="form-control">
                    @foreach ($skola as $s)
                        <option value="{{ $s->id }}">{{ $s->nazev }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- obor --}}
        <div class="form-group row">
            <label for="obor" class="col-md-4 col-form-label text-md-right">{{ __('Obor') }}</label>
            <div class="col-md-6">
                <select name="obor" id="obor" class="form-control">
                    @foreach ($obor as $o)
                        <option value="{{ $o->id }}">{{ $o->nazev }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- rok --}}
        <div class="form-group row">
            <label for="rok" class="col-md-4 col-form-label text-md-right">{{ __('Školní rok') }}</label>
            <div class="col-md-6">
                <input type="number" name="rok" id="rok" class="form-control" placeholder="např. 2009">
            </div>
        </div>

        {{-- pocet --}}
        <div class="form-group row">
            <label for="pocet" class="col-md-4 col-form-label text-md-right">{{ __('Počet přijatých uchazečů') }}</label>
            <div class="col-md-6">
                <input type="number" name="pocet" id="pocet" class="form-control" placeholder="např. 12">
            </div>
        </div>
        
        {{-- submit --}}
        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-2">
                <button type="submit" class="btn btn-primary form-control"> {{ __('Přidat') }}</button>
            </div>
        </div>

    </form>

@endsection