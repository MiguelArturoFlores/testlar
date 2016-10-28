var myString = new MyStrings();
var product;

function showDetailProduct(productModel, productSize) {
    this.product = productModel;
    var dialog = document.getElementById('detailProductDialog');
    dialog.style.display = "block";
    this.product.size = productSize;
    bindProductData(product);
}

function closeDetailProductDialog() {
    var dialog = document.getElementById('detailProductDialog');
    dialog.style.display = "none";
}

function handleClickDialog(event) {
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
    var priceLabel = myString.priceString;
    if (product.discount > 0) {
        discount.innerHTML = myString.beforeString + myString.generatePrice(product.price);
        discount.style.display = '';
        priceLabel = myString.nowString;
        var percentage = Number(product.discount) * 100 / Number(product.price);
        percentage = parseFloat(percentage).toFixed(1);
        discountPercentage.innerHTML = myString.generatePercentageDiscount(percentage);
        discountPercentage.style.display = '';
    } else {
        discount.style.display = 'none';
        discountPercentage.style.display = 'none';

    }

    var price = document.getElementById('detailProductDialogPrice');
    price.innerHTML = priceLabel + myString.generatePrice((Number(product.price) - Number(product.discount)));
    var image = document.getElementById('detailProductDialogProductImage');
    image.src = "../uploads/" + product.image.toString();
    var description = document.getElementById('detailProductDialogProductDescription');
    description.innerHTML = "" + product.description;
    var descriptionSmall = document.getElementById('detailProductDialogProductSmallDescription');
    descriptionSmall.innerHTML = product.small_description;
    var dialogTitle = document.getElementById('productDialogTitleDiv');
    dialogTitle.innerHTML = product.name;

    onProductDialogSizeSelected(product.size);
    var dialogSize = document.getElementById('productDialogTitleDiv');
    dialogTitle.innerHTML = product.name;

}

function addProductToBasketFromDialog() {
    if (hasSelectedSize()) {
        alert(currentSize);
        insertBasketProduct(product);
        closeDetailProductDialog();
    }
}

function hasSelectedSize() {
    if (hasSelectedSingleSize('S') || hasSelectedSingleSize('M') || hasSelectedSingleSize('L')) {
        return true;
    }
    return false;
}

function hasSelectedSingleSize(sizeId) {
    var size = document.getElementById('productDialogSize' + sizeId);
    if (size != null && size.className.includes('buttonSizeSelected')) {
        return true;
    }
    return false;
}

function unselectSizes() {
    unselectSingleSize('S');
    unselectSingleSize('M');
    unselectSingleSize('L');
}

function unselectSingleSize(sizeId) {
    var size = document.getElementById('productDialogSize' + sizeId);
    if (size != null) {
        size.className = 'buttonSize ' + 'w3-card-2 w3-hover-shadow w3-center ';
    }
}

function onProductDialogSizeSelected(selectedId) {
    unselectSizes();
    var size = document.getElementById('productDialogSize' + selectedId);
    size.className = 'buttonSizeSelected ' + 'w3-card-2 w3-hover-shadow w3-center';
    currentSize = selectedId;
}
