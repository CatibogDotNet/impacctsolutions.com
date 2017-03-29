function displayNextImage() {
        x = (x === images.length - 1) ? 0 : x + 1;
            document.getElementById("img").src = images[x];
			document.getElementById("img2").src = images[x];
		}

    function startTimer() {
        setInterval(displayNextImage, 1000);
    }

    var images = [], x = -1;
		images[0] = "images/logoa.png";
		images[1] = "images/logob.png";
		images[2] = "images/logoc.png";
		images[3] = "images/logod.png";
		images[4] = "images/logoe.png";
		images[5] = "images/logof.png";
