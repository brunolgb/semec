
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

        school_years.forEach((element, index) => {
            element.innerHTML = content[index];
        })
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

showTotalEventsSpecifc('letivo');
showTotalEvents("feriado+letivo+facultativo");