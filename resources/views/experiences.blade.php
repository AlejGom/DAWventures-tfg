@extends('layouts.header')

@section('content')

<div class="bg-white">
  <div class="mx-auto grid max-w-2xl grid-cols-1 items-center gap-x-8 gap-y-16 px-4 py-24 sm:px-6 sm:py-32 lg:max-w-7xl lg:grid-cols-2 lg:px-8">
    <div>
      <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $experience->title }}</h2>

      <dl class="mt-16 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 sm:gap-y-16 lg:gap-x-8">
        <div class="border-t border-gray-200 pt-4">
          <dt class="font-medium text-gray-900">País</dt>
          <dd class="mt-2 text-sm text-gray-500">{{ $experience->country }}</dd>
        </div>
        <div class="border-t border-gray-200 pt-4">
          <dt class="font-medium text-gray-900">Creación</dt>
          <dd class="mt-2 text-sm text-gray-500">{{ $experience->created_at }}</dd>
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
  </div>
</div>

@endsection