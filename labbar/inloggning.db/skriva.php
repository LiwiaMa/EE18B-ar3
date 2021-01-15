<?php
/**
 * 
 * En enkel blogg som använder en databas
* PHP version 7
* @category Webbaplikation med databas  
* @author     Liwia Matuszczak <liwiamatuszczak.@gmail.com>
* @license    PHP CC
*/
// Update = ändra
// Select, Insert (lägga in), 
// Include är att klistrar in det. Ungefär som css
include "../resurser/conn.php";

?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blogg</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="kontainer">
    <nav>
    <ul class="nav nav-tabs">
                <?php if (isset($_SESSION["anamn"])) { ?>
                    <li class="nav-item"><a class="nav-link" href="./logout.php">Logga ut</a></li>
                    <li class="nav-item"><a class="nav-link active" href="./lista.php">Lista</a></li>
                    <li class="nav-item"><a class="nav-link" href="./skriva.php">Skriv</a></li>
                    <li class="nav-item anamn"> <?php echo $_SESSION["anamn"] . " (". $_SESSION["antal"].")" ;?> 
                </li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link" href="./login.php">Logga in</a></li>
                    <li class="nav-item"><a class="nav-link" href="./registrera.php">Registrera</a></li>
                    <li class="nav-item"><a class="nav-link" href="./lasa.php">Läs</a></li>
                    <li class="nav-item"><a class="nav-link active" href="./sok.php">Sök</a></li>
                <?php } ?>
            </ul>
        </nav>
</nav>
    <h1>Min blogg</h1>
    <form action="#" method="POST">
        <label>Ange rubrik <input type="text" name="header"></label>
        <label>Ange text <textarea name="postText"></textarea></label>
        <input type="hidden" value="<?php echo $_SESSION['anamn']; ?>" >
        <button>Spara</button>
    </form>
    <?php

    // Ta emot det som skickas
    $header = filter_input(INPUT_POST, 'header', FILTER_SANITIZE_STRING);
    $postText = filter_input(INPUT_POST, 'postText', FILTER_SANITIZE_STRING);
    $usernamne = $_GET["usernamne"];
    // Om data finns...
    if ($header && $postText) {
        $_SESSION['anamn'] = $anamn;
        // mysql -> insert -> runrik och text -> copy php code
        // Sql satsen
       /*  $sql_a = "SELECT * FROM user"; */
        $sql_b = "INSERT INTO post (header, postText, username) VALUES ('$header', '$postText', '$anamn')";
        
        // Steg 2: nu kör vi sql-saten
       /*  $result_a = $conn->query($sql); */
        $result_b = $conn->query($sql);

        // Gick det bra att köra sql-satsen
        if (!$result_b) {
            die("Något blev fel med SQL-satsen");
        } else {
            echo "<p>Inlägget har registrerats</p>";
        }

        $rad = $result->fetch_assoc();
        $user = $rad['hash'];
        
        // Steg 3: Stänga ned anslutningen
        $conn->close();

        /* löseord för admin: 693sPYphU1tJ1qHar7KE */
    }  
    ?>
    </div>
</body>
</html>