var myString = new MyStrings();
var productList = new Array();

var currentSize = myString.sizeMediumString;

var totalPrice = 0;
var subTotal = 0;
var discount = 0;

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
        productPrice.innerHTML = myString.generatePrice(product.totalPrice);
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
        cart.innerHTML = myString.generateCartString(calculateTotalDifferentItems());
        cart.innerHTML = cart.innerHTML + '<br/>' + myString.generatePrice(totalPrice);
    }
}

function onBasketChange() {
    updateTotalCheckoutPrice();
    validateShowTotalItems();
    openBasket();
}

function insertBasketProduct(productToAdd) {
    var product = {
        id: productToAdd.id,
        name: productToAdd.name,
        description: productToAdd.description,
        photo: productToAdd.image,
        price: productToAdd.price,
        totalPrice: productToAdd.price,
        discount: productToAdd.discount,
        small_description: productToAdd.small_description,
        quantity: 1,
        size: currentSize //This size is calculated on productList
    };

    product.totalPrice = (Number(product.price) - Number(product.discount)) * Number(product.quantity);

    if (productToAdd.size != null && productToAdd.size != '') {
        product.size = productToAdd.size;

    }

    if (productIsAlreadyOnBasket(product)) {
        updateProductBasket(product);
        openBasket();
        updateCookieProduct();
    } else {
        productList.push(product);
        addProductToBasketVisual(product);
        addCookieProduct(product);
    }
    onBasketChange();
}

function hasBasketProductsInitially() {
    var basketProducts = Cookies.get('basketProducts');
    if (basketProducts == null) {
        return false;
    }
    return true;
}

function hasBasketProducts() {
    var basketProducts = Cookies.get('basketProducts');
    if (basketProducts == null || productList.length <= 0) {
        return false;
    }
    return true;
}

function addCookieProduct(product) {
    Cookies.set('basketProducts', JSON.stringify(productList));
}

function updateCookieProduct() {
    Cookies.set('basketProducts', JSON.stringify(productList));
}

function loadBasketProductsLocaly() {

    if (!hasBasketProductsInitially()) {
        productList = new Array();
        return;
    }
    var basketProducts = Cookies.get('basketProducts');

    productList = new Array();
    productList = JSON.parse(basketProducts);

    var isBasketOpen = Cookies.get('isBasketOpen');

    for (index = 0; index < productList.length; ++index) {
        addProductToBasketVisual(productList[index]);
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
                updateCookieProduct();
                onBasketChange();
            }
        }
    }
}

function updateProductSizeOnList(productId, sizeId) {
    for (var index = 0; index < productList.length; ++index) {
        if (productList[index].id == productId) {
            productList[index].size = sizeId;
            updateCookieProduct();
            break;
        }
    }
}

function changeProductSizeBasket(productId, sizeId) {
    var size = document.getElementById('productGridSize' + productId);
    if (size != null) {
        size.setAttribute('value', sizeId);
        size.innerHTML = myString.sizeLabelWithOutDots + sizeId;
        updateProductSizeOnList(productId, sizeId);
    }
}

function addProductToBasketVisualAux(product) {

    var basket = document.getElementById('basketProductList');
    if (basket != null) {
        var genericProductToClone = document.getElementById('productBasket');
        var genericProduct = genericProductToClone.cloneNode(true);

        genericProduct.style.display = '';
        genericProduct.id = 'productBasket' + product.id;

        var img = getChild(genericProduct, 'IMG', '');
        img.id = 'productImage' + product.id;
        img.src = '../uploads/' + product.photo;

        var productName = getChild(genericProduct, 'DIV', 'productMainPageName');
        productName.id = 'productMainPageName' + product.id;
        productName.innerHTML = product.name;

        var productDescription = getChild(genericProduct, 'DIV', 'productMainPageDescription');
        productDescription.id = 'productMainPageDescription' + product.id;
        productDescription.innerHTML = product.small_description;

        var dropdown = getChild(genericProduct, 'DIV', 'dropdownContent');
        var item1 = createA();
        item1.innerHTML = myString.sizeSmallString;
        item1.onclick = function (e) {
            changeProductSizeBasket(product.id, myString.smallSize);
        }
        dropdown.appendChild(item1);

        var item2 = createA();
        item2.innerHTML = myString.sizeMediumString;
        item2.onclick = function (e) {
            changeProductSizeBasket(product.id, myString.mediumSize);
        }
        dropdown.appendChild(item2);

        var item3 = createA();
        item3.innerHTML = myString.sizeLargeString;
        ;
        item3.onclick = function (e) {
            changeProductSizeBasket(product.id, myString.largeSize);
        }
        dropdown.appendChild(item3);

        var deleteDiv = getChild(genericProduct, 'DIV', 'productBasketDeleteDiv');
        deleteDiv.id = 'productBasketDeleteDiv' + product.id;
        deleteDiv.onclick = function (e) {
            onRemoveProduct(product);
        }

        var quantity = getChild(genericProduct, 'INPUT', 'productQuantity');
        quantity.id = 'productQuantity' + product.id;
        quantity.value = product.quantity;

        var quantityIncrementer = getChild(genericProduct, 'INPUT', 'productIncrementerPlus');
        quantityIncrementer.id = 'productIncrementerPlus' + product.id;
        quantityIncrementer.onclick = function (e) {
            onIncrementCheckoutBasketProduct(product.id);
        }

        var quantityDecrementer = getChild(genericProduct, 'INPUT', 'productIncrementerMinus');
        quantityDecrementer.id = 'productIncrementerMinus' + product.id;
        quantityDecrementer.onclick = function (e) {
            onDecrementCheckoutBasketProduct(product.id);
        }

        var size = getChild(genericProduct, 'BUTTON', 'productGridSize');
        size.id = 'productGridSize' + product.id;
        size.setAttribute('value', product.size);
        size.innerHTML = myString.sizeLabelWithOutDots + product.size;

        basket.appendChild(genericProduct);
    }
}

function addProductToBasketVisual(product) {
    if (true) {
        addProductToBasketVisualAux(product);
        return;
    }
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
        var inputMinus = createInput('', 'button', myString.minusString);
        inputMinus.onclick = function (e) {
            onDecrementCheckoutBasketProduct(product.id);
        }
        divIncrementer.appendChild(inputMinus);
        var inputQuantity = createInput('productQuantity' + product.id, 'text', product.quantity, 'readonly', '1');
        divIncrementer.appendChild(inputQuantity);
        var inputPlus = createInput('', 'button', myString.plusString);
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
    if (hasBasketProducts()) {
        window.location = "http://localhost:8000/checkout";
    } else {
        alert(myString.messageAddProductsToBasket);
    }
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
            product.totalPrice = (Number(product.price) - Number(product.discount)) * product.quantity;
            updateCookieProduct();

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

function updateProductSizes() {
    for (var index = 0; index < productList.length; ++index) {
        var size = document.getElementById('productGridSize' + productList[index].id);
        if (size != null) {
            size.setAttribute('value' , productList[index].size);
            size.innerHTML = myString.sizeLabelWithOutDots + productList[index].size;
        }
    }
}

function updateTotalCheckoutPrice() {
    var totalPriceHtml = document.getElementById('checkoutTotalPayment');
    var subTotalPriceHtml = document.getElementById('checkoutSubtotalPayment');
    var discountPriceHtml = document.getElementById('checkoutDiscountPayment');

    totalPrice = 0;
    subTotal = 0;
    discount = 0;

    for (index = 0; index < productList.length; ++index) {
        totalPrice = Number(productList[index].totalPrice) + Number(totalPrice);
        subTotal = Number(productList[index].price) * Number(productList[index].quantity) + Number(subTotal);
    }

    if (totalPriceHtml != null) {
        totalPriceHtml.innerHTML = myString.generatePrice(totalPrice);
    }
    if (subTotalPriceHtml != null) {
        subTotalPriceHtml.innerHTML = myString.generatePrice(subTotal);
    }
    discount = Number(subTotal) - Number(totalPrice);

    if (discountPriceHtml != null) {
        discountPriceHtml.innerHTML = myString.generatePrice(discount);
    }
}

function handleClickBasket(event) {
    //TODO here I can validate when user click outside the basket
    // but also I need to check when click on buttons that also opens basket
}
