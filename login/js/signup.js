class SignUp{
    constructor(name, email, password, retypePassword, nameError, emailError, passwordError, retypePasswordError, signup, address, contact, addressError, contactError){
        this.name = name;
        this.email = email;
        this.password = password;
        this.retypePassword = retypePassword;
        this.nameError = nameError;
        this.emailError = emailError;
        this.passwordError = passwordError;
        this.retypePasswordError = retypePasswordError;
        this.signup = signup;
        this.address = address;
        this.contact = contact;
        this.addressError = addressError;
        this.contactError = contactError;
    }

    signUp(){
        let thisObject = this;
        let buttonState = new ButtonState()

        thisObject.signup.click(function(){
            if(thisObject.name.val() == ""){
                thisObject.triggerInputError(thisObject.name, thisObject.nameError, 'Please fill out this field');
            }else if(thisObject.email.val() == ""){
                thisObject.triggerInputError(thisObject.email, thisObject.emailError, 'Please fill out this field');
            }else if(thisObject.contact.val() == ""){
                thisObject.triggerInputError(thisObject.contact, thisObject.contactError, 'Please fill out this field');
            }else if(thisObject.address.val() == ""){
                thisObject.triggerInputError(thisObject.address, thisObject.addressError, 'Please fill out this field');
            }else if(thisObject.password.val() == ""){
                thisObject.triggerInputError(thisObject.password, thisObject.passwordError, 'Please fill out this field');
            }else if(thisObject.retypePassword.val() == ""){
                thisObject.triggerInputError(thisObject.retypePassword, thisObject.retypePasswordError, 'Please fill out this field');
            }else if(thisObject.password.val() != thisObject.retypePassword.val()){
                thisObject.triggerInputError(thisObject.password, thisObject.passwordError, 'Password Mismatch');
            }else{
                buttonState.disableButton(thisObject.signup,thisObject.signup, 'Signing Up...')
                $.ajax({
                    type: 'POST',
                    url: 'sign-up/',
                    data:{
                        name: thisObject.name.val(),
                        email: thisObject.email.val(),
                        password: thisObject.password.val(),
                        address: thisObject.address.val(),
                        contact: thisObject.contact.val()
                    },
                    success: function(response){
                        if(response == 'ok'){
                            location.replace('../')
                        }else if(response == 'exists'){
                            thisObject.triggerInputError(thisObject.email, thisObject.emailError, 'This email already exists in our records. Please enter another email.');
                        }
                    }
                })
            }
        })
        
    }
    triggerInputError(input, inputError, text){
        input.addClass('is-invalid');
        inputError.text(text)
    }
    removeInputError(input){
        input.removeClass('is-invalid');
    }
}