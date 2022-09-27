
// Get the modal
var modal = document.getElementById("myModal");

var modalcontent = document.getElementById("modalcontent");

var modalimg = document.getElementById("modalsrc");
var modaldesc = document.getElementById("modaldesc");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

function showloadingmodal(){

    modalimg.src = ".\\resources\\delete.gif";
    modaldesc.innerHTML = "Deleting Data <br> Please Wait...";
    modal.style.display = "block";
    
}
function showresult(modal,modal1,btn,title,title2){
  document.getElementById("title").innerHTML = title;
  document.getElementById("title2").innerHTML = title2;
  document.getElementById("btnokayresult").classList.add(btn);
  document.getElementById("myModal").style.display = modal;           
  document.getElementById("myModalresult").style.display = modal1;
}
function showloading(location,content,desc,modal){
  document.getElementById("modalsrc").src = location;
  document.getElementById("modalcontent").style.background = content;
  document.getElementById("modaldesc").innerHTML = desc;
  document.getElementById("myModal").style.display = modal;
}
