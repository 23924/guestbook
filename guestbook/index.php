<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Gastenboek</title>
      <link rel="stylesheet" type="text/css" href="style.css">
  </head>

  <body>


  <div id="container">

    <h1> Gastenboek </h1>
    <h3> Luc Drenth, MD2A (BAP, MITJ) </h3>

    <form method="post" action="index.php">
      <label for="name">name</label>
      <input type="text" name="naam" id="name">
      <br>
      <label for="name">bericht</label>
      <textarea name="bericht" cols="50" rows="12"></textarea>
      <br>
      <input type="submit" name="submit" value="submit">
    </form>

<!-- INPUT VAN WEBSITE (FORM) NAAR DATABASE -->
    <?php

    $host="localhost";
    $user="23924login";
    $pass="23924wachtwoord";
    $dbname="myband1";

    $dbc = mysqli_connect($host, $user, $pass, $dbname) or die ('can not connect to database');

    if(isset($_POST['submit'])) {

        $naam = mysqli_real_escape_string($dbc, trim($_POST['naam']));
        $bericht = mysqli_real_escape_string($dbc, trim($_POST['bericht']));
        $naam =htmlspecialchars($_POST['naam']);
        $bericht =htmlspecialchars($_POST['bericht']);


        $bericht = preg_replace('/\bkut\b/','***', $bericht);
        $naam = preg_replace('/\bkut\b/','***', $naam);

        $query = "INSERT INTO gastenboek VALUES(0,'$naam','$bericht')";
        $result = mysqli_query($dbc, $query) or die ('error querying');
        echo 'gelukt';
    }

    // OUTPUT VAN DATABASE NAAR WEBSITE

    $query = "SELECT * FROM gastenboek ORDER BY id DESC";
    $result = mysqli_query($dbc, $query);
    while ($row = mysqli_fetch_array($result)) {
        $naam = $row['naam'];
        $bericht = $row['bericht'];
        echo '<div id="input">' . '<h2>' . $naam . '</h2>';
        echo '<p>' . $bericht . '</p>' . '</div>';

    }
    mysqli_close($dbc);
    ?>

  </div>

  </body>
</html>
