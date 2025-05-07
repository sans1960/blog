<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <form method="POST" action="{{route('admin.categories.update',$category)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" value="{{$category->name}}" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="mt-3">
            <x-input-label for="subname" :value="__('Subname')" />
            <x-text-input id="subname" class="block mt-1 w-full" type="text" name="subname" value="{{$category->subname}}" required  />
            <x-input-error :messages="$errors->get('subname')" class="mt-2" />
        </div>
        <div class="mt-3 grid grid-cols-1 md:grid-cols-2">
         <div>
         <x-input-label for="image" :value="__('Image')" />
            <x-text-input id="image" class="block mt-1 w-full" type="file" name="image"   />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
         </div>  
       <div>
       <img id="preview-image-before-upload" src="{{Storage::url($category->image)}}" alt="" class="w-48">
       </div>
              
        
        </div>
        <div class="mt-3">
            <x-input-label for="caption" :value="__('Caption')" />
            <x-text-input id="caption" class="block mt-1 w-full" type="text" name="subname" value="{{$category->caption}}" required  />
            <x-input-error :messages="$errors->get('caption')" class="mt-2" />
        </div>
        <div class="mt-3">
        <x-input-label for="body" :value="__('Body')" />
        <textarea name="body" id="body" class="w-full block">
            {!!$category->body!!}
        </textarea>
        <x-input-error :messages="$errors->get('body')" class="mt-2" />
        </div>

      

      


        <div class="flex items-center justify-end mt-4">
            

            <x-primary-button class="ms-4">
                {{ __('Update') }}
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
</script>

    @endsection
</x-app-layout>