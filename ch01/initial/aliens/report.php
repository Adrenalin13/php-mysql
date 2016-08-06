<html>
<head>
    <metacharset=utf-8" />
    <title>Aliens Abducted Me - Report an Abduction</title>
</head>
<body>
<h2>Aliens Abducted Me - Report an Abduction</h2>

<?php

$when_it_happened = $_POST['whenithappened'];
$how_long = $_POST['howlong'];
$alien_description = $_POST['aliendescription'];
$fang_spotted = $_POST['fangspotted'];
$email = $_POST['email'];
$how_many = $_POST['howmany'];
$what_they_did = $_POST['whattheydid'];
$other = $_POST['other'];
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];

$msg = "$name был похищен $when_it_happened, и отсутствовал в течение $how_long." . 
"\nКоличество пришельцев: $how_many.\n" . 
"Описание пришельцев: $what_they_did.\n" . 
"Фэнг замечен? $fang_spotted.\n" . 
"Дополнительная инфа: $other.\n";
$subject = 'Космические пришельцы похищали меня - Сообщение о похищении';
$to = 'Li.pain@yandex.ru';

mail($to, $subject, $msg, 'From: ' . $email);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$dbc = mysqli_connect("localhost", 'root', '', 'aliendatabase') or die ('Ошибка соединения с MySQL-сервером');

$query = "INSERT INTO aliens_abduction (first_name, last_name, when_it_happened, how_long, how_many, alien_description, what_they_did, fang_spotted, other, email) VALUES ('$first_name', '$last_name', '$when_it_happened', '$how_long', '$how_many', '$alien_description', '$what_they_did', '$fang_spotted', '$other', '$email')";

$result = mysqli_query($dbc, $query) or die ('Ошибка при выполнении запроса к базе данных');

echo "<br>";

mysqli_close($dbc);

echo 'Спасибо за выполнение формы. <br>';
echo 'Вы были похищены ' . $when_it_happened;
echo ' и отсутствовали в течение ' . $how_long . '<br>';
echo 'Сколько их было? ' . $how_many . '<br>';
echo 'Опишите их: ' . $alien_description . "<br>";
echo 'ЧТО они делали с вами? ' . $what_they_did . "<br>";
echo 'Видели ли вы мою собаку Фэнга? ' . $fang_spotted . "<br>";
echo 'Дополнительная информация ' . $other . "<br>";
echo 'Ваш адрес электронной почты: ' . $email;

echo "<br>";



?>

</body>
</html>