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
  require_once ('appvars.php');
  require_once ('connectvars.php');

  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Retrieve the score data from MySQL
  $query = "SELECT * FROM guitarwars WHERE approved = 1 ORDER BY score DESC, date ASC";
  $data = mysqli_query($dbc, $query);

  // Loop through the array of score data, formatting it as HTML 
  echo '<table>';

  $i = 0;

  while ($row = mysqli_fetch_array($data)) { 
    // Display the score data
    if ($i == 0) {
      echo '<tr><td colspan="2" class="topscoreheader">Наивысший рейтинг: ' . $row['score'] . '</td></tr>';
    }
    echo '<tr><td class="scoreinfo">';
    echo '<span class="score">' . $row['score'] . '</span><br />';
    echo '<strong>Имя:</strong> ' . $row['name'] . '<br />';
    echo '<strong>Дата:</strong> ' . $row['date'] . '</td>';
    if (is_file(GW_UPLOADPATH . $row['screenshot']) && filesize(GW_UPLOADPATH . $row['screenshot']) > 0) {
      echo '<td><img src="' . GW_UPLOADPATH. $row['screenshot'] . '" alt="Подтверждено" /></td></tr>';
    } else {
      echo '<td><img src="' . GW_UPLOADPATH . 'unverified.gif' . '" alt="НЕ Подтверждено" /></td></tr>';
    }
    $i++;
  }
  echo '</table>';

  mysqli_close($dbc);
?>

</body> 
</html>
