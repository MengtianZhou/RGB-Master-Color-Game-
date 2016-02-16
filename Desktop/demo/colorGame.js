var numSquares = 6;
var colors= generateRandomColors(numSquares);
var squares = document.querySelectorAll(".square");
var pickedColor = pickColor();
var colorDisplay = document.querySelector("#colorDisplay");
var messageDisplay = document.querySelector("#message");
var h1 = document.querySelector("h1");
var resetButton = document.querySelector("#reset");
var modeButtons = document.querySelectorAll(".mode");

init();

function init() {
	//setupModeListener
	setupModeListener();
	//setupSquares
	setupSquares();
	//reset
	reset();
}

function setupModeListener(){
	for (var i = 0; i < modeButtons.length; i++) {
		modeButtons[i].addEventListener("click", function(){
			modeButtons[0].classList.remove("selected");
			modeButtons[1].classList.remove("selected");
			this.classList.add("selected");
			if (this.textContent ==="Easy") {
				numSquares = 3;
			} else {
				numSquares = 6;
			}
			reset();
		});
	}
	resetButton.addEventListener("click", function(){
		reset();
	});
}

function setupSquares(){
	colorDisplay.textContent = pickedColor;
	for(var i = 0; i < squares.length; i++) {
		//add initial colors to squares
		squares[i].style.background = colors[i];
		//add click listeners to squares
		squares[i].addEventListener("click", function(){
			var clickedColor = this.style.background;
			//compare color to pickedColor
			if (clickedColor === pickedColor) {
				messageDisplay.textContent = "Correct!";
				changeColors(pickedColor);
				resetButton.textContent = "Play Again?";
				h1.style.background = pickedColor;
			} else {
				this.style.background = "#232323";
				messageDisplay.textContent = "Try Again!";
			}
		});
	}
}

function reset(){
	//generate all new colors
	colors = generateRandomColors(numSquares);
	//pick a new random color from array
	pickedColor = pickColor();
	//change colorDisplay to match picked color
	colorDisplay.textContent = pickedColor;
	messageDisplay.textContent = "";
	resetButton.textContent = "New colors"
	//change colors of squares
	for (var i = 0; i < squares.length; i++) {
		if (colors[i]) {
			//show squares
			squares[i].style.display = "block";
			//change each color to match given color
			squares[i].style.background = colors[i];	
		} else {
			squares[i].style.display = "none";
		}
	}
	h1.style.background = "steelblue";
}

function changeColors(color) {
	//loop through all squares
	for(var i = 0; i < colors.length; i++) {
		//change each color to match given color
		squares[i].style.background = color;
	}	
}

function pickColor(){
	var random = Math.floor(Math.random() * colors.length);
	return colors[random];
}

function generateRandomColors(num) {
	//make an array
	var colors = [];
	//add num random colors to array
	for (var i = 0; i < num; i++) {
		//get random color and push into array
		colors.push(randomColor());
	}
	//return that array
	return colors;
}

function randomColor(){
	//pick a "red" from 0-255
	var r = Math.floor(Math.random() * 256);
	//pick a "green" from 0-255
	var g = Math.floor(Math.random() * 256);
	//pick a "blue" from 0-255
	var b = Math.floor(Math.random() * 256);
	// "rgb(r, g, b)"
	return "rgb(" + r + ", " + g + ", " + b + ")";
}