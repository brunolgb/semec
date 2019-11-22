const importCalendar = document.querySelector("[import]");
importCalendar.addEventListener("click", () => {
    const id_calendar = document.querySelector("[calendar]");
    const url = `../../callCalendar.php?id=${id_calendar.value}`;
    fetch(url)
    .then(e => e.json())
    .then(content => {
        const importCalendar = document.querySelector(".importCalendar");
        if(importCalendar == null)
        {
            const parent = document.querySelector(".control-fill");
            creatorElements(content, parent);
            actionClose_btnClose(parent);
            showEvents_import(id_calendar.value, importCalendar)
        }
        else{
            importCalendar.classList.add("importCalendar_mov");
            setTimeout(() => {
                importCalendar.classList.remove("importCalendar_mov")
            }, 600);
        }
    })
})
function creatorElements(contents, parent)
{
    const importCalendar = document.createElement("div")
    importCalendar.setAttribute("class", "importCalendar");

    const title_importCalendar = document.createElement("div")
    title_importCalendar.setAttribute("class", "title_importCalendar");
    title_importCalendar.innerHTML = "Escolher calendário";
    importCalendar.appendChild(title_importCalendar);

    const btnClose_importCalendar = document.createElement("div")
    btnClose_importCalendar.setAttribute("class", "btnEventChoiseDay closeEventChoiseDay");
    btnClose_importCalendar.setAttribute("action_import", "close");
    btnClose_importCalendar.innerHTML = "X";
    title_importCalendar.appendChild(btnClose_importCalendar);
    

    const box_field_importCalendar = document.createElement("div")
    box_field_importCalendar.setAttribute("class", "box_importCalendar");

    contents.forEach(content => { 
        const field_importCalendar = document.createElement("div")
        field_importCalendar.setAttribute("class", "field_importCalendar");
        field_importCalendar.setAttribute("id_calendar", content["id"]);

        const name_and_locality = document.createElement("div")
        name_and_locality.setAttribute("class", "tam80");

        const calendar_name = document.createElement("span")
        calendar_name.innerHTML = content["calendar_name"];

        const locality = document.createElement("span")
        locality.innerHTML = content["locality"];

        const school_year = document.createElement("span")
        school_year.setAttribute("id", "school_year_import");
        school_year.setAttribute("class", "tam20");
        school_year.innerHTML = content["school_year"];
        
        // add childs
        name_and_locality.appendChild(calendar_name);
        name_and_locality.appendChild(locality)
        field_importCalendar.appendChild(name_and_locality);
        field_importCalendar.appendChild(school_year);
        box_field_importCalendar.appendChild(field_importCalendar);
    })
    const listEvents_import = document.createElement("div")
    listEvents_import.setAttribute("class", "listEvents_import");

    const events_and_calendar = document.createElement("div")
    events_and_calendar.setAttribute("class", "events_and_calendar");

    events_and_calendar.appendChild(box_field_importCalendar);
    events_and_calendar.appendChild(listEvents_import);
    importCalendar.appendChild(events_and_calendar);
    parent.appendChild(importCalendar);

}
function actionClose_btnClose(parent)
{
    const importCalendar = document.querySelector(".importCalendar");
    const btnClose = document.querySelector("[action_import]");
     btnClose.addEventListener("click", () => {
        parent.removeChild(importCalendar);
    })
}

function showEvents_import(id_calendar){
    const box_importCalendar = document.querySelector(".box_importCalendar");
    const field_importCalendar = document.querySelectorAll(".field_importCalendar");
    field_importCalendar.forEach(field => {
        field.addEventListener("click", () => {
            const id = field.getAttribute("id_calendar");
            const url = `../../getEvents.php?id=${id}`;
            fetch(url)
            .then(response => response.json())
            .then(content => {

                // add or remove class mov
                box_importCalendar.classList.remove("box_importCalendar_mov_reverse");
                box_importCalendar.classList.toggle("box_importCalendar_mov");
                
                const listEvents_import = document.querySelector(".listEvents_import");
                listEvents_import.classList.remove("listEvents_import_mov_reverse");
                listEvents_import.classList.toggle("listEvents_import_mov");
                listEvents_import.setAttribute("calendar_export", id)
                
                // image sharpeneder
                const div_leftSharpener = document.createElement("div")
                div_leftSharpener.setAttribute("class","div_leftSharpener");
                const leftSharpener = document.createElement("img")
                leftSharpener.setAttribute("src","../../assets/rightSharpener.svg")

                div_leftSharpener.appendChild(leftSharpener);
                listEvents_import.appendChild(div_leftSharpener);
                
                // bulding spans
                content.forEach(element => {
                    const span = document.createElement("span")
                    span.setAttribute("event_listEvents", "span");
                    span.setAttribute("listEvents", element["event"]);
                    span.innerHTML = element["event"];
                    listEvents_import.appendChild(span);
                })

                // buld button import
                const listEvents_submit = document.createElement("button")
                listEvents_submit.setAttribute("class","submit tam40");
                listEvents_submit.setAttribute("event_listEvents","submit");
                listEvents_submit.innerHTML = "Importar";

                const inputHidden = document.createElement("input")
                inputHidden.setAttribute("type","hidden");
                inputHidden.setAttribute("event_listEvents","hidden");

                listEvents_import.appendChild(inputHidden);
                listEvents_import.appendChild(listEvents_submit);
                left_sharpener();
                eventClickSpan();
                submitData(id_calendar, id);
            })
        })
    })

}
function eventClickSpan()
{
    const span = document.querySelectorAll(".listEvents_import span");
    const event_listEvents = document.querySelector("[event_listEvents=hidden]");
    span.forEach(element => {
        element.addEventListener("click", () => {
            element.classList.toggle("listEvent_actionClick");
            const event_of_span = element.getAttribute("listEvents");
            event_listEvents.value += `${event_of_span},`;
        })
    })

}
function left_sharpener()
{
    const div_leftSharpener = document.querySelector(".div_leftSharpener");
    const box_importCalendar = document.querySelector(".box_importCalendar");
    const listEvents = document.querySelectorAll("[event_listEvents]");

    div_leftSharpener.addEventListener("click", () => {
        div_leftSharpener.parentNode.classList.remove("listEvents_import_mov");
        box_importCalendar.classList.remove("box_importCalendar_mov");

        div_leftSharpener.parentNode.classList.add("listEvents_import_mov_reverse");
        box_importCalendar.classList.add("box_importCalendar_mov_reverse");

        listEvents.forEach(element => {
            div_leftSharpener.parentNode.removeChild(element);
        })
        div_leftSharpener.parentNode.removeChild(div_leftSharpener);
    })

}
function submitData(calendar_import, calendar_export)
{
    const btnImport = document.querySelector("[event_listEvents=submit]");
    const data = document.querySelector("[listEvents=form]");
    btnImport.addEventListener("click", () => {
        const span = data.childNodes;
        let eventsChecked = "";
        span.forEach(element => {
            const e = element.lastChild;
            if(e.checked)
            {
                eventsChecked += `${e.value}+`;
            }
        })
        if(eventsChecked.length != "")
        {
            events = eventsChecked.substr(0, eventsChecked.length - 1);
            const url = `../../importCalendar.php?import=${calendar_import}&export=${calendar_export}&q=${events}`;
            fetch(url)
            .then(response => response.json())
            .then(content => {
                console.log(content);
            })
        }
    })
}