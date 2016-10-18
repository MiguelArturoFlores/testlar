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
    var image = document.getElementById('detailProductDialogProductImage');
    image.src = "../uploads/" + product.image.toString();
    var description = document.getElementById('detailProductDialogProductDescription');
    description.innerHTML = "" + product.description;
}

function addProductToBasketFromDialog() {
    if (hasSelectedSize()) {
        insertBasketProduct(product);
        closeDetailProductDialog();
    }
}

function hasSelectedSize() {
    var r = document.getElementsByName("sizeChoice");
    for (var i = 0; i < r.length; i++) {
        if (r[i].checked) {
            return true;
        }
    }
    return false;
}

