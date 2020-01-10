

<div class="container-fluid">
    <h2 class="text-centered padded">Mandat bearbeiten</h2>
<div class="card">
  <div class="card-body">


<?php if (isset($success) && $success == true): ?>
<div class="alert alert-success" role="alert" id="infoMessage">   
Erfolgreich bearbeitet.
</div>
<?php endif;?>

<?php if (isset($success) && $success != true): ?>
<div class="alert alert-danger" role="alert" id="infoMessage">   
Datenbankfehler!
</div>
<?php endif;?>

<div class="alert alert-danger" role="alert" id="infoMessage">   
<?php echo validation_errors(); ?>
<?php echo $errors; ?>
</div>
    

    <?php echo form_open('manage/mandate_edit/'.$mandate_id); ?>

    <label for="title">Name <br><small>Vor- und Zuname</small></label><br>
    <input type="text" name="name" value="<?php echo html_escape($name); ?>" /><br />

    <label for="title">Liste <br><small>Angetreten auf Liste/für Partei</small></label><br>
    <input type="text" name="election_list" value="<?php echo html_escape($election_list); ?>" /><br />

    <label for="title">Wahlergebnis <br><small>Wahlergebnis in Prozent</small></label><br>
    <input type="number" step="0.1" name="election_result" value="<?php echo html_escape($election_result); ?>" /><br />

    <label for="title">Bundesland <br><small>Bundesland in dem das Mandat ausgeübt wird</small></label><br>
    <select name="state_name">
      <option value="<?php echo $state_display_name; ?>"><?php echo html_escape($state_display_name); ?></option>
      <option value="Brüssel">Brüssel (Europaparlament)</option>
      <option value="Baden-Württemberg">Baden-Württemberg</option>
      <option value="Bayern">Bayern</option>
      <option value="Berlin">Berlin</option>
      <option value="Brandenburg">Brandenburg</option>
      <option value="Bremen">Bremen</option>
      <option value="Hamburg">Hamburg</option>
      <option value="Hessen">Hessen</option>
      <option value="Mecklenburg-Vorpommern">Mecklenburg-Vorpommern</option>
      <option value="Niedersachsen">Niedersachsen</option>
      <option value="Nordrhein-Westfalen">Nordrhein-Westfalen</option>
      <option value="Rheinland-Pfalz">Rheinland-Pfalz</option>
      <option value="Saarland">Saarland</option>
      <option value="Sachsen">Sachsen</option>
      <option value="Sachsen-Anhalt">Sachsen-Anhalt</option>
      <option value="Schleswig-Holstein">Schleswig-Holstein</option>
      <option value="Thüringen">Thüringen</option>
    </select> <br>

    <label for="title">Postleitzahl <br><small>Postleitzahl des häufigsten Tagungsgebäudes/Rathaus/Parlament. Sollte sich der Marker auf der Karte unter einem anderen verstecken bitte benachbarte PLZ nutzen. Für Brüssel: 1047</small></label><br>
    <input type="text" name="postal_code" value="<?php echo html_escape($postal_code); ?>" /><br />

    <label for="title">Institution <br><small>Art des Mandats</small></label><br>
    <select name="institution">
      <option value="<?php echo $institution; ?>"><?php echo html_escape($institution); ?></option>
      <option value="Gemeinderat">Gemeinderat</option>
      <option value="Kreistag">Kreistag</option>
      <option value="Bürgermeister">Bürgermeister</option>
      <option value="Sonstiges kommunales Mandat">Sonstiges kommunales Mandat</option>
      <option value="Landesparlament">Landesparlament</option>
      <option value="Bundestag">Bundestag</option>
      <option value="Europaparlament">Europarlament</option>
      <option value="Sonstiges Mandat">Sonstiges Mandat</option>
    </select><br>

    <label for="title">Institution (Anzeigenamen)<br><small>So bezeichnet sich die Institution selbst.</small></label><br>
    <input type="text" name="institution_display_name" value="<?php echo html_escape($institution_display_name); ?>" /><br />

    <label for="title">Fraktion <br><small></small></label><br>
    <input type="text" name="parliamentary_group" value="<?php echo html_escape($parliamentary_group); ?>" /><br />

    <label for="title">Mandatsbeginn <br><small>Datum an dem das Mandat angetreten wird. Uhrzeit wird nicht berücksichtigt.</small></label><br>
    <input type="date" name="mandate_start"  value="<?php echo explode(" ", $mandate_start)[0]; ?>" /><br />

    <label for="title">Mandatsende <br><small>Datum an dem das Mandat endet wird. Urhzeit wird nicht berücksichtigt.</small></label><br>
    <input type="date" name="mandate_end" value="<?php echo explode(" ", $mandate_end)[0]; ?>" /><br />

    <label for="title">Externer Link<br><small>1 Link (startet mit http:// oder https://) mit weiterführenden Informationen. Etwa Social Media Account, Website.</small></label><br>
    <input type="text" name="external_link"  value="<?php echo html_escape($external_link); ?>" /><br />

    
    
    <label for="title">Status <br><small>Status des Eintrags</small></label><br>
    <select name="status">
      <option value="<?php echo $status; ?>"><?php echo html_escape($status); ?></option>
      <option value="0">Wartet auf Freischaltung (0)</option>
      <?php if ($this->ion_auth->in_group(['admin', 'superuser', 'acknowledged_user'])):?>
      <option value="1">Freigeschalten (1)</option>
      <?php endif;?>
      <?php if ($this->ion_auth->in_group(['admin', 'superuser'])):?>
      <option value="2">Nicht sichtbar/gelöscht (2)</option>
      <option value="3">Löschung beantragt (3)</option>
      <?php endif;?>
    </select><br>
    




    <input type="submit" value="Eintragen" />

    </form>
    </div>
    </div>

</div>
