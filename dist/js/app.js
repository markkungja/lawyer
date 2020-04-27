// JavaScript Document
function getData(parEle,parValue){
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {
		document.getElementById(parEle).innerHTML = this.responseText;
	  }
	};
	xmlhttp.open("GET", "../services/get_" + parEle + ".php?" + parValue, true);
	xmlhttp.send();
	console.log('get'+parEle);
	
}
function formPost(parEle){
	$('#' + parEle).submit(function(){
		$.ajax({
			type: 'POST',
			url: '../services/' + parEle + '.php',
			data: $(this).serialize()
		})
		.done(function(data){ 
			console.log(data);
			var myObj = JSON.parse(data);
			if(myObj.message != null){
				console.log(myObj.message);
			}
			if(myObj.alerts != null){
				document.getElementById('message').innerHTML = myObj.alerts;		
			}
			if(myObj.vaildate != null){
				document.getElementById('vaildate').value = myObj.vaildate;
			}
			if(myObj.redirect != null){
				//console.log(myObj.redirect);
				window.location.href = myObj.redirect;
			}
			if(myObj.refesh){
				window.location.reload();
			}
			return false;
		})
		.fail(function() {
			alert("การโพสต์ล้มเหลว");
		});
		return false;
	})
}
function getDelete(t,v,tf){
	var parValue = "t="+t+"&v="+v+"&tf="+tf;
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {
		//document.getElementById(parEle).innerHTML = this.responseText;
		window.location.reload();
		console.log(this.responseText);
	  }
	};
	xmlhttp.open("POST", "../services/delete.php", true);
	xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	xmlhttp.send(parValue);

}
function logout(){
	if (confirm("Do you want to logout ?") == true) {
	  window.location.href='services/logout.php';
	}
}
function goHref(page){
	window.location.href = page;
}
function goPage(page) {
	document.getElementById("main-display").src = page;
	console.log(page);
}
function goBack() {
	window.history.back();
}
function deleteData(tb,id,tf,code,go){
	if (confirm("Do you want to delete '"+ code +"'?") == true) {
		getDelete(tb,id,tf);
	}
}
function deleteDataFile(tb,id,tf,ff,code){
	if (confirm("Do you want to delete '"+ code +"'?") == true) {
		getDeleteFile(tb,id,tf,ff);
	}
}
function getDeleteFile(t,v,tf,ff){
	var parValue = "t="+t+"&v="+v+"&tf="+tf+"&ff="+ff;
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {
		//document.getElementById(parEle).innerHTML = this.responseText;
		window.location.reload();
		console.log(this.responseText);
	  }
	};
	xmlhttp.open("POST", "../services/delete_file.php", true);
	xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	xmlhttp.send(parValue);

}
function deleteAttech(n,t){
	if (confirm("Do you want to delete attach file Yes or No?") == true) {
		document.getElementById('temp_attach').value = '';
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
			  if (this.readyState == 4 && this.status == 200) {
				  console.log(this.responseText);
			  }
			};
			xmlhttp.open("GET", "../services/deletefile.php?n="+n+"&t="+t, true);
			xmlhttp.send();
	}
}

function duplicate_data(id,table,where_f,input){
	$.post("../services/duplicate_data.php", {table:table,f:input.name,value:input.value}, function(data){
		if(data == "success"){
			form_autosave(id,table,where_f,input);
		} else {
			alert("ไม่สามารถมี " + input.name + " ซ้ำกันได้ หรือเกิดข้อผิดพลาดกรุณาลองใหม่");
		}
	});
}

function form_autosave(n,t,tf,f){
	var parValue = 'n='+ n +'&t='+ t +'&tf='+ tf +'&v='+ f.value +'&f='+ f.name;
	xmlhttp2 = new XMLHttpRequest();
	xmlhttp2.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		console.log(this.responseText);
		//getLine();
	}
	};
	xmlhttp2.open("POST", "../services/autosave.php", true);
	xmlhttp2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	xmlhttp2.send(parValue);
}

function btn_reset(n,t,tf,fv,fn,code){
	if (confirm("Do you want to Reset '"+ code +"'?") == true) {
		$.post("../services/autosave.php", {n:n,t:t,tf:tf,v:fv,f:fn}, function(data){
			// console.log(data);
			// alert('รีเซตการปรับแต่งแล้ว!');
			location.reload();
		});
	}
}

function b64EncodeUnicode(str) {
    // first we use encodeURIComponent to get percent-encoded UTF-8,
    // then we convert the percent encodings into raw bytes which
    // can be fed into btoa.
    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
        function toSolidBytes(match, p1) {
            return String.fromCharCode('0x' + p1);
        }));
}
	
function b64DecodeUnicode(str) {
	// Going backwards: from bytestream, to percent-encoding, to original string.
	return decodeURIComponent(atob(str).split('').map(function(c) {
		return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
	}).join(''));
}

function get_all_input_text(){

	var input = document.getElementById('div_id').getElementsByTagName('input');
	for(i=0;i<input.length;i++){
		var text_id_html = input[i].getAttribute('id');
		//console.log(text_id_html);
		var text_id = document.getElementById(text_id_html);
		text_id.value = text_id_html;
	}

	var input_textarea = document.getElementById('div_id').getElementsByTagName('textarea');
	// console.log(input_textarea[0]);
	for(i=0;i<input_textarea.length;i++){
		var text_id_html = input_textarea[i].getAttribute('id');
		//console.log(text_id_html);
		var text_id = document.getElementById(text_id_html);
		text_id.value = text_id_html;
	}
}

function save_report(){
	var input = document.getElementById('div_id').getElementsByTagName('input');
	var jsonStr ='{"report":[],"doc_report_id":'+ document.getElementById("doc_report_id").value +'}';
	var obj = JSON.parse(jsonStr);
	for(i=0;i<input.length;i++){
		var text_id_html = input[i].getAttribute('id');
		var text_value = document.getElementById(text_id_html).value;  
		obj['report'].push({"text_id":text_id_html,"value":text_value});
	}

	var input_textarea = document.getElementById('div_id').getElementsByTagName('textarea');
	for(i=0;i<input_textarea.length;i++){
		var text_id_html = input_textarea[i].getAttribute('id');
		var text_value = document.getElementById(text_id_html).value;  
		obj['report'].push({"text_id":text_id_html,"value":text_value});
	}
	console.log(obj);
	var text = JSON.stringify(obj);
	// console.log(text);
	// console.log(obj.doc_report_id);
	var n = obj.doc_report_id;
	var t = "document_report";
	var tf = "doc_report_id";
	var v = text;
	var f = "doc_report_text";
	$.post("../../services/autosave.php", {n:n,t:t,tf:tf,v:v,f:f}, function(data){
		// console.log(data);
		alert('บันทึกข้อมูลแล้ว!');
	});

}

function get_form_report(text_report){
	for(i=0;i<text_report.report.length;i++){
		document.getElementById(text_report.report[i].text_id).value = text_report.report[i].value;
	}
}