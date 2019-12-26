<div class="container-fluid">
    <h2 class="text-centered padded">Neuen Mandatsträger anlegen</h2>
<div class="card">
  <div class="card-body upl">
    <?php echo validation_errors(); ?>
    <?php echo $errors; ?>

    <?php echo form_open('manage/mandate_new'); ?>

    <label for="title">Name* <br><small>Vor- und Zuname</small></label><br>
    <input type="text" name="name" value="<?php echo set_value('name'); ?>" /><br />

    <label for="title">Liste <br><small>Angetreten auf Liste/für Partei</small></label><br>
    <input type="text" name="election_list" value="<?php echo set_value('election_list'); ?>" /><br />

    <label for="title">Wahlergebnis <br><small>Wahlergebnis in Prozent</small></label><br>
    <input type="number" step="0.1" name="election_result" value="<?php echo set_value('election_result'); ?>" /><br />

    <label for="title">Bundesland* <br><small>Bundesland in dem das Mandat ausgeübt wird</small></label><br>
    <select name="state_name">
      <option value="<?php echo set_value('state_name'); ?>"><?php echo set_value('state_name'); ?></option>
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

    <label for="title">Postleitzahl* <br><small>Postleitzahl des häufigsten Tagungsgebäudes/Rathaus/Parlament. Sollte sich der Marker auf der Karte unter einem anderen verstecken bitte benachbarte PLZ nutzen. Für Brüssel: 1047</small></label><br>
    <input type="text" name="postal_code" value="<?php echo set_value('postal_code'); ?>" /><br />

    <label for="title">Institution* <br><small>Art des Mandats</small></label><br>
    <select name="institution">
      <option value="<?php echo set_value('institution'); ?>"><?php echo set_value('institution'); ?></option>
      <option value="Gemeinderat">Gemeinderat</option>
      <option value="Kreistag">Kreistag</option>
      <option value="Bürgermeister">Bürgermeister</option>
      <option value="Sonstiges kommunales Mandat">Sonstiges kommunales Mandat</option>
      <option value="Landesparlament">Landesparlament</option>
      <option value="Bundestag">Bundestag</option>
      <option value="Europaparlament">Europarlament</option>
      <option value="Sonstiges Mandat">Sonstiges Mandat</option>
    </select><br>

    <label for="title">Institution* (Anzeigenamen)<br><small>So bezeichnet sich die Institution selbst.</small></label><br>
    <input type="text" name="institution_display_name" value="<?php echo set_value('institution_display_name'); ?>" /><br />

    <label for="title">Fraktion <br><small></small></label><br>
    <input type="text" name="parliamentary_group" value="<?php echo set_value('parliamentary_group'); ?>" /><br />

    <label for="title">Mandatsbeginn* <br><small>Datum an dem das Mandat angetreten wird. Uhrzeit wird nicht berücksichtigt.</small></label><br>
    <input type="date" name="mandate_start"  value="<?php echo set_value('mandate_start'); ?>" /><br />

    <label for="title">Mandatsende* <br><small>Datum an dem das Mandat endet wird. Urhzeit wird nicht berücksichtigt.</small></label><br>
    <input type="date" name="mandate_end" value="<?php echo set_value('mandate_end'); ?>" /><br />

    <label for="title">Externer Link<br><small>1 Link (startet mit http:// oder https://) mit weiterführenden Informationen. Etwa Social Media Account, Website.</small></label><br>
    <input type="text" name="external_link"  value="<?php echo set_value('external_link'); ?>" /><br />
    
    <label for="title">Status <br><small>Status des Eintrags</small></label><br>
    <select name="status">
      <option value="<?php echo set_value('status'); ?>"><?php echo set_value('status'); ?></option>
      <option value="0">Wartet auf Freischaltung</option>
      <?php if ($this->ion_auth->in_group(['admin', 'superuser', 'acknowledged_user'])):?>
      <option value="1">Freigeschalten</option>
      <?php endif;?>
      <?php if ($this->ion_auth->in_group(['admin', 'superuser'])):?>
      <option value="2">Nicht sichtbar/gelöscht</option>
      <option value="3">Löschung beantragt</option>
      <?php endif;?>
    </select><br>
    
<br>
    <small class="text-danger">Beachte, dass du diesen Eintrag selbst nicht mehr löschen kannst, du kannst ihn lediglich ausblenden lassen. Eine vollständige Löschung übernehmen die Administratoren auf Anfrage.</small><br>
<br>


    <input type="submit" value="Eintragen" />

    </form>
    </div>
    </div>

</div>