function check_signup(form){
    var emailPattern = /^[-!#$%&\'*+\/0-9=?A-Z^_a-z{|}~](\.?[-!#$%&\'*+\/0-9=?A-Z^_a-z{|}~])*@[a-zA-Z](-?[a-zA-Z0-9])*(\.[a-zA-Z](-?[a-zA-Z0-9])*)+$/;
    
    var namePattern = /^([ \x{00c0}-\x{01ff}a-zA-Z\'\-])+$/;
    
    var passwordPattern = /[A-Za-z0-9 ,\/*\-+`~!@#$%^&\(\)_=<.>\{\}\\\|\?\[\];:\'"]{8,70}/;
    //email check
    if(form.email.match(emailPattern)){
	return true;
    }
    else{
	form.email.focus();
	return false;
    }
    //firstname check
    if(form.firstname.match(namePattern)){
	return true;
    }
    else{
	form.firstname.focus();
	return false;
    }
    //lastname check
    if(form.lastname.match(namePattern)){
	return true;
    }
    else{
	form.lastname.focus();
	return false;
    }
    //password check
    if(form.password.match(passwordPattern)){
	return true;
    }
    else{
	form.password.focus();
	return false;
    }
    //retype password check
    if(form.repass.match(passwordPattern)){
	return true;
    }
    else{
	form.repass.focus();
	return false;
    }
}