<div class="container-fluid">
    <h2 class="text-centered padded">Anmelden</h2>
<div class="row single">
<div class="card">
<div class="card-header">
<p><?php echo lang('login_subheading');?></p>
</div>
<div class="card-body">

<?php if (strlen($message) > 1): ?>
<div class="alert alert-danger" role="alert" id="infoMessage">   
<?php echo $message;?>
</div>
<?php endif;?>

<?php echo form_open("auth/login");?>

  <p>
    <?php echo lang('login_identity_label', 'identity');?>
    <?php echo form_input($identity);?>
  </p>

  <p>
    <?php echo lang('login_password_label', 'password');?>
    <?php echo form_input($password);?>
  </p>

  <p>
    <?php echo lang('login_remember_label', 'remember');?>
    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
  </p>


  <p><?php echo form_submit('submit', lang('login_submit_btn'));?></p>

<?php echo form_close();?>

<p><a class="btn btn-warning" href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>

</div>
</div>
</div>
</div>