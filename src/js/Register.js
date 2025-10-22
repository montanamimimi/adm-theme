export default class Register {
    constructor() {
        this.form = document.getElementById('registerForm');
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
        const strongPass = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

        if (data.get("name").length < 3) {
            this.displayError("Имя подлиннее пожалста. ");
            this.inputError("name");
            formOk = false;
        } else {
            this.inputOk("name");
        }

        if (!emailRegex.test(data.get("email"))) {        
            this.displayError("С почтой что-то не так. ");
            this.inputError("email");
            formOk = false;
        } else {
            this.inputOk("email");
        }  

        if (!strongPass.test(data.get("password"))) {
            this.displayError("Пароль посложнее чуть чуть, добавь цифер/буков. ");
            this.inputError("password");
            formOk = false;
        } else {
            this.inputOk("password");
        }  
        
        if (data.get("password") != data.get("password_ok")) {
            this.displayError("Пароли не совпадают. ");
            this.inputError("password_ok");
            formOk = false;
        } else {
            this.inputOk("password_ok");
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
