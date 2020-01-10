

<html>
   <head>
      <title>Kommunalpiraten | <?php echo $title; ?></title>
      <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
      <!-- Theme CSS -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/sb-admin-2.min.css');?>" />
      <!-- Map CSS -->
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
      <link href="<?php echo base_url('css/all.css');?>" rel="stylesheet" type="text/css">
      <!-- jQuery -->
      <script src="<?php echo base_url('js/jquery-3.3.1.slim.min.js');?>" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <!-- Map js -->
      <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>
      <!-- Popper -->
      <script src="<?php echo base_url('js/popper.min.js');?>" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <!-- Bootstrap CSS and js -->
      <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css');?>">
      <script src="<?php echo base_url('js/bootstrap.min.js');?>" ></script>
      <!-- Custom CSS -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/custom.css');?>" />
   </head>
   <body>
      <!-- Page Wrapper -->
      <div id="wrapper">
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar toggled sidebar-dark accordion" id="accordionSidebar">
         <!-- Sidebar - Brand -->
         <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
            <div class="sidebar-brand-icon">
               <img src="<?php echo base_url('images/logo.png');?>">
            </div>
            <div class="sidebar-brand-text mx-3">Piratenmandate</div>
         </a>
         <!-- Divider -->
         <hr class="sidebar-divider my-0">
         <!-- Nav Item - Dashboard -->
         <li class="nav-item">
            <a class="nav-link" href="/">
            <i class="fas fa-fw fa-map-marked-alt"></i>
            <span>Home</span></a>
         </li>
         <!-- Divider -->
         <hr class="sidebar-divider">
         <!-- Heading -->
         <div class="sidebar-heading">
            Mandate
         </div>
         <!-- Nav Item - Dashboard -->
         <li class="nav-item">
            <a class="nav-link" href="/mandates/list">
            <i class="fas fa-fw fa-users"></i>
            <span>Mandatsliste</span></a>
         </li>
         <!-- Nav Item - Dashboard -->
         <li class="nav-item">
            <a class="nav-link" href="/mandates/stats">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Statistik</span></a>
         </li>
         <!-- Divider -->
         <hr class="sidebar-divider">
         <!-- Heading -->
         <div class="sidebar-heading">
            Dokumentenarchiv
         </div>
         <!-- Nav Item - Dashboard -->
         <li class="nav-item">
            <a class="nav-link" href="/archive/list">
            <i class="fas fa-fw fa-folder"></i>
            <span>Archiv</span></a>
         </li>
         <?php if ($this->ion_auth->in_group(['admin', 'superuser', 'acknowledged_user', 'members'])):?>
         <!-- Divider -->
         <hr class="sidebar-divider">
         <!-- Heading -->
         <div class="sidebar-heading">
            Mandate verwalten
         </div>
         <li class="nav-item">
            <a class="nav-link" href="/manage/mandate_new">
            <i class="fas fa-fw fa-user-plus"></i>
            <span>Neues Mandat</span></a>
         </li>
         <?php endif;?>
         <?php if ($this->ion_auth->in_group(['admin', 'superuser', 'acknowledged_user'])):?>
         <li class="nav-item">
            <a class="nav-link" href="/manage/mandate_acklist">
            <i class="fas fa-fw fa-check"></i>
            <span>Mandate freischalten</span></a>
         </li>
         <?php endif;?>
         <?php if ($this->ion_auth->in_group(['admin', 'superuser', 'acknowledged_user', 'members'])):?>
         <!-- Divider -->
         <hr class="sidebar-divider">
         <!-- Heading -->
         <div class="sidebar-heading">
            Dokumentenarchiv verwalten
         </div>
         <li class="nav-item">
            <a class="nav-link" href="/managearchive/upload">
            <i class="fas fa-fw fa-folder-plus"></i>
            <span>Neue Akte</span></a>
         </li>
         <?php endif;?>
         <?php if ($this->ion_auth->in_group(['admin', 'superuser'])):?>
         <!-- Divider -->
         <hr class="sidebar-divider">
         <!-- Heading -->
         <div class="sidebar-heading">
            Administration
         </div>
         <li class="nav-item">
            <a class="nav-link" href="/manage/mandate_list">
            <i class="fas fa-fw fa-list"></i>
            <span>Mandate bearbeiten</span></a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="/managearchive/list">
            <i class="fas fa-fw fa-list"></i>
            <span>Akten bearbeiten</span></a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="/managearchive/file_list">
            <i class="fas fa-fw fa-list"></i>
            <span>Dateien bearbeiten</span></a>
         </li>
         <!-- Nav Item - Dashboard -->
         <!-- Nav Item - Dashboard -->
         <li class="nav-item">
            <a class="nav-link" href="/manage/user_acklist">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Userübersicht</span></a>
         </li>
         <?php endif;?>
         <?php if ($this->ion_auth->in_group(['admin'])):?>
         <li class="nav-item">
            <a class="nav-link" href="/auth">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Alle User</span></a>
         </li>
         <?php endif;?>
         <!-- Divider -->
         <hr class="sidebar-divider">
         <!-- Nav Item - Dashboard -->
         <li class="nav-item">
            <a class="nav-link" href="/faq">
            <i class="fas fa-fw fa-question-circle"></i>
            <span>FAQ</span></a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="/imprint">
            <span>Impressum & Datenschutz</span></a>
         </li>
         <!-- Divider -->
         <hr class="sidebar-divider d-none d-md-block">
         <!-- Sidebar Toggler (Sidebar) -->
         <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
         </div>
      </ul>
      <!-- End of Sidebar -->
      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
      <!-- Topbar -->
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
         <!-- Sidebar Toggle (Topbar) -->
         <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
         <i class="fa fa-bars"></i>
         </button>
         <!-- Topbar Navbar -->
         <ul class="navbar-nav ml-auto">
            <?php if ($this->ion_auth->logged_in()):?>
            <li class="nav-item">
               <a class="nav-link " href="/auth/edit_user/<?php echo $this->ion_auth->get_user_id();?>" role="button" >
               <span class="mr-2 d-lg-inline text-gray-600 small">Profil bearbeiten</span>
               </a>
            </li>
            <div class="topbar-divider d-sm-block"></div>
            <li class="nav-item">
               <a class="nav-link" href="/auth/logout" role="button" >
               <span class="mr-2 d-lg-inline text-gray-600 small">Abmelden</span>
               </a>
            </li>
            <?php endif;?>
            <?php if (!$this->ion_auth->logged_in()):?>
            <li class="nav-item">
               <a class="nav-link " href="/auth/register" role="button" >
               <span class="mr-2 d-lg-inline text-gray-600 small">Registrieren</span>
               </a>
            </li>
            <div class="topbar-divider d-sm-block"></div>
            <li class="nav-item">
               <a class="nav-link" href="/auth/login" role="button" >
               <span class="mr-2 d-lg-inline text-gray-600 small">Anmelden</span>
               </a>
            </li>
            <?php endif;?>
         </ul>
      </nav>
      <!-- End of Topbar -->

