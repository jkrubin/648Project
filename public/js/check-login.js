function check_login(form){
    var emailPattern = /^[-!#$%&\'*+\/0-9=?A-Z^_a-z{|}~](\.?[-!#$%&\'*+\/0-9=?A-Z^_a-z{|}~])*@[a-zA-Z](-?[a-zA-Z0-9])*(\.[a-zA-Z](-?[a-zA-Z0-9])*)+$/;
    
    var passwordPattern = /[A-Za-z0-9 ,\/*\-+`~!@#$%^&\(\)_=<.>\{\}\\\|\?\[\];:\'"]{8,70}/;
    //email check
    if(form.email.match(emailPattern)){
	return true;
    }
    else{
	form.email.focus();
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
}
