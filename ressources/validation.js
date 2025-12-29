function verifierFormulaire() {
    let champs = ["nom", "prenom", "sexe", "ville"];
    for (let c of champs) {
        let element = document.getElementById(c);
        if (!element || element.value.trim() === "") {
            alert("Veuillez remplir le champ : " + c);
            return false;
        }
    }
    let loisirs = document.getElementsByName("loisirs[]");
    let Case = false;
    for (let i = 0; i < loisirs.length; i++) {
        if (loisirs[i].checked) {
            Case= true;
            break;
        }
    }
    if (!Case) {
        alert("Veuillez sélectionner au moins un loisir.");
        return false;
    }
    return true;
}
