<div class="container-fluid">
  <h2 class="text-centered padded">Mandatsträger bearbeiten</h2>
<div class="row single">
<div class="card search">
  <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Suche</h6>
  </a>
<div class="collapse" id="collapseCardExample">
<div class="card-body">
    <form action="#" method="GET" class="searchform">

    <div class="col-sm">
    <label>Name</label><br>
    <input type="text" name="name" /> 
    </div>

    <div class="col-sm">
    <label>Username </label><br>
    <input type="text" name="username" value="<?php if (isset($_GET['username'])) {echo $_GET['username']; }?>" /> <br>
    </div>

    <div class="col-sm">
    <label>Userid </label><br>
    <input type="number" name="userid" value="<?php if (isset($_GET['userid'])) {echo $_GET['userid']; }?>" /> <br>
    </div>

    <div class="col-sm">
    <label>Fraktion</label><br>
    <input type="text" name="parliamentary_group" /> 
    </div>

    <div class="col-sm">
    <label>Institution</label><br>
    <select name="institution">
      <option value=""></option>
      <option value="Gemeinderat">Gemeinderat</option>
      <option value="Kreistag">Kreistag</option>
      <option value="Bürgermeister">Bürgermeister</option>
      <option value="Sonstiges kommunales Mandat">Sonstiges kommunales Mandat</option>
      <option value="Landesparlament">Landesparlament</option>
      <option value="Bundestag">Bundestag</option>
      <option value="Europaparlament">Europarlament</option>
      <option value="Sonstiges Mandat">Sonstiges Mandat</option>
    </select>
    </div>

    <div class="col-sm">
    <label>Stadt/Ort</label><br>
    <input type="text" name="city" /> 
    </div>

    <div class="col-sm">
    <label>Postleitzahl</label><br>
    <input type="text" name="postal_code" /> 
    </div>

    <div class="col-sm">
    <label>Bundesland</label><br>
     <select name="state">
      <option value=""></option>
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
    </select> 
    </div>

<div class="col-sm">   
    <label>Status </label><br>
    <select name="status">
      <option value=""></option>
      <option value="0">Wartet auf Freischaltung (0)</option>
      <option value="1">Freigeschalten (1)</option>
      <?php if ($this->ion_auth->in_group(['admin', 'superuser'])): ?>
      <option value="2">Gelöscht (2)</option>
      <option value="3">Löschung beantragt (3)</option>
        <?php endif;?>

    </select>
    </div>

    <div class="col-sm">
    <label>Sortieren nach </label><br>
    <select name="sort_by">
      <option value=""></option>
      <option value="name">Name</option>
      <option value="parliamentary_group">Fraktion</option>
      <option value="ci_foreign_states.display_name">Bundesland</option>
      <option value="ci_cities.display_name">Stadt/Ort</option>
      <option value="mandate_start">Mandat Anfang</option>
      <option value="mandate_end">Mandat Ende</option>
      <option value="institution">Institution</option>
    </select>

    <select name="order">
      <option value="ASC">Aufsteigend</option>
      <option value="DESC">Absteigend</option>
    </select>
    </div>

    <div class="col-sm">
    <label>Ausgelaufene Mandate anzeigen </label><br>
    <select name="old_mandates">
        <option value="no">Nein</option>
        <option value="yes">Ja</option>
    </select>
    </div>

    <div class="col-sm-12">
    <input type="submit" value="Suchen" class="btn btn-success" />
    </div>

</form>
<div class="col-sm-12">
<a href="/manage/mandate_list" class="btn btn-danger">Suche löschen</a>
</div>

</div>
</div>
</div>
</div>


    <div class="row single">

    <?php foreach($data as $entry):?>
<!-- Collapsable Card Example -->
<div class="card shadow mb-1 <?php if ($entry['institution'] == 'Europaparlament'):?>bg-lightred<?php endif;?> <?php if ($entry['institution'] == 'Bundestag'):?>bg-lightblue<?php endif;?> <?php if (in_array($entry['institution'], ['Sonstiges kommunales Mandat', 'Bürgermeister', 'Kreistag', 'Gemeinderat'])):?>bg-lightgrey<?php endif;?> <?php if (in_array($entry['institution'], ['Sonstiges Mandat', 'Landesparlament'])):?>bg-lightgreen<?php endif;?>">
             <div class="card-body row">
                  <div class="col-sm-12 mb-2">
                    <h5 class="m-0 font-weight-bold text-primary"><?php echo html_escape($entry['state_name']);?>, <?php echo html_escape($entry['institution_display_name']);?>, <?php echo html_escape($entry['name']);?></h5>
                    </div>

                  <div class="col-sm-2 mb-2">
                  <span><b>Eintrag von: </b> <?php echo $entry['username']; ?>  (<?php echo html_escape($entry['user_id']); ?>)</span><br>
                  </div>
                  <div class="col-sm-2 mb-2">
                  <span><b>Name: </b> <?php echo $entry['name']; ?></span><br>
                  </div>
                  <div class="col-sm-2 mb-2">
                  <span><b>Institution: </b> <?php echo $entry['institution']; ?>, <?php echo $entry['institution_display_name']; ?></span><br>
                  </div>
                  <div class="col-sm-2 mb-2">
                  <span><b>Ort: </b> <?php echo $entry['city_name']; ?></span><br>
                  </div>
                  <div class="col-sm-2 mb-2">
                  <span><b>Bundesland: </b> <?php echo $entry['state_name']; ?></span><br>
                  </div>
                  <div class="col-sm-2 mb-2">
                  <span><b>Fraktion: </b> <?php echo $entry['parliamentary_group']; ?></span><br>
                  </div>
                  <div class="col-sm-2 mb-2">
                  <span><b>Eingezogen über: </b> <?php echo $entry['election_list']; ?></span><br>
                  </div>
                  <div class="col-sm-2 mb-2">
                  <span><b>Wahlergebnis: </b> <?php echo $entry['election_result']; ?></span><br>
                  </div>
                  <div class="col-sm-2 mb-2">
                  <span><b>Mandat-Anfang: </b> <?php echo $entry['mandate_start']; ?></span><br>
                  </div>
                  <div class="col-sm-2 mb-2">
                  <span><b>Mandat-Ende: </b> <?php echo $entry['mandate_end']; ?></span><br>
                  </div>
                  <div class="col-sm-2 mb-2">
                  <span><b>Erstellt: </b> <?php echo $entry['insertdatetime']; ?></span><br>
                  </div>
                  <div class="col-sm-2 mb-2">
                  <span><b>Link: </b> <?php echo $entry['external_link']; ?></span><br>
                  </div>
                  

                  <div class="col-sm-12" style="margin-top: 0.4rem;">
                    

                  <div class="btn-group" role="group" aria-label="Basic example">
                  <a target="_blank" class="btn btn-warning" href="/mandates/single/<?php echo html_escape($entry['mandate_id']); ?>">Zum Mandatsträger <i class="fas fa-chevron-right"></i></a>
                  <?php if ($this->ion_auth->in_group(['admin', 'superuser']) || $entry['inserted_by'] == $this->ion_auth->get_user_id()): ?>
                  <a class="btn btn-outline-primary" href="/manage/mandate_edit/<?php echo html_escape($entry['mandate_id']); ?>">Eintrag bearbeiten <i class="fas fa-chevron-right"></i></a>
                  <a class="btn btn-outline-danger" href="/manage/mandate_remove_admin/<?php echo html_escape($entry['mandate_id']); ?>">Eintrag entfernen <i class="fas fa-chevron-right"></i></a>
                  <?php endif;?>
                  <?php if ($this->ion_auth->in_group(['admin', 'superuser'])): ?>
                  <a  class="btn btn-danger" href="/manage/mandate_delete_admin/<?php echo html_escape($entry['mandate_id']); ?>">Eintrag endgültig löschen <i class="fas fa-chevron-right"></i></a>
                  <?php endif;?>
                  </div>

                  </div>
        </div>
        </div>

    <?php endforeach; ?>

    </div>

    <?php echo form_open("manage/bulk_delete");?>
<input type="hidden" name="bulk_delete" value="<?php foreach($data as $entry){echo $entry['mandate_id'].',';}?>">


<?php if($_SERVER['REQUEST_METHOD'] === 'GET'): ?>
<p><input type="checkbox" required> Alle Einträge löschen?</p>
<p><input type="submit" value="Alle Einträge löschen" class="btn btn-danger"></p>
<?php endif;?>

<?php echo form_close();?>

</div>