export function draftsFrom0_9_0to0_10_0(oldDraft) {
    let newDraft;
    //Change the missions key to activites
    newDraft=oldDraft;
    for(let index in oldDraft) {
        newDraft[index].activites = newDraft[index].missions;
        delete newDraft[index].missions;
        newDraft[index].appVersion = "0.10.0";
    }
    localStorage.setItem('draft', JSON.stringify(newDraft));
    return newDraft;
}