$(document).ready(function(){
    let signupName = $('#signup-name');
    let singupEmail = $('#signup-email');
    let signupPassword = $('#signup-password');
    let signupRetypePassword = $('#signup-retype-password');
    let signUpNameError = $('#signup-name-error');
    let signupEmailError = $('#signup-email-error');
    let signupPasswordError = $('#signup-password-error');
    let retypePasswordError = $('#retype-password-error');
    let signupButton = $('#signup');
    
    let signup = new SignUp(signupName, singupEmail, signupPassword, signupRetypePassword, signUpNameError, signupEmailError, signupPasswordError, retypePasswordError,signupButton);
    signup.signUp();
})