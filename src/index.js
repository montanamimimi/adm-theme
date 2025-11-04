import "./scss/main.scss";
import Register from './js/Register';
import Profile from './js/Profile';
import Login from './js/Login';
import Reset from './js/Reset';
import Counter from './js/Counter';

document.addEventListener('DOMContentLoaded', () => {
  new Register();
  new Profile();
  new Login();
  new Reset();
  new Counter();
});


