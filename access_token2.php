<?php

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['token_button']))
    {
        // Si le bouton est activé, stocke l'access_token
        $appeltoken = get_token();
    } else {
      // Sinon retourne "rien"
      $appeltoken = "";
    }

    function get_token()
  {
    // Exécute le code java accesstoken.jar
    exec("\"jdk-8.0.292.10-hotspot\\jre\\bin\\java.exe\" -jar accesstoken.jar 2>&1", $output);
    // Retourne la valeur de access_token
    return ((array)json_decode(utf8_encode($output[0])))['access_token'];
  }

?>
<form action="tabs.php" method="post">
  <!--Le name="token_button" est utilisé dans le if du début de ce code-->
  <input type="submit" id="envoyer" name="token_button" value="Go Token GOOOOO !!!">
</form>
<p>
  <?php
  // Affiche le token lors du clic sur le bouton
    print_r($appeltoken);
  ?>
</p>
    <form action="tabs.php" method="post">
      <!--Le name="token_button" est utilisé dans le if du début de ce code-->
      <input type="submit" id="envoyer" name="token_button" value="Go Token GOOOOO !!!">
    </form>
    <p>
      <?php
      // Affiche le token lors du clic sur le bouton
        print_r($appeltoken);
      ?>
    </p>