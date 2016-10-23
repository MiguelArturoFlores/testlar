var product;
function showDetailProduct(productModel) {
    this.product = productModel;
    var dialog = document.getElementById('detailProductDialog');
    dialog.style.display = "block";
    bindProductData(product);
}

function closeDetailProductDialog() {
    var dialog = document.getElementById('detailProductDialog');
    dialog.style.display = "none";
}

window.onclick = function (event) {
    var dialog = document.getElementById('detailProductDialog');
    if (event.target == dialog) {
        dialog.style.display = "none";
    }
}

function bindProductData(product) {
    var name = document.getElementById('detailProductDialogName');
    name.innerHTML = product.name;

    var discount = document.getElementById('detailProductDialogDiscount');
    var discountPercentage = document.getElementById('detailProductDialogDiscountPercentage');
    var priceLabel = "Precio: ";
    if (product.discount > 0) {
        discount.innerHTML = 'Antes: ' + product.price;
        discount.style.display = '';
        priceLabel = "Ahora: ";
        var percentage = Number(product.discount) * 100 / Number(product.price);
        percentage = parseFloat(percentage).toFixed(1);
        discountPercentage.innerHTML = '-' + percentage + '%';
        discountPercentage.style.display = '';
    } else {
        discount.style.display = 'none';
        discountPercentage.style.display = 'none';

    }

    var price = document.getElementById('detailProductDialogPrice');
    price.innerHTML = priceLabel + (Number(product.price) - Number(product.discount)) + ' COP';
    var image = document.getElementById('detailProductDialogProductImage');
    image.src = "../uploads/" + product.image.toString();
    var description = document.getElementById('detailProductDialogProductDescription');
    description.innerHTML = "" + product.description;
    var descriptionSmall = document.getElementById('detailProductDialogProductSmallDescription');
    descriptionSmall.innerHTML = product.small_description;
    var dialogTitle = document.getElementById('productDialogTitleDiv');
    dialogTitle.innerHTML = product.name;
}

function addProductToBasketFromDialog() {
    if (hasSelectedSize()) {
        insertBasketProduct(product);
        closeDetailProductDialog();
    }
}

function hasSelectedSize() {
    for (var i = 1; i <= 3; i++) {
        var size = document.getElementById('productDialogSize' + i);
        if (size != null && size.className.includes('buttonSizeSelected')) {
            return true;
        }
    }
    return false;
}

function unselectSizes() {
    for (var i = 1; i <= 3; i++) {
        var size = document.getElementById('productDialogSize' + i);
        if (size != null) {
            size.className = 'buttonSize ' + 'w3-card-2 w3-hover-shadow w3-center ';
        }
    }
}

function onProductDialogSizeSelected(selectedId) {
    unselectSizes();
    var size = document.getElementById(selectedId);
    size.className = 'buttonSizeSelected ' + 'w3-card-2 w3-hover-shadow w3-center';
}
