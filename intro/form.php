<?php
if (isset($_POST['submit'])) {
    // filter_input
    $name = $_POST['name'];
    echo $name;
}
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Test</title>
</head>
<body>
<form action="" method="post">
    <div class="field">
        <label for="name">Seu nome:</label>
        <input type="text" name="name" id="name" autocomplete="on">
    </div>

    <input type="submit" value="Enviar" name="submit">
</form>
</body>
</html>
