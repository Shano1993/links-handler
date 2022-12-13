<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Inscription</h1>

    <form action="/index.php?c=user&a=register" method="post" id="register">
        <div class="inputUser">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
        </div>
        <div class="inputUser">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
        </div>
        <div class="inputUser">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <div class="inputUser">
            <label for="passwordRepeat">Password Repeat</label>
            <input type="password" name="passwordRepeat" id="passwordRepeat">
        </div>
        <input type="submit" name="save" value="S'enregistrer">
    </form>
</body>
</html>
