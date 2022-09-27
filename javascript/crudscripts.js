

$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});

function datefilter(){
    var x = document.getElementById("filterdate").value;
    if(x == "spec_date"){
      document.getElementById("inputdate").style.display = "block";


    }else{
      document.getElementById("inputdate").style.display = "none"; 

      retriveUser(1,document.getElementById('perpage').value);
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
    xhttp.open("GET", "./userinformation/filterbydate.php?SDate="+date+"&hassearch="+hassearch+"&pageno="+page+"&noofrecords="+noperpage, true);
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
    xhttp.open("GET", "./userinformation/searchuserinfo.php?Sinput="+input+"&hasdate="+hasdate+"&access="+access, true);
      xhttp.send();
      setTimeout(function(){      
      }, 500);
}
/////////////////////////////// Retrieving Data ////////////////////////////////

function retriveUser(page,noperpage) {
  //alert(page);
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
       xhttp.open("GET", "./userinformation/getuserdatawithpagination.php?pageno="+page+"&noofrecords="+noperpage, true);
       xhttp.send(); 
      }, 500);
  }

///////////////////////////////Delete Function////////////////////////////////////
 
  function Deletemodal(id){
    document.getElementById('customerid').value = id;
    $('#deleteEmployeeModal').modal('show');
  }
  function DeleteCustomer(id){
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {  
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText.trim() == "Deleted" ){
            showresult("none","block","btn-success","Alright! Success","We Have Deleted Your Data Succesfully!");                         
          }else{
            showresult("none","block","btn-danger","Opps! Error","An Error Occured While Deleting your Data.");   
          }
          if(document.getElementById("pagination")){
            retriveUser($('#pagination li.active').text(),document.getElementById('perpage').value);    
          }else{
            retriveUser(1,document.getElementById('perpage').value);  
          }
                 
      }      
    };
    showloading(".\\resources\\loading2.gif","none","Deleting Data <br> Please Wait...","block");
    $('#deleteEmployeeModal').modal('hide');
    
      setTimeout(function(){
       xhttp.open("GET", "./userinformation/deleteuser.php?userid="+id, true);
       xhttp.send(); 
      }, 3000);
  }
///////////////////////////////Add Function////////////////////////////////////
  function Adduserdata() {
    document.getElementById("btnadd").disabled  = false;
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var address = document.getElementById("address").value; 
    var email = document.getElementById("email").value;
    var contactno = document.getElementById("contactno").value;
    var date_inserted = document.getElementById("date_inserted").value;
    $('#addEmployeeModal').modal('hide');
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {  
      if (this.readyState == 4 && this.status == 200) {
          if(this.responseText.trim() == "Saved" ){
            showresult("none","block","btn-success","Alright! Success","Data Succesfully Saved!");         
          
          }else{
            showresult("none","block","btn-danger","Opps! Error","An Error Occured While Saving Data.");  
          }
          retriveUser($('#pagination li.active').text(),document.getElementById('perpage').value);
          modal.style.display = "none";
      }
      
    };
    showloading(".\\resources\\loading2.gif","none","Saving Data <br> Please Wait...","block");
    $('#deleteEmployeeModal').modal('hide');
      setTimeout(function(){
       xhttp.open("GET", "./userinformation/adduser.php?fname="+fname+"&lname="+lname+"&address="+address+"&email="+email+"&contactno="+contactno+"&date_inserted="+date_inserted, true);
       xhttp.send(); 
      }, 500);
  }
 ///////////////////////////////Update Function////////////////////////////////////

 function getupdatemodal(id,fname,lname,address,email,contact,date_inserted){
  document.getElementById('cus_id').value = id;
  document.getElementById('cus_fname').value = fname;
  document.getElementById('cus_lname').value = lname;
  document.getElementById('cus_address').value = address;
  document.getElementById('cus_email').value = email;
  document.getElementById('cus_contactno').value = contact;
  document.getElementById('cus_date_inserted').value = date_inserted;
  $('#editEmployeeModal').modal('show');
}
function Updatedata(){
  var id = document.getElementById('cus_id').value;
  var fname = document.getElementById('cus_fname').value;
  var lname = document.getElementById('cus_lname').value;
  var address = document.getElementById('cus_address').value;
  var email = document.getElementById('cus_email').value;
  var contact = document.getElementById('cus_contactno').value;
  var date_inserted = document.getElementById('cus_date_inserted').value;
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {  
    if (this.readyState == 4 && this.status == 200) {
      if(this.responseText.trim() == "Updated" ){
          showresult("none","block","btn-success","Alright! Success","We Have Updated Your Data Succesfully!");                        
        }else{
          showresult("none","block","btn-danger","Opps! Error","An Error Occured While Updating Data.");  
        }
        if(document.getElementById("pagination")){
          retriveUser($('#pagination li.active').text(),document.getElementById('perpage').value);    
        }else{
          searchuserdata("id",id);
        }
            
    }      
  };
  showloading(".\\resources\\loading2.gif","none","Updating Data <br> Please Wait...","block");
  $('#editEmployeeModal').modal('hide');
  
    setTimeout(function(){
     xhttp.open("GET", "./userinformation/updateuser.php?userid="+id+"&fname="+fname+"&lname="+lname+"&address="+address+"&email="+email+"&contact="+contact+"&date_inserted="+date_inserted, true);
     xhttp.send(); 
    }, 3000);
} 
 

