@extends('layouts.app')

@section('content')

    {{-- Title --}}
    <div class="row">
        <div class="col-md">
            <h2>{{ __('Nový záznam oboru') }}</h2>
        </div>
        <div class="col-md">
            <a class="btn btn-primary float-right" href="{{ route('obor.index') }}" title="Zpět na přehled">
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
    <form action="{{ route('obor.store') }}" method="post">
        @csrf

        {{-- nazev --}}
        <div class="form-group row">
            <label for="nazev" class="col-md-4 col-form-label text-md-right">{{ __('Název oboru') }}</label>
            <div class="col-md-6">
                <input type="text" name="nazev" id="nazev" class="form-control" placeholder="např. IT">
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