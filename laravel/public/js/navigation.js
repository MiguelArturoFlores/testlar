var productUrl = 'store/product/';
var mainStoreUrl = '../../store/';

var checkoutUrlFromPromotion = '../../../checkout';

function validateCloseBasketUrlNavigation() {
    var url = window.location.href;
    if (containsSubstring(url, productUrl)) {
        window.location.href = mainStoreUrl;
    }
}

function navigateToCheckout() {
    window.location.href = checkoutUrlFromPromotion;
}


