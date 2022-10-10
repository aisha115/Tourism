let searchBtn=document.querySelector('#search-btn');
let searchBar=document.querySelector('.search-bar-container');
let formBtn=document.querySelector('#login-btn');
let loginForm=document.querySelector('.login-form-container');
let formClose=document.querySelector('#form-close');
let regBtn=document.querySelector('#register-btn');
let regForm=document.querySelector('.register-form-container');
let regClose=document.querySelector('#reg-close');
let forgetBtn=document.querySelector('#forget-btn');
let forgetForm=document.querySelector('.forget');
let forgetClose=document.querySelector('#forget-close');
let menu=document.querySelector('#menu-bar');
let navbar=document.querySelector('.navbar');
let videoBtn=document.querySelectorAll('.vid-btn');

window.onscroll=()=>{
    searchBtn.classList.remove('fa-times');
    searchBar.classList.remove('active');
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
    loginForm.classList.remove('active');
    regForm.classList.remove('active');
    forgetForm.classList.remove('active');
}

menu.addEventListener('click',()=>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
});

searchBtn.addEventListener('click',()=>{
    searchBtn.classList.toggle('fa-times');
    searchBar.classList.toggle('active');
});

formBtn.addEventListener('click',()=>{
    loginForm.classList.add('active');
});

formClose.addEventListener('click',()=>{
    loginForm.classList.remove('active');
});

regBtn.addEventListener('click',()=>{
    regForm.classList.add('active');
    loginForm.classList.remove('active');
});

regClose.addEventListener('click',()=>{
    regForm.classList.remove('active');
});

forgetBtn.addEventListener('click',()=>{
    forgetForm.classList.add('active');
    loginForm.classList.remove('active');
});

forgetClose.addEventListener('click',()=>{
    forgetForm.classList.remove('active');
});

videoBtn.forEach(btn=>{
    btn.addEventListener('click',()=>{
        document.querySelector('.controls .active').classList.remove('active');
        btn.classList.add('active');
        let src=btn.getAttribute('data-src');
        document.querySelector('#video-slider').src=src;
    });
});

var swiper=new Swiper(".review-slider",{
    spaceBetween:20,
    loop:true,
    autoplay:{
        delay:2500,
        disableOnInteraction:false,
    },
    breakpoints:{
        640:{
            slidesPerView:1,
        },
        768:{
            slidesPerView:2,
        },
        1024:{
            slidesPerView:3
        },
    },
});