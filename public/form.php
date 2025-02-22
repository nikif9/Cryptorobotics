<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <!-- Подключаем Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div id="message"></div>
        <div class="card">
            <div class="card-header">
                Регистрация
            </div>
            <div class="card-body">
                <form id="registrationForm" novalidate>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                        <div class="invalid-feedback">Пожалуйста, введите корректный email.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Пароль:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        <div class="invalid-feedback">Пожалуйста, введите пароль.</div>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Повтор пароля:</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control"
                            required>
                        <div class="invalid-feedback">Пожалуйста, повторите пароль.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Подключение jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Подключение Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Кастомный JS для обработки формы -->
    <script src="js/app.js"></script>
</body>

</html>