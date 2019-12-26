<div class="container-fluid"> 
    <h2 class="text-centered padded">Profil bearbeiten</h2>
<div class="row single">
<div class="card">
<div class="card-header">
<p><?php echo lang('edit_user_subheading');?></p>
</div>
<div class="card-body">

<?php if (strlen($message) > 1): ?>
<div class="alert alert-danger" role="alert" id="infoMessage">   
<?php echo $message;?>
</div>
<?php endif;?>

<?php echo form_open(uri_string());?>

      <p>
            <?php echo lang('edit_user_fname_label', 'first_name');?> <br />
            <?php echo form_input($first_name);?>
      </p>

      <p>
            <?php echo lang('edit_user_lname_label', 'last_name');?> <br />
            <?php echo form_input($last_name);?>
      </p>

      
            <?php// echo lang('edit_user_company_label', 'company');?> <br />
            <?php echo form_input($company);?>
      

      
            <?php// echo lang('edit_user_phone_label', 'phone');?> <br />
            <?php echo form_input($phone);?>
     

      <p>
            <?php echo lang('edit_user_password_label', 'password');?> <br />
            <?php echo form_input($password);?>
      </p>

      <p>
            <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?><br />
            <?php echo form_input($password_confirm);?>
      </p>

      <?php if ($this->ion_auth->is_admin()): ?>

          <h3><?php echo lang('edit_user_groups_heading');?></h3>
          <?php foreach ($groups as $group):?>
              <label class="checkbox">
              <?php
                  $gID=$group['id'];
                  $checked = null;
                  $item = null;
                  foreach($currentGroups as $grp) {
                      if ($gID == $grp->id) {
                          $checked= ' checked="checked"';
                      break;
                      }
                  }
              ?>
              <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
              <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
              </label>
          <?php endforeach?>

      <?php endif ?>

      <?php echo form_hidden('id', $user->id);?>
      <?php echo form_hidden($csrf); ?>

      <p><?php echo form_submit('submit', lang('edit_user_submit_btn'));?></p>

<?php echo form_close();?>


<div class="btn-group" role="group" aria-label="Basic example">
    <a class="btn btn-danger" href="/manage/user_delete/<?php echo $user->id;?>">Account vollständig löschen (Einträge bleiben erhalten) <i class="fas fa-trash-alt"></i></a>
    <a class="btn btn-danger" href="/manage/delete_all/<?php echo $user->id;?>">Alle Einträge vollständig löschen (Akten, Dateien, Mandatsträger). <i class="fas fa-trash-alt"></i></a>
    <a target="_blank" class="btn btn-outline-info" href="/manage/information/<?php echo $user->id;?>">Alle meine Daten maschinenlesbar einsehen <i class="fas fa-database"></i></a>
</div>
</div>
</div>
</div>

</div>