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