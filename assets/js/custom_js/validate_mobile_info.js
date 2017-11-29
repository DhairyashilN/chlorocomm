function validate_sms_category () {
	//alert();return false;

	var sms_cat = document.getElementById('sms_cat').value;
	//alert(email_cat);return false;

	if (sms_cat == "") {
		//alert('Please enter Email Category');return false;

		document.getElementById('errmsg').innerHTML = "Please enter SMS Category";
		document.getElementById('errmsg').style.color = "red";
		return false;
	}
	else
	{

	}
}

function validate_add_mobile_no() {
	//alert();return false;

	var sms_category = document.getElementById('sms_category').value;
	var pname = document.getElementById('pname').value; 
	var pcontactno = document.getElementById('pcontactno').value;
	//alert(email_cat);return false;

	if (sms_category == "" || pname == "" || pcontactno == "") {
		//alert('Please enter Email Category');return false;

		document.getElementById('add_err_msg').innerHTML = "Please fill all data";
		document.getElementById('add_err_msg').style.color = "red";
		return false;
	}
	else
	{

	}
}

function validatemobAlphabet() 
{ 
	if(!(event.keyCode >= 65 && event.keyCode <= 90) && !(event.keyCode >= 97 && event.keyCode <= 122) && (event.keyCode != 46) && (event.keyCode != 32)) 
	{ 
		event.returnValue=false; 
		document.getElementById('errmsg').innerHTML="Category name must have alphabets only";
		document.getElementById('errmsg').style.color="red";
	}

	else if((event.keyCode == 46) && document.getElementById('sms_cat').value.split('.').length > 1) 
	{
	    event.returnValue=false;  
	}

	else
	{

		document.getElementById('errmsg').innerHTML="";
	}

} 


function validatemobAlphabet1() 
{ 
	if(!(event.keyCode >= 65 && event.keyCode <= 90) && !(event.keyCode >= 97 && event.keyCode <= 122) && (event.keyCode != 46) && (event.keyCode != 32)) 
	{ 
		event.returnValue=false; 
		document.getElementById('merr1').innerHTML="Name must have alphabets only";
		document.getElementById('merr1').style.color="red";
	}

	else if((event.keyCode == 46) && document.getElementById('pname').value.split('.').length > 1) 
	{
	    event.returnValue=false;  
	}
	
	else
	{
		document.getElementById('merr1').innerHTML="";
	}

} 


function checkOnlyDigits(e) {
	e = e ? e : window.event;
	var charCode = e.which ? e.which : e.keyCode;
	if (charCode < 48 || charCode > 57) 
	{
	document.getElementById('errorMsg').style.display = 'block';
	document.getElementById('errorMsg').style.color = 'red';
	document.getElementById('errorMsg').innerHTML = ' Only digits allowed to enter Mobile number.';
	return false;
	} 
	else 
	{
	document.getElementById('errorMsg').style.display = 'none';
	return true;
	}
}
function check_no(){
	
	alert();
}