<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Гитарные войны - Список рейтингов</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Гитарные войны - Список рейтингов</h2>
  <p>Добро пожаловать, гитарный воин! Твой рейтинг бьет рекорд, зарегистрированный в этом списке рейтингов? Если так, просто <a href="addscore.php">добавь свой рейтинг</a> в список.</p>
  <hr />

<?php
  // Connect to the database 
  $dbc = mysqli_connect('localhost', 'root', '', 'gwdb');

  // Retrieve the score data from MySQL
  $query = "SELECT * FROM guitarwars";
  $data = mysqli_query($dbc, $query);

  // Loop through the array of score data, formatting it as HTML 
  echo '<table>';
  while ($row = mysqli_fetch_array($data)) { 
    // Display the score data
    echo '<tr><td class="scoreinfo">';
    echo '<span class="score">' . $row['score'] . '</span><br />';
    echo '<strong>Name:</strong> ' . $row['name'] . '<br />';
    echo '<strong>Date:</strong> ' . $row['date'] . '</td></tr>';
  }
  echo '</table>';

  mysqli_close($dbc);
?>

</body> 
</html>
