export function draftsFrom0_9_0to0_10_0(oldDraft) {
    let newDraft;
    //Change the missions key to activites with other renamed properties
    newDraft=oldDraft;
    for(let index in oldDraft) {
        newDraft[index].activites = newDraft[index].missions;
        delete newDraft[index].missions;
        if(undefined !== newDraft[index].activites.navire) {
            if(undefined !== newDraft[index].activites.navire.controleSansPv) {
                newDraft[index].activites.navire.controleSansPv.controleNavireRealises = newDraft[index].activites.navire.controleSansPv.controles;
                delete newDraft[index].activites.navire.controleSansPv.controles;
            }
            for(let i = 0; i < newDraft[index].activites.navire.controles.length; i++) {
                newDraft[index].activites.navire.controles[i].controleNavireRealises = newDraft[index].activites.navire.controles[i].controles;
                delete newDraft[index].activites.navire.controles[i].controles;
                newDraft[index].activites.navire.controles[i].navire.immatriculation = newDraft[index].activites.navire.controles[i].navire.immatriculationFr;
                delete newDraft[index].activites.navire.controles[i].navire.immatriculationFr;
                newDraft[index].activites.navire.controles[i].navire.genreNav = newDraft[index].activites.navire.controles[i].navire.typeUsage;
                delete newDraft[index].activites.navire.controles[i].navire.typeUsage;
                newDraft[index].activites.navire.controles[i].navire.categorieUsageNavire = newDraft[index].activites.navire.controles[i].navire.categorieControleNavire;
                delete newDraft[index].activites.navire.controles[i].navire.categorieControleNavire;
            }
        }
        newDraft[index].appVersion = "0.10.0";
    }
    localStorage.setItem('draft', JSON.stringify(newDraft));
    return newDraft;
}