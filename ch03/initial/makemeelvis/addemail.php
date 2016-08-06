<?php

$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$email = $_POST['email'];

$dbc = mysqli_connect('localhost', 'root', '', 'elvis_store') or die ('Ошибка соединения с MySQL-сервером');
$query = "INSERT INTO email_list (first_name, last_name, email) VALUES ('$first_name', '$last_name', '$email')";
$result = mysqli_query($dbc, $query) or die ('Ошибка при выполнении запроса к базе данных');
mysqli_close($dbc);

echo 'Покупатель добавлен';

?>