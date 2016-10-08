function onProductOver(name, id) {

    document.getElementById('image' + id).className = 'darkenImage';
    document.getElementById('divProductGrid' + id).className = 'divProductGridOptions';

}

function onProductOut(name, id) {
    document.getElementById('image' + id).className = 'undarkenImage';
    document.getElementById('divProductGrid' + id).className = 'invisible';
}

function showDetailProduct(product) {
    alert(product.id);
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
    document.getElementById('productListDiv').className = 'productListWithBasket';
    document.getElementById('basketDiv').className = 'openBasket';
    //document.getElementById('buttonBasket').className = 'buttonCloseShoppingCarClose'ó
}

function closeBasket() {
    if (document.getElementById('basketDiv').className == 'openBasket') {
        Cookies.set('isBasketOpen', 'false');
        document.getElementById('productListDiv').className = 'productListWithOutBasket';
        document.getElementById('basketDiv').className = 'closeBasket';
        document.getElementById('buttonBasket').className = 'buttonShoppingCar'
    }
}
