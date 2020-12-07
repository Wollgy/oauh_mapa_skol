@extends('layouts.app')

@section('content')

    {{-- Title --}}
    <div class="row">
        <div class="col-md">
            <h2>{{ __('Úprava záznamu školy') }}</h2>
        </div>
        <div class="col-md">
            <a class="btn btn-primary float-right" href="{{ route('skola.index') }}" title="Zpět na přehled">
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

    {{-- Edit form --}}
    <form action="{{ route('skola.update', $skola->id)}}" method="post">
        @csrf
        @method('put')

        {{-- nazev --}}
        <div class="form-group row">
            <label for="nazev" class="col-md-4 col-form-label text-md-right">{{ __('Název školy') }}</label>
            <div class="col-md-6">
                <input type="text" name="nazev" id="nazev" class="form-control" placeholder="{{ $skola->nazev }}" value="{{ $skola->nazev }}">
            </div>
        </div>

        {{-- mesto --}}
        <div class="form-group row">
            <label for="mesto" class="col-md-4 col-form-label text-md-right">{{ __('Město') }}</label>
            <div class="col-md-6">
                <select name="mesto" id="mesto" class="form-control">
                    @foreach ($mesto as $m)
                        <option value="{{ $m->id }}" @if ($skola->mesto == $m->id) selected @endif>{{ $m->nazev }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- geo_lat --}}
        <div class="form-group row">
            <label for="geo_lat" class="col-md-4 col-form-label text-md-right">{{ __('Zeměpisná šířka') }}</label>
            <div class="col-md-6">
                <input type="number" step="any" name="geo_lat" id="geo_lat" class="form-control" placeholder="{{ $skola->geo_lat }}" value="{{ $skola->geo_lat }}">
            </div>
        </div>

        {{-- geo_long --}}
        <div class="form-group row">
            <label for="geo_long" class="col-md-4 col-form-label text-md-right">{{ __('Zeměpisná délka') }}</label>
            <div class="col-md-6">
                <input type="number" step="any" name="geo_long" id="geo_long" class="form-control" placeholder="{{ $skola->geo_long }}" value="{{ $skola->geo_long }}">
            </div>
        </div>
        
        {{-- submit --}}
        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-2">
                <button type="submit" class="btn btn-primary form-control"> {{ __('Upravit') }}</button>
            </div>
        </div>

    </form>

@endsection