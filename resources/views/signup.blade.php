@extends('layouts.header')

@section('content')

<div class="signupContainer" class="flex flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <img class="mx-auto h-12 w-auto" src="{{ asset('../storage/images/montana.png') }}" alt="Your Company">
    <h2 class="mt-5 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
  </div>

  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6"  method="POST" action="{{ route('signup') }}">
      @csrf
      <div>
        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
        <div class="mt-2">
          <input id="name" name="name" type="name" autocomplete="name" value="{{ old('name') }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('name') border-red-500 @enderror">
          @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
      </div>
      <!-- TODO añadir errores, no muestra los border rojos de login y signup porque no esta declarado el borde -->
      <div>
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
        <div class="mt-2">
          <input id="email" name="email" type="email" autocomplete="email" value="{{ old('email') }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
      </div>

      <div>
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
        <div class="mt-2">
          <input id="password" name="password" type="password"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
      </div>

      <div>
          <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Repeat password</label>
        <div class="mt-2">
          <input id="password_confirmation" name="password_confirmation" type="password"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          @error('password_confirmation') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
      </div>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
      </div>
    </form>

    <p class="mt-10 text-center text-sm text-gray-500">
      Have an account?
      <a href="{{ route('showLogin') }}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Login here</a>
    </p>
  </div>
</div>

@endsection