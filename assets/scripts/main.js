'use strict';

console.log('Hello World');

const btnDelete = document.querySelector('.btn-delete');

if (btnDelete) {
  btnDelete.addEventListener('click', (event) => {
    const reply = window.confirm('Are you sure?');

    if (!reply) {
      event.preventDefault();
    }
  });
}
//Hämta formulär med queryselctor
//Lyssna på eventets submit på formuläret
//Confirma att man vill submitta formuläret
//Submitta (element form.submit)

const rateIcons = document.querySelectorAll('.icon');

rateIcons.forEach((icon) => {
  if (icon) {
    icon.addEventListener('click', (event) => {
    window.location.replace(`app/posts/rating.php?post_id=${icon.dataset.post_id}&vote=${icon.dataset.vote}`);
    });
  }
});
