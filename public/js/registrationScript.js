
const selectCP = $('#codePostaleForm');
const selectCommune = $('#destinataire_form_adr_communSIREN');

selectCP.on('change', function(){
    if(this.value.length > 1){
        RemoveOption();
        AddOptionCommun(RequestCommune(this.value));
    }
});

function RequestCommune(codeP){
    const request = new XMLHttpRequest();
    request.open('GET', "https://geo.api.gouv.fr/communes?codePostal=" + codeP, false );
    let rep = JSON.parse(request.response);
    let res = [];
    for(commun in rep){
        res.push({
            "nom": commun.nom,
            "siren": commun.siren
        })
    }
    return res;
}

function AddOptionCommun(array){
    for(commun in array){
        selectCommune.append($('<option>', {
            value: commun.siren,
            text: commun.nom
        }));
    }
}
function RemoveOption(){
    selectCommune.innerHTMl = '';
}
