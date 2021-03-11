<?php
    /* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'educarps_defUser');
    define('DB_PASSWORD', 'thisIsOurDefaultUser');
    define('DB_NAME', 'educarps_DisplayFiles');
 
    // Attempt to connect to MySQL database
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
    // Check for good connection
    if (!$conn) {
        die("Connection failed: ".mysqli_connect_error());
    }

    function uploadFile($fileName, $projectionType) {
        global $conn;
        // Taken from https://www.youtube.com/watch?v=2jxM7IwpiXc
        if (isset($fileName)) {
             // List of errors that could come up when uploading, use print_r['taskUploadFile'] somewhere below to check for code
            $uploadErrors = array(
                0 => 'Success',
                1 => 'File is larger than specified size limit',
                2 => 'File is too large for HTML form',
                3 => 'Partial upload',
                4 => 'No file uploaded',
                6 => 'Missing temporary folder',
                7 => 'Failed to write file to disk',
                8 => 'Something else stopped the upload'
            );
            $name = $_FILES['taskUploadFile']['name']; // Just gives the name of the file, used for writing to database
        
            //$extensiontError = false;       // Can be implemented when we figure out what files shouldn't go in
            //$extensions = array();
            $fileExtension = explode('.', $fileName);
            $fileExtension = end($fileExtension);

            /*
            if (!in_array($fileExtension, $extensions)) {   // Part of extension checking
                $extensiontError = true;
            }
            */

            if ($fileName['name'] != 0) {
                echo $uploadErrors[$_FILES['taskUploadFile']['name']];
            } else if ($extensiontError) {
                echo 'Invalid file extension';
            }

            move_uploaded_file($fileName['tmp_name'], 'materials/imgs/'.$fileName['name']);
            //TODO -- MAKE WRITING TO THE DATABASE WORK
            $sql = "INSERT INTO DisplayFiles (name, extension, filepath, projectiontype) VALUES ('$name', '$fileExtension', 'materials/imgs/', '$projectionType')";

            if (mysqli_query($conn, $sql)) {
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
    }}
    
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
        <!--<form action="" method="post" enctype="multipart/form-data">-->
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
                                        <input type="button" class="btn btn-secondary" onclick="chooseExisting('tCenter')" id="taskUpload" value="Choose Existing">
                                            <?php uploadFile($_FILES['taskUploadFile'], 'task')?>
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <span class="btn btn-file btn-primary">Upload New<input type="file" oninput="uploadFile('taskUploadFile', 'tCenter', 'tImage')" id="taskUploadFile" name="taskUploadFile"></span>
                                                <input type="submit" class="btn btn-success" value="Upload">
                                            </form>
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
                                        <input type="button" class="btn btn-secondary" onclick="chooseExisting('aCenter')" id="answerUpload" value="Choose Existing">
                                            <?php uploadFile($_FILES['answerUploadFile'], 'answer')?>
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <span class="btn btn-file btn-primary">Upload New<input type="file" oninput="uploadFile('answerUploadFile', 'aCenter', 'aImage')" id="answerUploadFile" name="answerUploadFile"></span>
                                                <input type="submit" class="btn btn-success" value="Upload">
                                            </form>
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
                                        <input type="button" class="btn btn-secondary" onclick="chooseExisting('mCenter')" id="modelUpload" value="Choose Existing">
                                            <?php uploadFile($_FILES['modelUploadFile'], 'model')?>
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <span class="btn btn-file btn-primary">Upload New<input type="file" oninput="uploadFile('modelUploadFile', 'mCenter', 'mImage')" id="modelUploadFile" name="modelUploadFile"></span>
                                                <input type="submit" class="btn btn-success" value="Upload">
                                            </form>
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
        <!--</form>-->
    </body>
</html>