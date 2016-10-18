function createDiv(className, idDiv) {
    var div = document.createElement('div');
    div.id = idDiv;
    div.className = className;
    return div;
}

function createImage(id, src, width, height) {
    var img = document.createElement('img');
    img.id = id;
    img.width = width;
    img.height = height;
    img.src = src;
    return img;
}

function createBr() {
    var br = document.createElement('br');
    return br;
}

function createInput(id, type, value, readonly, size) {
    var input = document.createElement('input');
    input.id = id;
    input.type = type;
    input.value = value;
    if (readonly != null && readonly != '') {
        input.readOnly = readonly;
    }
    if (size != null && size != '') {
        input.size = size;
    }
    return input;
}