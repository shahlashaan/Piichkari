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
    if (document.getElementById("imageTitle").value === "") {
        swal("Please give a title.");
    } else {
        var dataURL = lc.getImage().toDataURL("image/jpeg");
        download(dataURL, document.getElementById("imageTitle").value);
    }
}

function downloadPNG() {
    if (document.getElementById("imageTitle").value === "") {
        swal("Please give a title.");
    } else {
        var dataURL = lc.getImage().toDataURL("image/png");
        download(dataURL, document.getElementById("imageTitle").value);
    }
}

function save(){
    if (document.getElementById("imageTitle").value === "") {
        swal("Please give a title.");
    } else {
        var dataURL = lc.getImage().toDataURL("image/jpeg");
        document.getElementById("imageDataURL").value = dataURL;
    }
}