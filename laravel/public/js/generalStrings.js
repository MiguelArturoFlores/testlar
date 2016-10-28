function MyStrings() { // constructor function

    this.beforeString = 'Antes: ';
    this.nowString = 'Ahora: ';
    this.priceString = 'Precio: ';
    this.sizeSmallString = 'Talla S';
    this.sizeMediumString = 'Talla M';
    this.sizeLargeString = 'Talla L';
    this.minusString = '-';
    this.plusString = '+';
    this.messageAddProductsToBasket = 'Agrega productos al carrito';
    this.sizeLabel = 'Talla :';
    this.sizeLabelWithOutDots = 'Talla ';
    this.smallSize = 'S';
    this.mediumSize = 'M';
    this.largeSize = 'L';

    MyStrings.prototype.generatePrice = function generatePrice(priceValue) {
        return '$ ' + Number(priceValue) + ' COP';
    }

    MyStrings.prototype.generatePercentageDiscount = function generatePercentageDiscount(percentage) {
        return '-' + percentage + '%';
    }

    MyStrings.prototype.generateCartString = function generateCartString(itemsCount) {
        return 'Carrito (' + itemsCount + ')';
    }

}



