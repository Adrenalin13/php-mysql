<?php

require_once ('authorize.php');

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Guitar Wars - Approve a High Score</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <h2>Guitar Wars - Approve a High Score</h2>

<?php

require_once('appvars.php');
require_once('connectvars.php');

if (isset($_GET['id']) && isset($_GET['date']) && isset($_GET['name']) && isset($_GET['score']) &&
 isset($_GET['screenshot'])) {
    // извлечение данных рейтинга из суперглобального массива $_GET
    $id = $_GET['id'];
    $date = $_GET['date'];
    $name = $_GET['name'];
    $score = $_GET['score'];
    $screenshot = $_GET['screenshot'];
} else if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['score'])) {
    // извлечение данных рейтинга из суперглобального массива $_POST
    $id = $_POST['id'];
    $name = $_POST['name'];
    $score = $_POST['score'];
} else {
    echo '<p class="error">Ни одного рейтинга не было подтверждено!</p>';
}

if (isset($_POST['submit'])) {
    if ($_POST['confirm'] == 'Да') {
        // Соединение с БД
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // Санкционирование рейтинга путем установки значения 1 для колонки approved, таблицы 
        // guitarwars
        $query = "UPDATE guitarwars SET approved = 1 WHERE id = '$id';";
        mysqli_query($dbc, $query);
        mysqli_close($dbc);

        // вывод на экран подтверждения санкционирования
        echo '<p>Рейтинг ' . $score . ' для пользователя ' . $name . ' успешно санкционирован</p>';
    } else {
        echo '<p class="error"Рейтинг не санкционирован.</p>';
    }
} else if (isset($id) && isset($name) && isset($date) && isset($score)) {
    echo '<p>Вы уверены что желаете санкционировать данный рейтинг?</p>';
    echo '<p><strong>Имя: </strong>' . $name . '<br><strong>Дата: </strong>' . $date .
        '<br><strong>Рейтинг: </strong>' . $score . '</p>';
    echo '<form method="POST" action="approvescore.php">';
    echo '<input type="radio" name="confirm" value="Да"/>Да';
    echo '<input type="radio" name="confirm" value="Нет" checked="checked"/>Нет<br>';
    echo '<input type="submit" value="Санкционировать" name="submit"/>';
    echo '<input type="hidden" name="id" value="' . $id . '"/>';
    echo '<input type="hidden" name="name" value="' . $name . '"/>';
    echo '<input type="hidden" name="score" value="' . $score . '"/>';
    echo '</form>';
}

    echo '<p><a href="admin.php">&lt;&lt; Назад к странице &quot;Администратора&quot;</a></p>';


?>


</body> 
</html>