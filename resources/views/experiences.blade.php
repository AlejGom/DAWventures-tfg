@extends('layouts.header')

@section('content')

<div class="absolute top-[140px] left-[50px]">
  <a href="{{ route('main') }}"><button class="ml-4 py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Volver al menú</button></a>
</div>

<div class="bg-white">
  <div class="mx-auto grid max-w-2xl grid-cols-1 items-center gap-x-8 gap-y-16 px-4 py-24 sm:px-6 sm:py-32 lg:max-w-7xl lg:grid-cols-2 lg:px-8">
    <div>
      <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $experience->title }}</h2>

      <dl class="mt-16 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 sm:gap-y-16 lg:gap-x-8">
        <div class="border-t border-gray-200 pt-4">
          <dt class="font-medium text-gray-900">País</dt>
          <dd class="mt-2 text-sm text-blue-400 underline hover:text-blue-800"><a href="https://www.google.com/maps/search/{{ $experience->country }}" target="_blank">{{ $experience->country }}</a></dd>
        </div>
        <div class="border-t border-gray-200 pt-4">
          <dt class="font-medium text-gray-900">Creación</dt>
          <dd class="mt-2 text-sm text-gray-500">{{ $experience->created_at->diffForHumans() }}</dd>
        </div>
      </dl>

      <div class="mt-10 border-t border-gray-200 pt-10">
        <p class="mt-4 text-gray-500">{{ $experience->description }}</p>
      </div>

    </div>
    <div class="grid grid-cols-2 grid-rows-2 gap-4 sm:gap-6 lg:gap-8">
      @foreach ($experience->images as $image)
        <img src="{{ $image->route }}" class="rounded-lg bg-gray-100">
      @endforeach
    <!-- <img src="" class="rounded-lg bg-gray-100">
      <img src="" class="rounded-lg bg-gray-100">
      <img src="" class="rounded-lg bg-gray-100">
      <img src="" class="rounded-lg bg-gray-100"> -->
    </div>
    <div class="mt-10 border-t border-gray-200 pt-10">
      <p class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Comentarios</p>
        <div>
          <form action="{{ route('comment') }}" method="POST">
            @csrf
            <input type="hidden" name="experience_id" value="{{ $experience->id }}">
            <div class="mb-4">
              <label class="block mb-2 text-sm font-bold text-gray-700" for="comment">Commenta tu experiencia</label>
              @if (!Auth::check())
                <p class="text-red-500">Debes iniciar sesión para comentar</p>
              @endif
              <textarea class="w-full h-40 px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 border rounded-lg focus:outline-none" id="comment" name="comment"></textarea>
            </div>
            <div class="mb-6 text-right">
              <button class="w-250 px-4 py-2 font-bold text-white @if (Auth::check()) bg-blue-500 hover:bg-blue-700 @else bg-blue-300 @endif rounded-lg focus:outline-none focus:shadow-outline" @if (!Auth::check()) disabled @endif type="submit">Enviar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="mt-10 border-t border-gray-200 pt-10 bg-gray-100">
  <p class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Comentarios</p>

    <div class="mt-8 space-y-8 m-10">
      @foreach ($comments as $comment)
        <div class="border rounded-lg border-gray-200 p-4 bg-white">
          <div class="flex items-center gap-x-4">
            <img src="../{{ $comment->user->profile_image }}" alt="" class="h-10 w-10 rounded-full bg-gray-50">
            <div class="text-sm leading-6">
              <p class="font-semibold text-gray-900">
                <a href="{{ route('showOtherUser', $comment->user->id) }}">{{ $comment->user->name }}</a>
              </p>
              <p class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
            </div>
          </div>
          <div class="mt-4">
            <p class="text-gray-700">{{ $comment->comment }}</p>
          </div>
        </div>
      @endforeach

      @if ($comments->isEmpty())
        <p class="text-gray-500">No hay comentarios aún.</p>
      @endif
    </div>

@endsection