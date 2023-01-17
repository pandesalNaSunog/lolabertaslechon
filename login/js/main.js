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
    let address = $('#signup-address');
    let addressError = $('#signup-address-error');
    let contact = $('#signup-contact');
    let contactError = $('#signup-contact-error');
    
    let signup = new SignUp(signupName, singupEmail, signupPassword, signupRetypePassword, signUpNameError, signupEmailError, signupPasswordError, retypePasswordError,signupButton,address, contact, addressError, contactError);
    signup.signUp();
})