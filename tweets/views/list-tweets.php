<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Tweets</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<!-- lista de tweets -->
<h1>Tweets</h1>
<div class="list">
    <table>
        <thead>
        <tr>
            <th>Text</th>
            <th>User</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tweets AS $tweet) : ?>
        <tr>
            <td><?= $tweet['text'] ?></td>
            <td><?= $tweet['username'] ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<hr>
<!-- filtro -->
<h2>Filtro</h2>
<div class="filter">
    <form action="tweets.php" method="post">
        <div class="field">
            <label for="desc">Descrição</label>
            <input type="text" name="desc" id="desc" autocomplete="on">
        </div>

        <input type="submit" value="Buscar" name="submit">
    </form>
</div>
</body>
</html>
