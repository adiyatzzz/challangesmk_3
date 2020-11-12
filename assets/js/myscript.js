let denda = document.querySelectorAll('.denda');
window.addEventListener('load', function () {
    denda.forEach(el => {

        let trimStr = el.textContent.trim();
        if (trimStr.length == 0) {
            el.textContent = '0';
        }
    });
});
