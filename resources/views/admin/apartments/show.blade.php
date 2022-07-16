@extends('layouts.app')

@section('content')
  <div class="container" id="apartment-show">

    <h2 class="text-center py-3">Dettagli appartamento</h2>

    <div class="card p-3">
      <div class="card-body d-flex flex-wrap">

        <div class="col-12">
          <h2 class="card-title text-center font-weight-bold mb-3">{{ $apartment->title }}</h2>
        </div>

        <div class="col-md-8 col-12 mb-3 d-block mx-auto">
          <img src="{{ asset('images/apartments') }}/{{ $apartment->image }}" class="card-img-top mt-2" alt="{{ $apartment->title }}">
        </div>

        <div class="row d-flex justify-content-between mb-3">
          <div class="col-md-7 col-12 border rounded rounded-3 p-3">
            {{ $apartment->description }}
          </div>

          <div class="col-md-4 col-12 border rounded rounded-3 p-3">
            <div class="apartment-info">
              <ul>
                <li>
                  <i class="fa-solid fa-door-closed"></i>
                  <span class="info-label">Stanze: </span>
                  <span class="info-data">{{ $apartment->rooms }}</span>
                </li>
                <li>
                  <i class="fa-solid fa-toilet"></i>
                  <span class="info-label">Bagni: </span>
                  <span class="info-data">{{ $apartment->bathrooms }}</span>
                </li>
                <li>
                  <i class="fa-solid fa-bed"></i>
                  <span class="info-label">Letti: </span>
                  <span class="info-data">{{ $apartment->beds }}</span>
                </li>
                <li>
                  <i class="fa-solid fa-maximize"></i>
                  <span class="info-label">MQ: </span>
                  <span class="info-data"> {{ $apartment->beds }}</span>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="services">
            <h5>Servizi</h5>
            <ul>
            @forelse($apartment->services as $service)
              <li>
                <i class="fa-solid fa-check"></i>
                {{$service->name}}
              </li>
            @empty
              <li>
                <div class="text-gray">Nessun servizio indicato</div>
              </li>
            @endforelse
            </ul>
          </div>
        </div>

        <div class="col-12">
          <h5 class="d-block mb-2">Mappa</h5>
          <div id="map" class="map mb-3">
            <div id="marker"></div>
          </div>
        </div>

        <div class="col-12">
          <button type="button" class="btn btn-primary my-2"><a class="text-white" href="{{route('admin.apartments.edit', $apartment->id)}}">Modifica</a></button>
          <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="post" class="delete-form" data-title="{{ $apartment->title }}">
            @csrf
            @method('DELETE')
            <button type='submit' class="btn btn-danger">Cancella</button>
          </form>
          <button type="button" class="btn btn-secondary my-2"><a class="text-white" href="{{route('admin.messages.index', $apartment->id)}}">Vedi i messaggi</a></button>
        </div>

      </div>
    </div>

    {{-- Tomtom Map --}}
    <script type="text/javascript">
      let center = [ {{$apartment->longitude}} , {{$apartment->latitude}}];
      const map = tt.map({
          key: "cMTORuMrpmoMysQnNBGRyAx2g8Nmo8P9",
          container: "map",
          center: center,
          zoom: 15
      })
      map.on('load', () => {
          var marker = new tt.Marker()
              .setLngLat(center)
              .addTo(map);
      })
  </script>

  </div>
@endsection