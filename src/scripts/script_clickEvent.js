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
                showTotalEventsSpecifc('letivo');
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