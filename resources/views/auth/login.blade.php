@extends('base')

@section('content')

<div class="flex justify-start mt-9 text-white">
    <div class="w-[50%] max-w-xs bg-slate-100">
    {{ dump(session('image')) }}
        @if(session('success'))
        <div class="bg-green-100 border-2 border-green-500 text-green-700 p-4" role="alert">
            <p class="font-bold">Success</p>
            <p>{{ session('success') .' '. session('email') }}</p>
        </div>
        @elseif(session('error'))
        <div class="bg-red-100 border-2 border-red-500 text-red-700 p-4" role="alert">
            <p class="font-bold">Error</p>
            <p>{{ session('error') .' '.session('email') }}</p>
        </div>
        @endif
        @if(session('image'))
        <div class="border-2 p-4 flex justify-center" role="alert">
            <img src="/storage/{{ session('image') }}" class="h-20" alt="image">
        </div>
        @endif

        <form action="" method="post" class="bg-gray-200 shadow-md rounded px-8 pt-6 pb-8 mb-4" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    email
                </label>
                <input id="email" type="email" name="email" value="{{ old('email', 'john@doe.be') }}" placeholder="email"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('email')
                <p class="text-red-500 text-xs italic">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input id="password" type="password" name="password"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                @error('password')
                <p class="text-red-500 text-xs italic">{{$message}}</p>
                @enderror
            </div>


            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    File
                </label>
                <input id="image" type="file" name="image"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                @error('image')
                <p class="text-red-500 text-xs italic">{{$message}}</p>
                @enderror
            </div>


            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Sign In
                </button>
            </div>
        </form>
        <div class="text-black pl-4 text-xs pb-2"> &copy; Dotdev - Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }} - {{ PHP_SAPI }})</div>
    </div>
</div>

@endsection