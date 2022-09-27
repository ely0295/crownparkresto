
  function Adduserdata() {
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var address = document.getElementById("address").value; 
    var email = document.getElementById("email").value;
    var contactno = document.getElementById("contactno").value;
    $('#addEmployeeModal').modal('hide');
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {  
      if (this.readyState == 4 && this.status == 200) {
          //document.getElementById("Userlist").innerHTML = this.responseText;
          if(this.responseText.trim() == "Saved" ){
            modalsuccess.src = ".\\resources\\success.png";
            modaldescsuccess.innerHTML = "Data Successfully Saved!"
            myModalresult.style.display = "block";
          }else{

          }
          retriveUser();
          modal.style.display = "none";
      }
      
    };

    modalimg.src = ".\\resources\\delete.gif";
    modaldesc.innerHTML = "Saving Data <br> Please Wait..." 
    modal.style.display = "block";
    document.getElementById("Userlist").innerHTML = "";
      setTimeout(function(){
       xhttp.open("GET", "./userinformation/adduser.php?fname="+fname+"&lname="+lname+"&address="+address+"&email="+email+"&contactno="+contactno, true);
       xhttp.send(); 
      }, 3000);
  }