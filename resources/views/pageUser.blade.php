@extends('layouts.header')

@section('content')

<link rel="stylesheet" href="{{ asset('../resources/css/app.css') }}">

<div class="flex flex-row items-center justify-center px-6 py-12 lg:px-8">
  <img src="../{{ $user->profile_image }}" class="h-16 w-16 rounded-full mr-4">
  <h1 class="text-center text-3xl font-bold leading-9 tracking-tight text-gray-900">{{ $user->name }}</h1>
</div>

<p class="text-center mb-10">Número de experiencias: {{ count($experiences) }}</p>

  <div class="sm:mx-auto sm:w-full sm:max-w-sm border-t border-gray-200 pt-10">
    <h2 class="text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Experiencias de {{ $user->name }}</h2>
  </div>

<div class="">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
      @foreach ($experiences as $experience)
      <article class="flex max-w-xl flex-col items-start justify-between">
        <div class="flex items-center gap-x-4 text-xs">
          @if (Auth::user())
            @if (Auth::user()->id == $experience->user_id || Auth::user()->rol == 'admin')
              <a class="deleteLink" href="{{ route('deleteExperience', $experience->id) }}"><img class="w-6 h-6 mr-4" src="{{ asset('../storage/images/borrar.png') }}"></a>
              <a href="{{ route('showEditForm', $experience->id) }}"><img class="w-6 h-6 mr-4" src="{{ asset('../storage/images/boligrafo.png') }}"></a>
            @endif
          @endif
          <time datetime="{{ $experience->created_at }}" class="text-gray-500">{{ $experience->created_at }}</time>
          <a href="https://www.google.com/maps/search/{{ $experience->country }}" target="_blank" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">{{ $experience->country }}</a>
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
          <img src="../{{ $experience->user->profile_image }}" alt="" class="h-10 w-10 rounded-full bg-gray-50">
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

<script>
  document.addEventListener('DOMContentLoaded', function() {
        var deleteButtons = document.querySelectorAll('.deleteLink');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                var confirmDelete = confirm('¿Estas seguro que quieres borrar esta experiencia?');
                if (!confirmDelete) {
                    event.preventDefault();
                }
            });
        });
    });
</script>
@endsection