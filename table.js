let form = document.getElementById("reserveForm");

form.addEventListener("submit", function(e){

e.preventDefault();

let name = document.getElementById("name").value;
let persons = document.getElementById("persons").value;

document.getElementById("message").textContent =
"Table reserved for " + name + " (" + persons + " persons).";

form.reset();

});