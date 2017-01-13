<?php
   echo '<br><br><h1 style="font-family: \'Indie Flower\';font-size: 6em; text-align: center; line-height: 1;margin-bottom:10px;">Sostieni il Progetto<br><small>con una donazione</small></h1>';
    
    echo '<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ "Indie+Flower::latin" ] }
  };
  (function() {
    var wf = document.createElement("script");
    wf.src = ("https:" == document.location.protocol ? "https" : "http") +
      "://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js";
    wf.type = "text/javascript";
    wf.async = "true";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(wf, s);
  })(); </script>';
    
    echo '<center>
    
    <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=F2JK36SCXKTE2">
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Dona ora">
    </a>
    <a href="'.admin_url('admin.php?page=impostazioni-wpgov').'">
        <input type="submit" name="submit" id="submit" class="button" value="No, grazie">
    </a>
    
    <br><br>
    
    <small>
    
        WPGov è un progetto open-source, senza obbligo di registrazione, a disposizione degli uffici della pubblica amministrazione e degli enti pubblici.
        
        <br>
        
        Per supportare lo sviluppo di questi prodotti e per coprirne i costi si accettano donazioni sia da coloro che ne ufruiscono gratuitamente e sia da chi, invece, lo commercializza per fini professionali.
        
        <br>
        
        <strong>Solamente così potrà continuare ad essere free.</strong>
        
    </small>
    
        <br>
        <br>
        <span style="font-size:30px;font-family: \'Indie Flower\';">Marco Milesi</span>
        
    </center>';
?>