<x-app-layout>
    <div>
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert" id="info" style="display: none">
            <span id="message" class="font-medium"></span>
        </div>
    </div>

    <!-- Photos -->
    <div>
    <section class="overflow-hidden text-gray-700 ">
  <div class="container px-5 py-2 mx-auto lg:pt-12 lg:px-32">
    <div class="flex flex-wrap -m-1 md:-m-2">
        @foreach($posts as $post)
      <div class="flex flex-wrap w-1/3">
        <div class="w-full p-1 md:p-2">
        
        <div class="flex justify-between text-1xl">
            <p>{{$post->title }}</p>
            <p> {{ $post->user->firstName }}</p>
        </div>
          <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
            src="{{ Storage::url($post->image) }}">
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>


        {{ $posts->links() }}

    </div>
</x-app-layout>




<script>
    if(sessionStorage.getItem("message")) 
    {
        document.getElementById("message").innerText=sessionStorage.getItem("message");
        document.getElementById("info").style.display="block";
        setTimeout(function() {
            document.getElementById("info").remove();
            sessionStorage.removeItem("message");
        }, 2000);
        
    }
</script>
