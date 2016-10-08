var productList = new Array();

document.addEventListener('DOMContentLoaded', function () {
    loadBasketProductsLocaly();
}, false);

function insertBasketProduct(id, name, description, photo) {

    var product = {
        id: id,
        name: name,
        description: description,
        photo: photo,
        quantity: 1
    };

    if (productIsAlreadyOnBasket(product)) {
        document.getElementById('productQuantity' + id).innerHTML = product.quantity.toString();
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

    for (index = 0; index < productList.length; ++index) {
        addProductToBasket(productList[index]);
    }

}

function clearBasket() {
    Cookies.remove('basketProducts');
    var basket = document.getElementById('basketProductList');
    productList = new Array();
    while (basket.hasChildNodes()) {
        basket.removeChild(basket.lastChild);
    }
}

function addProductToBasket(product) {
    var basket = document.getElementById('basketProductList');
    var basketProductDiv = document.createElement('div');
    basketProductDiv.id = product.id;
    //TODO must insert and then change the values
    basketProductDiv.innerHTML = '<img width="100" height="100" src="' + product.photo.toString() + '">' +
        '<div id="productQuantity' + product.id.toString() + '"> ' + product.quantity.toString() + '</div>';
    basket.appendChild(basketProductDiv);
    openBasket();
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

function checkoutBasket(){
    window.location = "http://localhost:8000/checkout";
}