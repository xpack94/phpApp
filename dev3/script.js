function validateOptions() {
    const debut = document.querySelector(".debut");
    const fin = document.querySelector(".fin");
    const debutVal = parseInt(debut.options[debut.selectedIndex].value);
    const finVal = parseInt(fin.options[fin.selectedIndex].value);
    if (debutVal >= finVal) {
        alert("l'heure de debut ne peut pas etre plus petite que l'heure de fin");
        true
        return false;
    }
    return true;

};


