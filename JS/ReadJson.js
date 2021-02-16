var dataset;

fetch("./Data/Data.json")
.then(response => {
	return response.json();
})
.then(data => reload(data))
.then(() => console.log(dataset));

function reload(data){
	console.log(data);
}