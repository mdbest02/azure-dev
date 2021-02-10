<html>
<body>
  Start Query maken <br>
  <?php

  $leeftijden = array(
    "Onder 7",
    "Onder 8",
    "Onder 9",
    "Onder 10",
    "Onder 11",
    "Onder 12",
    "Onder 13",
    "Onder 14",
    "Onder 15",
    "Onder 16",
    "Onder 17",
    "Onder 18",
    "Onder 19"
  );

  $sexe = array(
  "jongens",
  "meiden",
  );

  $klasses = array(
    "divisie," => "%ivisie%",
    "hoofdklasse," => "%oofdklasse%",
    "eersteklasse," => "%1e klasse%",
    "tweedeklasse," => "%2e klasse%",
    "derdeklasse," => "%3e klasse%",
    "vierdeklasse," => "%4e klasse%",
    "vijfdeklasse," => "%5e klasse%",
    "zesdeklasse," => "%6e klasse%",
    "zevendeklasse" => "%7e klasse%",
  );

  // Nu loopen door deze arrays om veel geparametriseerde queries te maken

  foreach ($leeftijden as $leeftijd) {
      foreach ($sexe as $sex) {
          print "select \"".$leeftijd." ".$sex."\", ";
          if ($sex=="jongens") {
            $NOT = "NOT";
          } else {
            $NOT = "";
          }
          foreach ($klasses as $label => $klasse) {
              print "(select count(*) from
  (select t.CompNummer from KNVBComps kco, KNVBClass kcl, teams t where kco.comp_naam like '%".$leeftijd."%' and kco.comp_naam ".$NOT." like '%Meiden%' and kcl.class_naam like '".$klasse."' and kcl.comp_id=kco.comp_id and t.comp_id=kco.comp_id and t.class_id=kcl.class_id group by t.CompNummer) as temp ) as ".$label."\n";
          }
          print "\nunion\n";
      }
  }
  ?>
</body>
</html>
