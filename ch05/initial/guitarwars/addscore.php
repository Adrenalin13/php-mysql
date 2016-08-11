<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Гитарные войны - Добавьте свой рейтинг.</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<h2>Гитарные войны - Добавьте свой рейтинг</h2>

<?php

require_once('appvars.php');
require_once('connectvars.php');

if (isset($_POST['submit'])) {
    // Grab the score data from the POST
    @$name = mysqli_real_escape_string($dbc, trim($_POST['name'])) ; // trim() удаляет пробелы перед и после значения
    @$score = mysqli_real_escape_string($dbc, trim($_POST['score'])); 
    @$screenshot = mysqli_real_escape_string($dbc, trim($_FILES['screenshot']['name']));
    $screenshot_size = $_FILES['screenshot']['size'];
    $screenshot_type = $_FILES['screenshot']['type'];

    if (!empty($name) && is_numeric($score) && !empty($screenshot)) {
        if ((($screenshot_type == 'image/png') || ($screenshot_type == 'image/jpeg') || ($screenshot_type == 'image/gif') || ($screenshot_type == 'image/pjpeg')) && ($screenshot_size > 0) && ($screenshot_size <= GW_MAXFILESIZE)) {
            if ($_FILES['screenshot']['error'] == 0) {
                // Перемещение файла в постоянный каталог для изображений
                $target = GW_UPLOADPATH . $screenshot;
                if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)) {
                    // Connect to the database
                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

                    // Запись данных в ДБ с сокрытием ID и approved (чтобы не провели SQL-injection) 
                    $query = "INSERT INTO guitarwars (date, name, score, screenshot) VALUES (NOW(), '$name', '$score', '$screenshot')";
                    mysqli_query($dbc, $query);

                    // Confirm success with the user
                    echo '<p>Спасибо что добавили свой рейтинг!</p>';
                    echo '<p><strong>Имя:</strong> ' . $name . '<br />';
                    echo '<strong>Рейтинг:</strong> ' . $score . '<br>';
                    echo '<img src="' . GW_UPLOADPATH . $screenshot . '" alt="Изображение, подтверждающее подлинность рейтинга." /></p>';
                    echo '<p><a href="index.php">&lt;&lt; Назад к списку рейтингов</a></p>';

                    // Clear the score data to clear the form
                    $name = "";
                    $score = "";
                    $screenshot = "";

                    mysqli_close($dbc);
                } else {
                    echo '<p class="error">Извините, возникла ошибка при загрузке файла изображения.</p>';
                }
            }
        } else {
            echo '<p class="error">Файл, подтверждающий рейтинг, должен быть файлом в форматах GIF, JPEG или PNG, и его размер не должен превышать ' . (GW_MAXFILESIZE / 1024) . 'Кб</p>';
        }

        // Попытко удалить временный файл изображения, подтверждающий рейтинг пользователя
        @unlink($_FILES['screenshot']['tmp_name']);
    } else {
        echo '<p class="error">Введите, пожалуйста, всю информацию, необходимую для добавления вашего рейтинга.</p>';
    }
}
?>

<br/>
<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="32768"/>
    <label for="name">Имя:</label>
    <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>"/><br/>
    <label for="score">Рейтинг:</label>
    <input type="text" id="score" name="score" value="<?php if (!empty($score)) echo $score; ?>"/>
    <br>
    <label for="screenshot">Файл изображения:</label>
    <input type="file" id="screenshot" name="screenshot"/>
    <hr/>
    <input type="submit" value="Добавить" name="submit"/>
</form>
</body>
</html>
