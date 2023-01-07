class InputState{
    constructor(input, inputError){
        this.input = input;
        this.inputError = inputError;
    }

    triggerError(text){
        let thisObject = this;
        thisObject.input.addClass('is-invalid')
        thisObject.inputError.text(text);
    }
    removeError(){
        let thisObject = this;
        thisObject.input.removeClass('is-invalid');
    }
}