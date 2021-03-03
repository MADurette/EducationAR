window.onload = function () {
    document.querySelector(".hint-button").addEventListener("click", function () {
            // here you can change also a-scene or a-entity properties, like
            // changing your 3D model source, size, position and so on
            // or you can just open links, trigger actions...
            alert("Hint Box");
        });
}

function loaddata() {
    var name = document.getElementById("username");
    if (name) {
        $.ajax({
            type: 'post',
            url: 'Config/loaddata.php',
            data: {
                user_name: name,
            },
            success: function (response) {
                // We get the element having id of display_info and put the response inside it
                InsertData(response);
            }
        });
    }
    else {
        console.log("Error loading data from Database");
    }
}

function InsertData(data) {
    document.getElementById("Tasktexture").src = "";
    document.getElementById("Answertexture").src = "";
    document.getElementById("Modeltexture").src = "";
    document.getElementById("3dobj").src = "";
    document.getElementById("Prerecordedvid").src = "";
    document.getElementById("Aentity").position = "";
    document.getElementById("Tentity").position = "";
    document.getElementById("Mentity").position = "";
    document.getElementById("Aentity").scale = "";
    document.getElementById("Tentity").scale = "";
    document.getElementById("Mentity").scale = "";
    document.getElementById("Aentity").animation = "";
    document.getElementById("Tentity").animation = "";
    document.getElementById("Mentity").animation = "";
}

document.addEventListener("DOMContentLoaded", function (event) {
    var scene = document.querySelector("a-scene");
    var vid = document.getElementById("Prerecordedvid");
    var videoShere = document.getElementById("3dvid");

    if (scene.hasLoaded) {
        run();
    } else {
        scene.addEventListener("loaded", run);
    }

    function run() {
        if (AFRAME.utils.device.isMobile()) {
            document.querySelector('#splash').style.display = 'flex';
            document.querySelector('#splash').addEventListener('click', function () {
                playVideo();
                this.style.display = 'none';
            })
        } else {
            playVideo();
        }
    }

    function playVideo() {
        vid.play();
        videoShere.components.material.material.map.image.play();
    }
})