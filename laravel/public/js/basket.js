var productList = new Array();

document.addEventListener('DOMContentLoaded', function () {
    loadBasketProductsLocaly();
}, false);

function updateVisualBasketProduct(product) {
    var productQuantity = document.getElementById('productQuantity' + product.id);
    if (productQuantity != null) {
        productQuantity.setAttribute('value', product.quantity);
        productQuantity.value = product.quantity;
    }
    var productPrice = document.getElementById('productPrice' + product.id);
    if (productPrice != null) {
        productPrice.innerHTML = product.totalPrice;
    }
}
function updateProductBasket(product) {
    for (index = 0; index < productList.length; ++index) {
        if (productList[index].id == product.id) {
            productList[index].quantity = productList[index].quantity + product.quantity;
            productList[index].totalPrice = productList[index].quantity * productList[index].price;
            product.quantity = productList[index].quantity;
            product.totalPrice = productList[index].totalPrice;
            updateVisualBasketProduct(product);
        }
    }
}

function calculateTotalDifferentItems() {
    var total = 0;
    for (index = 0; index < productList.length; ++index) {
        total = total + Number(productList[index].quantity);
    }
    return total;
}

function validateShowTotalItems() {
    var cart = document.getElementById('buttonBasketText');
    if (cart != null) {
        cart.innerHTML = 'Carrito (' + calculateTotalDifferentItems() + ')';
    }
}
function onBasketChange() {
    validateShowTotalItems();
    validateShowTotalPrice();
}
function insertBasketProduct(productToAdd) {
    //TODO set size
    var product = {
        id: productToAdd.id,
        name: productToAdd.name,
        description: productToAdd.description,
        photo: productToAdd.image,
        price: productToAdd.price,
        totalPrice: productToAdd.price,
        quantity: 1,
        size: ''
    };

    if (productToAdd.quantity != null && productToAdd.quantity != '') {
        product.quantity = productToAdd.quantity;
        productToAdd.totalPrice = productToAdd.price * productToAdd.quantity;
    }

    if (productToAdd.totalPrice != null && productToAdd.totalPrice != '') {
        product.totalPrice = productToAdd.totalPrice;
    }

    if (productIsAlreadyOnBasket(product)) {
        updateProductBasket(product);
        openBasket();
        updateCookieProduct(product);
    } else {
        productList.push(product);
        addProductToBasket(product);
        addCookieProduct(product);
    }
    onBasketChange();
}

function hasBasketProducts() {
    var basketProducts = Cookies.get('basketProducts');
    if (basketProducts == null) {
        return false;
    }
    return true;
}

function addCookieProduct(product) {
    Cookies.set('basketProducts', JSON.stringify(productList));
}

function updateCookieProduct(product) {
    Cookies.set('basketProducts', JSON.stringify(productList));
}

function loadBasketProductsLocaly() {
    if (!hasBasketProducts()) {
        productList = new Array();
        return;
    }
    var basketProducts = Cookies.get('basketProducts');

    productList = new Array();
    productList = JSON.parse(basketProducts);

    var isBasketOpen = Cookies.get('isBasketOpen');

    for (index = 0; index < productList.length; ++index) {
        addProductToBasket(productList[index]);
    }

    if (isBasketOpen == 'false') {
        closeBasket();
    }

    onBasketChange();
}

function clearBasket() {
    Cookies.remove('basketProducts');
    var basket = document.getElementById('basketProductList');
    productList = new Array();
    if (basket != null) {
        while (basket.hasChildNodes()) {
            basket.removeChild(basket.lastChild);
        }
    }
    onBasketChange();
}
function addProductToBasketCheckout(product) {
    var pro = JSON.parse(product);
    insertBasketProduct(pro);
}

function validateShowTotalPrice() {
    var totalPrice = document.getElementById('basketTotalPriceDiv');

    if (totalPrice != null) {
        if (hasBasketProducts()) {
            totalPrice.style.display = "inline-block";
            updateTotalCheckoutPrice();
        } else {
            totalPrice.style.display = "none";
        }

    }
}

function onRemoveProduct(product) {
    var productNode = document.getElementById('productBasket' + product.id);
    var basket = document.getElementById('basketProductList');
    if (productNode != null && basket != null) {
        basket.removeChild(productNode);
        var productToRemove = product;
        if (productToRemove != null) {
            var index = productList.indexOf(productToRemove);
            if (index > -1) {
                productList.splice(index, 1);
                updateCookieProduct(product);
                onBasketChange();
            }
        }
    }
}

function addProductToBasket(product) {
    var basket = document.getElementById('basketProductList');
    if (basket != null) {
        var div1 = createDiv('productBasketGeneralDiv', 'productBasket' + product.id);
        var div11 = createDiv('productBasketImageDiv', '');
        var div12 = createDiv('productBasketNameDiv', '');
        var div13 = createDiv('productBasketDeleteDiv', '');
        var img = createImage('', '../uploads/' + product.photo, 100, 100);
        div11.appendChild(img);
        var divName = createDiv("", "");
        divName.innerHTML = product.name;
        div12.appendChild(divName);
        div12.appendChild(createBr());
        var divIncrementer = createDiv('', '');
        var inputMinus = createInput('', 'button', '-');
        inputMinus.onclick = function (e) {
            onDecrementCheckoutBasketProduct(product.id);
        }
        divIncrementer.appendChild(inputMinus);
        var inputQuantity = createInput('productQuantity' + product.id, 'text', product.quantity, 'readonly', '1');
        divIncrementer.appendChild(inputQuantity);
        var inputPlus = createInput('', 'button', '+');
        inputPlus.onclick = function (e) {
            onIncrementCheckoutBasketProduct(product.id);
        };
        divIncrementer.appendChild(inputPlus);
        var divPrice = createDiv('', 'productPrice' + product.id);
        divPrice.innerHTML = product.totalPrice;
        divIncrementer.appendChild(divPrice);
        div12.appendChild(divIncrementer);

        div13.innerHTML = 'x';
        div13.onclick = function (e) {
            onRemoveProduct(product);
        }

        div1.appendChild(div11);
        div1.appendChild(div12);
        div1.appendChild(div13);

        basket.appendChild(div1);
        openBasket();
    }
}

function productIsAlreadyOnBasket(product) {
    for (index = 0; index < productList.length; ++index) {
        if (productList[index].id == product.id) {
            return true;
        }
    }
    return false;
}

function findProductById(id) {
    for (index = 0; index < productList.length; ++index) {
        if (productList[index].id == id) {
            return productList[index];
        }
    }
    return null;
}

function checkoutBasket() {
    window.location = "http://localhost:8000/checkout";
}

function onIncrementCheckoutBasketProduct(productId) {
    changeProductQuantity(1, productId);
    updateTotalCheckoutPrice();
}

function onDecrementCheckoutBasketProduct(productId) {
    changeProductQuantity(-1, productId);
    updateTotalCheckoutPrice();
}

function changeProductQuantity(quantity, productId) {
    var productQuantity = document.getElementById('productQuantity' + productId);
    if (productQuantity != null) {
        var product = findProductById(productId);
        if (product != null) {
            if (product.quantity + quantity < 1) {
                product.quantity = 1;
            } else if (product.quantity + quantity > 12) {
                product.quantity = 12
            } else {
                product.quantity = product.quantity + quantity;
            }
            product.totalPrice = product.price * product.quantity;
            updateCookieProduct(product);

            var productPrice = document.getElementById('productPrice' + productId);
            if (productPrice != null) {
                productPrice.innerHTML = product.totalPrice;
            }
            productQuantity.setAttribute('value', product.quantity);
            productQuantity.value = product.quantity;
        }
    }
    onBasketChange();
}

function updateTotalCheckoutPrice() {
    var totalPriceHtml = document.getElementById('checkoutTotalPayment');
    if (totalPriceHtml != null) {
        var totalPrice = 0;
        for (index = 0; index < productList.length; ++index) {
            totalPrice = Number(productList[index].totalPrice) + Number(totalPrice);
        }
        totalPriceHtml.innerHTML = totalPrice;
    }
}