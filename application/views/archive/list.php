<div class="container-fluid">

<h2 class="text-centered padded">Dokumentenarchiv</h2>
<div class="row single">
<div class="card search">
  <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Suche</h6>
  </a>
<div class="collapse" id="collapseCardExample">
<div class="card-body">
    <form action="#" method="GET" class="searchform">

    <div class="col-sm">
    <label>Titel </label><br>
    <input type="text" name="title" value="<?php if (isset($_GET['title'])) {echo $_GET['title']; }?>" /> 
    </div>

    <div class="col-sm">
    <label>Schlüsselwörter </label><br>
    <input type="text" name="keywords" value="<?php if (isset($_GET['keywords'])) {echo $_GET['keywords']; }?>" /> 
    </div>


    <div class="col-sm">
    <label for="title">Bundesland </label><br>
    <select name="state_name">
      <option value="<?php if (isset($_GET['state_name'])) {echo $_GET['state_name']; }?>"><?php if (isset($_GET['state_name'])) {echo $_GET['state_name']; }?></option>
      <option value="">-</option>
      <?php foreach ($states as $value): ?>
        <option value="<?php echo($value['slug']);?>"><?php echo($value['display_name']);?></option>
      <?php endforeach;?>
    </select> 
    </div>

    <div class="col-sm">
    <label for="title">Themenbereich </label><br>
    <select name="topic">
      <option value="<?php if (isset($_GET['topic'])) {echo $_GET['topic']; }?>"><?php if (isset($_GET['topic'])) {echo $_GET['topic']; }?></option>
      <option value="">-</option>
      <?php foreach ($topics as $value): ?>
        <option value="<?php echo($value['slug']);?>"><?php echo($value['display_name']);?></option>
      <?php endforeach;?>
    </select> 
    </div>

    <div class="col-sm">
    <label>Sortieren nach </label><br>
    <select name="sort_by">
      <option value=""></option>
      <option value="title">Titel</option>
      <option value="institution">Institution</option>
      <option value="state_id">Bundesland</option>
      <option value="topic_id">Themenbereich</option>
      <option value="date">Datum</option>
    </select>  


    <select name="order">
      <option value="ASC">Aufsteigend</option>
      <option value="DESC">Absteigend</option>

    </select>
    </div>

<div class="col-sm">
<?php if ($this->ion_auth->logged_in()): ?>
    <label>Nur eigene Einträge</label>
    <input type="checkbox" value="yes" name="own"> 
    <?php endif;?>
    </div>

    <div class="col-sm-12">
    <input type="submit" value="Suchen" class="btn btn-success" />
    </div>

</form>
<div class="col-sm-12">
<a href="/archive/list" class="btn btn-danger">Suche löschen</a>
</div>

</div>
</div>
</div>
</div>

    <div class="row single">

    <?php foreach($data as $entry):?>
        <!-- Collapsable Card Example -->
        <div class="card shadow mb-1">
                <!-- Card Content - Collapse -->
                
                  <div class="card-body row">
                  <div class="col-sm-12">
                    <h5 class="m-0 font-weight-bold text-primary"><?php echo html_escape($entry['title']);?></h5>
                    </div>
                    <div class="col-sm">
                    <span><b>Institution: </b> <?php echo html_escape($entry['institution']); ?></span>
                    </div>
                    <div class="col-sm">
                    <span><b>Bundesland: </b> <?php echo html_escape($entry['state_display_name']); ?></span>
                    </div>
                    <div class="col-sm">
                    <span><b>Themenbereich: </b> <?php echo html_escape($entry['topic_display_name']); ?></span>
                    </div>
                    <div class="col-sm">
                    <span><b>Datum: </b> <?php echo html_escape($entry['date']); ?></span>
                    </div>
                    <div class="col-sm">
                    <span><b>Schlüsselwörter: </b> <?php echo html_escape($entry['keywords']); ?></span>
                    </div>
                    <div class="col-sm">
                    

                      <div class="btn-group" role="group" aria-label="Basic example">
                                <a class="btn btn-warning" href="/archive/dossier/<?php echo $entry['dossier_id']; ?>">Zur Akte <i class="fas fa-chevron-right"></i></a>
                                 <?php if ($this->ion_auth->get_user_id() == $entry['inserted_by'] || $this->ion_auth->in_group(['admin', 'superuser'])): ?>
                                 <a class="btn btn-outline-danger" href="/managearchive/delete/<?php echo $entry['dossier_id']; ?>">Löschen <i class="fas fa-trash-alt"></i></a>
                                 <?php endif;?>
                               </div>
               
                    </div>
                  
                
                  <br>
                  

                  </div>
                
        </div>

    <?php endforeach; ?>

    </div>

</div>