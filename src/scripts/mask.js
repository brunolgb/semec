const years = document.querySelectorAll('[mask-year]');
years.forEach(year => {
    year.addEventListener('focus', () => {
        if(year.value > 1900 & year.value < 2020)
        {
            
        }
    })
});