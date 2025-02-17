@extends('base')

@section('title', 'Dotdev Creative Web Development')

@section('content')

    @php
      $type =  "warning"
    @endphp

    <x-alert type="alert">Some informations</x-alert>

    <!--x-alert :type=$type></x-alert -->

    <!-- x-meteo></!-- -->

    <div class="grid grid-cols-4 gap-4 mt-10">
        @foreach ($products as $product )
            
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg p-6" src="/docs/{{$product->image}}" alt="" />
            </a>
            <div class="p-5">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$product->name}}</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$product->description}}</p>
                <div class="flex justify-between">
                  <a href="{{ route('products.show', ['name'=>$product->name, 'product'=>$product->id]) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                      Read more
                      <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                      </svg>
                  </a>
                  <form method="POST" action="{{ route('products.destroy', [$product->id]) }}" >
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-700 hover:bg-red-600 text-white font-bold py-2 px-4 border border-red-700 rounded-md">
                      Delete
                    </button>
                  </form>
                </div>
            </div>
        </div>   
        @endforeach
    </div>


    @empty($products)
        <h3>no product.</h3>
    @endempty
<div class="mt-8 flex">
    {{$products->links()}}
</div>
<div class="text-white float-end mb-8">Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }} - {{ PHP_SAPI }})</div>

@endsection

