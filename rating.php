<?php
    //Tietokannan luominen tiedostoon
    $db = new PDO('sqlite:db/kommentit.db');
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Kommenttitaulukon luominen jos ei ole jo luotu
    $db->exec("CREATE TABLE IF NOT EXISTS `kommenttitaulukko` (id INTEGER PRIMARY KEY, rating INTEGER, rating_id INTEGER, urlid INTEGER, name TEXT, comment TEXT, dateNtime TIMESTAMP)");
    $linkid = $_GET['id'];
    $movieid = '{{movie.id}}';
    //Tietojen haku url id :llä, samassa yhteensä äänimäärä ja keskiarvon laskeminen
    $query = $db->prepare("SELECT SUM(rating_id) as ratecount, AVG(rating) as average_rate FROM kommenttitaulukko WHERE urlid = $linkid");
    $query->execute();

    //Arvosanojen haku ja keskiarvomittarin tulostus ja muotoilu
    foreach($query->fetchAll() as $row) {
      $ratecount = $row['ratecount'];
      if(empty($ratecount)){
        $ratecount = 0;
      }
      $average_rate = $row['average_rate'];
      $average_rate = number_format($average_rate, 1);
      echo "<p class='metertxt'><span style='font-size:15px;'>Arvosana:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$average_rate." / 10</span></br>";
      echo "<meter class='iso' value='".$average_rate."' min='0.0' low='4.0' optimum='7.0' max='10.0'></meter></br>";
      echo "<span style='font-size:12px;'>(".$ratecount." arvostelua)</span></p>";
    }
?>
