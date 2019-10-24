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
function replaceEvents(event)
{
    switch (event) {
        case 'semana pedagogica':
            return 'semana pedagógica'
            break;
        case 'atribuicao':
            return 'atribuição'
            break;
        case 'ferias':
            return 'férias'
            break;
        default:
            return event;
            break;
    }
}
function addValue(element_to_add_content, content)
{
    const element_to_content = document.querySelector(element_to_add_content);
    element_to_content.setAttribute('id', content.event)
    const event = content.event;
    const transformationEvent = event.replace('_', ' ');
    element_to_content.innerHTML = replaceEvents(transformationEvent);
}
function getAttributesDay(day, calendar)
{
    const dateChoise = day.getAttribute('date');
    fetch(`../../getAttributeDay.php?id_calendar=${calendar}&calendar_date=${dateChoise}`)
        .then(e => e.json())
        .then(e => {
            verify = e.filter(e => {
                if(e.event)
                {
                    return e;
                }
            });

            if(verify.length)
            {
                verify.map( e => {
                    addValue('.chosieDay_content', e);
                })
            }
        })
}

function creatingParentChoise(day)
{
    if(day.childNodes[1] == undefined)
    {
        const calendar = document.querySelector("[calendar]");
        getAttributesDay(day,calendar.value);
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
        const child_content = createChildChoiseDay({
            element: "div",
            attributes:
            [
                {
                    name: "class",
                    value: "chosieDay_content tam100"
                }
            ]
        })
        const child_addEvent = createChildChoiseDay({
            element: "div",
            attributes:
            [
                {
                    name: "class",
                    value: "addEvent tam100"
                }
            ]
        })

        // adicionando os filhos do addEvent com todos os eventos
        fetch('../../data/events.json')
            .then(events_to_transform => events_to_transform.json())
            .then(events_transformated => {
                const titleEventsAdd = createChildChoiseDay({
                    element: "div",
                    data: "Escolha o evento",
                    attributes:
                    [
                        {
                            name: "class",
                            value: "tam100"
                        }
                    ]
                })

                child_addEvent.appendChild(titleEventsAdd);

                events_transformated.map(element => {
                    const value_element = element.nameReplace == undefined ? element.name : element.nameReplace;
                    const childs = createChildChoiseDay({
                        element: "div",
                        data: value_element,
                        attributes:
                        [
                            {
                                name: "class",
                                value: "tam100"
                            },
                            {
                                name: "id",
                                value: element.name
                            },
                            {
                                name: "event",
                                value: element.name
                            }
                        ]
                    })
                    child_addEvent.appendChild(childs);
                    
                })
            })


        
        // childs de choiseEventDay
        choiseEventDay.appendChild(shapenerChoiseDay);
        choiseEventDay.appendChild(child_btnClose);
        choiseEventDay.appendChild(child_btnChoiseDay);
        choiseEventDay.appendChild(child_content);
        choiseEventDay.appendChild(child_addEvent);
        
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
function setEventDay(event, calendar_date)
{
    const id_calendar = document.querySelector("[calendar]");

    fetch(`../../addEvent.php?id_calendar=${id_calendar.value}&event=${event}&calendar_date=${calendar_date}`)
    .then(json_parse => json_parse.json())
    .then(data => data.message)
}
function showTotalEventsSpecifc(event)
{
    const calendar = document.querySelector("[calendar]");
    const url = `../../callAttributos.php?calendar=${calendar.value}&event=${event}`;
    fetch(url)
    .then(contentJson => contentJson.json())
    .then(content => {
        const school_years = document.querySelectorAll("[school_years]");
        const totalLetivo = document.querySelector(`[total_${event}]`);

        school_years.forEach((element, index) => {
            element.innerHTML = content[index];
        })

        const totalEvent = content.reduce((total, counter) => {
            return total + counter;
        });

        totalLetivo.innerHTML = totalEvent;
    })
}
function showTotalEvents(events)
{
    const calendar = document.querySelector("[calendar]");
    const url = `../../callAttributos.php?calendar=${calendar.value}&event=${events}`;
    fetch(url)
    .then(contentJson => contentJson.json())
    .then(content => {
        content.forEach(element => {
            const totalSpeficic = document.querySelector(`[total_${element['name']}]`);
            totalSpeficic.innerHTML = element["total"];
        })
    })
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

        const add_choiseEventDay = document.querySelector('.newEventChoiseDay');
        add_choiseEventDay.onclick = () => {
            const addEvent = document.querySelector('.addEvent');
            addEvent.classList.toggle('addEvent_mov');

            const chosieDay_content = document.querySelector('.chosieDay_content');
            chosieDay_content.classList.toggle('chosieDay_content_mov');
        }

        const listEvent = document.querySelectorAll('[event]');
        listEvent.forEach(event => {
            event.onclick = () => {
                const attr_event = event.getAttribute('event');
                const chosieDay_content = document.querySelector('.chosieDay_content');
                const addEvent = document.querySelector('.addEvent');

                
                // replace element selected
                chosieDay_content.innerHTML = event.innerHTML;

                // insert ou update em database
                const parent = event.parentNode.parentNode.parentNode;
                const calendar_date = parent.getAttribute('date');
                setEventDay(event.getAttribute('id'), calendar_date);

                // replace values total events
                showTotalEventsSpecifc(attr_event);
                showTotalEvents("feriado+letivo+facultativo");

                // trocando em tela
                chosieDay_content.setAttribute('id',attr_event);
                addEvent.classList.toggle('addEvent_mov');
                chosieDay_content.classList.toggle('chosieDay_content_mov');
                parent.setAttribute('id', event.getAttribute('id'));
                
            }
        })
    })
});