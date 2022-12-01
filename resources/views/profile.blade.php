<x-app-layout>
    <p> {{$user->firstName . " " . $user->lastName }}</p>
    <p>Total posts: {{ $user->posts->count() }}</p>

    <form>   
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
        <input type="search" onkeydown="return /[a-z]/i.test(event.key)" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search photo by name" required>
        
    </div>

    <div class="container px-5 py-2 mx-auto lg:pt-12 lg:px-32">
        <div class="flex flex-wrap -m-1 md:-m-2" id="posts">
        @foreach($user->posts()->where('created_at', '>=', \Carbon\Carbon::now()->subDay()->toDateTimeString())->orderBy('created_at', 'desc')->get() as $post)
            
            <div class="flex flex-wrap w-1/3">
                <div class="w-full p-1 md:p-2">
                
                <div class="flex justify-between text-1xl">
                    <p >{{$post->title }}</p>
                </div>
                <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                    src="{{ Storage::url($post->image) }}">
                </div>
                
            </div>
        @endforeach
        </div>
  </div>

</form>
</x-app-layout>

<script>
    let search = document.getElementById("default-search");
    let id = <?php echo $user->id ?>;
    let inputListener = function(event) {
        searchPosts();
    }

    async function searchPosts() {
        let posts = await fetch(`/user/${id}/posts?search=${search.value}`);
        result = await posts.json();
        console.log(result);
    }

    search.addEventListener("input", inputListener);
</script>

