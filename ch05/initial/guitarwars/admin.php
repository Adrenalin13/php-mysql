<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Гитарные войны - Высшие рейтинги Administration</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Гитарные войны - Высшие рейтинги Administration</h2>
  <p>Ниже список всех рекордов Гитарных войн. Используйте эту страницу, чтобы удалить рейтинги по мере необходимости.</p>
  <hr />


<?php

require_once('appvars.php');
require_once('connectvars.php');

// Соединение с БД
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Извлечение данных из БД
$query = "SELECT * FROM guitarwars ORDER BY score DESC, date ASC";
$data = mysqli_query($dbc, $query);

// Извлечение данных из массива рейтингов в цикле. Формирование данных записей в виде HTML
echo '<table>';
while ($row = mysqli_fetch_array($data)) {
    // вывод данных рейтинга
    echo '<tr class="scorerow"><td><strong>' . $row['name'] . '</strong></td>';
    echo '<td>' . $row['date'] . '</td>';
    echo '<td>' . $row['score'] . '</td>';
    echo '<td><a href="removescore.php?id=' . $row['id'] . '&amp;date=' . $row['date'] .
      '&amp;name=' . $row['name'] . '&amp;score=' . $row['score'] .
      '&amp;screenshot=' . $row['screenshot'] . '">Удалить</a></td></tr>';
}
    echo '</table>';

    mysqli_close($dbc);

?>


</body> 
</html>