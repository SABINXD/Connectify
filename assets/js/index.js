const navMenu = document.getElementById('nav-menu');
const moreMenu = document.getElementById('more-menu');
const  mainWrapper = document.querySelector('.main-wrapper');
moreMenu.addEventListener('click',function (e){
navMenu.style.display="block";
}) ;
mainWrapper.addEventListener('click',function(e){
    navMenu.style.display="none";
})  

