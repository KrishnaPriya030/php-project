let menu = JSON.parse(localStorage.getItem("menu")) || [];

let container = document.getElementById("menuContainer");

/* DISPLAY MENU */

function displayMenu(){

container.innerHTML = "";

menu.forEach((item,index)=>{

container.innerHTML += `
<div class="menu-card">

<img src="${item.image}">

<h3>${item.name}</h3>
<p>₹${item.price}</p>
<p>Available: ${item.qty}</p>

${item.qty > 0 
? `<button onclick="addToCart(${index})">Add to Cart</button>` 
: `<p style="color:red;">Out of Stock</p>`}

</div>
`;
});
}

/* ADD TO CART */

function addToCart(index){

if(menu[index].qty <= 0){
alert("Out of stock");
return;
}

/* reduce stock */
menu[index].qty--;

/* save updated menu */
localStorage.setItem("menu", JSON.stringify(menu));

/* optional cart */
let cart = JSON.parse(localStorage.getItem("cart")) || [];
cart.push(menu[index]);
localStorage.setItem("cart", JSON.stringify(cart));

displayMenu();
}

/* AUTO UPDATE WHEN PAGE LOADS */
displayMenu();