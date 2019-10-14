function showRegistration(){
    const registration = document.querySelector(".registration-section");
    registration.classList.toggle('registration-section-mov');
    return registration;
}
function setVerifyAction(section){
    const verify_action = document.querySelector("[verify_action]");
    if(section.getAttribute('class') == "registration-section")
    {
        verify_action.value='login';
        return "login";
    }
    else{
        verify_action.value='registration';
        return "registration";
    }
}
function setBtnRegistration(btn, value){
    btn.innerHTML = value == "login" ? "Cadastrar-se" : "Já sou cadastrado";
}


const registration = document.querySelector('[registration]');
registration.addEventListener('click', (event) => {
    event.preventDefault();

    const return_ShowResgitration = showRegistration();
    const return_setVerifyAction = setVerifyAction(return_ShowResgitration);
    setBtnRegistration(registration, return_setVerifyAction);
})