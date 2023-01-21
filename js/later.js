$('document').ready(function () {
    // loadGoods();
    init();
});

function init() {
    $.getJSON('goods.json', loadGoods);
}

function loadGoods(data) {
    // $.getJSON('goods.json', function (data) {
    var out = '';
    var later = {}
    if (localStorage.getItem('later') != null) {
        later = JSON.parse(localStorage.getItem('later'))
        for (let key in later) {
            out += '<div class="product-item">';
            out += '<img src="' + data[key].image + '" alt="d">';
            out += '<div class="product-list">';
            out += '<h3>' + data[key]['name'] + '</h3>';
            out += '<span class="price">' + data[key]['price'] + '</span>';
            out += `<a href="goods.html#${key}">Просмотреть</a>`
            out += '</div>'
            out += '</div>'
        }
        $('#goods').html(out);

    } else {
        $('#goods').html('Добавьте товар');

    }
    // })
}