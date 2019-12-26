<div class="container-fluid">
    <h2 class="text-centered padded">Mandatsträger</h2>

    <div class="row single">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary"><?php echo $data['institution']; ?>: <?php echo $data['name']; ?></h6>
                </div>
                <div class="card-body row">
                <div class="col-sm-12 mb-2">
                  <span><b>Name: </b> <?php echo $data['name']; ?></span><br>
                  </div>
                  <div class="col-sm-12 mb-2">
                  <span><b>Institution: </b> <?php echo $data['institution']; ?>, <?php echo $data['institution_display_name']; ?></span><br>
                  </div>
                  <div class="col-sm-12 mb-2">
                  <span><b>Ort: </b> <?php echo $data['city_name']; ?></span><br>
                  </div>
                  <div class="col-sm-12 mb-2">
                  <span><b>Bundesland: </b> <?php echo $data['state_name']; ?></span><br>
                  </div>
                  <div class="col-sm-12 mb-2">
                  <span><b>Fraktion: </b> <?php echo $data['parliamentary_group']; ?></span><br>
                  </div>
                  <hr>
                  <div class="col-sm-12 mb-2">
                  <span><b>Wahlergebnis: </b> <?php echo $data['election_result']; ?> %</span><br>
                  </div>
                  <div class="col-sm-12 mb-2">
                    <span><b>Angetreten auf Liste/für Partei: </b> <?php echo $data['election_list']; ?></span><br>
                    </div>
                    <div class="col-sm-12 mb-2">
                      <span><b>Mandats-Begin: </b> <?php echo explode(" ", $data['mandate_start'])[0]; ?></span><br>
                      </div>
                      <div class="col-sm-12 mb-2">
                      <span><b>Mandats-Ende: </b> <?php echo explode(" ", $data['mandate_end'])[0]; ?></span><br>
                      </div>
                      <br>
                      <div class="col-sm-12 mb-2">
                  <?php if (strlen($data['external_link']) > 2 && strpos($data['external_link'], 'http') !== false) {
                      echo '<a targeT="_blank" class="btn btn-warning" href="'.$data['external_link'].'">Mehr zum Mandat <i class="fas fa-external-link-alt"></i></a>';
                  } ?>
                    </div>
                <div class="col-sm-12" style="margin-top: 0.4rem;">
                    

                    <div class="btn-group" role="group" aria-label="Basic example">
                    
                    <?php if ($this->ion_auth->in_group(['admin', 'superuser']) || $data['inserted_by'] == $this->ion_auth->get_user_id()): ?>
                    <a class="btn btn-outline-primary" href="/manage/mandate_edit/<?php echo html_escape($data['mandate_id']); ?>">Eintrag bearbeiten <i class="fas fa-chevron-right"></i></a>
                    <a class="btn btn-outline-danger" href="/manage/mandate_remove/<?php echo html_escape($data['mandate_id']); ?>">Eintrag entfernen <i class="fas fa-chevron-right"></i></a>
                    <?php endif;?>
                    <?php if ($this->ion_auth->in_group(['admin', 'superuser'])): ?>
                    <a  class="btn btn-danger" href="/manage/mandate_delete/<?php echo html_escape($data['mandate_id']); ?>">Eintrag endgültig löschen <i class="fas fa-chevron-right"></i></a>
                    <?php endif;?>
                    </div>
                  
                </div>

        </div>
    </div>


</div>