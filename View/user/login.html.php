<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Connexion</h1>

    <form action="/index.php?c=user&a=login" method="post" id="register">
        <div class="inputUser">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
        </div>
        <div class="inputUser">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <input type="submit" name="save" value="Connexion">
    </form>
</body>
</html>
