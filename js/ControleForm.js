//fonction qui génère les messages d'erreur du formulaire
function createMsg(){
    var tabInp = document.querySelectorAll(".inpForm input");
    tabInp.forEach(function(inp){
        var msg = inp.parentElement.querySelector("div");
        inp.style.backgroundColor = "white";
        if (!inp.checkValidity()){
            if (inp.validity.patternMismatch){
                msg.innerHTML = "Seul les caractères suivants sont acceptés : ";
                if (inp.pattern === "^[0-9]+$"){
                    msg.innerHTML += "chiffres (0-9).";
                }else if (inp.pattern === "^[0-9A-Z]+$"){
                    msg.innerHTML += "chiffres (0-9) et majuscules.";
                }else if (inp.type === "text"){
                    msg.innerHTML += "lettres, tiret (-), apostrophe et espace.";
                }else{
                    msg.innerHTML = inp.validationMessage;
                }
            }
            inp.value = "";
            inp.style.backgroundColor = "rgba(255,0,0,0.1)";
        }else{
            msg.innerHTML = "";
        }
    });
};

//se lance au chargement de la page
window.onload = function(){
    var btnValid = document.querySelector("input[name=valider]");
    btnValid.addEventListener("click", createMsg, false);
};
