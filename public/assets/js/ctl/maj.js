function onClickBtnAjt(event) {
    event.preventDefault();
    const url = this.href;
    const btn = this.querySelector('button');
    console.log(btn);
    axios.get(url).then(function (response) {
                console.log(btn.classList)
            if (btn.classList.contains('btn-primary')) {
                btn.classList.replace('btn-primary', 'btn-secondary');

                btn.firstChild.data = "_";
            } else {
                btn.classList.replace('btn-secondary', 'btn-primary');
                btn.firstChild.data = "X";
            }

            console.log('lu5');
            console.log(response);
        }).catch(function (error) {
            if (error.response.status === 403) {
                window.alert("Erreur");
            }
    });
}
// permet d'appeler la fontionquand on agit sur boton atcle - GTA
    console.log('lu02');
    document.querySelectorAll('a.js-status').forEach(function (link) {
    console.log('lu3');
    link.addEventListener('click', onClickBtnAjt);

    })
