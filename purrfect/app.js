// function for navigation menu 
const toggleMenu = () => {
    const menuToggle = document.querySelector('.toggle');
    const navigation = document.querySelector('.navigation');
    menuToggle.classList.toggle('active');
    navigation.classList.toggle('active');
};

// for menu toggle button 
const menuToggle = document.querySelector('.toggle');
menuToggle.addEventListener('click', toggleMenu); 

// for products page
function toggleCart() {
    const cartElement = document.getElementById('cart');
    cartElement.style.display = (cartElement.style.display === 'flex') ? 'none' : 'flex';
}

const cart = {};
// function addToCart(item, category, price) {
//     if (!cart[category]) {
//         cart[category] = [];
//     }
//     cart[category].push({ item, price });
//     updateCartDisplay();
//     updateTotal();
// }
function addToCart(item, category, price) {
    if (!cart[category]) {
        cart[category] = [];
    }
    cart[category].push({ item, price });
    updateCartDisplay();
    updateTotal();

    // Send AJAX request to PHP backend to add item to cart
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'cartactions.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Update cart display after successful addition
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    cart[category].push({ item, price });
                    updateCartDisplay();
                    updateTotal();
                } else {
                    console.error('Failed to add item to cart');
                }
            } else {
                console.error('Failed to send request');
            }
        }
    };
    xhr.send(`product_id=${item}&quantity=1`); // Adjust data as per your requirements
}

function updateCartDisplay() {
    const cartElement = document.getElementById('cart');
    const cartContentElement = document.getElementById('cart-content');

    cartContentElement.innerHTML = '';

    for (const category in cart) {
        if (cart.hasOwnProperty(category)) {
            const categoryItems = cart[category];

            // Check if the category has items
            if (categoryItems.length > 0) {
                const categoryHeading = document.createElement('h3');
                categoryHeading.textContent = `${category} Items`;
                cartContentElement.appendChild(categoryHeading);

                const itemList = document.createElement('ul');
                categoryItems.forEach((item, index) => {
                    const listItem = document.createElement('li');
                    const priceText = typeof item.price === 'number' ? `$${item.price.toFixed(2)}` : 'Invalid Price';
                    listItem.textContent = `${item.item} - ${priceText}`;

                    const removeButton = document.createElement('button'); 
                    
                    removeButton.textContent = '\u00d7';
                    removeButton.addEventListener('click', () => removeFromCart(category, index));

                    listItem.appendChild(removeButton);
                    listItem.style.listStyle = 'none';
                    itemList.appendChild(listItem);
                });
                cartContentElement.appendChild(itemList);
            }
        }
    }
}

// function removeFromCart(category, index) {
//     if (cart[category] && cart[category].length > index) {
//         cart[category].splice(index, 1);
//         updateCartDisplay();
//         updateTotal();
//     }
// }

function removeFromCart(category, index) {
    if (cart[category] && cart[category].length > index) {
        cart[category].splice(index, 1);
        updateCartDisplay();
        updateTotal();
    }

    if (cart[category] && cart[category].length > index) {
        const cart_item_id = cart[category][index].id; // Assuming each item in the cart has an 'id' property
        // Send AJAX request to delete item from cart
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'cartActions.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        cart[category].splice(index, 1);
                        updateCartDisplay();
                        updateTotal();
                    } else {
                        console.error('Failed to remove item from cart');
                    }
                } else {
                    console.error('Failed to send request');
                }
            }
        };
        xhr.send(`action=delete&cart_item_id=${cart_item_id}`);
    }
}

function updateQuantity(category, index, newQuantity) {
    if (cart[category] && cart[category].length > index) {
        const cart_item_id = cart[category][index].id; // Assuming each item in the cart has an 'id' property
        // Send AJAX request to update item quantity in cart
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'cartActions.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        cart[category][index].quantity = newQuantity;
                        updateCartDisplay();
                        updateTotal();
                    } else {
                        console.error('Failed to update item quantity in cart');
                    }
                } else {
                    console.error('Failed to send request');
                }
            }
        };
        xhr.send(`action=update_quantity&cart_item_id=${cart_item_id}&new_quantity=${newQuantity}`);
    }
}

function updateTotal() {
    const totalElement = document.getElementById('total');
    let overallTotal = 0;
    for (const category in cart) {
        if (cart.hasOwnProperty(category)) {
            overallTotal += cart[category].reduce((sum, item) => sum + item.price, 0);
        }
    }

    totalElement.innerHTML = `<p>Total: $${overallTotal.toFixed(2)}</p>`;
}

function logoutAlert() {
    result = window.confirm("Are you sure you want to log out?");
    if (result){
        window.location.href = "logout.php";
    } else {
        //nothing will happen
    }
}

function ExitPostAlert() {
    result = window.confirm("Are you sure you want to exit? Changes will not be saved.");
    if (result){
        window.location.href = "products.php";
    } else {
        //nothing will happen
    }
}

