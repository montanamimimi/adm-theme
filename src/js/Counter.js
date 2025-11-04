export default class Counter {
    constructor() {
        this.counter = document.getElementById('counter');        
        if (!this.counter) return;
        this.now = new Date();
        this.nextYear = this.now.getFullYear() + 1;
        this.newYear = new Date(`January 1, ${this.nextYear} 00:00:00`);
        this.diff = (this.newYear - this.now) / 1000;
        this.updateCountdown();
    }

    updateCountdown() {

        this.diff = this.diff - 1;        

        const hours = Math.floor(this.diff / (60 * 60));
        const mins = Math.floor((this.diff - hours*60*60 ) / (60));
        const secs = Math.floor(this.diff -  hours*60*60 - mins*60);

        this.counter.innerText =
        `${hours.toString().padStart(2, '0')}:` +
        `${mins.toString().padStart(2, '0')}:` +
        `${secs.toString().padStart(2, '0')}`;

        setTimeout(() => this.updateCountdown(), 1000);        
    }

}
