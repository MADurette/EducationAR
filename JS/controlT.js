//------------==SLIDERS==------------//
//TASK PROJECTION X and Y positioning
var xsliderT = document.getElementById("xAxisTask");
var xoutputT = document.getElementById("xValTask");
var ySliderT = document.getElementById("yAxisTask");
var yOutputT = document.getElementById("yValTask");

xoutputT.innerHTML = "X Pos: " + xsliderT.value; // Display the default slider value
yOutputT.innerHTML = "Y Pos: " + ySliderT.value;

// Update the current slider value (each time you drag the slider handle)
xsliderT.oninput = function() {
    xoutputT.innerHTML =  "X Pos: " + this.value;
}
  
ySliderT.oninput = function() {
    yOutputT.innerHTML = "Y Pos: " + this.value;
}

// ANSWER PROJECTION X and Y positioning
var xSliderA = document.getElementById("xAxisAns");
var xOutputA = document.getElementById("xValAns");
var ySliderA = document.getElementById("yAxisAns");
var yOutputA = document.getElementById("yValAns");

xOutputA.innerHTML = "X Pos: " + xSliderA.value;
yOutputA.innerHTML = "Y Pos: " + ySliderA.value;

xSliderA.oninput = function() {
  xOutputA.innerHTML =  "X Pos: " + this.value;
}

ySliderA.oninput = function() {
    yOutputA.innerHTML = "Y Pos: " + this.value;
}

// MODEL PROJECTION X and Y positioning
var xSliderM = document.getElementById("xAxisMod");
var xOutputM = document.getElementById("xValMod");
var ySliderM = document.getElementById("yAxisMod");
var yOutputM = document.getElementById("yValMod");

xOutputM.innerHTML = "X Pos: " + xSliderM.value;
yOutputM.innerHTML = "Y Pos: " + ySliderA.value;

xSliderM.oninput = function() {
  xOutputM.innerHTML =  "X Pos: " + this.value;
}

ySliderM.oninput = function() {
    yOutputA.innerHTML = "Y Pos: " + this.value;
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

function chooseFile(markerArea, center, image) {
  var file = document.getElementById(markerArea).files[0];
  var span = document.getElementById(center);
  var imgHTML = '<img src="" class="img-fluid" height="300" id="' + image + '">';
  span.innerHTML = imgHTML;
  var img = document.getElementById(image);
  img.src = URL.createObjectURL(file); // TODO -- find how to restore file name and store
  //
  // TODO -- Push file to wherever files are stored for students to view
  //
}

