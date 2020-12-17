var control = false

function Control(){
	control = !control;
	if(control == true){
		document.getElementById("Controlbtn").value = "Stop Control";
	}else{
		document.getElementById("Controlbtn").value = "Take Control";
	}
}

var slider = document.getElementById("Rotation");
var output = document.getElementById("RotValue");
output.innerHTML = slider.value; // Display the default slider value

// Update the current slider value (each time you drag the slider handle)
slider.oninput = function() {
  output.innerHTML = this.value;
}