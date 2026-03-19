let menu = JSON.parse(localStorage.getItem("menu")) || [];

const preview = document.getElementById("preview");
const imageInput = document.getElementById("image");

/* IMAGE PREVIEW */
imageInput.onchange = function(){
let file = this.files[0];
if(file){
let reader = new FileReader();
reader.onload = e => {
preview.src = e.target.result;
preview.style.display = "block";
};
reader.readAsDataURL(file);
}
};

/* DISPLAY MENU */

function displayMenu(){
let container = document.getElementById("menuList");
container.innerHTML = "";

menu.forEach((item,index)=>{

container.innerHTML += `
<div class="menu-card">

<img src="${item.image}">

<h3>${item.name}</h3>
<p>₹${item.price}</p>
<p>Qty: ${item.qty}</p>

<button class="update" onclick="updateItem(${index})">Update</button>
<button class="delete" onclick="deleteItem(${index})">Delete</button>

</div>
`;
});
}

/* ADD ITEM */

function addItem(){

let name = document.getElementById("name").value;
let price = document.getElementById("price").value;
let qty = document.getElementById("qty").value;
let file = imageInput.files[0];

if(!file){
alert("Upload image");
return;
}

let reader = new FileReader();

reader.onload = function(e){

menu.push({
name:name,
price:price,
qty:qty,
image:e.target.result
});

localStorage.setItem("menu",JSON.stringify(menu));
displayMenu();

};

reader.readAsDataURL(file);
}

/* DELETE */

function deleteItem(index){
menu.splice(index,1);
localStorage.setItem("menu",JSON.stringify(menu));
displayMenu();
}

/* UPDATE */

function updateItem(index){
let name = prompt("Name",menu[index].name);
let price = prompt("Price",menu[index].price);
let qty = prompt("Qty",menu[index].qty);

menu[index].name = name;
menu[index].price = price;
menu[index].qty = qty;

localStorage.setItem("menu",JSON.stringify(menu));
displayMenu();
}

displayMenu();