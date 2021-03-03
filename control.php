<?php
    #require_once($_SERVER['DOCUMENT_ROOT'].'/xampp/EducationAR/Config/mysqlconfig.php');
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>ARPS: Instructor Control Panel</title>
        <link rel="shortcut icon" href="" type="image/x-icon">
        <link rel="stylesheet" href="./CSS/bootstrap.min.css">
        <link rel="stylesheet" href="./CSS/control.css">
        <script src="./JS/control.js" async></script>
    </head>
    <body>
        <!--TOP "ARPS: INSTRUCTOR CONTROL PANEL" BAR-->
        <div class="container-fluid" id="topBar">
            <h4>ARPS: Instructor Control Panel</h4>
        </div>
        <div class="container" id="separator" style="margin-bottom: 2%;">
        </div>
        <!--MAIN WORKSPACE OF CONTROL PANEL INCLUDES
            1) LEFTHAND CONTROL PANEL
            2) "TOP" TASK & ANSWER MARKER CONTROL AREAS
            3) RIGHTHAND CONTROL PANEL
            4) "BOTTOM" MODEL MARKER CONTROL AREA-->
        <form>
            <div class="container-fluid h-100" id="mainWorkspaceDiv">
                <div class="row" id="mainWorkspace" style="margin-bottom:20px;">
                    <div class="col-sm-4 align-self-center" id="leftControl">
                        <div class="card">
                            <div class="card-header">
                                <h6>Controls</h6>
                            </div>
                            <div class="card-body">
                                <p><b>Display Task:</b></p>
                                <input onclick="displayToggle('taskToggle')" type="button" class="btn btn-danger" id="taskToggle" value="Off">
                                <p></p>
                                <p><b>Task Position:</b></p>
                                <div class="slidecontainer">
                                    <input type="range" min="-128" max="127" value="0" class="slider" id="xAxisTask">
                                    <p id="xValTask"></p>
									<input type="range" min="-128" max="127" value="0" class="slider" id="yAxisTask">
									<p id="yValTask"></p>
                                </div>
								<hr class="solid"><br>
                                <p><b>Display Answer:</b></p>
                                <input onclick="displayToggle('answerToggle')" type="button" class="btn btn-danger" id="answerToggle" value="Off">
                                <p></p>
                                <p><b>Answer Position:</b></p>
                                <div class="slidecontainer">
                                    <input type="range" min="-128" max="127" value="0" class="slider" id="xAxisAns">
									<p id="xValAns"></p>
                                    <input type="range" min="-128" max="127" value="0" class="slider" id="yAxisAns">
									<p id="yValAns"></p>
								</div>
								<hr class="solid"><br>
                                <p><b>Display:</b></p>
                                <input onclick="displayToggle('modelToggle')" type="button" class="btn btn-danger" id="modelToggle" value="Off">
                                <p></p>
                                <p><b>Model Position:</b></p>
                                <div class="slidecontainer">
                                    <input type="range" min="-128" max="127" value="0" class="slider" id="xAxisMod">
									<p id="xValMod"></p>
                                    <input type="range" min="-128" max="127" value="0" class="slider" id="yAxisMod">
									<p id="yValMod"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8 align-self-center" id="markerSpace">
                        <div class="row" id="topMarkers">
                            <div class="col-sm-6 align-self-center" id="tMarker">
                                <div class="jumbotron">
                                    <h6 id="tAreaHeader">TASK MARKER AREA</h6>
                                    <span id="tCenter">
                                        <h3>No file selected</h3>
                                    </span>
                                    <div class="btn btn-group" id=tMarkButtons>
                                        <input type="button" class="btn btn-primary" onclick="chooseExisting('tCenter')" id="taskUpload" value="Choose Existing">
                                        <span class="btn btn-file btn-success">Upload New<input type="file" oninput="uploadFile('taskUploadFile', 'tCenter', 'tImage')" id="taskUploadFile"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 align-self-center" id="aMarker">
                                <div class="jumbotron">
                                    <h6 id="aAreaHeader">ANSWER MARKER AREA</h6>
                                    <span id="aCenter">
                                        <h3>No file selected</h3>
                                    </span>
                                    <div class="btn btn-group" id=aMarkButtons>
                                        <input type="button" class="btn btn-primary" onclick="chooseExisting('aCenter')" id="answerUpload" value="Choose Existing">
                                        <span class="btn btn-file btn-success">Upload New<input type="file" oninput="uploadFile('answerUploadFile', 'aCenter', 'aImage')" id="answerUploadFile"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 align-self-center" id="mMarker">
                                <div class="jumbotron">
                                    <h6 id="mAreaHeader">MODEL MARKER AREA</h6>
                                    <span id="mCenter">
                                        <h3>No file selected</h3>
                                    </span>
                                    <div class="btn btn-group" id=mMarkButtons>
                                        <input type="button" class="btn btn-primary" onclick="chooseExisting('mCenter')" id="modelUpload" value="Choose Existing">
                                        <span class="btn btn-file btn-success">Upload New<input type="file" oninput="uploadFile('modelUploadFile', 'mCenter', 'mImage')" id="modelUploadFile"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="text-center">
							<button type="submit" class="btn btn-success" id="masterSubmit higher">Submit</button>
						</div>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>