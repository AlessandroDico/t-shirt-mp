// per Bootstrap
require('./bootstrap');
//per Fabric Js
const fabric = require("fabric").fabric;
// per Domtoimage
var domtoimage = require('dom-to-image');
console.log(domtoimage);


//Creiamo una variabile canvas con funzioni stabilite da Fabric.Js per poter lavorare sulla "tela" della t-shirt
let canvas = new fabric.Canvas('tshirt-canvas');

function updateTshirtImage(imageURL){
	fabric.Image.fromURL(imageURL, function(img) {
		img.scaleToHeight(150);
		img.scaleToWidth(150);
		canvas.centerObject(img);
		canvas.add(img);
		canvas.renderAll();
	});
}

// cambio colore t-shirt tramite background al change della select
document.getElementById("t-shirt-palette").addEventListener('click', function(e) {
    e = e || window.event;
    var target = e.target || e.srcElement,
    text = target.textContent || target.innerText;
	console.log(target);
	document.getElementById("tshirt-container").style.backgroundColor = target.getAttribute("value");
}, false);

//aggiunta stampa scelta tra quelle esistenti e aggiornamento t-shirt
document.getElementById("default-prints-list").addEventListener('click', function(e) {
    e = e || window.event;
    var target = e.target || e.srcElement,
    text = target.textContent || target.innerText;
	updateTshirtImage(target.getAttribute("value"));
}, false);

//funzione per l'upload di un'immagine custom
document.getElementById('tshirt-custompicture').addEventListener("change", function(e){
    var reader = new FileReader();

    reader.onload = function (event){
        var imgObj = new Image();
        imgObj.src = event.target.result;

		//Quando l'immagine viene caricata, crea l'immagine in Fabric.js
        imgObj.onload = function () {
            var img = new fabric.Image(imgObj);

            img.scaleToHeight(150);
            img.scaleToWidth(150);
            canvas.centerObject(img);
            canvas.add(img);
            canvas.renderAll();
        };
    };

    // SE l'utente ha selezionato un'immagine verrà caricata
    if(e.target.files[0]){
        reader.readAsDataURL(e.target.files[0]);
    }
}, false);

//Funzione per la cancellazione di un immagine inserita nella maglietta quando si preme DEL/CANC
document.addEventListener("keydown", function(e) {
    var keyCode = e.keyCode;

    if(keyCode == 46){
        canvas.remove(canvas.getActiveObject());
    }
}, false);


var node = document.getElementById('tshirt-container');

document.getElementById("form-button").addEventListener("click", function(){
	domtoimage.toPng(node).then(function (dataUrl) {
		// dataUrl in Base64
//se il click del form proviane dalla create
		if (document.getElementById("form-button").classList.contains("create-form")) {

			if (canvas._objects.length && document.getElementById("t-shirt-title").value.trim().length >= 6) {
				var img = new Image();
				img.src = dataUrl;
				//assegno ad un input il value della t-shirti in base64
				//tolgo dal dataUrl la stringa fino alla virgola
				let base64String = dataUrl.split(',')[1];

				document.getElementById("special").value = base64String;
				console.log(document.getElementById("special").value);
				//spedisco il form
				document.forms["t-shirt-form"].submit();
			} else {

				alert('aggiungi almeno una stampa e inserisci un titolo di almeno 6 caratteri');
			}
		}

//se il vlick del form proviane dalla edit
		if (document.getElementById("form-button").classList.contains("edit-form")) {

			if (document.getElementById("t-shirt-title").value.trim().length >= 6) {
				var img = new Image();
				img.src = dataUrl;
				//assegno ad un input il value della t-shirti in base64
				//tolgo dal dataUrl la stringa fino alla virgola
				let base64String = dataUrl.split(',')[1];
				// console.log(baseString);
				document.getElementById("special").value = base64String;
				console.log(document.getElementById("special").value);
				document.forms["t-shirt-edit-form"].submit();
			}
		}
	}).catch(function (error) {
		console.error('oops, something went wrong!', error);
	});

}, false);
