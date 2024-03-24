
const selectCP = $('#codePostaleForm');//input cope postal
const selectCommune = $('#destinataire_form_adr_communSIREN');//input commun
//Change les options
selectCP.on('change', async function(){
    if(this.value.length > 1){
        RemoveOption();
        AddOptionCommun(await RequestCommune(this.value));
    }
});
/**
 * Retournz une liste de commune siren et nom
 * @param {string} codeP code postale
 * @returns 
 */
async function RequestCommune(codeP){
    // const request = new XMLHttpRequest();
    // request.open('GET', "https://geo.api.gouv.fr/communes?codePostal=" + codeP, true );
    // let rep;
    // request.onload = function() {
    //     rep = JSON.parse(request.response);
    // }
    // request.send();
    const response = await fetch(`https://geo.api.gouv.fr/communes?codePostal=${codeP}`);
    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }
    const rep = await response.json(); // Obtient le JSON de la réponse

    let res = [];
    for(commun of rep){
        res.push({
            "nom": commun.nom,
            "siren": commun.siren
        })
    }
    return res;
}
/**
 * Ajout les option.
 * @param {array} array list commune
 */
function AddOptionCommun(array){
    for(commun of array){
        selectCommune.append($('<option>', {
            value: commun.siren,
            text: commun.nom
        }));
    }
}
/**Efface les option */
function RemoveOption(){
    selectCommune.empty();
}
