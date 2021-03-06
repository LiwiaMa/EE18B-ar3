
<?php
/** \ generellt escape-tecken 
 * \n matchar ny rad-tecken – newline 
 * \t matchar tabb-tecken 
 * \d siffra - samma sak som [0-9] 
 * \D inte siffra - samma sak som [^0-9] 
 * \s matchar mellanrumstecken - mellanslag, ny rad, tabb, formfeed, return 
 * \S matchar allt utom mellanrumstecken 
 * ^ matchar från början av sträng (eller början av rad med växeln /m ) 
 * \A matchar från början av sträng (oberoende av växeln /m ) 
 * $ matchar till slutet av sträng (eller slutet av rad med växeln /m ) 
 * \Z matchar till slutet av sträng (oberoende av växeln /m ) 
 * . matchar vilket tecken som helst för utom ny rad-tecken ( \n ) 
 * [a-z] teckenföljd 
 * | logiskt "eller" 
 * (x) delmönster 
 * ? matchar 0 eller 1 av föregående mönster
* matchar 0 eller fler av föregående mönster  
* matchar 1 eller fler av föregående mönster 
*{x,y} matchar mellan x och y gånger av föregående mönster

* UPPGIFT 4
*Gör ett formulär där användaren ska fylla i ett domännamn. Kontrollera sedan att domännamnet slutar på .com, .net eller .org. Du ska också kontrollera att de övriga tecknen endast består av bokstäver a-z, siffror 0-9 eller bindestreck (-). Första tecknet måste vara en bokstav. Domännamnet ska vara minst 6 tecken och högst 200 tecken långt.
* @category   
* @author     Liwia Matuszczak <liwiamatuszczak.@gmail.com>
* @license    PHP CC
*/
?><!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Regex</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="kontainer">
        <h1>Hitta match med regex</h1>
        <form action="#" method="POST">
            <label>Ange text
                <input type="text" name="text" required>
            </label>
            <button>Skicka</button>
        </form>
        <?php
        /* Ta emot data som skickas */
        $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING);

        if ($text) {
            echo "<h3>Inmattat</h3>";
            echo "<p>Text: <em>'$text'</em></p>";

            echo "<h3>Resultat</h3>";

            // Matcha .com .net .org
            if (preg_match("/[a-z0-9\-@].com|.net|.org$/", $text)) {
                echo "<p>&#10003; Slutar på antingen .com eller .net eller .org.</p>";
            } else {
                echo "<p>&#10005; Slutar INTE på .com eller .net eller .org.</p>";
            } 

            // Matcha a-z, 0-9, @ och -
            if (preg_match("/[a-z0-9@-\.]+/", $text)) {
                echo "<p>&#10003; Innehåller a-z, 0-9, @ och -</p>";
            } else {
                echo "<p>&#10005; Innehåller INTE a-z, 0-9, @ och -.</p>";
            } 

            // Första tecknet måste vara en bokstav!
            if (preg_match("/^[a-z]/", $text)) {
                echo "<p>&#10003; Första tecknet är en bokstav</p>";
            } else {
                echo "<p>&#10005; Första tecknet är INTE en bokstav</p>";
            } 

            // Längden 6-200 tecken. Pukt betyder anytime
            if (preg_match("/.{6,200}/", $text)) {
                echo "<p>&#10003; är 6-200 tecken lång</p>";
            } else {
                echo "<p>&#10005; är INTE 6-200 tecken lång</p>";
            } 


          

        }
        ?>
    </div>
</body>
</html>