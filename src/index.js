import "./scss/main.scss";
import Register from './js/Register';
import Profile from './js/Profile';
import Login from './js/Login';
import Reset from './js/Reset';

document.addEventListener('DOMContentLoaded', () => {
  new Register();
  new Profile();
  new Login();
  new Reset();
});


