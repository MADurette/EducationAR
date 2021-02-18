const fs = require('fs');

const data = {
"RefreshRate" : "60",

"Markers":[

{"Task":[{
"Src" : "Materials/Imgs/BaseBinary-HexProblem1Transparent.png",
"Loc" : [0,0,0],
"Dir" : [0,0,0],
"Rot" : [0,0,0],
"Control" : "False",
"Types" : [1,0,0]
}]}

{"Answer":[{
"Src" : "Materials/Imgs/BaseBinary-HexProblem1TransparentANS.png",
"Loc" : [0,0,0],
"Dir" : [0,0,0],
"Rot" : [0,0,0],
"Control" : "False",
"Types" : [1,0,0]
}]}

{"Model":[{
"Src" : "Materials/Imgs/BaseBinary-HexProblem1.png",
"Loc" : [0,0,0],
"Dir" : [0,0,0],
"Rot" : [0,0,0],
"Control" : "False",
"Types" : [1,0,0]
}]}
]
};

const jsdata = JSON.stringify(data);

fs.writeFile('Data/Data.json', jsdata, (err) =>{
	if(err){
		throw err
	}
	console.log("Data has been saved");
});