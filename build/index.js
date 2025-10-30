/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/Login.js":
/*!*************************!*\
  !*** ./src/js/Login.js ***!
  \*************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Login)
/* harmony export */ });
class Login {
  constructor() {
    this.form = document.getElementById('loginForm');
    if (!this.form) return;
    this.error = document.querySelector('.register__error');
    this.form.addEventListener("submit", event => {
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

/***/ }),

/***/ "./src/js/Profile.js":
/*!***************************!*\
  !*** ./src/js/Profile.js ***!
  \***************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Profile)
/* harmony export */ });
class Profile {
  constructor() {
    this.editor = document.getElementById('profilePictureEditor');
    if (!this.editor) return;
    this.avatars = document.getElementById('availableAvatars');
    this.images = this.avatars.querySelectorAll('.profile__image');
    this.input = document.getElementById('avatarId');
    this.editor.addEventListener("click", event => {
      this.avatars.style.display = "flex";
      this.editor.style.display = "none";
    });
    this.images.forEach(image => {
      image.addEventListener('click', event => {
        const img = this.editor.querySelector('img');
        const newImg = image.querySelector('img');
        this.input.value = newImg.dataset.id;
        img.src = newImg.src;
        this.avatars.style.display = "none";
        this.editor.style.display = "block";
      });
    });
  }
}

/***/ }),

/***/ "./src/js/Register.js":
/*!****************************!*\
  !*** ./src/js/Register.js ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Register)
/* harmony export */ });
class Register {
  constructor() {
    this.form = document.getElementById('registerForm');
    if (!this.form) return;
    this.error = document.querySelector('.register__error');
    this.form.addEventListener("submit", event => {
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
    if (!data.get("password") || data.get("password").length < 4) {
      this.displayError("Слишком короткий пароль");
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

/***/ }),

/***/ "./src/js/Reset.js":
/*!*************************!*\
  !*** ./src/js/Reset.js ***!
  \*************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Reset)
/* harmony export */ });
class Reset {
  constructor() {
    this.form = document.getElementById('resetForm');
    if (!this.form) return;
    this.error = document.querySelector('.register__error');
    this.form.addEventListener("submit", event => {
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
    // const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;       

    // if (!emailRegex.test(data.get("email"))) {        
    //     this.displayError("С почтой что-то не так. ");
    //     this.inputError("email");
    //     formOk = false;
    // } else {
    //     this.inputOk("email");
    // }  

    if (!data.get("password") || data.get("password").length < 4) {
      this.displayError("Слишком короткий пароль");
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

/***/ }),

/***/ "./src/scss/main.scss":
/*!****************************!*\
  !*** ./src/scss/main.scss ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _scss_main_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./scss/main.scss */ "./src/scss/main.scss");
/* harmony import */ var _js_Register__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./js/Register */ "./src/js/Register.js");
/* harmony import */ var _js_Profile__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./js/Profile */ "./src/js/Profile.js");
/* harmony import */ var _js_Login__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./js/Login */ "./src/js/Login.js");
/* harmony import */ var _js_Reset__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./js/Reset */ "./src/js/Reset.js");





document.addEventListener('DOMContentLoaded', () => {
  new _js_Register__WEBPACK_IMPORTED_MODULE_1__["default"]();
  new _js_Profile__WEBPACK_IMPORTED_MODULE_2__["default"]();
  new _js_Login__WEBPACK_IMPORTED_MODULE_3__["default"]();
  new _js_Reset__WEBPACK_IMPORTED_MODULE_4__["default"]();
});
})();

/******/ })()
;
//# sourceMappingURL=index.js.map