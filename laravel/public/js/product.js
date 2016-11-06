function addProductToBasketFromDetail(product) {
    if (hasSelectedSize()) {
        addProductToBasketCheckout(product);
    }
}

function addProductToBasketFromPromotionDetail(product) {
    if (hasSelectedSize()) {
        addProductToBasketCheckout(product);
        navigateToCheckout();
    }
}
