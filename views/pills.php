<?php
// views/todo.php
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pills</title>
</head>
<body>
  <h1>Pills</h1>
  <ul>
    <?php foreach($todos as $todo): ?>
      <li><?= $todo['name']; ?></li>
    <?php endforeach; ?>
  </ul>
</body>
</html>
