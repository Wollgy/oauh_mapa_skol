@extends('layouts.app')

@section('content')
    
    {{-- Title --}}
    <div class="row">
        <div class="col">
            <h2> {{ __('Obory') }}</h2>
        </div>
        <div class="col">
            <a class="btn btn-success float-right" href="{{ route('obor.create') }}" title="Přidat záznam">
                <i class="fas fa-plus-circle"></i> {{ __('Přidat záznam')}}
            </a>
        </div>
    </div><br>

    {{-- Success (create, update, destroy) --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success" style="text-align: center;">
            <h4>{{ $message }}</h4>
        </div>
    @endif

    {{-- Table --}}
    <table class="table table-hover table-responsive-sm" style="text-align: center;">
        <thead class="thead-dark">
            <tr>
                <th class="align-middle">#</th>
                <th class="align-middle">Název oboru</th>
                <th></th>
            </tr>
        </thead>
        @foreach ($obor as $o)
        <tbody>
            <tr>
                <td class="align-middle">{{ $o->id }}</td>
                <td class="align-middle">{{ $o->nazev }}</td>
                <td class="align-middle">
                    <form action="{{ route('obor.destroy', $o->id) }}" method="post">
                        <a href="{{ route('obor.edit', $o->id) }}" title="Upravit záznam">
                            <i class="fas fa-edit fa-lg"></i>
                        </a>
                        
                        @csrf
                        @method('delete')

                        <button type="submit" title="Smazat záznam" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>
                        </button>
                    </form>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>

    {{-- Pagination links --}}
    {{ $obor->links('pagination::bootstrap-4') }}
@endsection