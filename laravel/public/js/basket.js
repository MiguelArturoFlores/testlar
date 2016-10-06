var productList = new Array();

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
    } else {
      addProductToBasket(product);
    }
}

function addProductToBasket(product){

    productList.splice(productList.length, 0, product);

    var basket = document.getElementById('basketProductList');

    var basketProductDiv = document.createElement('div');
    basketProductDiv.id = product.id;
    //TODO must insert and then change the values
    basketProductDiv.innerHTML = '<img width="100" height="100" src="' + product.photo + '">' +
        '<div id="productQuantity' + product.id + '"> ' + product.quantity + '</div>';

    basket.appendChild(basketProductDiv);
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
