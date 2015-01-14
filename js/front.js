var publish = new XMLHttpRequest();
var update  = new XMLHttpRequest();

function addLoadEvent(newEvent) {
	var oldevent  = window.onload;
	window.onload = function() {
		oldEvent();
		newEvent();
	} 
}

function updateScroll() {
	var obj = document.getElementById("chatbody");
	obj.scrollTop = obj.scrollHeight;
}


function showChange() {
	if (update.readyState == 4) {
		var body    = document.getElementById("chatbody");
		var dialog  = document.createElement("p");
		var content = update.responseText;
		dialog.innerHTML = update.responseText;
		body.appendChild(dialog);
		updateScroll(); // 添加完文本后，重置滚动条到最底部
	}
}

function getUpdateData() {
	url = "getUpdate.php";
	update.open("GET",url,true);
	update.send(null);
	update.onreadystatechange = showChange;
}

function publishData() {
	var url     = "publishContent.php";
	var name    = document.getElementById("author").value;
	var content = document.getElementById("content").value;
	if (content.length <= 0) {
		alert("nothing!");
		return;
	}
	url = url + "?content=" + content + "&name=" + name;
	publish.open("GET",url,true);
	publish.send(null);
	publish.onreadystatechange = getUpdateData;
	document.getElementById("content").value = "";
}

window.onload = function() {
	document.getElementById("submit").onclick = function() {
		publishData();
	}
	setInterval(getUpateData,1000);
}