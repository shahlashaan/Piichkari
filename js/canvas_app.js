var wrapper = document.getElementById("canvas-pad");
var clearButton = document.getElementById("clearCanvas");
// var changeColorButton = wrapper.querySelector("[data-action=change-color]");
var undoButton = document.getElementById("undoCanvas");
var savePNGButton = document.getElementById("savePNG");
var saveJPGButton = document.getElementById("saveJPG");
var canvas = wrapper.querySelector("canvas");
var CanvasPad = new CanvasPad(canvas, {
    backgroundColor: 'rgb(255, 255, 255)'
});
// canvas.style.cursor='pointer';
canvas.style.cursor = 'url(\'./img/canvas/brush.png\'), auto';
document.getElementById('brushButton').disabled = true;
var hexColor = "";
//colorPicker
$(function () {
    var $inlinehex = $('#inlinecolorhex h3 small');
    $('#inlinecolors').minicolors({
        inline: true,
        theme: 'bootstrap',
        change: function (hex) {
            if (!hex) return;
            $inlinehex.html(hex);
            if (document.getElementById('eraserButton').disabled === false){
                CanvasPad.penColor = hex;
                hexColor = hex;
            }
            hexColor = hex;
        }
    });
});

//eraser
function eraser() {
    canvas.style.cursor = 'url(\'./img/canvas/eraser.png\'), auto';
    CanvasPad.penColor = '#ffffff';
    document.getElementById('eraserButton').disabled = true;
    document.getElementById('brushButton').disabled = false;
}

//brush
function brush() {
    canvas.style.cursor = 'url(\'./img/canvas/brush.png\'), auto';
    if (hexColor === "") {
        CanvasPad.penColor = '#000';
    }
    else {
        CanvasPad.penColor = hexColor;
    }
    document.getElementById('eraserButton').disabled = false;
    document.getElementById('brushButton').disabled = true;
}

// Adjust canvas coordinate space taking into account pixel ratio,
// to make it look crisp on mobile devices.
// This also causes canvas to be cleared.
function resizeCanvas() {
    // When zoomed out to less than 100%, for some very strange reason,
    // some browsers report devicePixelRatio as less than 1
    // and only part of the canvas is cleared then.
    var ratio = Math.max(window.devicePixelRatio || 1, 1);

    // This part causes the canvas to be cleared
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext("2d").scale(ratio, ratio);

    CanvasPad.clear();
}

// On mobile devices it might make more sense to listen to orientation change,
// rather than window resize events.
window.onresize = resizeCanvas;
resizeCanvas();

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

// One could simply use Canvas#toBlob method instead, but it's just to show
// that it can be done using result of CanvasPad#toDataURL.
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

clearButton.addEventListener("click", function (event) {
    CanvasPad.clear();
});

undoButton.addEventListener("click", function (event) {
    var data = CanvasPad.toData();

    if (data) {
        data.pop(); // remove the last dot or line
        CanvasPad.fromData(data);
    }
});

// changeColorButton.addEventListener("click", function (event) {
//   var r = Math.round(Math.random() * 255);
//   var g = Math.round(Math.random() * 255);
//   var b = Math.round(Math.random() * 255);
//   var color = "rgb(" + r + "," + g + "," + b +")";
//
//   CanvasPad.penColor = color;
// });

savePNGButton.addEventListener("click", function (event) {
    if (CanvasPad.isEmpty()) {
        swal("Please draw something.");
    }
    else if (document.getElementById("imageTitle").value === "") {
        swal("Please give a title.");
    } else {
        var dataURL = CanvasPad.toDataURL();
        download(dataURL, document.getElementById("imageTitle").value);
    }
});

saveJPGButton.addEventListener("click", function (event) {
    if (CanvasPad.isEmpty()) {
        swal("Please draw something.");
    }else if (document.getElementById("imageTitle").value === "") {
        swal("Please give a title.");
    } else {
        var dataURL = CanvasPad.toDataURL("image/jpeg");
        download(dataURL, document.getElementById("imageTitle").value);
    }
});

