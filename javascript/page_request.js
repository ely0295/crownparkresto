function retriveUser() {
    
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {  
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("Userlist").innerHTML = this.responseText;
        document.getElementById("loading").style.display = "none";
    }
    
  };
  document.getElementById("loading").style.display = "block";
  document.getElementById("Userlist").innerHTML = "";
    setTimeout(function(){
     xhttp.open("GET", "./userinformation/getuserinfo.php", true);
     xhttp.send(); 
    }, 3000);
}
//Delete User
function DeleteUser(id) {
    
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {  
      if (this.readyState == 4 && this.status == 200) {
          if(this.responseText.trim() == "Deleted" ){
            modalsuccess.src = ".\\resources\\success.png";
            modaldescsuccess.innerHTML = "You Have Successfully Deleted the Data!"
            myModalresult.style.display = "block";
          }else{

          }
          retriveUser();
          modal.style.display = "none";
      }
      
    };
    modalimg.src = ".\\resources\\delete.gif";
    modaldesc.innerHTML = "Deleting Data <br> Please Wait..." 
    modal.style.display = "block";
    document.getElementById("Userlist").innerHTML = "";
      setTimeout(function(){
       xhttp.open("GET", "./userinformation/deleteuser.php?userid="+id, true);
       xhttp.send(); 
      }, 3000);
  }

