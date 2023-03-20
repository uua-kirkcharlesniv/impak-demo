import './bootstrap';

import Alpine from 'alpinejs';
import AOS from "aos";

window.AOS = AOS;
document.addEventListener('DOMContentLoaded',(e)=>{
    AOS.init({
        once: true,
        disable: 'phone',
        duration: 600,
        easing: 'ease-out-sine',
    });
})
  
// Call Alpine
window.Alpine = Alpine;
Alpine.start();
