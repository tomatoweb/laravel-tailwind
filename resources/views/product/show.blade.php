@extends('base')

@section('title', 'Dotdev Creative Web Development')

@section('content')
<div class="flex items-center justify-center m-8">
  <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
      <a href="#">
          <img class="rounded-t-lg p-6" src="/docs/{{$product->image}}" alt="" />
      </a>
      <div class="p-5">
          <a href="#">
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$product->name}}</h5>
          </a>
          <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$product->description}}</p>
      </div>
  </div>
</div>

    @empty($product)
        <h3>no product.</h3>
    @endempty
    
@endsection

