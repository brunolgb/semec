function showRegistration(){
    const registration = document.querySelector(".registration-section");
    registration.classList.toggle('registration-section-mov');
    return registration;
}
function setVerifyAction(section){
    const verify_action = document.querySelector("[verify_action]");
    const btnSubmit = document.querySelector(".submit");
    if(section.getAttribute('class') == "registration-section")
    {
        verify_action.value='login';
        btnSubmit.innerHTML = "Entrar";
        return "login";
    }
    else{
        verify_action.value='registration';
        btnSubmit.innerHTML = "Cadastrar";
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

//replace image do password
const password = document.querySelector("[password]");
password.addEventListener("click", () => {
    const imgPassword = password.childNodes[1];
    const fieldPassword = document.querySelector("[fieldPassword]");

    password.classList.add("movimentPassword");
    setTimeout(() => {
        password.classList.remove("movimentPassword");
    }, 200);

    if(fieldPassword.getAttribute("type") == "password")
    {
        fieldPassword.setAttribute("type", "text");
        imgPassword.src = imgPassword.src.replace("password-hidden", "password-show");
    }
    else{
        fieldPassword.setAttribute("type", "password");
        imgPassword.src = imgPassword.src.replace("password-show", "password-hidden");
    }
})