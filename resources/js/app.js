import './bootstrap';

import Alpine from 'alpinejs';
import Swal from 'sweetalert2';
import * as Livewire from '../../vendor/livewire/livewire/dist/livewire.esm.js';



const Toast = Swal.mixin({
    toast: true,
    position: 'top-end', // Correct position value
    timer: 7500,
    timerProgressBar: true,
    showConfirmButton: false,
});


window.Toast = Toast;
window.Alpine = Alpine;

// ✅ Start Alpine and Livewire after DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    Alpine.start();
    Livewire.start();
});

// this code is the original code if something went wrong just delete top adn uncomment this i jsut did the top one as i have no idea
// what could break in the future so i as gpt and that is what given 
// import './bootstrap';


// import Alpine from 'alpinejs';

// import Swal from 'sweetalert2';

// const Toast = Swal.mixin({
//     toast:true,
//     position:'top-right',
//     timer:7500,
//     timerProgressBar:true   
// })


// window.Toast =Toast;

// window.Alpine =Alpine;

// Alpine.start();