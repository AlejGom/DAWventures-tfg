@extends('layouts.header')

@section('content')

<div class="absolute top-[140px] left-[50px]">
  <a href="{{ route('main') }}">
    <button class="ml-4 py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Volver al menú</button>
  </a>
</div>

<div class="mt-10 mb-10 max-w-lg mx-auto">
  <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="space-y-6">
      <div>
        <h2 class="text-xl font-semibold text-gray-900">¿Dónde has ido?</h2>
        <p class="mt-2 text-sm text-gray-600">Esta información se mostrará públicamente, así que tenga cuidado con lo que comparte.</p>
      </div>

      <div>
        <input placeholder="Título" type="text" name="title" id="title" autocomplete="title" class="mt-1 block w-full border border-gray-300 @error('title') border-red-500 @enderror rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('title') }}">
        @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      <div class="relative">
        <select name="country" class="block appearance-none w-full bg-white border border-gray-300 @error('country') border-red-500 @enderror hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
          <option value="" disabled {{ old('country') === null ? 'selected' : '' }}>País</option>
            @foreach ($countries as $country)
              <option value="{{ $country->id }}" {{ old('country') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
            @endforeach
        </select>
        <!-- <input list="countries" name="country" placeholder="País" class="block appearance-none w-full bg-white border border-gray-300 @error('country') border-red-500 @enderror hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
        <datalist id="countries">
          @foreach ($countries as $country)
            <option value="{{ $country->name }}">{{ $country->name }}</option>
          @endforeach
        </datalist> -->
        @error('country') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        
  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
      <path d="M10 12.586l4.293-4.293a1 1 0 111.414 1.414l-5 5a1 1 0 01-1.414 0l-5-5a1 1 0 111.414-1.414L10 12.586z"/>
    </svg>
  </div>
</div>


      <div>
        <label for="description" class="block text-sm font-medium text-gray-900">Descripcion</label>
        <textarea id="description" name="description" rows="15" class="mt-1 block w-full h-500 border border-gray-300 @error('description') border-red-500 @enderror rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('description') }}</textarea>
        @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>
    </div>

    <div>
        <label for="images" class="block">Subir imágenes (hasta 4):</label>
        <input type="file" name="images[]" id="images" accept="image/*" multiple>
    </div>
    <div id="imageNames"></div>
    @error('images') <p class="text-red-500 text-xs mt-1">El número máximo de imágenes es 4'</p> @enderror

    <div class="mt-6 flex justify-end space-x-4 mb-8">
      <button type="submit" class="inline-block px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Crear experiencia</button>
    </div>
  </form>
</div>

<script>
    document.getElementById('images').addEventListener('change', function(e) {
        const files = e.target.files;
        const imageNamesContainer = document.getElementById('imageNames');
        imageNamesContainer.innerHTML = '';

        for (let i = 0; i < files.length; i++) {
            const imageName = document.createElement('p');
            imageName.textContent = files[i].name;
            imageNamesContainer.appendChild(imageName);
        }
    });
</script>

@endsection
