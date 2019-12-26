<div class="container-fluid">

    <h2 class="text-centered padded">Akte</h2>

<div class="row single">

    <div class="card">
        <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary"><?php echo html_escape($data[0]['title']); ?></h6>
        </div>
        <div class="card-body row">
        <div class="col-sm-12 mb-2">
            <?php echo html_escape($data[0]['description']); ?>
        </div>
        <div class="col-sm">
        <span><b>Institution: </b> <?php echo html_escape($data[0]['institution']); ?></span>
        </div>
        <div class="col-sm">
        <span><b>Bundesland: </b> <?php echo html_escape($data[0]['state_display_name']); ?></span>
        </div>
        <div class="col-sm">
        <span><b>Themenbereich: </b> <?php echo html_escape($data[0]['topic_display_name']); ?></span>
        </div>
        <div class="col-sm">
        <span><b>Datum: </b> <?php echo html_escape($data[0]['date']); ?></span>
        </div>
        <div class="col-sm">
        <span><b>Schlüsselwörter: </b> <?php echo html_escape($data[0]['keywords']); ?></span>
        </div>

        

        <div class="col-sm-12 mb-2" style="padding-top: 0.7rem;">
            <b>Angehängte Dateien:</b>
        </div>
        <div class="col-sm-12 mb-4">
                    

                    <?php foreach ($data as $file):?>
                    <?php if (file_exists('./uploads/'.$file['filename']) && strlen($file['filename']) > 0): ?>
                    <a target="_blank" href="/uploads/<?php echo html_escape($file['filename']); ?>"><i class="far fa-file"></i> <?php echo html_escape($file['file_display_name']); ?> (<?php echo html_escape($file['filesize']); ?> Kb)  <i class="fas fa-chevron-right"></i></a> 
                    <?php if($file['file_inserted_by'] == $this->ion_auth->get_user_id() || $this->ion_auth->in_group(['admin', 'superuser']) || $file['dossier_inserted_by'] == $this->ion_auth->get_user_id()):?>  
                    <a href="/managearchive/delete_file/<?php echo $file['file_id']?>"><small><i>Datei löschen</i></small></a>
                    <?php endif;?>
                    <br>
                    <?php endif;?>
                    <?php endforeach;?>

             
      </div>
      <div class="col-sm-12 mb-4">
                    

                    <div class="btn-group" role="group" aria-label="Basic example">
                              <?php if ($this->ion_auth->get_user_id() == $data[0]['inserted_by'] || $this->ion_auth->in_group(['admin', 'superuser', 'acknowledged_user'])): ?>
                               <a class="btn btn-info" href="/managearchive/upload_single/<?php echo $data[0]['dossier_id']; ?>">Datei hinzufügen <i class="fas fa-plus"></i></a>
                               <?php endif;?>
                               <?php if ($this->ion_auth->get_user_id() == $data[0]['inserted_by'] || $this->ion_auth->in_group(['admin', 'superuser'])): ?>
                               <a class="btn btn-outline-danger" href="/managearchive/delete/<?php echo $data[0]['dossier_id']; ?>">Löschen <i class="fas fa-trash-alt"></i></a>
                               <?php endif;?>
                             </div>
             
      </div>




        </div>
    </div>
</div>
</div>