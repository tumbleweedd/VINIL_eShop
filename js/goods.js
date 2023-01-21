var cart = {};
// var later = {};
$('document').ready(function () {
    // loadGoods();
    init();
    checkCart();
    showMiniCart();
});

function init() {
    // $.getJSON('goods.json', loadGoods);
    // Формирования id страницы товара
    var hash = window.location.hash.substring(1)
    console.log(hash)
    // обращаемся к файлу core.php, выполняя оттуда функцию loadSingleGoods
    $.post(
        "admin/core.php",
        {
            "action": "loadSingleGoods",
            "id": hash
        },
        loadGoods
    );
}

// Пихаем товар в функцию loadGoods
function loadGoods(data) {
    data = JSON.parse(data);
    // $.getJSON('goods.json', function (data) {
    var out = '';

    out += '<div class="desc_img">'
    out += '<a href="#"><image class="image" src="' + data.image + '"></image>'
    out += '</div>'

    out += '<div class="desc_words">'
    out += '<h1>' + data.name + '</h1>'
    out += '</div>'

    out += '<div class="value">'
    out += '<p>' + data.price + '</p>'
    out += '</div>'

    out += '<div class="desc_h5">'
    out += '<h3>' + data.description + '</h3>'
    out += '</div>'

    out += `<button class="add-to-cart btn" data-art="' + ${data.id} + '">В корзину</button>`


    // out += '<div class="product-item">';
    // out += '<button class="later" data-art="' + data.id + '">&hearts;</button>'
    // out += '<img src="' + data.image + '" alt="d">';
    // out += '<div class="product-list">';
    // out += '<h3>' + data.name + '</h3>';
    // out += '<span class="price">' + data.price + '</span>';
    // out += `<button class="add-to-cart" data-art="' + ${data.id} + '">В корзину</button>`
    // out += '</div>'
    // out += '</div>'

    // Отображаем товар
    $('#goods').html(out);
    // Добавление в корзину и в желаемрое по нажатию кнопки
    $('button.add-to-cart').on('click', addToCart);
    $('button.later').on('click', addToLater);

    // })
}

function addToLater() {
    // добавление товара в желаемое
    var later = {};
    if (localStorage.getItem('later') != null) {
        later = JSON.parse(localStorage.getItem('later'))
    }
    alert('Добавлено в Желаемое');
    var id = $(this).attr('data-art');
    later[id] = 1;
    localStorage.setItem('later', JSON.stringify(later));

}

function addToCart() {
    //добавление товара в корзину
    var articul = $(this).attr('data-art');
    if (cart[articul] !== undefined) {
        cart[articul]++;
    } else {
        cart[articul] = 1;
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    //console.log(cart);
    showMiniCart();
}

function checkCart() {
    //проверка наличия корзины в localStorage
    if (localStorage.getItem('cart') != null) {
        cart = JSON.parse(localStorage.getItem('cart'))
    }
}

function showMiniCart() {
    //отображение содержимого корзины
    var out = '';
    for (var e in cart) {
        out += e + ' --- ' + cart[e] + '<br>'
    }
    out += '<br><a href="cart.php">Корзина</a>'
    $('#mini-cart').html(out)
}


function showLater() {
    //отображение содержимого корзины
    var out = '';
    for (var e in later) {
        out += e + ' --- ' + later[e] + '<br>'
    }
    $('#mini-cart').html(out)
}