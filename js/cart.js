var cart = {}; // корзина

$.getJSON('goods.json', function (data) {
    var goods = data; // все товары в массиве
    //console.log(goods);
    checkCart();
    $('.send-email').on('click', sendEmail);
    // console.log(cart);
    showCart(); // вывод товаров

    // Отображаем товарыв корзине
    function showCart() {
        // Отображение при пустой корзине
        if ($.isEmptyObject(cart)) {
            var out = 'Корзина пуста. <a href="index.php">Выбрать товары</a>';
            // Записываем по id #my-cart переменную out (в файл cart.php)
            $('#my-cart').html(out);

        } else {
            // Формируем товары для отображения (в переменную out)
            var out = '';
            for (var key in cart) {
                out += '<button class="delete" data-art="' + key + '">x</button>';
                // out += '<img src="' + data[key].image + '" alt="d">';

                out += '<img src="' + goods[key].image + '" width="100" height="100">';
                out += goods[key].name;
                out += '<button class="minus" data-art="' + key + '">-</button>';
                out += cart[key];
                out += '<button class="plus" data-art="' + key + '">+</button>';
                out += cart[key] * goods[key].price;
                out += '<br>';
            }

            // Отображаем товары по id #my-cart
            $('#my-cart').html(out);
            $('.plus').on('click', plusGoods);
            $('.minus').on('click', minusGoods);
            $('.delete').on('click', deleteGoods);
        }
    }

    function plusGoods() {
        var articul = $(this).attr('data-art');
        // Добавляем товар
        cart[articul]++;
        saveCartToLS(); //сохранение корзины в localStorage
        showCart();
    }

    function minusGoods() {
        var articul = $(this).attr('data-art');
        if (cart[articul] > 1) {
            cart[articul]--;
        } else {
            delete cart[articul];
        }
        saveCartToLS(); //сохранение корзины в localStorage
        showCart();
    }

    function deleteGoods() {
        var articul = $(this).attr('data-art');
        delete cart[articul];
        saveCartToLS(); //сохранение корзины в localStorage
        showCart();
    }
});

function checkCart() {
    //проверка наличия корзины в localStorage
    if (localStorage.getItem('cart') != null) {
        cart = JSON.parse(localStorage.getItem('cart'))
    }
}

function isEmpty(object) {
    //проверка корзины на пустоту
    for (var key in object)
        if (object.hasOwnProperty(key)) return true;
    return false;
}

// Отправка информации о заказе по почте
function sendEmail() {
    var ename = $('#ename').val();
    var email = $('#email').val();
    var ephone = $('#ephone').val();
    // если поля непустые
    if (ename != '' && email != '' && ephone != '') {
        // если корзина непуста
        if (isEmpty(cart)) {
            // отправляем сообщение на почту
            $.post(
                "core/mail.php",
                {
                    "ename": ename,
                    "email": email,
                    "ephone": ephone,
                    "cart": cart
                },
                function (data) {
                    console.log(data);
                }
            );
            alert('Заказ оформлен')
        } else {
            alert('Корзина пуста');
        }
    } else {
        alert('Заполните поля');
    }

}

function saveCartToLS() {
    localStorage.setItem('cart', JSON.stringify(cart));
}