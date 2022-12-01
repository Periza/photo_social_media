
<html>
    <head>
        <meta name="_token" content="{{ csrf_token() }}">
        @vite(['resources/js/main.js'])
    </head>
    <body>
    <x-app-layout>
        <div class="drop-zone">
                <span class="drop-zone__prompt">Drop file here or click to upload</span>
                <input type="file" name="myFile" class="drop-zone__input">
        </div>
        <div class="title">
            <label for="title">Photo title: </label>
            <input type="text" id="title" name="title">
            <x-input-error :messages="$errors->get('required')" class="mt-2" />
        </div>
        <div id="buttonDiv">
            <button id="postButton" class="fileNotPresent">POST</button>
        </div>
    </x-app-layout>
    </body>
</html>
