<?php

$from = 'Li.pain@yandex.ru';
$subject = $_POST['subject'];
$text = $_POST['elvismail'];
$dbc = mysqli_connect('localhost', 'root', '', 'elvis_store') or die ('Ошибка соединения с MySQL-сервером') or die ('Ошибка соединения с MySQL-сервером.');
$query = "SELECT * FROM email_list";
$result = mysqli_query($dbc, $query) or die ('Ошибка при выполнении запроса к базе данных'); // теперь у нас есть номер идентификатора запроса на ресурс, его нужно передать в mysqli_fetch_array() , которая извлекает данные по 1й записи зараз в массив
 // за 1 запрос в массив приходит 1 строка из таблицы

while ($row = mysqli_fetch_array($result)) {
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$msg = "Уважаемый $first_name $last_name, \n $text.";
	$to = $row['email'];

	mail($to, $subject, $text, 'From: ' . $from);
	echo 'Электронное письмо отправлено: ' . $to . '<br>';
}

mysqli_close($bdc);



?>