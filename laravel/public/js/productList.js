function onProductOver(name, id) {

    document.getElementById('image' + id).className = 'darkenImage';

}

function onProductOut(name, id) {
    document.getElementById('image' + id).className = 'undarkenImage';
}

function openBasket() {
    if(document.getElementById('basketDiv').className == 'openBasket'){
      closeBasket();
    } else {
      Cookies.set('isBasketOpen','true');
      document.getElementById('productListDiv').className = 'productListWithBasket';
      document.getElementById('basketDiv').className = 'openBasket';
      //document.getElementById('buttonBasket').className = 'buttonCloseShoppingCarClose'
    }
}

function closeBasket() {
    if(document.getElementById('basketDiv').className == 'openBasket'){
      Cookies.set('isBasketOpen','false');
      document.getElementById('productListDiv').className = 'productListWithOutBasket';
      document.getElementById('basketDiv').className = 'closeBasket';
      document.getElementById('buttonBasket').className = 'buttonShoppingCar'
    }
}
