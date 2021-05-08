function confirmPasswd() {
  var newPasswd = document.getElementById("newPassword").value;
  var newPasswd2 = document.getElementById("confirmPassword").value;
  if(newPasswd == newPasswd2) {
    return true;
  }
  return false;
}

function password_validation(id) {
  var format = /[`._!@#$%^&*()+\-=\[\]{};':"\\|<>\/?~\s]/;
  var passwd = document.getElementById(id);
  passwd.style.backgroundColor = "#FFFFFF";
  if(format.test(passwd.value)) {
    passwd.style.backgroundColor = "#e0d101";
    return false
  }
  return true;
}

function change_password_validation() {
  if(!password_validation('currentPassword')) {
    return false;
  }
  if(!password_validation('newPassword')) {
    return false;
  }
  if(!password_validation('confirmPassword')) {
    return false;
  }
  if(!confirmPasswd()) {
    return false;
  }
  return true;
}
