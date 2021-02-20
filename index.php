<?php
#require_once($_SERVER['DOCUMENT_ROOT'].'/xampp/EducationAR/Config/mysqlconfig.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Classroom AR</title>
	<link rel="shortcut icon" href="" type="image/x-icon">
	<link rel="stylesheet" href="CSS/Style.css">
    <script src="Frameworks/Aframe.min.js"></script>
    <!-- we import arjs version without NFT but with marker + location based support -->
    <script src="Frameworks/Aframe-ar.js"></script>
	  <script src="https://raw.githack.com/fcor/arjs-gestures/master/dist/gestures.js"></script>
    <script>
      window.onload = function () {
        document
        .querySelector(".hint-button")
        .addEventListener("click", function () {
          // here you can change also a-scene or a-entity properties, like
          // changing your 3D model source, size, position and so on
          // or you can just open links, trigger actions...
          alert("Hint Box");
        });
      };
	  
	  var name = 0;
	
	  function loaddata(){
	  var name=document.getElementById( "username" );
	
	  if(name){
		$.ajax({
			type: 'post',
			url: 'Config/loaddata.php',
			data: {
				user_name:name,
			},
			success: function (response) {
	  // We get the element having id of display_info and put the response inside it
      console.log(response);
	  }});
	  }
	  else{
		  console.log("Test");
		  }
	  }
      </script>
  <style>
    .buttons {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 5em;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 10;
    }
	
	#splash {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;

        align-items: center;
        justify-content: center;
        
        background: rgba(0, 0, 0, 1);
        color: white;
        cursor: pointer;
        z-index: 999;
      }
  </style>
  <meta name="apple-mobile-web-app-capable" content="yes">
  <script>
      document.addEventListener("DOMContentLoaded", function(event) {
        var scene = document.querySelector("a-scene");
        var vid = document.getElementById("Prerecordedvid");
        var videoShere = document.getElementById("3dvid");

        if (scene.hasLoaded) {
          run();
        } else {
          scene.addEventListener("loaded", run);
        }
        
        function run () {
          if(AFRAME.utils.device.isMobile()) {
            document.querySelector('#splash').style.display = 'flex';
            document.querySelector('#splash').addEventListener('click', function () {
              playVideo();
              this.style.display = 'none';
            })
          } else {
              playVideo();
          }
        }
        
        function playVideo () {
          vid.play();
          videoShere.components.material.material.map.image.play();
        }
      })
    </script>
	</head>
    <body style="margin : 0px; overflow: hidden;">
	<div class="buttons">
      <button class="hint-button" style="display:none;">Hints</button>
    </div>
	<div id="splash">
      <div id="start-button">Click</div>
    </div>
		<a-assets>
			<img id="Tasktexture" src="Materials/Imgs/BaseBinary-HexProblem1Transparent.png" style="width:100%;">
			<img id="Answertexture" src="Materials/Imgs/BaseBinary-HexProblem1TransparentANS.png" style="width:100%;">
			<img id="Modeltexture" src="Materials/Imgs/BaseBinary-HexProblem1.png" style="width:100%;">
			<video id="Prerecordedvid" autoplay loop="true" src="Materials/Videos/Digital.mp4"></video>
			<a-asset-item id="dna-obj" src="Materials/Models/dna.obj"></a-asset-item>
			<a-mixin id="normal" scale=".05 .05 .05"></a-mixin>
		</a-assets>
        <a-scene embedded arjs="sourceType: webcam; patternRatio: 0.75 trackingMethod: best maxDetectionRate: 60 detectionMode: mono" renderer="antialias: true; alpha: true; precision: medium; logarithmicDepthBuffer: true;" vr-mode-ui="enabled: false;" gesture-detector id="scene">
		<!-- Marker T is the marker for Pictures with tasks-->
		<a-marker type="pattern" url="Markers/MarkerFile/pattern-T.patt" id="markerT">
              <a-entity geometry="primitive:plane;height:2;width:2;" position="2 0 .5" rotation="-90 0 0" material="src:#Tasktexture;shader:flat;"></a-entity>
        </a-marker>
		<!-- Marker A is the marker for Pictures with Answers or Hints-->
		<a-marker type="pattern" url="Markers/MarkerFile/pattern-A.patt" id="markerA">
              <a-video id="3dvid" src="#Prerecordedvid" width="3" height="3" position="0 0 0" rotation="-90 0 0" webkit-playsinline playsinline></a-video>
        </a-marker>
		<!-- Marker M is the marker for Models and Helpful Infographics-->
		<a-marker type="pattern" url="Markers/MarkerFile/pattern-M.patt" raycaster="objects: .clickable"  emitevents="true" cursor="fuse: false; rayOrigin: mouse;" id="markerM">
			  <a-entity mixin="normal" animation="property: rotation; to: 360 0 0; loop: true; dur: 10000" obj-model="obj: #dna-obj;" class="clickable" gesture-handler></a-entity>
        </a-marker>
        <a-entity camera></a-entity>
        </a-scene>
    </body>
</html>
