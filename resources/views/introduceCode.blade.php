@extends('layouts.header')

@section('content')

<div class="loginContainer" class="flex flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <img class="mx-auto h-12 w-auto" src="{{ asset('../storage/images/montana.png') }}" alt="Your Company">
    <h2 class="mt-5 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Recupera tu cuenta</h2>
  </div>

  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="changePassword" method="POST">
      @csrf

      <input type="hidden" name="hiddenCode" value="{{ $code }}">
      <input type="hidden" name="hiddenUser" value="{{ $user->id }}">

      <div>
        <label for="code" class="block text-sm font-medium leading-6 text-gray-900">Introduce el código y cambia la contraseña</label>
        <div class="mt-2">
          <input id="code" name="code" type="code" autocomplete="code" value="{{ old('code') }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          @error('code')  <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
          @error('codigoError')  <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
      </div>

      <div>
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Contraseña</label>
        <div class="mt-2">
          <input id="password" name="password" type="password"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
      </div>

      <div>
          <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Repetir contraseña</label>
        <div class="mt-2">
          <input id="password_confirmation" name="password_confirmation" type="password"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          @error('password_confirmation') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
      </div>


      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cambiar contraseña</button>
      </div>

    </form>
  </div>
</div>

@endsection