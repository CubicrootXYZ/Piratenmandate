<div class="container-fluid">

<h2 class="text-centered padded">Dokumentenarchiv Dateiliste</h2>
<div class="row single">
<div class="card search">
  <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Suche</h6>
  </a>
<div class="collapse" id="collapseCardExample">
<div class="card-body">
    <form action="#" method="GET" class="searchform">

    <div class="col-sm">
    <label>Username </label><br>
    <input type="text" name="username" value="<?php if (isset($_GET['username'])) {echo $_GET['username']; }?>" /> <br>
    </div>

    <div class="col-sm">
    <label>Userid </label><br>
    <input type="number" name="userid" value="<?php if (isset($_GET['userid'])) {echo $_GET['userid']; }?>" /> <br>
    </div>

    <div class="col-sm">
    <label>Dateiname </label><br>
    <input type="text" name="filename" value="<?php if (isset($_GET['filename'])) {echo $_GET['filename']; }?>" /> <br>
    </div>

    <div class="col-sm-12">
    <input type="submit" value="Suchen" class="btn btn-success" />
    </div>

</form>
<div class="col-sm-12">
<a href="/managearchive/file_list" class="btn btn-danger">Suche löschen</a>
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
                    <h5 class="m-0 font-weight-bold text-primary"><?php echo html_escape($entry['file_display_name']);?></h5>
                    </div>
                    <div class="col-sm">
                    <span><b>Eingetragen von: </b> <?php echo html_escape($entry['username']); ?> (<?php echo html_escape($entry['user_id']); ?>)</span>
                    </div>
                    <div class="col-sm">
                    <span><b>Dateiname: </b> <?php echo html_escape($entry['file_display_name']); ?></span>
                    </div>
                    <div class="col-sm">
                    <span><b>Dateityp: </b> <?php echo html_escape($entry['filetype']); ?></span>
                    </div>
                    <div class="col-sm">
                    <span><b>Dateigröße: </b> <?php echo html_escape($entry['filesize']); ?> Kb</span>
                    </div>

                    

                      <div class="btn-group" role="group" aria-label="Basic example">
                                 <?php if ($this->ion_auth->get_user_id() == $entry['inserted_by'] || $this->ion_auth->in_group(['admin', 'superuser'])): ?>
                                 <a class="btn btn-outline-danger" href="/managearchive/delete_file_admin/<?php echo $entry['file_id']; ?>">Löschen <i class="fas fa-trash-alt"></i></a>
                                 <?php endif;?>
                               </div>
               
                    </div>
                  
                
                  
                  

                  
                
        </div>

    <?php endforeach; ?>

    </div>

    <?php echo form_open("managearchive/bulk_delete_file");?>
<input type="hidden" name="bulk_delete" value="<?php foreach($data as $entry){echo $entry['file_id'].',';}?>">

<?php if($_SERVER['REQUEST_METHOD'] === 'GET'): ?>
<p><input type="checkbox" required> Alle Einträge löschen?</p>
<p><input type="submit" value="Alle Einträge löschen" class="btn btn-danger"></p>
<?php endif;?>
<?php echo form_close();?>

</div>