
<?php
 
include("headers.php");
include("container.php");
getheader();
?>
<?php 
 
if($_SESSION['user_id']=='')
header ('location:index.php');
?>
<script src="./content/jquery.js"></script>
<!-- JQUERY -->
<link href="jquery.custom.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script>
$(function() {
    $( "#admission" ).datepicker({dateFormat: 'yy-mm-dd'});
	
});
$(function() {
    $( "#graduation" ).datepicker({dateFormat: 'yy-mm-dd'});
	
});
</script>
<script type="text/javascript">

function nameSearch(str,divid)
	{
			
		if (str.length<2)
		{ 
			document.getElementById(divid).innerHTML="";

			document.getElementById(divid).style.border="0px";
			return;
		}
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				if(divid=="name")
				document.getElementById("name").innerHTML=xmlhttp.responseText;
			if(divid=="idnumber")
						document.getElementById("idnumber").innerHTML=xmlhttp.responseText;
					if(divid=="myemail")
				document.getElementById("myemail").innerHTML=xmlhttp.responseText;

			}
		}
	
		//when search function is called, send the search string, the search type (user vs appt), user id, and searcher type (faculty vs student)
		if(divid=="name")
			xmlhttp.open("GET","namesearch.php?name="+str,true);
		if(divid=="idnumber")
			xmlhttp.open("GET","namesearch.php?idn="+str,true);
		if(divid=="myemail")
			xmlhttp.open("GET","namesearch.php?email="+str,true);
		xmlhttp.send();
	}
	
function errorcheck()
{//begin inputCheck function
	var inputError=new Array(" "," "," "," "," "," "," "," ");
	var errorCount=0;

	var fname = document.forms.form1['fname'].value;
	var lname = document.forms.form1['lname'].value;
	var phone = document.forms.form1['phone'].value;
	var email= document.forms.form1['email'].value;
	var office =document.forms.form1['office'].value;
	var password =document.forms.form1['password'].value;
	var username =document.forms.form1['uname'].value;
	var confirmed =document.forms.form1['confirm'].value;
	var idn =document.forms.form1['idn'].value;
	if (fname.length < 1)
	{
		inputError[0]=("\n Invalid first name.");
		errorCount=errorCount+1;
	}

if (lname.length < 1 )
	{
		inputError[1]=("\n Invalid last name");
		errorCount=errorCount+1;
	}

	if (phone.length < 1)
	{
		inputError[2] = ("\n Phone number must be entered.");
		errorCount=errorCount+1;
	}

	if (email.length < 1)
	{
		inputError[3]=("\n Email must be entered");
		errorCount=errorCount+1;
	}

	if (office.length < 1)
	{
		inputError[4] = ("\n Office must be entered");
		errorCount=errorCount+1;
	}
	if (password.length < 8)
	{
		inputError[5] = ("\n Password is too Short");
		errorCount=errorCount+1;
	}
	if (password.length >= 8 && password != confirmed)
	{
		inputError[5] = ("\n Passwords do not Match");
		errorCount=errorCount+1;
	}
	if (username.length <3)
	{
		inputError[6] = ("\n Username is too short (must be longer than 3 characters)");
		errorCount=errorCount+1;
	}
	if (username.length <1)
	{
		inputError[6] = ("\n Username must be entered");
		errorCount=errorCount+1;
	}
	
	if (document.getElementById('name').innerHTML=="<o>Name already in use</o>")
		{
		inputError[6] = ("\n Username is already in use");
		errorCount=errorCount+1;
		}
			if (idn.length <1)
	{
		inputError[7] = ("\n ID must be entered");
		errorCount=errorCount+1;
	}
	
	if (document.getElementById('idnumber').innerHTML=="<o>ID already in use</o>")
		{
		inputError[7] = ("\n ID number is already in use");
		errorCount=errorCount+1;
		}
			
	if (document.getElementById('myemail').innerHTML=="<o>Email already in use</o>")
		{
		inputError[8] = ("\n Email is already in use");
		errorCount=errorCount+1;
		}
	if (errorCount >0)
		alert(errorCount+" Error(s). "+inputError[0]+inputError[1]+inputError[2]+inputError[3]+inputError[4]+inputError[5]+inputError[6]+inputError[7]+inputError[8]);
	if(errorCount == 0)
	{
		document.forms["form1"].submit();

	}
	else
		return false;
}// end errorcheck function

function cancel()
{
window.location = 'begin.php';
}

</script>
<script>
var keylist="abcdefghijklmnopqrstuvwxyz123456789"
var temp=''
function generatepass(plength){
temp=''
for (i=0;i<plength;i++)
temp+=keylist.charAt(Math.floor(Math.random()*keylist.length))
return temp
}
function populateform(enterlength){
document.form1.password.value=generatepass(enterlength);
document.form1.confirm.value=document.form1.password.value;
}
</script>
 <div class="panel panel-primary" style="margin-top:-20px; border-radius:0px;">


      <div class="panel-body" >
	  <br><br><br>
  <div style="height:100%" >
 

  <form class="form-horizontal" name="form1" id="form1" method="post" action="facultysubmit.php">
 
 <p align="left">
 <label style="color:orange;font-size:20px;">
 <img src="images/faculty.png" width="150px" height="150px">
 Enter Faculty/Staff Information</label></p><br />
    <div class="form-group" align="center">
	
      <label class="control-label col-sm-2" for="email">First Name:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="fname" id="fname" placeholder="Enter First Name">
      </div>
    </div>
   
    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Last Name:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="lname" id="lname" placeholder="Enter Last Name">
      </div>
    </div>
    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Phone #:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="phone" id="phone" placeholder="Enter Phone Number">
      </div>
    </div>

	
	
	
    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-4">
        <input type="email" class="form-control"  name="email" id="email" placeholder="Enter Email">
      </div>
    </div>
		<div class="form-group">
	
      <label class="control-label col-sm-2" for="email"></label>
      <div class="col-sm-4" id="myemail">
      </div>
    </div>


    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Office :</label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="office" id="office" placeholder="Enter ">
      </div>
    </div>

	
	
	
	
	
	

	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">User Name:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="uname" id="uname" onkeyup="nameSearch(this.value,'name')" placeholder="Enter User Name">
      </div>
    </div>
		<div class="form-group">
	
      <label class="control-label col-sm-2" for="email"></label>
      <div class="col-sm-4" id="name">
      </div>
    </div>
	
	
	
	
	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">ID Number:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="idn" id="idn" onkeyup="nameSearch(this.value,'idnumber')" placeholder="Enter ID Number">
      </div>
    </div>
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email"></label>
      <div class="col-sm-4" id="idnumber">
      </div>
    </div>
	



	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Type:</label>
      <div class="col-sm-4">
    <select name="type" class="form-control"><option value="0" selected>Faculty</option><option value="1">Staff</option></select>  </div>
    </div>


	
	
	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Password:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="password" id="password" placeholder="Enter Password">
      </div>
    </div>
	
	
	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Confirm-Password:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="confirm" id="confirm" placeholder="Enter Confirm Password">
      </div>
    </div>
	
	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">(OR) Generate Password :</label>
      <div class="col-sm-4">
		 <input type="hidden" name="thelength" size=3 value="8">
        <button type="button" class="btn btn-primary" onClick="populateform(this.form.thelength.value)">Generate</button>

		</div>
    </div>
	
	
	

	
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">

        <button type="submit" class="btn btn-primary" onclick= "return errorcheck()" name="submit">Submit</button>
		<button type="button" class="btn btn-warning" onclick= "cancel()" name="submit" id="myBtn">Cancel</button>
	 </div>
    </div>
  </form>
  </div>
    </div>

</div>
<?php
include('footer.php');
?>
 