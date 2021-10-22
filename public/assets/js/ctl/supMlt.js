function onClickBtnSupMlt(event) {	
    event.preventDefault();
    const url = this.href;
    const btn = this.querySelector('button');  
    console.log(btn.classList)
    var btns = document.getElementsByClassName("js-status");
         for (var i = 0; i < btns.length; i++) {
            btns[i].children[0].className='btn btn-secondary btn-sm'
            btns[i].children[0].firstChild.data='_';
         }
        axios.get(url).then(function (response) {
            console.log('lu5');
            console.log(response);
        }).catch(function (error) {
            if (error.response.status === 403) {
                window.alert("Erreur");
            }
        });
}
console.log('lu02');
document.querySelectorAll('a.js-status3').forEach(function (link) {
console.log('lu3');
link.addEventListener('click', onClickBtnSupMlt);

})