const minusBtn = document.querySelectorAll(".minus-btn");
const addBtn = document.querySelectorAll(".add-btn");
const quantityInput = document.querySelectorAll(".quantityInput");

minusBtn.forEach(element => {
    element.addEventListener("click", (e) => {
        console.log(e);
        if(e.target.nextElementSibling.value==1) {
            modal.style.display = "block";
            const item = e.target.parentElement.parentElement.childNodes[1][0]; // CHECKBOX ITEM
            console.log(item.dataset);

            document.getElementById("itemNameRemove").value = item.dataset.name;
            document.getElementById("itemQuantityRemove").value = item.dataset.quantity;
            document.getElementById("itemPriceRemove").value = item.dataset.price;
        } else {
            e.target.nextElementSibling.value-=1;
            
            e.target.parentElement.parentElement.childNodes[1][0].dataset.quantity = e.target.nextElementSibling.value
            e.target.parentElement.parentElement.childNodes[1][0].dataset.price = 1000 * e.target.nextElementSibling.value;
            e.target.parentElement.previousElementSibling.textContent = e.target.parentElement.parentElement.childNodes[1][0].dataset.price;
        }
    });
});

addBtn.forEach(element => {
    element.addEventListener("click", (e) => {

        console.log(e.target.previousElementSibling)

        e.target.previousElementSibling.value = parseInt(e.target.previousElementSibling.value) + 1;
        e.target.parentElement.parentElement.childNodes[1][0].dataset.quantity = e.target.previousElementSibling.value
        e.target.parentElement.parentElement.childNodes[1][0].dataset.price = 1000 * e.target.previousElementSibling.value;
        e.target.parentElement.previousElementSibling.textContent = e.target.parentElement.parentElement.childNodes[1][0].dataset.price;
    });
});

const checkoutBtn = document.getElementById("checkoutBtn");

const InputName = document.querySelectorAll("input[name='orderName[]']");
if(InputName.length == 0) {
    checkoutBtn.disabled = true;
    checkoutBtn.className = "btn btn-action btn-disabled";
}

const checkItems = document.querySelectorAll(".checkItems");
checkItems.forEach(element => {
    element.addEventListener("change", (e) => {
        const amount = document.getElementById("amount");
        const totalAmount = document.getElementById("totalForm");
        const orderSum = document.getElementById("orderSum");
        const checkoutForm = document.getElementById("checkoutForm");

        if(e.target.checked) {
            // ADD AMOUNT TO CART
            amount.textContent = amount.textContent == "" ? 0 + parseFloat(e.target.dataset.price) : parseFloat(amount.textContent) + parseFloat(e.target.dataset.price);
            totalAmount.value = totalAmount.value == "" ? 0 + parseFloat(e.target.dataset.price) : parseFloat(totalAmount.value) + parseFloat(e.target.dataset.price)

            // ADD ITEM TO ORDER SUMMARY
            if(orderSum.innerHTML == "") {
                orderSum.innerHTML = "<ul id='orderSumList'><li data-name='"+e.target.dataset.name+"'>"+e.target.dataset.quantity+" "+e.target.dataset.name+"</li></ul>";
                
                const orderQuantity = document.createElement("input");
                orderQuantity.setAttribute("type", "hidden");
                orderQuantity.setAttribute("name", "orderQuantity[]");
                orderQuantity.dataset.name = e.target.dataset.name;
                orderQuantity.setAttribute("value", e.target.dataset.quantity);
                
                const orderName = document.createElement("input");
                orderName.setAttribute("type", "hidden");
                orderName.setAttribute("name", "orderName[]");
                orderName.dataset.name = e.target.dataset.name;
                orderName.setAttribute("value", e.target.dataset.name);

                checkoutForm.appendChild(orderQuantity);
                checkoutForm.appendChild(orderName);
            } else {
                const orderList = document.getElementById("orderSumList");
                const li = document.createElement("li");
                li.dataset.name = e.target.dataset.name;
                li.textContent = e.target.dataset.quantity+" "+e.target.dataset.name;
                orderList.appendChild(li);

                const orderQuantity = document.createElement("input");
                orderQuantity.setAttribute("type", "hidden");
                orderQuantity.setAttribute("name", "orderQuantity[]");
                orderQuantity.dataset.name = e.target.dataset.name;
                orderQuantity.setAttribute("value", e.target.dataset.quantity);
                
                const orderName = document.createElement("input");
                orderName.setAttribute("type", "hidden");
                orderName.setAttribute("name", "orderName[]");
                orderName.dataset.name = e.target.dataset.name;
                orderName.setAttribute("value", e.target.dataset.name);

                checkoutForm.appendChild(orderQuantity);
                checkoutForm.appendChild(orderName);
            }

            if(checkoutBtn.disabled) {
                checkoutBtn.disabled = false;
                checkoutBtn.className = "btn btn-action";
            }

        } else if(!e.target.checked) {
            // REMOVE AMOUNT TO CART
            amount.textContent = amount.textContent == "" ? 0 - parseFloat(e.target.dataset.price) : parseFloat(amount.textContent) - parseFloat(e.target.dataset.price);
            totalAmount.value = totalAmount.value == "" ? 0 - parseFloat(e.target.dataset.price) : parseFloat(totalAmount.value) - parseFloat(e.target.dataset.price)

            // REMOVE ITEM TO ORDER SUMMARY
            if(!orderSum.innerHTML == "") {
                const orderList = document.getElementById("orderSumList");
                const childs = orderList.childNodes;

                const checkoutForm = document.getElementById("checkoutForm");
                const InputName = document.querySelectorAll("input[name='orderName[]']");
                const InputQuantity = document.querySelectorAll("input[name='orderQuantity[]']");
                console.log(InputName);

                for(var i=0; i<childs.length; i++) {
                    if(childs[i].dataset.name == e.target.dataset.name) {
                        orderList.removeChild(childs[i]);
                        checkoutForm.removeChild(InputName[i]);
                        checkoutForm.removeChild(InputQuantity[i]);
                    } else {
                        continue;
                    }
                }

                const newInputName = document.querySelectorAll("input[name='orderName[]']");
                if(newInputName.length == 0) {
                    checkoutBtn.disabled = true;
                    checkoutBtn.className = "btn btn-action btn-disabled";
                }
            }

        }
    });
});