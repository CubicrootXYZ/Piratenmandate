
<div class="container-fluid">
    <h2 class="text-centered padded">Registrieren</h2>
<div class="row single">
<div class="card">
<div class="card-header">
<p><?php echo lang('create_user_subheading');?></p>
</div>
<div class="card-body upl">

<?php if (strlen($message) > 1): ?>
<div class="alert alert-danger" role="alert" id="infoMessage">   
<?php echo $message;?>
</div>
<?php endif;?>

<?php echo form_open("auth/create_user");?>

      <p>
            <?php echo lang('create_user_fname_label', 'first_name');?> <br />
            <?php echo form_input($first_name);?>
      </p>

      <p>
            <?php echo lang('create_user_lname_label', 'last_name');?> <br />
            <?php echo form_input($last_name);?>
      </p>
      
      <?php
      if($identity_column!=='email') {
          echo '<p>';
          echo lang('create_user_identity_label', 'identity');
          echo '<br />';
          echo form_error('identity');
          echo form_input($identity);
          echo '</p>';
      }
      ?>

      <p>
            <?php echo lang('create_user_email_label', 'email');?> <br />
            <?php echo form_input($email);?>
      </p>

      <p>
            <?php echo lang('create_user_password_label', 'password');?> <br />
            <?php echo form_input($password);?>
      </p>

      <p>
            <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
            <?php echo form_input($password_confirm);?>
      </p>
      <p>
            <input type="checkbox" name="policy"> Hiermit stimme ich der <a target="_blank" href="/imprint">Datenschutzerklärung</a> zu.

      <br>
      <p>Nach der Anmeldung bitte die Mailadresse bestätigen in dem Sie auf den Link in der zugesendeten Mail klicken.</p>

      <p><?php echo form_submit('submit', lang('create_user_submit_btn'));?></p>

<?php echo form_close();?>
</div>
</div>
</div>

</div>