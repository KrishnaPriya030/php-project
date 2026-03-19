function filterOrders(status){

let orders = document.querySelectorAll(".order-box");

orders.forEach(order => {

if(status === "all"){
order.style.display = "block";
}
else if(order.classList.contains(status)){
order.style.display = "block";
}
else{
order.style.display = "none";
}

});

}