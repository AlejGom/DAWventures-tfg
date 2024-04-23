@extends('layouts.header')

@section('content')

<link rel="stylesheet" href="{{ asset('../resources/css/app.css') }}">

<div class="flex  flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h2 class="text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ Auth::user()->name }}'s profile</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6"  method="POST" action="{{ route('updateProfile') }}" enctype="multipart/form-data">
      @csrf
      
      <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Change profile image</label>
      <div class="mt-2">
        <label for="image" class="image-input">
          <img src="{{ Auth::user()->profile_image }}" class="image-preview" value="{{ Auth::user()->profile_image }}">
          <input id="image" name="image" type="file">
        </label>
      </div>

      <div>
        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Change username</label>
        <div class="mt-2">
          <input value="{{ Auth::user()->name }}" id="name" name="name" type="name" autocomplete="name" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Change email address</label>
        <div class="mt-2">
          <input value="{{ Auth::user()->email }}" id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save changes</button>
      </div>
    </form>
  </div>
</div>


  <div class="sm:mx-auto sm:w-full sm:max-w-sm border-t border-gray-200 pt-10">
    <h2 class="text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Your posts</h2>
  </div>

<div class="">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
      @foreach ($experiences as $experience)
      <article class="flex max-w-xl flex-col items-start justify-between">
        <div class="flex items-center gap-x-4 text-xs">
          <a href="{{ route('deleteExperience', $experience->id) }}"><img class="w-6 h-6 mr-4" src="{{ asset('../storage/images/borrar.png') }}"></a>
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