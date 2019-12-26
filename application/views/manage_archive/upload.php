<div class="container-fluid">
    <h2 class="text-centered padded">Neue Akte anlegen</h2>
<div class="card">
  <div class="card-body upl">
    <?php echo validation_errors(); ?>
    <?php echo $errors; ?>

    <?php echo form_open_multipart('managearchive/upload'); ?>

    <label for="title">Titel* <br><small>Titel der Akte.</small></label><br>
    <input type="text" name="title" value="<?php echo set_value('title'); ?>" /><br />

    <label for="title">Beschreibung <br><small>Ausführliche Beschreibung der Akte.</small></label><br>
    <textarea name="desc" value="<?php echo set_value('desc'); ?>" /></textarea><br />

    <label for="title">Institution <br><small>Institution in der die Akte behandelt wurde (Gemeinderat Ulm, Landtag NRW, ...). </small></label><br>
    <input type="text" name="institution" value="<?php echo set_value('institution'); ?>" /><br />

    <label for="title">Bundesland <br><small>Bundesland der Institution.</small></label><br>
    <select name="state_name">
      <option value="<?php echo set_value('state_name'); ?>"><?php echo set_value('state_name'); ?></option>
      <?php foreach ($states as $value): ?>
        <option value="<?php echo($value['slug']);?>"><?php echo($value['display_name']);?></option>
      <?php endforeach;?>
    </select> <br>

    <label for="title">Themenbereich <br><small>Themenbereich in dem die Akte zu verorten ist.</small></label><br>
    <select name="topic">
      <option value="<?php echo set_value('topic'); ?>"><?php echo set_value('topic'); ?></option>
      <?php foreach ($topics as $value): ?>
        <option value="<?php echo($value['slug']);?>"><?php echo($value['display_name']);?></option>
      <?php endforeach;?>
    </select> <br>

    <label for="title">Schlüsselwörter<br><small>Bitte seperiert mit Komma.</small></label><br>
    <input type="text" name="keywords" value="<?php echo set_value('keywords'); ?>" /><br />

    <label for="title">Datum der Akte<br><small>Relevantes Datum für die Akte.</small></label><br>
    <input type="date" name="date" value="<?php echo set_value('date'); ?>" /><br />    


    <label for="title">Datei<br><small>Akzeptierte Formate: PDF, JPG, PNG, TXT. Maximal 10 Mb.</small></label><br>
    <small class="text-danger">Achte darauf, dass das Dokument keine persönlichen Daten, etwa Namen, Adressen, Telefonnummern, enthält. <br> Auch der Dokumentennamen wird sichtbar sein.</small><br>
    <input type="file" name="userfile" value="<?php echo set_value('userfile'); ?>" /><br />

    <p>Weitere Dokumente können später hinzugefügt werden.</p>    




    <input type="submit" value="Eintragen" />

    </form>
    </div>
    </div>

</div>