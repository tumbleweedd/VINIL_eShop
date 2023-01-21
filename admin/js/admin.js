function init() {
    // Обращение в файлу core.php с последующим вызовом функции init()
    $.post(
        "core.php",
        {
            "action": "init"
        },
        showGoods
    );
}

// показать товары
function showGoods(data) {
    // парсим входные данные
    data = JSON.parse(data);
    console.log(data);
    // переменная для вывода товаров в select
    var out = '<select>';
    // добавляем в переменную поле
    out += '<option data-id="0">Новый товар</option>';
    for (var id in data) {
        // добавляем в переменную айди и имя товаров
        out += `<option data-id="${id}">${data[id].name}</option>`;
    }
    out += '</select>';
    // выводим переменную out на экран
    $('.goods-out').html(out);
    //
    $('.goods-out select').on('change', selectGoods);
}

// Берём товар по его id из выпадающего списка
function selectGoods() {
    // Берём id
    var id = $('.goods-out select option:selected').attr('data-id');
    console.log(id)
    // обращаемся к core.php и вызываем функцию selectOneGoods, которая берёт товар по его id
    $.post(
        "core.php",
        {
            "action": "selectOneGoods",
            "gid": id
        },

        // присваиваем полям в форме значения для соответствующего товара
        function (data) {
            data = JSON.parse(data);
            $('#gname').val(data.name);
            $('#gcost').val(data.price);
            $('#gdesc').val(data.description);
            $('#gorder').val(data.ord);
            $('#gimg').val(data.image);
            $('#gid').val(data.id);


        }
    )
}

// Функция добавления/обновления товара
function saveToDB() {
    var id = $('#gid').val();
    if (id != "") {
        // обращаемся к core.php и вызываем функцию updateGoods
        $.post(
            "core.php",
            {
                "action": "updateGoods",
                "id": id,
                "gname": $('#gname').val(),
                "gcost": $('#gcost').val(),
                "gdesc": $('#gdesc').val(),
                "gorder": $('#gorder').val(),
                "gimg": $('#gimg').val()
            },

            // формируем сообщение
            function (data) {
                if (data == 1) {
                    alert('Запись обновлена')
                    init();
                } else {
                    console.log(data);
                }
            }
        );
    }
    else {
        console.log('new');
        $.post(
            "core.php",
            {
                "action": "newGoods",
                "id": 0,
                "gname": $('#gname').val(),
                "gcost": $('#gcost').val(),
                "gdesc": $('#gdesc').val(),
                "gorder": $('#gorder').val(),
                "gimg": $('#gimg').val()
            },
            function (data) {
                if (data == 1) {
                    alert('Запись добавлена')
                    init();
                } else {
                    console.log(data);
                }
            }
        );
    }
}

// Основная функция для вызова остальных
$(document).ready(function () {
    init();
    $('.add-to-db').on('click', saveToDB)
});