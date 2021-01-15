<?php

/**
 * PHP version 7
 * @category   Inloggning
 * @author     Liwia Matuszczak <liwiamatuszczak.@gmail.com>
 * @license    PHP CC
 */
include "./resurser/conn.php";
session_start();
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inloggning</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="kontainer">
        <nav>
            <ul class="nav nav-tabs">
            <?php if (isset($_SESSION["anamn"])) { ?>
                    <li class="nav-item"><a class="nav-link" href="./logout.php">Logga ut</a></li>
                    <li class="nav-item"><a class="nav-link active" href="./skriva.php">Skriv</a></li>
                    <li class="nav-item"><a class="nav-link " href="./lista.php">Lista</a></li>
                   
                   
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link active" href="./login.php">Logga in</a></li>
                    <li class="nav-item"><a class="nav-link" href="./registrera.php">Registrera</a></li>
                    <li class="nav-item"><a class="nav-link" href="./lasa.php">Läs</a></li>
                    <li class="nav-item"><a class="nav-link" href="./sok.php">Sök</a></li>

                <?php } ?>
            </ul>
        </nav>
        <header>
            <h1>Inloggning</h1>
        </header>
        <main>
            <form action="#" method="post">
                <label>Användarnamn <input type="text" name="anamn" required></label>
                <label>Lösenord <input type="password" name="lösen" required></label>
                <button>Logga in</button>
            </form>
        </main>
        <?php
        // Ta emot data och skydda från hot
        $anamn = filter_input(INPUT_POST, "anamn", FILTER_SANITIZE_STRING);
        $lösen = filter_input(INPUT_POST, "lösen", FILTER_SANITIZE_STRING);

        // Kontrollera om data finns
        if ($anamn && $lösen) {
            // Finns användaren i tabellen?
            $sql = "SELECT * FROM user WHERE anamn = '$anamn'";
            $result = $conn->query($sql);

            if ($result->num_rows == 0) {
                echo "<p class=\"alert alert-warning\">Användaren finns redan</p>";
            } else {

                // Plocka ut hashet för användaren
                $rad = $result->fetch_assoc();
                $hash = $rad['hash'];
                /* var_dump($rad);
                exit; */
                // Kontrollera lösenordet
                if (password_verify($lösen, $hash)) {
                    // Inloggad
                    echo "<p class=\"alert alert-success\">Du är inloggad</p>";
                   
                    // Skapa en sessionsvariabel
                    $_SESSION["anamn"] = $anamn;

                    // Räkna antal
                    $antal = $rad['antal'] + 1;
                    //Registrera ny inloggning
                    $sql = "UPDATE user SET antal = '$antal' WHERE id = $rad[id]";
                    $conn->query($sql);
                    // Skapa en sessionsvariabel
                     $_SESSION["antal"] = $antal;
                     $_SESSION["username"] = $rad["anamn"];

                    // Hoppa till sidan lista
                    header("Location: ./lista.php");
                } else {
                    //Fel
                    echo "<p class=\"alert alert-warning\">Lösenordet stämmer inte</p>";
                }
            }
        }
        ?>
    </div>
</body>
</html>