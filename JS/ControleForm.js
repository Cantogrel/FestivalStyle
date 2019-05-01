function createMsg(){
    var tabInp = document.querySelectorAll(".inpForm input");
    tabInp.forEach(function(inp){
        var msg = inp.parentElement.querySelector("div");
        if (!inp.checkValidity()){
            if (inp.validity.patternMismatch){
                msg.innerHTML = "Seul les caractères suivants sont acceptés : ";
                if (inp.pattern === "^[0-9A-Z]+$"){
                    msg.innerHTML += "chiffres (0-9) et lettres majuscules (A-Z).";
                }else if (inp.pattern === "^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ'\s\-]+$"){
                    msg.innerHTML += "lettres minuscules (a-z), majuscules (A-Z), tiret (-), apostrophe et espace.";
                }else if (inp.pattern === "^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"){
                    msg.innerHTML = "Le format d'une adresse mail n'est pas respectés.";
                }else{
                    msg.innerHTML = inp.validationMessage;
                }
            }else{
                msg.innerHTML = inp.validationMessage;
            }
        }else{
            msg.innerHTML = "";
        }
    });
};

window.onload = function(){
    var btnValid = document.querySelector("input[name=valider]");
    btnValid.addEventListener("click", createMsg, false);
};
