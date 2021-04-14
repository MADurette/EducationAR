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

    // Handles uploading new files to the server and their respective information to the DB
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
            $sql = "INSERT INTO DisplayFiles (fileName, extension, filepath, projectiontype) VALUES ('$name', '$fileExtension', 'materials/imgs/', '$projectionType');";
            if (mysqli_query($conn, $sql)) {
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            // $sql = "UPDATE ControlData SET Source = 'materials/imgs/$name' WHERE MarkerArea = '$projectionType';";
            // if (mysqli_query($conn, $sql)) {
            // } else {
            //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            // }
        }
    }

    //Simply pushes the currently selected file on the right card to be displayed
    function pushFile($projectionType) {
        global $conn;

        $fileName = $_REQUEST['src'];

        $sql = "UPDATE ControlData SET Source = '$fileName' WHERE MarkerArea = '$projectionType';";
        if (mysqli_query($conn, $sql)) {
            
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    
    // Handles pushing data to server database upon user submission
    function postData() {
        global $conn;
        // Get all inputs from form
        $taskToggle = $_REQUEST['taskToggle'];
        $xAxisTask = $_REQUEST['xAxisTask'];
        $yAxisTask = $_REQUEST['yAxisTask'];
        $answerToggle = $_REQUEST['answerToggle'];
        $xAxisAns = $_REQUEST['xAxisAns'];
        $yAxisAns = $_REQUEST['yAxisAns'];
        $modelToggle = $_REQUEST['modelToggle'];
        $xAxisMod = $_REQUEST['xAxisMod'];
        $yAxisMod = $_REQUEST['yAxisMod'];

        $sql = "UPDATE ControlData SET XPos = '$xAxisTask', YPos = '$yAxisTask' WHERE MarkerArea = 'task';";
        if (mysqli_query($conn, $sql)) {

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        $sql = "UPDATE ControlData SET XPos = '$xAxisMod', YPos = '$yAxisMod' WHERE MarkerArea = 'model';";
        if (mysqli_query($conn, $sql)) {

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Pulls names of images from DB and stores them in an array
    function getGalleryInfo() {
        global $conn;

        $imgNameArray = [];
        $sql = "SELECT fileName, filePath FROM DisplayFiles;";
        if ($result = mysqli_query($conn, $sql)) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($imgNameArray, $row['filePath'] . $row['fileName']);
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        $arraySize = count($imgNameArray);
        return $imgNameArray;
    }
?>

<!DOCTYPE html>

<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <title>ARPS: Instructor Control Panel</title>
        <link rel="shortcut icon" href="" type="image/x-icon">
        <link rel="stylesheet" href="./CSS/bootstrap.min.css">
        <link rel="stylesheet" href="./CSS/control.css">
        <script src="./JS/control.js"></script>
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
        <?php //postData()?>
        <!--<form action="" method="post" enctype="multipart/form-data">-->
            <div class="container-fluid h-100" id="mainWorkspaceDiv">
                <div class="row" id="mainWorkspace" style="margin-bottom:20px;">
                    <div class="col-sm-4 align-self-center" id="leftControl" style="display:none;">
                        <div class="card">
                            <div class="card-header">
                                <h6>Controls</h6>
                            </div>
                            <div class="card-body">
                                <p><b>Display Task:</b></p>
                                <input onclick="displayToggle('taskToggle')" type="checkbox" class="btn btn-danger" id="taskToggle" value="Off" name="taskToggle">
                                <p></p>
                                <p><b>Task Position:</b></p>
                                <div class="slidecontainer">
                                    <input type="range" min="-128" max="127" value="0" class="slider" id="xAxisTask" name="xAxisTask">
                                    <p id="xValTask"></p>
									<input type="range" min="-128" max="127" value="0" class="slider" id="yAxisTask" name="yAxisTask">
									<p id="yValTask"></p>
                                </div>
								<hr class="solid"><br>
                                <p><b>Display Answer:</b></p>
                                <input onclick="displayToggle('answerToggle')" type="checkbox" class="btn btn-danger" id="answerToggle" value="Off" name="answerToggle">
                                <p></p>
                                <p><b>Hint Position:</b></p>
                                <div class="slidecontainer">
                                    <input type="range" min="-128" max="127" value="0" class="slider" id="xAxisAns" name="xAxisAns">
									<p id="xValAns"></p>
                                    <input type="range" min="-128" max="127" value="0" class="slider" id="yAxisAns" name="yAxisAns">
									<p id="yValAns"></p>
								</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 align-self-center" id="markerSpace">
                        <div class="row" id="topMarkers">
                            <div class="col-sm-6 align-self-center" id="galleryContainer">
                                <div class="jumbotron" style="height:570px;">
                                    <h6 id="galleryHeader">MARKER IMAGE GALLERY</h6>
                                    <div id="gallery">
                                        <script>
                                            var array = <?php echo json_encode(getGalleryInfo()); ?>;
                                            GalleryFill(array);
                                        </script>
                                    </div>
                                    <?php uploadFile($_FILES['taskUploadFile'], 'task'); ?>
                                    <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="btn btn-group" role="group" id="tMarkButtons">
                                        <span class="btn btn-file btn-primary">Choose New<input type="file" oninput="uploadFile('taskUploadFile', 'tCenter', 'tImage')" id="taskUploadFile" name="taskUploadFile"></span>
                                        <button type="submit" class="btn btn-success" id="Submit">Upload</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-6 align-self-center" id="tMarker">
                                <div class="jumbotron">
                                    <h6 id="tAreaHeader">CURRENT MARKER IMAGE</h6>
                                    <?php pushFile('Task'); ?>
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <span id="tCenter">
                                            <img id="taskimg" src="" style="width:400px;height:400px;margin:20px;">
                                        </span>
                                        <div class="btn btn-group" role="group" id="pushMarkerButtons">
                                            <button class="btn btn-primary" id="sequencePrev"><</button>
                                            <button class="btn btn-primary" id="sequenceNext">></button>
                                            <button type="submit" class="btn btn-success" id="pushMarkerFile">Push Image</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 align-self-center" id="mMarker">
                                <div class="jumbotron">
                                    <h6 id="mAreaHeader">MODEL</h6>
                                    <span id="mCenter">
									<div class="row">	
								
										<div style="margin:auto;">
										<img src="" style="width:700px;height:500px;background-color:black;margin:20px;">
										</div>
										
									<div style="margin:auto;">
										<p><b>Model Position:</b></p>
									<div class="slidecontainer">
										<input type="range" min="-128" max="127" value="0" class="slider" id="xAxisMod" name="xAxisMod">
										<p id="xValMod"></p>
										<input type="range" min="-128" max="127" value="0" class="slider" id="yAxisMod" name="yAxisMod">
										<p id="yValMod"></p>
									</div>
									</div>
									</div>
                                    </span>
                                    <div class="btn btn-group" id=mMarkButtons>
                                            <?php uploadFile($_FILES['modelUploadFile'], 'model')?>
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <span class="btn btn-file btn-primary">Upload New<input type="file" oninput="uploadFile('modelUploadFile', 'mCenter', 'mImage')" id="modelUploadFile" name="modelUploadFile"></span>
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
