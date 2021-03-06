var myString = new MyStrings();

function onProductOver(name, id) {

    document.getElementById('image' + id).className = 'darkenImage';
    document.getElementById('divProductGrid' + id).className = 'divProductGridOptions';

}

function onProductOut(name, id) {
    document.getElementById('image' + id).className = 'undarkenImage';
    document.getElementById('divProductGrid' + id).className = 'invisible';
}

function openBasketButton() {
    if (document.getElementById('basketDiv').className == 'openBasket w3-card-8') {
        closeBasket();
    } else {
        openBasket();
    }
}

function openBasket() {
    if (!hasBasketProducts()) {
        closeBasket();
        return;
    }
    Cookies.set('isBasketOpen', 'true');
    var productListDiv = document.getElementById('productListDiv');
    if (productListDiv != null) {
        productListDiv.className = 'productListWithBasket';
    }
    var basketDiv = document.getElementById('basketDiv');
    if (basketDiv != null) {
        basketDiv.className = 'openBasket w3-card-8';
    }
}

function closeBasket() {
    var basketDiv = document.getElementById('basketDiv');
    if (basketDiv!=null && basketDiv.className == 'openBasket w3-card-8') {
        Cookies.set('isBasketOpen', 'false');
        document.getElementById('productListDiv').className = 'productListWithOutBasket';
        document.getElementById('basketDiv').className = 'closeBasket';
    }
}

function validateDiscountAvailable(product) {
    var productDiscountDiv = document.getElementById('productGridDiscount' + product.id);
    if (productDiscountDiv != null) {
        productDiscountDiv.innerHTML = myString.beforeString + myString.generatePrice(product.price);
    }
    var productPriceDiv = document.getElementById('productGridPrice' + product.id);
    if (productPriceDiv != null) {
        productPriceDiv.innerHTML = myString.nowString + myString.generatePrice((Number(product.price) - Number(product.discount)));
        productPriceDiv.className = "productGridPriceDivExalted"
        var productPriceLabelDiv = document.getElementById('productGridDiscountLabel' + product.id);
        if (productPriceLabelDiv != null) {
            productPriceLabelDiv.className = 'productGridDiscountLabelDiv';
            var discountPercentage = Number(product.discount) * 100 / Number(product.price);
            discountPercentage = parseFloat(discountPercentage).toFixed(1);
            productPriceLabelDiv.innerHTML = myString.generatePercentageDiscount(discountPercentage);
        }
    }
}

function validateNonDiscountAvailable(product) {
    var productDiscountDiv = document.getElementById('productGridDiscount' + product.id);
    if (productDiscountDiv != null) {
        productDiscountDiv.className = 'invisible';
    }
}

function validateProductDiscount(productModel) {
    var product = JSON.parse(productModel);
    if (product.discount > 0) {
        validateDiscountAvailable(product);
    } else {
        validateNonDiscountAvailable(product);
    }
}

function changeProductSize(productId, size) {
    var productSize = document.getElementById('productGridSize' + productId);
    if (productSize != null) {
        productSize.setAttribute('value', size);
        productSize.innerHTML = myString.sizeLabel + size;
    }
    changeProductSizeBasket(productId, size);
}

function detailProductRedirect(product) {
    window.location = "http://localhost:8000/store/detail/" + product.id;
}

function calculateProductListSelectedSize(productId) {

    var productSize = document.getElementById('productGridSize' + productId);
    if (productSize != null) {
        currentSize = productSize.getAttribute('value');
    }

}

function getProductListSize(productId){
    calculateProductListSelectedSize(productId);
    return currentSize;
}