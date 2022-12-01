const button = document.getElementById("convertButton");

// get csrfToken
const csrfToken = document.getElementsByName("csrf-token")[0].content;

const title = document.getElementById('title');



document.querySelectorAll(".drop-zone__input").forEach(inputElement => {
    const dropZoneElement = inputElement.closest(".drop-zone");

    title.addEventListener("input", (event) => {
        changeButtonColor();
    });

    button.addEventListener("mouseover", function(event) {
        changeButtonColor();
    });

    function changeButtonColor() {
        if(inputElement.files.length && title.value.length) {
            button.classList.remove('fileNotPresent');
            button.classList.add('filePresent');
        } else {
            button.classList.add('fileNotPresent');
            button.classList.remove('filePresent');
        }
    }

    dropZoneElement.addEventListener("click", event => {
        inputElement.click();
    });

    inputElement.addEventListener("change", event => {
        if(inputElement.files.length) {
            updateThumbnail(dropZoneElement, inputElement.files[0]);

            button.addEventListener('click', (event) => {
                uploadFile(event, inputElement.files[0]);
            });

        }

    })

    dropZoneElement.addEventListener("dragover", event => {
        event.preventDefault();
        dropZoneElement.classList.add("drop-zone--over");
    })

    dropZoneElement.addEventListener("dragleave", event => {
        dropZoneElement.classList.remove("drop-zone--over");
    });

    dropZoneElement.addEventListener("dragend", event => {
        dropZoneElement.classList.remove("drop-zone--over");
    });

    dropZoneElement.addEventListener("drop", event => {
        event.preventDefault();
        
        if(event.dataTransfer.files.length) {
            inputElement.files = event.dataTransfer.files;

            updateThumbnail(dropZoneElement, event.dataTransfer.files[0]);
        }

        dropZoneElement.classList.remove("drop-zone--over");
    })
});

/**
 * 
 * @param {HTMLElement} dropZoneElement 
 * @param {File} file
 */
function updateThumbnail(dropZoneElement, file) {
    let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

    // First time - remove the prompt
    if(dropZoneElement.querySelector(".drop-zone__prompt")) {
        dropZoneElement.querySelector(".drop-zone__prompt").remove();
    }

    // first time, there is no thumbnail element, so let's create it
    if(!thumbnailElement) {
        thumbnailElement = document.createElement("div");
        thumbnailElement.classList.add("drop-zone__thumb");
        dropZoneElement.appendChild(thumbnailElement);
    }

    thumbnailElement.dataset.label = file.name;

    // Show thumbnail for image files
    if(file.type.startsWith("image/")) {
        const reader = new FileReader();
        
        reader.readAsDataURL(file);
        reader.onload = () => {
            thumbnailElement.style.backgroundImage = `url('${reader.result}')`
        }
    } else {
        thumbnailElement.style.backgroundImage = null;
    }

}

/**
 * @async
 * @param {Event} event
 * @param {File} file
 */
async function uploadFile(event, file) {
    // new form data
    let formData = new FormData();

    formData.append("userfile", file);
    formData.append("title", title);

    const result = await fetch('/post', {
        method: "POST",
        body: formData,
        headers: {
            "X-CSRF-Token": csrfToken
        }
    });

    console.log(result);


    const filename = result.headers.get('content-disposition');


    /* const blob = await result.blob();
    const href = URL.createObjectURL(blob);
    
    const pdf = Object.assign(document.createElement('a'), {href, style:"display:none", download: filename});

    document.body.appendChild(pdf);
    pdf.click();

    URL.revokeObjectURL (href);
    pdf.remove(); */
}