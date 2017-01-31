<?php
    //Tietokannan luominen tiedostoon
    $db = new PDO('sqlite:db/kommentit.db');
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Kommenttitaulukon luominen jos ei ole jo luotu
    $db->exec("CREATE TABLE IF NOT EXISTS `kommenttitaulukko` (id INTEGER PRIMARY KEY, rating INTEGER, rating_id INTEGER, urlid INTEGER, name TEXT(25), comment TEXT(300), dateNtime TIMESTAMP)");
    $linkid = $_GET['id'];
    //Tietojen haku url id :llä
    $query = $db->prepare("SELECT rating, urlid, name, comment, dateNtime, id FROM kommenttitaulukko WHERE urlid = $linkid ORDER BY Id DESC");
    $query->execute();

    //Kommenttien sekä arvosanan tulostus per käyttäjä ylläolevasta kyselystä ja muotoilu kenttään
    //Kentissä myös htmlspecialchars injektioita vastaan
    //Mittarin tulostus ja arvosana per käyttäjä/kommentti
    foreach($query->fetchAll() as $row) {
      $nick = htmlspecialchars($row['name']);
      $comment = htmlspecialchars($row['comment']);
      $date = $row['dateNtime'];
      $id = $row['urlid'];
      $rate = htmlspecialchars($row['rating']);
      echo "<div style='float:right;'><i>".$date."</i></div>";
      echo "<b>".$nick.":</b></br>";
      echo "antoi ".$rate." / 10</br>";
      echo "<meter class='pieni' value='".$rate."' min='0.0' low='4.0' optimum='7.0' max='10'></meter>";
      echo "<p>".$comment."</p>";
      echo "<hr></hr></br>";
    }

      //Formin suoritus, jos elokuvan id on sama kuin formissa
      //Virhehälytys jos kentät tai arvosana ovat tyhjiä
      if(isset($_POST['linkid'])==$linkid) {
        $name = $_POST['name'];
        $comment = $_POST['comment'];
        $rate = $_POST['rating'];
        $rateid = 1;
          if(!empty($name && $comment && $rate)) {
            $query = $db->prepare("INSERT INTO kommenttitaulukko (`rating`, `rating_id`, `urlid`, `name`, `comment`, `dateNtime`) VALUES ('$rate', '$rateid', '$linkid', '$name', '$comment', '".date('H:i - d.m.Y')."')");
            $query->execute();
            header("location:leffa.php?id=$linkid");
          } elseif(empty($name) || empty($comment) || empty($rating)) {
            echo "<script>document.location='leffa.php?id=$linkid';
            window.alert('Täytä puuttuvat kommenttikentät!');</script>";
          }
      }
?>
