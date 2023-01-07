class ButtonState{
    constructor(){

    }
    enableButton(button, span, text){
        button.prop('disabled', false);
        span.text(text);
    }
    disableButton(button, span, text){
        button.prop('disabled', true);
        span.text(text);
    }
}