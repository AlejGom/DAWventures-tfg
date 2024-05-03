@extends('layouts.header')

@section('content')

<div  class="bg-white py-24 sm:py-32">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="tittleContainer">
      <div class="mx-auto max-w-2xl lg:mx-0">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">DAWventures</h2>
        <h6 class="mt-2 text-lg leading-8 text-gray-600">Where every page is a new adventure in your journey around the world.</h6>
      </div>
      <img class="tittleImage" src="{{ asset('../storage/images/kyoto.jpg') }}">
    </div>
    <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
      @foreach ($experiences as $experience)
      <article class="flex max-w-xl flex-col items-start justify-between">
        <div class="flex items-center gap-x-4 text-xs">
          <time datetime="{{ $experience->created_at }}" class="text-gray-500">{{ $experience->created_at }}</time>
          <a href="{{ route('showExperience', $experience->id) }}" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">{{ $experience->country }}</a>
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
              <a href="{{ route('showExperience', $experience->id) }}">
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