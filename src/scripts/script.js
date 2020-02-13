const btnMenu = document.querySelector(".btnMenu");
btnMenu.addEventListener('click', () => {
    const menu = document.querySelector(".menu");
    const li = document.querySelectorAll(".menu li");

    menu.classList.toggle('movimentingMenu');

    li.forEach((e) => {
        e.classList.toggle('opacityMenuLi');
    })
    
    li.forEach((e, index) => {
        const timeAll = index * 50
        setTimeout(() => {
            e.classList.toggle('movimentingMenuLi');
        }, timeAll );
    })
})

function addValueInputHidden(element)
{
    const locality = element.getAttribute("locality");
    const fieldHidden = document.querySelector('[localityValue]');

    fieldHidden.value = locality;
}

const choiseLocality = document.querySelectorAll('.choiseLocality');
choiseLocality.forEach(e => {
    e.addEventListener('click', () => {
        e.classList.add('locatityCalendarMoviment');

        addValueInputHidden(e);
        
        choiseLocality.forEach(elements => {
            if(elements != e)
            {
                elements.classList.remove('locatityCalendarMoviment');
            }
        })
    });
})

const deleteRegist = document.querySelectorAll('[delete]');
deleteRegist.forEach(e => {
    e.addEventListener('click', () => {
        const parent = e.parentNode;
        const id = parent.getAttribute('idRegistro');
        const tbl = parent.getAttribute('tbl');

        fetch(`../../callDelete.php?id=${id}&tbl=${tbl}`)
            .then(e => e.json())
            .then(e => {
                if(e.message)
                {
                    window.location.reload();
                }
                else{
                    console.log('mensagem de erro');
                }
            })
            .catch(e => {
                console.log('Não foi possivel fazer a requisição');
            })
    })
})

const updateRegist = document.querySelectorAll('[update]');
updateRegist.forEach(e => {
    e.addEventListener('click', () => {
        const parent = e.parentNode;
        const id = parent.getAttribute('idRegistro');
        const tbl = parent.getAttribute('tbl');
        const page = parent.getAttribute('page');

        window.location.href = `../${page}/?id=${id}&tbl=${tbl}`;
    })
})

const links = document.querySelectorAll('[linkWindow]');
links.forEach(e => {
    e.addEventListener('click', () => {
        const link = e.getAttribute('linkWindow');
        const parent = e.parentNode;
        const childParent = parent.childNodes;
        childParent.forEach(e => {
            const id = parent.getAttribute('idRegistro');
            if(id != undefined)
            {
                window.location.href = `${link}/?calendar=${id}`;
            }
        });
    })
})

// withdrawal
const btn_withdraw = document.querySelectorAll('[withdraw]');
btn_withdraw.forEach(btn => {
    btn.addEventListener('click', () => {
        const box_withdraw = document.querySelector(".box_withdraw")
        box_withdraw.classList.add("show_box_withdraw");

        settext_and_class(btn)
        const number_of_seleteds = number_of_withdraw_selected(box_withdraw);
        show_options_withdraw(box_withdraw ,number_of_seleteds)
    })
})

function settext_and_class(btn)
{
    const attribute_btn = btn.getAttribute("class");
    if(attribute_btn.indexOf("withdraw_selected") > 0)
    {
        btn.classList.remove("withdraw_selected");
        btn.innerHTML = "RETIRAR"
    }
    else
    {
        btn.classList.add("withdraw_selected");
        btn.innerHTML = "SELECIONADO"
    }
    
}
function number_of_withdraw_selected(box_withdraw)
{
    const number_of_withdrawSelected = document.querySelector("[number_of_withdrawSelected]");
    const selecteds = document.querySelectorAll(".withdraw_selected");
    number_of_withdrawSelected.innerHTML = selecteds.length;

    let ids_selecteds = '';

    selecteds.forEach(selected => {
        ids_selecteds += `${selected.parentNode.getAttribute("idWithdraw")},`;
    });

    //get ids selecteds
    const final_ids_selecteds = ids_selecteds.substr(0,ids_selecteds.length - 1);
    const ids_school_transfer = document.querySelector('[ids_school_transfer]');
    ids_school_transfer.value = final_ids_selecteds

    if(!selecteds.length)
    {
        box_withdraw.classList.add("reverse_show_box_withdraw");

        setTimeout(() => {
            box_withdraw.classList.remove("show_box_withdraw");
            box_withdraw.classList.remove("reverse_show_box_withdraw");
        }, 500);     
    }
}
function show_options_withdraw()
{
    const withdraw = document.querySelector("#withdraw");
    withdraw.addEventListener("click", () => {
        const formwithdraw = document.querySelector(".form_withdraw");
        formwithdraw.style.display = "block";
    })
}

// close withdrawal
const close_withdraw = document.querySelector("[close_withdraw]");
if(close_withdraw != undefined)
{
    close_withdraw.addEventListener("click", (event) => {
        event.preventDefault()
        const close_formwithdraw = document.querySelector(".form_withdraw");
        close_formwithdraw.style.display = "none";
})
}

// option input select on select school destination
const select_destinationSchool = document.querySelector("#destination_school");
if (select_destinationSchool != undefined) {
    select_destinationSchool.addEventListener("change", () => {
        const citydestination = document.querySelector(".destination_city")
        if(select_destinationSchool.value=="nenhuma")
        {
            citydestination.classList.add("anime_destination_city");
            citydestination.focus();
        }
        else{
            citydestination.classList.remove("anime_destination_city");
        }
    })
}

// getdata form withdraw
const submit_from_withdraw = document.querySelector("[submit]");
if (close_withdraw != undefined) {
    submit_from_withdraw.addEventListener("click", (event) => {
        event.preventDefault();
        const URLFormfield = mountURLFormfield();

        let ids_school_transfer = document.querySelector('[ids_school_transfer]');
        ids_school_transfer = ids_school_transfer.value.split(',');

        creatorBackgroundWithdrawal();

        ids_school_transfer.forEach(async ids => {
            const response = await withdraw(ids, URLFormfield)
            const response_ids_withdraw = await response.json();
        });
    })
}

function mountURLFormfield()
{
    const form_field_withdraw = document.querySelectorAll("[form_field]");
    let partyUrl = "";
    form_field_withdraw.forEach((field) => {
        partyUrl += `${field.name}=${field.value}&`
    })

    return partyUrl.substr(0, partyUrl.length - 1) 
}
function withdraw(id, partyUrl)
{
    return fetch(`../../setWithdraw.php?ids_school_transfer=${id}&${partyUrl}`)
}

function creatorBackgroundWithdrawal()
{
    const background = document.createElement('div');
    background.setAttribute('class','loadWithdrawal_background');
    
    const form_withdraw = document.querySelector('.form_withdraw');
    form_withdraw.appendChild(background);
}


const development = document.querySelector(".developer");
if (development != undefined)
{
    development.addEventListener("click", ()=>{
        window.location.replace('../desenvolvedor/')
    })
}
