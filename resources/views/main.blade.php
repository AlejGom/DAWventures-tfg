@extends('layouts.header')

@section('content')

<div  class="bg-white py-24 sm:py-32">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="tittleContainer">
      <div class="mx-auto max-w-2xl lg:mx-0">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">DAWventures</h2>
        <h6 class="mt-2 text-lg leading-8 text-gray-600">Donde cada página es una nueva aventura en tu viaje alrededor del mundo.</h6>
      </div>
      <img class="tittleImage" src="{{ asset('../storage/images/kyoto.jpg') }}">
    </div>

    <!-- Filters -->
    <div class="text-start mx-auto mt-10 grid max-w-2xl gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
      <form action="{{ route('filterMain') }}" method="POST">
        @csrf
        <h3 class="mt-3 mb-5 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">Filtrado de experiencias</h3>
        
        <div class="flex items-center">
          <select name="country" class="block appearance-none w-full bg-white border border-gray-300 @error('country') border-red-500 @enderror hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
            <option value="" disabled {{ old('country') === null ? 'selected' : '' }}>Selecciona un país</option>
            @if ($filtered == true)
              <option value="{{ $selectedCountry }}" selected>{{ $selectedCountry }}</option>
            @endif
            @foreach ($countries as $country)
              <option value="{{ $country->name }}" {{ old('country') == $country->name ? 'selected' : '' }}>{{ $country->name }}</option>
            @endforeach
          </select>

          <button type="submit" class="ml-4 py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Filtrar</button>
          @if ($filtered == true)
            <a href="{{ route('main') }}" class="ml-4 py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Limpiar</a>
          @endif
        </div>
      </form>
    </div>

    <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
      @foreach ($experiences as $experience)
      <article class="flex max-w-xl flex-col items-start justify-between">
        <div class="flex items-center gap-x-4 text-xs">
          @if (Auth::user() && Auth::user()->id == $experience->user_id || Auth::user() && Auth::user()->rol == 'admin')
            <a class="deleteLink" href="{{ route('deleteExperience', $experience->id) }}"><img class="w-6 h-6 mr-4" src="{{ asset('../storage/images/borrar.png') }}"></a>
            <a href="{{ route('showEditForm', $experience->id) }}"><img class="w-6 h-6 mr-4" src="{{ asset('../storage/images/boligrafo.png') }}"></a>
          @endif
          <time datetime="{{ $experience->created_at }}" class="text-gray-500">{{ $experience->created_at->diffForHumans() }}</time>
          <a href="https://www.google.com/maps/search/{{ $experience->country }}" target="_blank" class="relative z-10 rounded-full bg-gray-200 px-3 py-1.5 font-medium text-gray-800 hover:bg-gray-300">{{ $experience->country }}</a>
          <img class="messageImage" src="../storage\images\comentarios.png" alt="">
          <span>{{ $experience->comments_count }}</span>
        </div>
        <div class="group relative">
          <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
            <a href="{{ route('showExperience', $experience->id) }}">
              <span class="absolute inset-0"></span>
              {{ $experience->title }}
            </a>
          </h3>
          <!-- line-clamp-3 limit the number of lines shown -->
          <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">{{ $experience->description }}</p>
        </div>
        <div class="relative mt-8 flex items-center gap-x-4">
          <img src="{{ $experience->user->profile_image }}" alt="" class="h-10 w-10 rounded-full bg-gray-50">
          <div class="text-sm leading-6">
            <p class="font-semibold text-gray-900">
              <a href="{{ route('showOtherUser', $experience->user->id) }}">
                <span class="absolute inset-0"></span>
                {{ $experience->user->name }}
              </a>
            </p>
          </div>
        </div>
      </article>
      @endforeach
    </div>
  </div>
</div>


@endsection