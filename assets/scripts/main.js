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
