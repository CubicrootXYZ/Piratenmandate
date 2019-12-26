<div class="container-fluid">
    <h2 class="text-centered padded">Neue Datei hochladen</h2>
<div class="card">
  <div class="card-body upl">
    <?php echo validation_errors(); ?>

    <?php echo form_open_multipart('managearchive/upload_single/'.$id); ?>

    <label for="title">Datei<br><small>Akzeptierte Formate: PDF, JPG, PNG, TXT. Maximal 10 Mb.</small></label><br>
    <small class="text-danger">Achte darauf, dass das Dokument keine persönlichen Daten, etwa Namen, Adressen, Telefonnummern, enthält.<br> Auch der Dokumentennamen wird sichtbar sein.</small><br>
    <input type="file" name="userfile" value="<?php echo set_value('userfile'); ?>" /><br /><br>


    <input type="submit" value="Hochladen" />

    </form>
    </div>
    </div>

</div>