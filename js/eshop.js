// Переменная для хранения товаров
var cart = {};
// var later = {};
// Инициализирующая функция
$('document').ready(function () {
    // loadGoods();
    init();
    checkCart();
    showMiniCart();
});

function init() {
    //C помощью $.post() загружаем данные с сервера с помощью HTTP запроса методом POST
    // Переходим в core.php и вызываем функцию loadG
    $.post(
        "admin/core.php",
        {
            "action": "loadG"
        },
        loadGoods
    );
}

//
function loadGoods(data) {
    // Конвертация в JSON наших товаров
    data = JSON.parse(data);
    // $.getJSON('goods.json', function (data) {
    // Создаём пустую переменную, которой будем приравнивать html-элементы для каждого товара
    var out = '';
    // Формируем карточку для каждого товара
    for (var key in data) {
        out += '<div class="product-item">';

        out += '<button class="later" data-art="' + key + '">&hearts;</button>'

        out += '<img src="' + data[key].image + '" alt="d">';
        out += '<div class="product-list">';
        out += '<h3>' + '<a href="goods.html#' + key + '">' + data[key]['name'] + '</a>' + '</h3>';
        // out += `<h3><a href="goods.html#${key}"> $data[key].name</a></h3>`

        out += '<span class="price">' + data[key]['price'] + '</span>';
        out += '<button class="add-to-cart" data-art="' + key + '">В корзину</button>'
        // out += '<button name="myActionName" type="submit" value="0">Редактировать</button>'
        // out+= '    <?php if (isset($_POST[\'myActionName\'])) {require \'admin/admin.php\';} ?>
        out += '<button type="button" onclick="window.location.href = \'../admin/admin.php\';">Редактировать</button>'

        out += '</div>'
        out += '</div>'
    }
    // Отображаем товары на странице
    $('#goods').html(out);
    // добавляем товар в корзину
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
    // Берём id по его атрибуту
    var id = $(this).attr('data-art');
    later[id] = 1;
    // Сохраняем в хранилище желаемый товар
    localStorage.setItem('later', JSON.stringify(later));

}

function addToCart() {
    //добавление товара в корзину
    var articul = $(this).attr('data-art');
    // формирование корзины
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


// function showLater() {
//     //отображение содержимого корзины
//     var out = '';
//     for (var e in later) {
//         out += e + ' --- ' + later[e] + '<br>'
//     }
//     $('#mini-cart').html(out)
// }