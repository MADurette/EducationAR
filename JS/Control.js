/*
//------------==SLIDERS==------------//
//TASK PROJECTION X and Y positioning
var xsliderT = document.getElementById("xAxisTask");
var xoutputT = document.getElementById("xValTask");
var ySliderT = document.getElementById("yAxisTask");
var yOutputT = document.getElementById("yValTask");

xoutputT.innerHTML = "X Pos: " + xsliderT.value; // Display the default slider value
yOutputT.innerHTML = "Y Pos: " + ySliderT.value;

// Update the current slider value (each time you drag the slider handle)
xsliderT.oninput = function () {
  xoutputT.innerHTML = "X Pos: " + this.value;
}

ySliderT.oninput = function () {
  yOutputT.innerHTML = "Y Pos: " + this.value;
}

// ANSWER PROJECTION X and Y positioning
var xSliderA = document.getElementById("xAxisAns");
var xOutputA = document.getElementById("xValAns");
var ySliderA = document.getElementById("yAxisAns");
var yOutputA = document.getElementById("yValAns");

xOutputA.innerHTML = "X Pos: " + xSliderA.value;
yOutputA.innerHTML = "Y Pos: " + ySliderA.value;

xSliderA.oninput = function () {
  xOutputA.innerHTML = "X Pos: " + this.value;
}

ySliderA.oninput = function () {
  yOutputA.innerHTML = "Y Pos: " + this.value;
}
*/
// MODEL PROJECTION X and Y positioning
var xSliderM = document.getElementById("xAxisMod");
var xOutputM = document.getElementById("xValMod");
var ySliderM = document.getElementById("yAxisMod");
var yOutputM = document.getElementById("yValMod");

xOutputM.innerHTML = "X Pos: " + xSliderM.value;
yOutputM.innerHTML = "Y Pos: " + ySliderM.value;

xSliderM.oninput = function () {
  xOutputM.innerHTML = "X Pos: " + this.value;
}

ySliderM.oninput = function () {
  yOutputM.innerHTML = "Y Pos: " + this.value;
}
//------------==SLIDERS==------------//

//------------==BUTTONS==------------//
/*
function displayToggle(toggleID) {
  var toggle = document.getElementById(toggleID);
  if (toggle.value == "Off") {
    toggle.value = "On";
    toggle.className = "btn btn-success";
  } else {
    toggle.value = "Off";
    toggle.className = "btn btn-danger";
  }
}
*/
//ABOVE DEPRECATED.

//Originally used to display newly uploaded image
function uploadFile(markerArea, center, image) {
  var file = document.getElementById(markerArea).files[0];
  var span = document.getElementById(center);
  var imgHTML = '<img src="" class="img-fluid" id="audienceImg" style="height:500px;margin:20px;">';
  span.innerHTML = imgHTML;
  var img = document.getElementById(image);
  img.src = URL.createObjectURL(file);
}

function showSelectedFile(input) {
  console.log(input);
  //CHANGES CURRENT DISPLAYED MARKER IMAGE
  var span = document.getElementById('markerCenter');
  var imgHTML = '<img src="" class="img-fluid" id="markerImg" style="height:400px;margin:20px;">';
  span.innerHTML = imgHTML;
  var img = document.getElementById('markerImg');
  img.src = input;
  img.value = input;

  //CHANGES SRCTOPUSH FOR WHEN PUSH OCCURS
  var hiddenInput = document.getElementById("srcToPush");
  hiddenInput.value = input;
}

function changeModelFile() {
  var input = document.getElementById('modelUploadFile').files[0]
  console.log(input);
  var span = document.getElementById('modImgDiv');
  var imgHTML = '<img src="" class="img-fluid" id="modelImg" style="height:500px;margin:20px;">';
  span.innerHTML = imgHTML;
  var img = document.getElementById('modelImg');
  img.src = URL.createObjectURL(input);
}

//Displays name of file to upload next to upload button. 
function prepUploadFile() {
  var file = document.getElementById("markerUploadFile").value;
  var res = file.split("\\");
  file = res[res.length - 1];
  var target = document.getElementById("markerSubmit");
  target.innerHTML = "Upload: " + file;
}
//------------==BUTTONS==------------//

function GalleryFill(array) {
  for (i = array.length - 1; i >= 0; i--) {
    document.getElementById("gallery").innerHTML += "<button class='galimg'><img src='" + array[i] + "' onclick=showSelectedFile(\'" + array[i] + "\')></button>";
  }
}
