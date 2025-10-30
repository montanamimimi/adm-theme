export default class Login {
    constructor() {
        this.form = document.getElementById('loginForm');
        if (!this.form) return;

        this.error = document.querySelector('.register__error');
        
        this.form.addEventListener("submit", (event) => {
            event.preventDefault();
            const formData = new FormData(this.form);
            if (this.checkForm(formData)) {
                this.form.submit();
            }           
        });        
    }

    checkForm(data) {
        
        let formOk = true;
        this.error.innerHTML = "";
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;       

        // if (data.get("name").length < 3) {
        //     this.displayError("Имя подлиннее пожалста. ");
        //     this.inputError("name");
        //     formOk = false;
        // } else {
        //     this.inputOk("name");
        // }

        if (!emailRegex.test(data.get("email"))) {        
            this.displayError("С почтой что-то не так. ");
            this.inputError("email");
            formOk = false;
        } else {
            this.inputOk("email");
        }  
        
        if (!data.get("password")) {
            this.displayError("Введите пароль. ");
            this.inputError("password");
            formOk = false;
        } else {
            this.inputOk("password");
        }  

        return formOk;
    }

    displayError(message) {
        this.error.innerHTML = this.error.innerText + "<br>" + message;
    }

    inputError(id) {
        const input = document.getElementById(id);
        input.classList.add('input--error');
    }

    inputOk(id) {
        const input = document.getElementById(id);
        input.classList.remove('input--error');
    }

}
