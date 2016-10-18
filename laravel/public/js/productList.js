function onProductOver(name, id) {

    document.getElementById('image' + id).className = 'darkenImage';
    document.getElementById('divProductGrid' + id).className = 'divProductGridOptions';

}

function onProductOut(name, id) {
    document.getElementById('image' + id).className = 'undarkenImage';
    document.getElementById('divProductGrid' + id).className = 'invisible';
}

function openBasketButton() {
    if (document.getElementById('basketDiv').className == 'openBasket') {
        closeBasket();
    } else {
        openBasket();
    }
}

function openBasket() {
    Cookies.set('isBasketOpen', 'true');
    var productListDiv = document.getElementById('productListDiv');
    if (productListDiv != null) {
        productListDiv.className = 'productListWithBasket';
    }
    var basketDiv = document.getElementById('basketDiv');
    if (basketDiv != null) {
        basketDiv.className = 'openBasket';
    }
}

function closeBasket() {
    if (document.getElementById('basketDiv').className == 'openBasket') {
        Cookies.set('isBasketOpen', 'false');
        document.getElementById('productListDiv').className = 'productListWithOutBasket';
        document.getElementById('basketDiv').className = 'closeBasket';
        document.getElementById('buttonBasket').className = 'buttonShoppingCar'
    }
}

function detailProductRedirect(product) {
    window.location = "http://localhost:8000/store/detail/" + product.id;
}