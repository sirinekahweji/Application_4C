export default function (to, from, next) {
    if (!localStorage.getItem('user')) {
      next('/');
    } else {
      next();
    }
}