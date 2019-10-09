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