export default class Profile {
    constructor() {
        this.editor = document.getElementById('profilePictureEditor');        
        if (!this.editor) return;

        this.avatars = document.getElementById('availableAvatars');
        this.images = this.avatars.querySelectorAll('.profile__image');      
        this.input = document.getElementById('avatarId');
        
        this.editor.addEventListener("click", (event) => {
            this.avatars.style.display = "flex";
            this.editor.style.display = "none";
        }); 
        
        this.images.forEach(image => {
            image.addEventListener('click', (event) => {
                const img = this.editor.querySelector('img');
                const newImg = image.querySelector('img');
                this.input.value = newImg.dataset.id;
                img.src = newImg.src;
                this.avatars.style.display = "none";
                this.editor.style.display = "block";
            })
        })
    }

}
