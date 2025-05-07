<x-app-layout>
  

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">

        <div class="max-w-md bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
    <a href="#">
        <img class="rounded-t-lg" src="{{Storage::url($category->image)}}" alt="" />
    </a>
    <div class="p-5">
        <a href="#">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$category->name}}</h5>
            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{$category->subname}}</h5>
        </a>
        <div class="mb-3 font-normal text-gray-700 dark:text-gray-400">
            {!!$category->body!!}
        </div>
     
    </div>
</div>
            
        </div>
    </div>
</x-app-layout>