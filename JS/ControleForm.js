function createMsg(){
    var inp = document.querySelector("input[name=id]");
    var msg = document.querySelector("#f_id div");
    if (!inp.checkValidity()){
        if (inp.validity.patternMismatch){
            msg.innerHTML = "Seul les caractères numériques sont acceptés.";
        }else{
            msg.innerHTML = inp.validationMessage;
        }
    }else{
        msg.innerHTML = ""
    }
};

window.onload = function(){
    var btnValid = document.querySelector("#BtnRight");
    btnValid.addEventListener("click", createMsg, false);
};
