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
function addToCart(item, category, price) {
    if (!cart[category]) {
        cart[category] = [];
    }
    cart[category].push({ item, price });
    updateCartDisplay();
    updateTotal();
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

function removeFromCart(category, index) {
    if (cart[category] && cart[category].length > index) {
        cart[category].splice(index, 1);
        updateCartDisplay();
        updateTotal();
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
function PostAlert() {
    
}

function ExitPostAlert() {
    result = window.confirm("Are you sure you want to exit? Changes will not be saved.");
    if (result){
        window.location.href = "products.php";
    } else {
        //nothing will happen
    }
}

