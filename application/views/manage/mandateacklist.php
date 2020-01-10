<div class="container-fluid">
<h2 class="text-centered padded">Mandat freischalten</h2>
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
    <input type="text" name="name" value="<?php if (isset($_GET['name'])) {echo html_escape($_GET['name']); }?>" /> 
    </div>

    <div class="col-sm">
    <label>Fraktion</label><br>
    <input type="text" name="parliamentary_group" value="<?php if (isset($_GET['parliamentary_group'])) {echo html_escape($_GET['parliamentary_group']); }?>" /> 
    </div>

    <div class="col-sm">
    <label>Institution</label><br>
    <select name="institution">
    <option value="<?php if (isset($_GET['institution'])) {echo html_escape($_GET['institution']); }?>"><?php if (isset($_GET['institution'])) {echo html_escape($_GET['institution']); }?></option>
      <option value="">-</option>
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
    <input type="text" name="city" value="<?php if (isset($_GET['city'])) {echo html_escape($_GET['city']); }?>" /> 
    </div>

    <div class="col-sm">
    <label>Postleitzahl</label><br>
    <input type="text" name="postal_code" value="<?php if (isset($_GET['postal_code'])) {echo html_escape($_GET['postal_code']); }?>" /> 
    </div>

    <div class="col-sm">
    <label>Bundesland</label><br>
     <select name="state">
     <option value="<?php if (isset($_GET['state'])) {echo html_escape($_GET['state']); }?>"><?php if (isset($_GET['state'])) {echo html_escape($_GET['state']); }?></option>
      <option value="">-</option>
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
    <label>Sortieren nach </label><br>
    <select name="sort_by">
    <option value="<?php if (isset($_GET['sort_by'])) {echo html_escape($_GET['sort_by']); }?>"><?php if (isset($_GET['sort_by'])) {echo html_escape($_GET['sort_by']); }?></option>
      <option value="">-</option>
      <option value="name">Name</option>
      <option value="parliamentary_group">Fraktion</option>
      <option value="ci_foreign_states.display_name">Bundesland</option>
      <option value="ci_cities.display_name">Stadt/Ort</option>
      <option value="mandate_start">Mandat Anfang</option>
      <option value="mandate_end">Mandat Ende</option>
      <option value="institution">Institution</option>
    </select>

    <select name="order">
    <option value="<?php if (isset($_GET['order'])) {echo html_escape($_GET['order']); }?>"><?php if (isset($_GET['order'])) {echo html_escape($_GET['order']); }?></option>
      <option value="ASC">Aufsteigend</option>
      <option value="DESC">Absteigend</option>
    </select>
    </div>

    <div class="col-sm-12">
    <input type="submit" value="Suchen" class="btn btn-success" />
    </div>

</form>
<div class="col-sm-12">
<a href="/manage/mandate_acklist" class="btn btn-danger">Suche löschen</a>
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

                  <div class="col-sm mb-2">
                  <span><b>Name: </b> <?php echo $entry['name']; ?></span><br>
                  </div>
                  <div class="col-sm mb-2">
                  <span><b>Institution: </b> <?php echo $entry['institution']; ?>, <?php echo $entry['institution_display_name']; ?></span><br>
                  </div>
                  <div class="col-sm mb-2">
                  <span><b>Ort: </b> <?php echo $entry['city_name']; ?></span><br>
                  </div>
                  <div class="col-sm mb-2">
                  <span><b>Bundesland: </b> <?php echo $entry['state_name']; ?></span><br>
                  </div>
                  <div class="col-sm mb-2">
                  <span><b>Fraktion: </b> <?php echo $entry['parliamentary_group']; ?></span><br>
                  </div>
                  

                  <div class="col-sm-12" style="margin-top: 0.4rem;">
                                 
                  <a class="btn btn-outline-success" href="/manage/mandate_ack/<?php echo $entry['mandate_id']; ?>">Freischalten <i class="fas fa-chevron-right"></i></a>
                  <?php if ($this->ion_auth->in_group(['admin', 'superuser'])): ?>
                  <a class="btn btn-danger" href="/manage/mandate_delete/<?php echo $entry['mandate_id']; ?>">Eintrag endgültig löschen <i class="fas fa-chevron-right"></i></a>
                  <?php endif;?>
                </div>
</div>
        </div>
        </div>

    <?php endforeach; ?>

    </div>

</div>