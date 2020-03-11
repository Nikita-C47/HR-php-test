$(document).ready(function () {
    // Установка новой цены товара
    $("[data-type='price_changer']").click(function () {
        // Текущий элемент
        var current = $(this);
        // Родительский div
        var div = current.parent();
        // Текстовый блок
        var helpBlock = current.siblings(".help-block");
        // Поле ввода
        var input = current.siblings("input");
        // URL для обновления цены
        var update_price_url = current.data('action');

        // Блокируем элементы, ужадяем классы, пишем что загрузка пошла
        div.removeClass('has-success has-error');
        current.prop('disabled', 'disabled');
        helpBlock.text("Загрузка...");
        input.prop('disabled', 'disabled');
        // Собираем данные
        var data = new FormData();
        data.append('price', input.val());
        // Отправляем запрос
        axios.post(update_price_url, data).then(response => {
            // Если все успешно
            if(response.status === 200) {
                div.addClass('has-success');
                helpBlock.text("Обновлено!");
            }
        }).catch(error => {
            // Ошибка
            div.addClass('has-error');
            if(error.response) {
                // Если это валидация - пишем в текстовый блок ошибку
                if(error.response.status === 422) {
                    helpBlock.text(error.response.data.errors.price[0]);
                } else {
                    helpBlock.text("Ошибка!");
                }
            } else {
                helpBlock.text("Ошибка!");
            }
            console.log(error);
        }).then(() => {
            // В конче разблокируем элементы
            current.removeAttr('disabled');
            input.removeAttr('disabled');
        });
    });
});
