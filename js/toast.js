class Toast{
    constructor(toast, toastTitle, toastMessage){
        this.toast = toast;
        this.toastTitle = toastTitle;
        this.toastMessage = toastMessage;
    }

    showToast(title, message){
        this.toastTitle.text(title);
        this.toastMessage.text(message);
        this.toast.toast('show');
        console.log('showed')
    }
}