<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <form method="POST" action="{{route('admin.posts.store')}}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>
        <div class="mt-3">
            <x-input-label for="subtitle" :value="__('Subtitle')" />
            <x-text-input id="subtitle" class="block mt-1 w-full" type="text" name="subtitle" :value="old('subtitle')" required  />
            <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
        </div>
        <div class="mt-3">
             
           <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Choose Category</h3>
         <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @foreach($categories as $category)
    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
        <div class="flex items-center ps-3">
            <input id="horizontal-list-radio-license" type="radio" value="{{$category->id}}" name="category_id" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
            <label for="horizontal-list-radio-license" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$category->name}} </label>
        </div>
    </li>
    @endforeach
 
      </ul>

        </div>
        <div class="mt-3 grid grid-cols-1 md:grid-cols-2"> 
            <div>
        <x-input-label for="bgimage" :value="__('Bg-Image')" />
            <x-text-input id="bgimage" class="block mt-1 w-full" type="file" name="bgimage" :value="old('bgimage')" required  />
            <x-input-error :messages="$errors->get('bgimage')" class="mt-2" />
            </div>
        <div>
        <img id="preview-bgimage-before-upload" src="{{asset('img/uno.jpg')}}" alt="" class="w-48">
        </div>    

        </div>
        <div class="mt-3">
        <x-input-label for="summary" :value="__('Summary')" />
        <textarea name="summary" id="summary" class="w-full block"></textarea>
        <x-input-error :messages="$errors->get('summary')" class="mt-2" />
        </div>
        
        <div class="mt-3 grid grid-cols-1 md:grid-cols-2"> 
            <div>
        <x-input-label for="image" :value="__('Image')" />
            <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')" required  />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>
        <div>
        <img id="preview-image-before-upload" src="{{asset('img/uno.jpg')}}" alt="" class="w-48">
        </div>    

        </div>
        <div class="mt-3">
        <x-input-label for="body" :value="__('Body')" />
        <textarea name="body" id="body" class="w-full block"></textarea>
        <x-input-error :messages="$errors->get('body')" class="mt-2" />
        </div>

      

      


        <div class="flex items-center justify-end mt-4">
            

            <x-primary-button class="ms-4">
                {{ __('Create') }}
            </x-primary-button>
        </div>
    </form>
                </div>
            </div>
        </div>
    </div>
    @section('js')
    <script>
  tinymce.init({
            selector: 'textarea',
            advcode_inline: true,
            plugins: 'anchor autolink charmap codesample code emoticons  link lists  searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link  table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat | code',
            branding: false,
            menubar: false,
            language: 'ca',
            advcode_inline: true,
        });
</script>
<script>
  $(document).ready(function (e) {
       $('#image').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => {
          $('#preview-image-before-upload').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
       });
    });
    $(document).ready(function (e) {
       $('#bgimage').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => {
          $('#preview-bgimage-before-upload').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
       });
    });
</script>
    @endsection
</x-app-layout>