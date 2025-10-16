export default class Burger {
    constructor() {
        this.burger = document.getElementById('burger');
        if (!this.burger) return;
        
        this.burger.addEventListener("click", (event) => {
            console.log('CLICK');
        });        
    }

}
