LC.init(
    document.getElementsByClassName('my-drawing')[0],
    {imageURLPrefix: 'img/'}
);
canvas = document.getElementsByClassName("lc-drawing with-gui")[0].children[1];
canvas.setAttribute("style", "background-color: white;");
context = canvas.getContext('2d');

hideDiv = document.getElementsByClassName("color-well")[2];
hideDiv.parentNode.removeChild(hideDiv);

function download(dataURL, filename) {
    var blob = dataURLToBlob(dataURL);
    var url = window.URL.createObjectURL(blob);

    var a = document.createElement("a");
    a.style = "display: none";
    a.href = url;
    a.download = filename;

    document.body.appendChild(a);
    a.click();

    window.URL.revokeObjectURL(url);
}

function dataURLToBlob(dataURL) {
    var parts = dataURL.split(';base64,');
    var contentType = parts[0].split(":")[1];
    var raw = window.atob(parts[1]);
    var rawLength = raw.length;
    var uInt8Array = new Uint8Array(rawLength);

    for (var i = 0; i < rawLength; ++i) {
        uInt8Array[i] = raw.charCodeAt(i);
    }

    return new Blob([uInt8Array], {type: contentType});
}

function downloadJPG() {
    context.globalCompositeOperation = "destination-over";
    context.fillStyle = 'white';
    context.fillRect(0, 0, canvas.width, canvas.height);
    if (document.getElementById("imageTitle").value === "") {
        swal("Please give a title.");
    } else {
        var CanvasToDownload = document.getElementsByClassName("lc-drawing with-gui")[0].children[1];
        var dataURL = CanvasToDownload.toDataURL("image/jpeg");
        download(dataURL, document.getElementById("imageTitle").value);
    }
}

function downloadPNG() {
    if (document.getElementById("imageTitle").value === "") {
        swal("Please give a title.");
    } else {
        var CanvasToDownload = document.getElementsByClassName("lc-drawing with-gui")[0].children[1];
        var dataURL = CanvasToDownload.toDataURL("image/png");
        download(dataURL, document.getElementById("imageTitle").value);
    }
}

function save(){
    context.globalCompositeOperation = "destination-over";
    context.fillStyle = 'white';
    context.fillRect(0, 0, canvas.width, canvas.height);
    if (document.getElementById("imageTitle").value === "") {
        swal("Please give a title.");
    } else {
        var CanvasToDownload = document.getElementsByClassName("lc-drawing with-gui")[0].children[1];
        var dataURL = CanvasToDownload.toDataURL("image/jpeg");
        document.getElementById("imageDataURL").value = dataURL;
    }
}

function edit(imageURL){
    var targetImage = document.getElementById("editImage");
    targetImage.src = imageURL;
    //context.globalCompositeOperation = "destination-over";
    context.drawImage(targetImage, 10, 10);
}