
function datefilter(){
    var x = document.getElementById("filterdate").value;
    if(x == "spec_date"){
      document.getElementById("inputdate").style.display = "block";
    }else{
      document.getElementById("inputdate").style.display = "none"; 
      retrieveOrders(1,document.getElementById('perpage').value);
    }
}

function filterbydate(date,page,noperpage){
  var hassearch= "none";
  if(document.getElementById('searchinput').value != ""){
    hassearch = document.getElementById('searchinput').value;
  }
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {  
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("Userlist").innerHTML = this.responseText;
        document.getElementById("loading").style.display = "none";
    }      
  };    
  document.getElementById("loadingdesc").innerHTML = "Searching Data <br> Please Wait. Thank you";
  document.getElementById("loading").style.display = "block";
  document.getElementById("Userlist").innerHTML = "";
    setTimeout(function(){
    xhttp.open("GET", "./orders/filterbydate.php?SDate="+date+"&hassearch="+hassearch+"&pageno="+page+"&noofrecords="+noperpage, true);
    xhttp.send(); 
    }, 500);
}
function searchuserdata(access,input){
    var hasdate = "none";
    if(document.getElementById('inputdate').style.display == "block"){
      hasdate = document.getElementById('inputdatevalue').value;

    }
    //alert(hasdate);
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {  
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("Userlist").innerHTML = this.responseText;
          document.getElementById("loading").style.display = "none";
      }      
    };    
    document.getElementById("loadingdesc").innerHTML = "Searching Data <br> Please Wait. Thank you";
    document.getElementById("loading").style.display = "block";
    
    document.getElementById("Userlist").innerHTML = "";
    xhttp.open("GET", "./orders/searchorder.php?Sinput="+input+"&hasdate="+hasdate+"&access="+access, true);
      xhttp.send();
      setTimeout(function(){      
      }, 500);
}
/////////////////////////////// Retrieving Data ////////////////////////////////

function retrieveOrders(page,noperpage) {
  if(document.getElementById('inputdate').style.display == "block"){

    filterbydate(document.getElementById('inputdatevalue').value,page,noperpage);
    return 0;
  }
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
       xhttp.open("GET", "./orders/getorderdatawithpagination.php?pageno="+page+"&noofrecords="+noperpage, true);
       xhttp.send(); 
      }, 500);
  }

///////////////////////////////Delete Function////////////////////////////////////

 

