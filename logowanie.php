<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Forum o psach</title>
    <link rel="stylesheet" href="styl4.css">
</head>

<body>
    <header>
        <h1>Forum wielbicieli psów</h1>
    </header>
    <main>
        <div id="lewy">
            <img src="obraz.jpg" alt="foksterier">
        </div>
        <div id="prawy1">
            <h2>Zapisz się</h2>
            <form action="logowanie.php" method="post">
                Login: <input type="text" name="login" id=""> <br>
                Hasło: <input type="password" name="haslo" id=""> <br>
                Powtórz hasło: <input type="password" name="haslo1" id=""> <br>
                <input type="submit" value="Zapisz">
            </form>
            <?php
            $conn = mysqli_connect('localhost', 'root', '', 'psy');
            if (empty($_POST['login']) || empty($_POST['haslo']) || empty($_POST['haslo1'])) {
                echo "<p>Nie wypełniono przynajmniej jednego pola formularza</p>";
            } else {
                $l = $_POST['login'];
                $h = $_POST['haslo'];
                $h1 = $_POST['haslo1'];
                $res = mysqli_query($conn, "SELECT login FROM uzytkownicy;");
                foreach ($res as $r) {
                    if ($r['login'] == $l) {
                        echo "<p>Login występuje w bazie danych hasło nie zostało dodane</p>";
                        break;
                    } else {
                        $pop = true;
                    }
                }
                if ($h != $h1) {
                    echo "<p>Hasła nie są takie same, konto nie zostało dodane</p>";
                    $pop = false;
                }
                if ($pop == true) {
                    $h = sha1($h);
                    mysqli_query($conn, "INSERT INTO `uzytkownicy`( `login`, `haslo`) VALUES ('$l','$h');");
                }
            }
            mysqli_close($conn);
            ?>
        </div>
        <div id="prawy2">
            <h2>Zapraszamy wszystkich</h2>
            <ol>
                <li>właścicieli psów</li>
                <li>weterynarzy</li>
                <li>tych, co chcą kupić psa</li>
                <li>tych, co lubią psy</li>
            </ol>
            <a href="regulamin.html">Przeczytaj regulamin forum</a>
        </div>
    </main>
    <footer>
        Stronę wykonał: PESEL
    </footer>
</body>

</html>