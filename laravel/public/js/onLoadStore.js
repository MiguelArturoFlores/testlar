document.addEventListener('DOMContentLoaded', function() {
    validateOpenBasket();
}, false);

function validateOpenBasket(){
    var isBasketOpen = Cookies.get('isBasketOpen');
    if(isBasketOpen == 'true'){
        openBasket();
    }
}
