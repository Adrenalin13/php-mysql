<?php

require_once('connectvars.php');

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
    // Имя или пвроль не были введены, по этому заголовки отправляются, предлагая логиниться снова
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Несоответствия"');
    exit('<h3>Несоответствия</h3>Простите, вы должны ввести ваше имя и пароль для того ' . 
        'чтобы войти в приложение и получить доступ к этой странице.');
}

// Соединение с БД
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Получение введенных пользователем данных для аутентификации
$user_username = mysqli_real_escape_string($dbc, trim($_SERVER['PHP_AUTH_USER']));
$user_password = mysqli_real_escape_string($dbc, trim($_SERVER['PHP_AUTH_PW']));

// Поиск имени и пароля пользователя в БД
$query = "SELECT user_id, username FROM mismatch_user WHERE username = '$user_username'" .
 " AND password = SHA('$user_password')";
$data = mysqli_query($dbc, $query);

if (mysqli_num_rows($data) == 1) {
    // вход прошел нормально, присваиваем переменным значения id пользователя и его имя
    $row = mysqli_fetch_array($data);
    $user_id = $row['user_id'];
    $username = $row['username'];
} else {
    // Имя или пароль введены неверно, отправляем заголовки аутентификации
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Несоответствия"');
    exit('<h3>Несоответствия</h3>Простите, вы должны ввести ваше имя и пароль для того ' . 
        'чтобы войти в приложение и получить доступ к этой странице.');
}

// Подтверждение успешного входа в приложение
echo '<p class="login">Вы вошли в приложение как ' . $username . '</p>';

?>