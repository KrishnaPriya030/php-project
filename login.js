document.getElementById("loginForm").addEventListener("submit", function(e){

e.preventDefault();

let username = document.getElementById("username").value;
let password = document.getElementById("password").value;

let adminUser = "admin";
let adminPass = "1234";

if(username === adminUser && password === adminPass){

window.location.href = "admin.html";

}else{

document.getElementById("error").textContent = "Invalid username or password";

}

});