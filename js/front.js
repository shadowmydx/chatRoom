
function addLoadEvent(newEvent) {
	var oldevent  = window.onload;
	window.onload = function() {
		oldEvent();
		newEvent();
	} 
}

function getUpdateData() {
	var request = XMLHttpRequest();
	
}

window.onload = function() {
	document.getElementById("submit").onclick = function() {
		
	}
}