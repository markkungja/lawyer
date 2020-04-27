
var btnBold = document.getElementById("btnBold");
var btnItalic = document.getElementById("btnItalic");
var btnUnderline = document.getElementById("btnUnderline");
var btnStrike = document.getElementById("btnStrike");
var btnSubscript = document.getElementById("btnSubscript");
var btnRemoveFormat = document.getElementById("btnRemoveFormat");
var btnSuperscript = document.getElementById("btnSuperscript");
var btnCenter = document.getElementById("btnCenter");
var btnRight = document.getElementById("btnRight");
var btnLeft = document.getElementById("btnLeft");
var btnIndent = document.getElementById("btnIndent");
var btnOutdent = document.getElementById('btnOutdent');
btnOutdent.addEventListener('mousedown', function(event){
    document.execCommand("outdent")
    event.preventDefault();
});
btnIndent.addEventListener("mousedown", function(event){
    document.execCommand("indent");
    event.preventDefault();
});
btnLeft.addEventListener("mousedown", function(event){
    document.execCommand("justifyLeft");
    event.preventDefault();
});
btnRight.addEventListener("mousedown", function(event){
    document.execCommand("justifyRight");
    event.preventDefault();
});
btnCenter.addEventListener('mousedown', function(event){
    document.execCommand("justifyCenter");
    event.preventDefault();
});
btnSuperscript.addEventListener("mousedown", function(event){
    
    document.execCommand("superscript");
    event.preventDefault();
    
});
btnRemoveFormat.addEventListener("mousedown", function(event){
    
    document.execCommand("removeFormat");
    event.preventDefault();
    
});
btnSubscript.addEventListener("mousedown", function(event){
    
    document.execCommand("subscript");
    event.preventDefault();
    
});
btnStrike.addEventListener("mousedown", function(event){
    
    document.execCommand("strikethrough");
    event.preventDefault();
    
});
btnBold.addEventListener("mousedown", function(event){
    
    document.execCommand("bold");
    event.preventDefault();

});
btnItalic.addEventListener("mousedown", function(event){
    
    document.execCommand("italic");
    event.preventDefault();
    
});
btnUnderline.addEventListener("mousedown", function(event){
    
    document.execCommand("underline");
    event.preventDefault();
    
});
