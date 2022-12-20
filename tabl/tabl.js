let selectElem = document.querySelector("select");
let inputElems = document.querySelectorAll("input");

selectElem.onchange = function() {
  for(let i = 0; i < inputElems.length; i++) {
    inputElems[i].value = "";
  }

  if(selectElem.value === "États-Unis") {
    inputElems[2].parentNode.style.display = "inline";

    inputElems[0].placeholder = "Code régional";
    inputElems[0].pattern = "[0-9]{3}";

    inputElems[1].placeholder = "Première partie";
    inputElems[1].pattern = "[0-9]{3}";
    inputElems[1].setAttribute("aria-label","Première partie du numéro");

    inputElems[2].placeholder = "Seconde partie";
    inputElems[2].pattern = "[0-9]{4}";
    inputElems[2].setAttribute("aria-label","Seconde partie du numéro");
  } else if(selectElem.value === "Royaume-Uni") {
    inputElems[2].parentNode.style.display = "none";

    inputElems[0].placeholder = "Code régional";
    inputElems[0].pattern = "[0-9]{3,6}";

    inputElems[1].placeholder = "Numéro local";
    inputElems[1].pattern = "[0-9]{4,8}";
    inputElems[1].setAttribute("aria-label","Numéro local");
  } else if(selectElem.value === "Allemagne") {
    inputElems[2].parentNode.style.display = "inline";

    inputElems[0].placeholder = "Code régional";
    inputElems[0].pattern = "[0-9]{3,5}";

    inputElems[1].placeholder = "Première partie";
    inputElems[1].pattern = "[0-9]{2,4}";
    inputElems[1].setAttribute("aria-label","Première partie du numéro");

    inputElems[2].placeholder = "Seconde partie";
    inputElems[2].pattern = "[0-9]{4}";
    inputElems[2].setAttribute("aria-label","Seconde partie du numéro");
  }
}
