
<html>
    <head>
        <meta name="_token" content="{{ csrf_token() }}">
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
        </div>
        <div id="buttonDiv">
            <button id="convertButton" class="fileNotPresent">POST</button>
        </div>
    </x-app-layout>
    </body>
</html>
