<div class="container-fluid">

    <form action="#" method="GET" class="searchform">

    <div class="col-sm">
    <label>Username</label><br>
    <input type="text" name="username" /> 
    </div>

    <div class="col-sm">
    <label>E-Mail</label><br>
    <input type="text" name="email" /> 
    </div>

    <div class="col-sm">
    <label>Zeige freigeschaltene User</label><br>
    <select name="ack">
        <option value="no">Nein</option>
        <option value="yes">Ja</option>
</select>
</div>

    <div class="col-sm">
    <input type="submit" class="btn btn-success" value="Suchen" />

<a href="/manage/user_acklist" class="btn btn-danger">Suche löschen</a>
</div>

</form>

    <div class="row single">

    <?php foreach($data as $entry):?>

        <div class="card">

                <div class="card-body">

                  <span><b>Username: </b> <?php echo html_escape($entry['username']); ?> (<?php echo html_escape($entry['first_name']); ?>, <?php echo html_escape($entry['last_name']); ?>)</span><br>
                  <span><b>E-Mail: </b> <?php echo html_escape($entry['email']); ?></span><br>
                 
                  <div class="btn-group" role="group" aria-label="Basic example">
                <?php if (!$this->ion_auth->in_group(['acknowledged_user'], $entry['users_id'])): ?>
                  <a class="btn btn-outline-success" href="/manage/user_ack/<?php echo $entry['users_id']; ?>">User freischalten<i class="fas fa-chevron-right"></i></a>
                <?php endif;?>
                <?php if ($this->ion_auth->in_group(['acknowledged_user'], $entry['users_id'])): ?>
                  <a class="btn btn-outline-danger" href="/manage/user_deack/<?php echo $entry['users_id']; ?>">Freischaltung aufheben<i class="fas fa-chevron-right"></i></a>
                <?php endif;?>
                <?php if ($entry['active'] != 1): ?>
                  <a class="btn btn-success" href="/manage/user_activate/<?php echo $entry['users_id']; ?>">User aktivieren<i class="fas fa-chevron-right"></i></a>
                  <?php endif;?>



                  </div>
                </div>
        </div>

    <?php endforeach; ?>

    </div>

</div>