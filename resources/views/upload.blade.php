@extends('layouts.header')

@section('content')

<div class="mt-10 mb-10 max-w-lg mx-auto">
  <form action="{{ route('upload') }}" method="POST">
    @csrf
    <div class="space-y-6">
      <div>
        <h2 class="text-xl font-semibold text-gray-900">Profile</h2>
        <p class="mt-2 text-sm text-gray-600">This information will be displayed publicly, so be careful what you share.</p>
      </div>

      <div>
        <input placeholder="Title" type="text" name="title" id="title" autocomplete="title" class="mt-1 block w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      </div>

      <div class="relative">
        <select name="country" class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
            <option value="" disabled selected>Country</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
      <path d="M10 12.586l4.293-4.293a1 1 0 111.414 1.414l-5 5a1 1 0 01-1.414 0l-5-5a1 1 0 111.414-1.414L10 12.586z"/>
    </svg>
  </div>
</div>


      <div>
        <label for="description" class="block text-sm font-medium text-gray-900">Description</label>
        <textarea id="description" name="description" rows="15" class="mt-1 block w-full h-500 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
      </div>
    </div>

    <div class="mt-6 flex justify-end space-x-4 mb-8">
      <button type="button" class="inline-block px-4 py-2 text-sm font-semibold text-gray-900 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Cancel</button>
      <button type="submit" class="inline-block px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
    </div>
  </form>
</div>

@endsection
