@extends('layouts.app')

{{-- Body --}}
@section('content')

    <div class="card">
        <p class="card-body" id="mapid"></p>
    </div><br>

    {{-- Filter form --}}
    <form action="{{ route('index.filter') }}" method="get">
        @csrf

        <div class="row">
            <div class="col-md">
                <select name="skola" id="skola" class="form-control">
                    <option value="{{ __('*') }}">{{ __('Všechny školy') }}</option>
                    @foreach ($skola as $s)
                        <option value="{{ $s->id }}">{{ $s->nazev }}</option>
                    @endforeach
                </select><br>
            </div>

            <div class="col-md">
                <select name="obor" id="obor" class="form-control">
                    <option value="{{ __('*') }}">{{ __('Všechny obory') }}</option>
                    @foreach ($obor as $o)
                        <option value="{{ $o->id }}">{{ $o->nazev }}</option>
                    @endforeach
                </select><br>
            </div>
            
            <div class="col-md">
                <select name="rok" id="rok" class="form-control">
                    <option value="{{ __('*') }}">{{ __('Všechny roky') }}</option>
                    @foreach ($roky as $r)
                        <option value="{{ $r->rok }}">{{ $r->rok }}</option>
                    @endforeach
                </select><br>
            </div>

            <div class="col-md">
                <button type="submit" class="btn btn-primary form-control"> {{ __('Filtrovat') }}</button><br><br>
            </div>
        </div>
    </form>

    {{-- Table --}}
    <table class="table table-hover table-responsive-lg" style="text-align: center;">
        <thead class="thead-dark">
            <tr>
                <th class="align-middle">Škola</th>
                <th class="align-middle">Obor</th>
                <th class="align-middle">Rok</th>
                <th class="align-middle">Počet přijatých uchazečů</th>
            </tr>
        </thead>
        @foreach ($pocet as $p)
            <tbody>
                <tr>
                    <td class="align-middle">{{ $p->skola()->first()->nazev }}</td>
                    <td class="align-middle">{{ $p->obor()->first()->nazev }}</td>
                    <td class="align-middle">{{ $p->rok }}</td>
                    <td class="align-middle">{{ $p->pocet }}</td>
                </tr>
            </tbody>
        @endforeach
    </table>
    
    {{-- Pagination links --}}
    {{ $pocet->links('pagination::bootstrap-4') }}
@endsection

@section('styles')
    <style>
        #mapid {
            width: 100%;
            height: 400px;
            margin:0;
            padding:0;
        }
    </style>
@endsection

@push('scripts')
    <script>
        // Create map
        var map = L.map('mapid').setView([{{ config('leaflet.map_center_latitude') }}, {{ config('leaflet.map_center_longitude') }}], {{ config('leaflet.zoom_level') }});
        map.invalidateSize();
        
        // Implement tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
    </script>
    {{-- Fill map with markers --}}
    @foreach($skola as $s)
        <script>
            var marker = L.marker([{{ $s->geo_lat }}, {{ $s->geo_long }}]).addTo(map);
            marker.bindPopup("<b>{{ $s->nazev }}</b><br> {{ $s->mesto()->first()->nazev }}").closePopup();
        </script>
    @endforeach
@endpush