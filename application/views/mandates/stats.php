<div class="container-fluid"> 
    <h2 class="text-centered padded">Statistik</h2>
    <div class="row">

        <div class="card card-single ">
            <div class="card-header orange-header">
            Anzahl Mandate nach Ebene
            </div>
        </div>

                <!-- card begin -->
                <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Europaabgeordnete</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $ep_mandates;?></div>
                            </div>
                            <div class="col">
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $ep_mandates_rel;?>%" aria-valuenow="<?php echo $ep_mandates_rel;?>" aria-valuemin="0" aria-valuemax="100"><?php echo round($ep_mandates_rel, 1);?>%</div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- card end -->

                <!-- card begin -->
                <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Bundestagsabgeordnete</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $bt_mandates;?></div>
                            </div>
                            <div class="col">
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $bt_mandates_rel;?>%" aria-valuenow="<?php echo $bt_mandates_rel;?>" aria-valuemin="0" aria-valuemax="100"><?php echo round($bt_mandates_rel, 1);?>%</div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- card end -->

                <!-- card begin -->
                <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Landtagssabgeordnete</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $lt_mandates;?></div>
                            </div>
                            <div class="col">
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $lt_mandates_rel;?>%" aria-valuenow="<?php echo $lt_mandates_rel;?>" aria-valuemin="0" aria-valuemax="100"><?php echo round($lt_mandates_rel, 1);?>%</div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- card end -->

                <!-- card begin -->
                <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-dark shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kommunale Mandate</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $local_mandates;?></div>
                            </div>
                            <div class="col">
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-dark" role="progressbar" style="width: <?php echo $local_mandates_rel;?>%" aria-valuenow="<?php echo $local_mandates_rel;?>" aria-valuemin="0" aria-valuemax="100"><?php echo round($local_mandates_rel, 1);?>%</div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- card end -->
        

        <div class="card card-single ">
            <div class="card-header orange-header">
            Anzahl Mandate nach Kategorien
            </div>
        </div>




            <!-- Project Card -->
            <div class="col-sm-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                    <h3 class="small text-primary font-weight-bold">Bundesland (kommunale Mandate)</h3>
                    <hr>
                    <?php foreach ($by_state as $name => $values):?>
                    <h4 class="small font-weight-bold"><?php echo $values['display_name'];?><span class="float-right"><?php echo $values['val'];?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: <?php echo $values['rel'];?>%" aria-valuenow="<?php echo $values['rel'];?>" aria-valuemin="0" aria-valuemax="100"><?php echo round($values['rel'], 1);?>%</div>
                    </div>
                    <?php endforeach;?>
                
                    </div>
                </div>
            </div>  
            <!-- end project card -->

              <!-- Project Card -->
            <div class="col-sm-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    <h3 class="small text-primary font-weight-bold">Institution</h3>
                    <hr>
                    <?php foreach ($by_institution as $values):?>
                    <h4 class="small font-weight-bold"><?php echo $values['display_name'];?><span class="float-right"><?php echo $values['val'];?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: <?php echo $values['rel'];?>%" aria-valuenow="<?php echo $values['rel'];?>" aria-valuemin="0" aria-valuemax="100"><?php echo round($values['rel'], 1);?>%</div>
                    </div>
                    <?php endforeach;?>

                    <h3 class="small text-primary font-weight-bold">Eingezogen über Liste/Partei</h3>
                    <hr>
                    <?php foreach ($by_list as $values):?>
                    <h4 class="small font-weight-bold"><?php echo $values['display_name'];?><span class="float-right"><?php echo $values['val'];?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: <?php echo $values['rel'];?>%" aria-valuenow="<?php echo $values['rel'];?>" aria-valuemin="0" aria-valuemax="100"><?php echo round($values['rel'], 1);?>%</div>
                    </div>
                    <?php endforeach;?>

                    <h3 class="small text-primary font-weight-bold">Fraktionspartner</h3>
                    <hr>
                    <?php foreach ($by_group as $values):?>
                    <h4 class="small font-weight-bold"><?php echo $values['display_name'];?><span class="float-right"><?php echo $values['val'];?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: <?php echo $values['rel'];?>%" aria-valuenow="<?php echo $values['rel'];?>" aria-valuemin="0" aria-valuemax="100"><?php echo round($values['rel'], 1);?>%</div>
                    </div>
                    <?php endforeach;?>

                    </div>
                </div>
            </div>
            <!-- end project card -->

            <!-- End big Card body -->



    </div>
</div>


