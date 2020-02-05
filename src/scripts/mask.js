const years = document.querySelectorAll('[mask-year]');
years.forEach(year => {
    year.addEventListener('focus', () => {
        if(year.value > 1900 & year.value < 2020)
        {
            
        }
    })
});

const cep = document.querySelector("[cep]");
if(cep != undefined)
{
    cep.addEventListener("keyup", () => {
        const cepValue = cep.value;
        if(cepValue.length == 8)
        {
            const urlCep = `https://viacep.com.br/ws/${cepValue}/json/`;
            fetch(urlCep)
            .then(response => response.json())
            .then(content => {
                if(content["erro"])
                {
                    const msg = document.createElement("div");
                    msg.setAttribute("class","erro");
                    msg.innerHTML = "CEP inválido";
                    document.body.appendChild(msg);

                    setTimeout(() => {
                        document.body.removeChild(msg);
                    }, 3000);
                    setValueCep("#logradouro", "");
                    setValueCep("#bairro", "");
                    setValueCep("#cidade", "");
                    setValueCep("#uf", "");
                }
                else{
                    setValueCep("#logradouro", content["logradouro"]);
                    setValueCep("#bairro", content["bairro"]);
                    setValueCep("#cidade", content["localidade"]);
                    setValueCep("#uf", content["uf"]);
                }
            })
        }
    })
}
function setValueCep(selector, value)
{
    const element = document.querySelector(selector);
    element.value = value;
}

const cpf = document.querySelector("[cpf]");
if (cpf != undefined)
{
    cpf.addEventListener("keypress", () => {
        const valueCpf = cpf.value;

        if(valueCpf.length == 3)
        {
            cpf.value = `${valueCpf}.`
        }
        else if(valueCpf.length == 7)
        {
            cpf.value = `${valueCpf}.`
        }
        else if (valueCpf.length == 11) {
            cpf.value = `${valueCpf}-`
        }
        else{
            cpf.value = valueCpf
        }
    })

    cpf.addEventListener("change", () => {
        const valueCpf = cpf.value;
        const regexCpf = /[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}/
        const testMask = regexCpf.test(valueCpf);

        if(!testMask)
        {
            window.location.replace("./?m=10")
        }
    })
}