let regBtn=document.querySelector('#register-btn');
let regForm=document.querySelector('.register-form-container');
let regClose=document.querySelector('#reg-close');
let forgetBtn=document.querySelector('#forget-btn');
let forgetForm=document.querySelector('.forget');
let forgetClose=document.querySelector('#forget-close');

window.onscroll=()=>{
    regForm.classList.remove('active');
    forgetForm.classList.remove('active');
}

regBtn.addEventListener('click',()=>{
    regForm.classList.add('active');
    loginForm.classList.remove('active');
});

regClose.addEventListener('click',()=>{
    regForm.classList.remove('active');
});

forgetBtn.addEventListener('click',()=>{
    forgetForm.classList.add('active');
    document.querySelector('.login-form-container').style.top=-120;
});

forgetClose.addEventListener('click',()=>{
    forgetForm.classList.remove('active');
    document.querySelector('.login-form-container').style.top=0;
});