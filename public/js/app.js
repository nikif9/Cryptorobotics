$(function() {
    const $form = $('#registrationForm');
    const $message = $('#message');
    const $email = $('#email');
    const $password = $('#password');
    const $confirmPassword = $('#confirm_password');

    $form.on('submit', function(e) {
        e.preventDefault();
        let valid = true;

        // Сброс классов ошибок и сообщений
        const $inputs = $form.find('input');
        $inputs.removeClass('is-invalid');
        $message.empty();

        // Проверка обязательных полей
        $form.find('input[required]').each(function() {
            if (!$.trim($(this).val())) {
                $(this).addClass('is-invalid');
                valid = false;
            }
        });

        if (!valid) {
            $message.html('<div class="alert alert-danger">Пожалуйста, заполните все обязательные поля корректно.</div>');
            return;
        }

        // AJAX-запрос на регистрацию
        $.ajax({
            url: '/register',
            type: 'POST',
            data: $form.serialize(),
            dataType: 'json'
        })
        .done(response => {
            if (response.success) {
                $form.hide();
                $message.html(`<div class="alert alert-success">${response.message}</div>`);
            }else{
                let errorText = 'Произошла ошибка при отправке формы';
                $message.html(`<div class="alert alert-danger">${errorText}</div>`);
            }
        })
        .fail((xhr, status, error) => {
            const response = xhr.responseJSON;
            let errorText = 'Произошла ошибка при отправке формы';
            if (response && response.message) {
                errorText = response.message;
                if (response.error === 'invalid_email' || response.error === 'user_exists') {
                    $email.addClass('is-invalid');
                }
                if (response.error === 'password_mismatch') {
                    $password.add($confirmPassword).addClass('is-invalid');
                }
            }
            $message.html(`<div class="alert alert-danger">${errorText}</div>`);
        });
    });
});
