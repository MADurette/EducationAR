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
function displayToggle(toggleID) {
  var toggle = document.getElementById(toggleID);
  if (toggle.value == "Off") {
    toggle.value = "On";
    toggle.className = "btn btn-success";
    //
    // TODO -- Allow marker content to be displayed on AR projection
    //
  } else {
    toggle.value = "Off";
    toggle.className = "btn btn-danger";
    //
    // TODO -- Stop displaying marker content on AR projection
    //
  }
}

//Originally used to display newly uploaded image
function uploadFile(markerArea, center, image) {
  var file = document.getElementById(markerArea).files[0];
  var span = document.getElementById(center);
  var imgHTML = '<img src="" class="img-fluid" height="300" id="' + image + '">';
  span.innerHTML = imgHTML;
  var img = document.getElementById(image);
  img.src = URL.createObjectURL(file);
}

//Displays name of file to upload next to upload button. 
function prepUploadFile() {
  var file = document.getElementById("taskUploadFile").value;
  var res = file.split("\\");
  file = res[res.length - 1];
  var target = document.getElementById("Submit");
  console.log(target);
  target.innerHTML = "Upload: " + file;
}

function GalleryFill(array) {
  for (i = array.length - 1; i >= 0; i--) {
    document.getElementById("gallery").innerHTML += "<button class='galimg'><img src='" + array[i] + "' onclick=showSelectedFile(\'" + array[i] + "\')></button>";
  }
}

function showSelectedFile(input) {
  console.log(input);
  //CHANGES CURRENT DISPLAYED MARKER IMAGE
  var span = document.getElementById('tCenter');
  var imgHTML = '<img src="" class="img-fluid" id="taskimg" style="width:400px;height:400px;margin:20px;">';
  span.innerHTML = imgHTML;
  var img = document.getElementById('taskimg');
  img.src = input;
  img.value = input;
  singleSelectedFile = input;

  //CHANGES SRCTOPUSH FOR WHEN PUSH OCCURS
  var hiddenInput = document.getElementById("srcToPush");
  hiddenInput.value = input;
}
