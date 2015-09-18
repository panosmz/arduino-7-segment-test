/*
Displays a message on the connected arduino.
©2015 Panos Mazarakis 
Open-source - released under GNU Licence.
https://github.com/panosmz/arduinoledtest
*/

$(document).ready(function() {

	$(".error").delay(4500).fadeOut();

	$('#input-text').keyup(function(event){
		var len = $('#input-text').val().length;
		var wlimit = "/15";
		if (len == 0) {
			$("#remaining-char").text(len+wlimit);
			$("#remaining-char").css("color", "gray");
		} else if (len < 15) {
			$("#remaining-char").text(len+wlimit);
			$("#remaining-char").css("color", "limegreen");
		} else {
			$("#remaining-char").text(len+wlimit);
			$("#remaining-char").css("color", "red");
		}
	});

	lcdDisplay();


});

function lcdDisplay() {

	var currentMessage = $('#current-mess').text()+" ";
	var i = 0;

	function displayLoop()
	{
		$('#current-text').text(currentMessage.substr(i,4));

		if(++i == currentMessage.length)
		{
			currentMessage = $('#current-mess').text()+" ";
			i = 0;
		}
		window.setTimeout(displayLoop, 1000);
	}
	displayLoop();		
	
}