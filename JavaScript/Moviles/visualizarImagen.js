    function readFile(input) {
        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function (e) {
                var filePreview = document.createElement('img');
                filePreview.id = 'file-preview';

                //e.target.result contents the base64 data from the image uploaded
                filePreview.src = e.target.result;
                var previewZone = document.getElementById('imagenVistaPrevia');
                previewZone.appendChild(filePreview);
            }

            reader.readAsDataURL(input.files[0]);
        }

    }
    var fileUpload = document.getElementById('ingresar_foto');
    fileUpload.onchange = function (e) {
        readFile(e.srcElement);
    }
