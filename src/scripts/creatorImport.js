const importCalendar = document.querySelector("[import]");
importCalendar.addEventListener("click", () => {
    const url = "../../callCalendar.php";
    fetch(url)
    .then(e => e.json())
    .then(content => {
        const id_calendar = document.querySelector("[calendar]");
        creatorCalendars(content, id_calendar.value);
    })
})
function creatorCalendars(contents, calendar)
{
    const parent = document.querySelector(".control-fill");
    const importCalendar = creator("div", [{
        name:"class",
        value: "importCalendar"
    }]);

    contents.forEach(content => { 
        const field_importCalendar = creator("div", [
                {
                name: "class",
                value: "field_importCalendar"
            },
            {
                name: "id_calendar",
                value: content["id"]
            }
        ]);
        const name_and_locality = creator("div", [
            {
                name: "class",
                value: "tam80"
            }
        ]);
        const calendar_name = creator("span", []);
        calendar_name.innerHTML = content["calendar_name"];

        const locality = creator("span", []);
        locality.innerHTML = content["locality"];

        const school_year = creator("span", [
            {
                name: "id",
                value: "school_year_import"
            },
            {
                name: "class",
                value: "tam20"
            }
        ]);
        school_year.innerHTML = content["school_year"];
        
        name_and_locality.appendChild(calendar_name);
        name_and_locality.appendChild(locality)
        field_importCalendar.appendChild(name_and_locality);
        field_importCalendar.appendChild(school_year);
        importCalendar.appendChild(field_importCalendar);
        parent.appendChild(importCalendar);
    })
}
function creator(element, attributes)
{
    const creator = document.createElement(element);
    attributes.forEach(attribute => {
        creator.setAttribute(attribute.name, attribute.value)
    });
    return creator;
}