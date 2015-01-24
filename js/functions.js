function _(el) {
	return document.getElementById(el);
}

function print_r(printthis, returnoutput) {
    var output = '';

    if($.isArray(printthis) || typeof(printthis) == 'object') {
        for(var i in printthis) {
            output += i + ' : ' + print_r(printthis[i], true) + '\n';
        }
    }else {
        output += printthis;
    }
    if(returnoutput && returnoutput == true) {
        return output;
    }else {
        alert(output);
    }
}

function uploadFile() {
	var file = _("file").files[0];
	//alert(file.name+" | "+file.size+" | "+file.type);
	var formdata = new FormData();
	formdata.append("file", file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "convert.php");
	ajax.send(formdata);
}

function progressHandler(e) {
	_("progressBar").style.display = "block";

	//_("status").style.display = "block";
	_("loaded_n_total").style.display = "block";

	_("loaded_n_total").innerHTML = "Uploaded "+e.loaded+" bytes of "+e.total;
	var percent = (e.loaded / e.total) * 100;
	_("progressBar").value = Math.round(percent);
	_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
}

function completeHandler(e) {
	_("status").innerHTML = e.target.responseText;
	_("progressBar").value = 0;
	_("progressBar").style.display = "none";
	_("loaded_n_total").style.display = "none";
	console.log("Upload Complete");
	// videojs("vid").ready(function() {
 // 	 	var myPlayer = this;

 // 	 	myPlayer.src([
 // 	 	{ type: "video/mp4", src: "/uploads/firstbust.mp4" },
	// 		{ type: "video/webm", src: "http://www.w3schools.com/html/mov_bbb.webm" },
	// 		{ type: "video/ogg", src: "http://www.w3schools.com/html/mov_bbb.ogg" }
	// 	]);
	// });
}

function errorHandler(e){
	_("status").innerHTML = "Upload Failed";
	console.log("Upload Failed");
}

function abortHandler(e){
	_("status").innerHTML = "Upload Aborted";
	console.log("Upload Aborted");
}

function save_skills_n_xp(skillsArray,titlesArray,yearsArray,descsArray) {
  $.ajax({
    type: "post",
    dataType: "json",
    url: "save_profile.php",
    data: { "skills":skillsArray, "titles":titlesArray, "years":yearsArray, "descs":descsArray }
  })
    .success(function(data, textStatus, jqXHR) {
     // $.each(data, function(key, value) { 
     // 	console.log(value);
  	 // });
	    for (var i = 0; i < Things.length; i++) {
	    	Things[i]
	    };
    });
}