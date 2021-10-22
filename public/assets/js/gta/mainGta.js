
	function onClickBtnAjt(event) {

        event.preventDefault();
        var elements = document.getElementsByClassName("js-status");
        // console.log(elements);
        const url = this.href;
        const btn = this.querySelector('button');
        console.log(btn);
        console.log(btn.id);
        var idBtn =btn.id;
        const myArray = idBtn.split('_');
        console.log(myArray);

         console.log('lu4');
        for ( let i=0;i<elements.length;i++){
            console.log('trouve');
          //  console.log(elements[i]);
            // console.log(elements[i].children[0].name);
            var idBtnElt=elements[i].children[0].id;
            console.log(idBtnElt);
            const myArrayElt = idBtnElt.split('_');
            console.log(myArrayElt);
            if (myArrayElt[0] == myArray[0] && myArrayElt[1] != myArray[1]) {
                 console.log('trouve id');
                 console.log(elements[i].children[0].className)
                elements[i].children[0].className='btn btn-secondary btn-sm'
                elements[i].children[0].firstChild.data='_';
            }
             console.log('fin trouve');
        }

;
        axios.get(url).then(function (response) {
            if (btn.classList.contains('btn-primary')) {
            // btn.classList.replace('btn-primary', 'btn-secondary');

            // btn.firstChild.data = "_";
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

    console.log('lu2');
    document.querySelectorAll('a.js-status').forEach(function (link) {
     console.log('lu3');

    console.log('lu3fin');
        link.addEventListener('click', onClickBtnAjt);
    })