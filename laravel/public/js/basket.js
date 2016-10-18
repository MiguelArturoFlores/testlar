var productList = new Array();

document.addEventListener('DOMContentLoaded', function () {
    loadBasketProductsLocaly();
}, false);

function insertBasketProduct(productToAdd) {

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
        document.getElementById('productQuantity' + product.id).innerHTML = product.quantity;
        openBasket();
        updateCookieProduct(product);
    } else {
        productList.push(product);
        addProductToBasket(product);
        addCookieProduct(product);
    }
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
}
function addProductToBasketCheckout(product) {
    var pro = JSON.parse(product);
    insertBasketProduct(pro);
}

function addProductToBasketAux2(product) {
    var basket = document.getElementById('basketProductList');
    if (basket != null) {
        var basketProductDiv = document.createElement('div');
        basketProductDiv.id = product.id;
        //TODO must insert and then change the values
        basketProductDiv.innerHTML = '<img width="100" height="100" src="../uploads/' + product.photo.toString() + '">' +
            '<div id="productQuantity' + product.id.toString() + '"> ' + product.quantity.toString() + '</div>';
        basket.appendChild(basketProductDiv);
        openBasket();
    }
}

function addProductToBasket(product) {
    var basket = document.getElementById('basketProductList');
    if (basket != null) {
        var div1 = createDiv('productBasketGeneralDiv', '');
        var div11 = createDiv('productBasketImageDiv', '');
        var div12 = createDiv('productBasketNameDiv', '');
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
        div1.appendChild(div11);
        div1.appendChild(div12);


        basket.appendChild(div1);
        openBasket();
    }
}

function productIsAlreadyOnBasket(product) {
    for (index = 0; index < productList.length; ++index) {
        if (productList[index].id == product.id) {
            productList[index].quantity = productList[index].quantity + product.quantity;
            product.quantity = productList[index].quantity;
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
    updateTotalCheckoutPrice()
}

function onDecrementCheckoutBasketProduct(productId) {
    changeProductQuantity(-1, productId);
    updateTotalCheckoutPrice()
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
}

function updateTotalCheckoutPrice() {

    var totalPriceHtml = document.getElementById('checkoutTotalPayment');
    if (totalPriceHtml != null) {
        var totalPrice = 0;
        for (index = 0; index < productList.length; ++index) {
            totalPrice = Number(productList[index].totalPrice) + Number(totalPrice);
        }
        alert(totalPrice);
        totalPriceHtml.innerHTML = totalPrice;
    }

}