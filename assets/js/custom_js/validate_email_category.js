function validate_add_contact(){
	var email_cat = document.getElementById('category').value;
	var pname = document.getElementById('pname').value; 
	var pmobile = document.getElementById('pmobile').value;
	if (email_cat == "" || pname == "" || pmobile == "") {
		document.getElementById('add_err_msg').innerHTML = "Field names with (*) are required";
		document.getElementById('add_err_msg').style.color = "red";
		return false;
	}
}

function validateAlphabet(){ 
	if(!(event.keyCode >= 65 && event.keyCode <= 90) && !(event.keyCode >= 97 && event.keyCode <= 122) && (event.keyCode != 46) && (event.keyCode != 32)){ 
		event.returnValue=false; 
		document.getElementById('err').innerHTML="Category name must have alphabets only";
		document.getElementById('err').style.color="red";
	}else if((event.keyCode == 46) && document.getElementById('cat').value.split('.').length > 1) {
		event.returnValue=false;  
	}else{
		document.getElementById('err').innerHTML="";
	}
} 

function validateAlphabet1(){ 
	if(!(event.keyCode >= 65 && event.keyCode <= 90) && !(event.keyCode >= 97 && event.keyCode <= 122) && (event.keyCode != 46) && (event.keyCode != 32)){ 
		document.getElementById('err1').innerHTML="Name must have alphabets only";
		document.getElementById('err1').style.color="red";
	}else if((event.keyCode == 46) && document.getElementById('pname').value.split('.').length > 1){
		event.returnValue=false;  
	}else{
		document.getElementById('err1').innerHTML="";
	}
} 