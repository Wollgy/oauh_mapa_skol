@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="text-align: center">
                <div class="card-header">{{ __('Administrace') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Jste přihlášeni!') }}
                </div>
            </div>
        </div>
    </div>

@endsection
