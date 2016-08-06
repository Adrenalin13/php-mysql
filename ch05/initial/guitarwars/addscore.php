<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Гитарные войны - Добавьте свой рейтинг.</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Гитарные войны - Добавьте свой рейтинг</h2>

<?php
  if (isset($_POST['submit'])) {
    // Grab the score data from the POST
    $name = $_POST['name'];
    $score = $_POST['score'];

    if (!empty($name) && !empty($score)) {
      // Connect to the database
      $dbc = mysqli_connect('localhost', 'root', '', 'gwdb');

      // Write the data to the database
      $query = "INSERT INTO guitarwars VALUES (0, NOW(), '$name', '$score')";
      mysqli_query($dbc, $query);

      // Confirm success with the user
      echo '<p>Спасибо что добавили свой рейтинг!</p>';
      echo '<p><strong>Имя:</strong> ' . $name . '<br />';
      echo '<strong>Рейтинг:</strong> ' . $score . '</p>';
      echo '<p><a href="index.php">&lt;&lt; Назад к списку рейтингов</a></p>';

      // Clear the score data to clear the form
      $name = "";
      $score = "";

      mysqli_close($dbc);
    }
    else {
      echo '<p class="error">Введите, пожалуйста, всю информацию, необходимую для добавления вашего рейтинга.</p>';
    }
  }
?>

  <hr />
  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="32768" />
    <label for="name">Имя:</label>
    <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>" /><br />
    <label for="score">Рейтинг:</label>
    <input type="text" id="score" name="score" value="<?php if (!empty($score)) echo $score; ?>" />
    <br>
    <label for="screenshot">Файл изображения:</label>
    <input type="file" id="screenshot" name="screenshot" />
    <hr />
    <input type="submit" value="Добавить" name="submit" />
  </form>
</body> 
</html>
