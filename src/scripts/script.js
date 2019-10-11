const btnMenu = document.querySelector(".btnMenu");
btnMenu.addEventListener('click', () => {
    const menu = document.querySelector(".menu");
    const li = document.querySelectorAll(".menu li");

    menu.classList.toggle('movimentingMenu');
    setTimeout(() => {
        li.forEach(e => {
            e.classList.toggle('movimentingMenuLi');
        })
    }, 100);
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
        const id = e.getAttribute('idRegistro');
        const tbl = e.getAttribute('tbl');

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

const links = document.querySelectorAll('[linkWindow]');
links.forEach(e => {
    e.addEventListener('click', () => {
        const link = e.getAttribute('linkWindow');
        const parent = e.parentNode;
        const childParent = parent.childNodes;
        childParent.forEach(e => {
            const id = e.getAttribute('idRegistro');
            if(id != undefined)
            {
                window.location.href = `${link}/?calendar=${id}`;
            }
        });
    })
})

function getDataChoiseDay(){

}
function createChildChoiseDay(element)
{
    const child = document.createElement(element.element);
    element.attributes.map(e => {
        child.setAttribute(e.name, e.value);
    })
    if(element.data != undefined)
    {
        child.innerHTML = element.data;
    }

    return child;
}

function creatingParentChoise(day)
{
    if(day.childNodes[1] == undefined)
    {
        // descobrindo o tamanho da tela para organizar o right
        const fillBody = document.querySelector('.fill-body');
        const widthHorizont = fillBody.scrollWidth - day.offsetLeft;

        let attribute_choiseEventDay = "choise-event-day";
        let attribute_shapenerChoiseDay = 'shapener-choise-day';

        if(day.offsetLeft < 100)
        {
            attribute_choiseEventDay = 'choise-event-day moviment-choise-event-day-left';
            attribute_shapenerChoiseDay = "shapener-choise-day shapener-choise-day-left";
        }
        else if(widthHorizont < 200)
        {
            attribute_choiseEventDay = 'choise-event-day moviment-choise-event-day-right';
            attribute_shapenerChoiseDay = 'shapener-choise-day shapener-choise-day-right';
        }

        const choiseEventDay = createChildChoiseDay({
            element: "div",
            attributes:
            [
                {
                    name: "class",
                    value: attribute_choiseEventDay
                }
            ]
        })
        const shapenerChoiseDay = createChildChoiseDay({
            element: "img",
            attributes:
            [
                {
                    name: "class",
                    value: attribute_shapenerChoiseDay
                },
                {
                    name: "src",
                    value: "../../assets/sharpener.svg"
                }
            ]
        })

        const child_btnChoiseDay = createChildChoiseDay({
            element: "button",
            data: "+",
            attributes:
            [
                {
                    name: "class",
                    value: "btnEventChoiseDay newEventChoiseDay"
                },
                {
                    name: "title",
                    value: "Criar um novo evento"
                }
            ]
        })

        const child_btnClose = createChildChoiseDay({
            element: "button",
            data: "x",
            attributes:
            [
                {
                    name: "class",
                    value: "btnEventChoiseDay closeEventChoiseDay"
                },
                {
                    name: "title",
                    value: "Fechar"
                },
                {
                    name: 'closeChoise'
                }
            ]
        })

        
        // childs de choiseEventDay
        choiseEventDay.appendChild(shapenerChoiseDay);
        choiseEventDay.appendChild(child_btnClose);
        choiseEventDay.appendChild(child_btnChoiseDay);
        
        // parent
        day.appendChild(choiseEventDay);
    }
}
function checkingChoiseSemana(daySemana, day)
{
    daySemana.forEach(e => {
        if(e != day)
        {
            const diferenceChoise = e.childNodes[1];
            
            if(diferenceChoise != undefined)
            {
                e.removeChild(diferenceChoise);
            }
        }
    });
}
const daySemana = document.querySelectorAll('[day]');
daySemana.forEach(day => {
    day.style.cursor = 'pointer';
    day.addEventListener('click', ()=>{
        creatingParentChoise(day);
        checkingChoiseSemana(daySemana, day);

        const close_choiseEventDay = document.querySelector('.closeEventChoiseDay');
        close_choiseEventDay.onclick = () => {
            close_choiseEventDay.parentNode.style.display = 'none';
        }
    })
});