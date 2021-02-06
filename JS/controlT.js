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
function displayTaskToggle() {
  var elem = document.getElementById("taskToggle");
  if (elem.value == "Off") {
    elem.value = "On";
    elem.className = "btn btn-success";
    //
    // TODO -- Allow task marker content to be displayed
    //
  } else {
    elem.value = "Off";
    elem.className = "btn btn-danger";
    //
    // TODO -- Stop displaying task marker content
    //
  }
}

function displayAnswerToggle() {
  var elem = document.getElementById("answerToggle");
  if (elem.value == "Off") {
    elem.value = "On";
    elem.className = "btn btn-success";
    //
    // TODO -- Allow answer marker content to be displayed
    //
  } else {
    elem.value = "Off";
    elem.className = "btn btn-danger";
    //
    // TODO -- Stop displaying answer marker content
    //
  }
}

function displayModelToggle() {
  var elem = document.getElementById("modelToggle");
  if (elem.value == "Off") {
    elem.value = "On";
    elem.className = "btn btn-success";
    //
    // TODO -- Allow model marker content to be displayed
    //
  } else {
    elem.value = "Off";
    elem.className = "btn btn-danger";
    //
    // TODO -- Stop displaying model marker content
    //
  }
}
//------------==BUTTONS==------------//
