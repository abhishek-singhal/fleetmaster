<div class="content-wrapper">
    <section class="content-header">
        <h1>Past Event Details<small></small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $event_details->event_name;?></h3>
                        <div class="box-tools">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                Created By: <a href="<?php echo URL . 'user/profile/' . $event_details->user_id;?>" target="_blank"><?php echo $this->model->fetchUser($event_details->user_id)->steam_name;?></a>
                            </ul>
                        </div>
                    </div>
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt><div align="left">Event Name</div></dt>
                            <dd><?php echo $event_details->event_name;?></dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><div align="left">Server</div></dt>
                            <dd><?php echo $event_details->server;?></dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><div align="left">Source</div></dt>
                            <dd><?php echo $event_details->source;?></dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><div align="left">Destination</div></dt>
                            <dd><?php echo $event_details->destination;?></dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><div align="left">Time</div></dt>
                            <dd><?php echo (date("F j, Y H:i",$event_details->time));?> GMT</dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><div align="left">Trailer</div></dt>
                            <dd><?php echo $event_details->trailer;?></dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><div align="left">Route Map</div></dt>
                            <dd><?php if($event_details->route_map == '0'){ echo "Not Available"; }else{?><a href="<?php echo $event_details->route_map;?>" target="_blank">Click Here</a><?php }?></dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><div align="left">ETS2C.COM</div></dt>
                            <dd><?php if($event_details->event_page == '0'){ echo "Not Available"; }else{?><a href="<?php echo $event_details->event_page;?>" target="_blank">Click Here</a><?php }?></dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><div align="left">Additional Notes:</div></dt>
                            <dd><?php echo $event_details->notes;?></dd>
                        </dl>
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Event Details</h3>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th>Role</th>
                                <th>Status</th>
                            </tr>
                            <?php foreach ($event_roles AS $event_role){?>
                                <tr>
                                    <td><?php echo $this->model->fetchRole($event_role->role_id);?></td>
                                    <td><?php if($event_role->user_id != 0){echo $this->model->fetchUser($event_role->user_id)->steam_name;}else{?><span class="label label-warning">Not Assigned</span><?php }?></td>
                                </tr>
                            <?php }?>
                            <tr>
                                <td>Drivers</td>
                                <td>
                                    <?php foreach ($fetch_drivers AS $fetch_driver){ echo $this->model->fetchUser($fetch_driver->user_id)->steam_name;?><br><?php }?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Download Save</h3>
                    </div>
                    <div class="box-body">
                        <?php if($event_details->save_file != NULL){?>
                            Download Save File.
                        <?php }
                        else if($file_check == 1){?>
                            Download Save File.
                        <?php }else{?>
                            Save file is not available.
                        <?php }?>
                    </div>
                    <div class="box-footer">
                        <?php if($file_check == 1){?>
                            <button class="btn btn-danger pull-right"><a href="<?php echo URL . 'uploads/saves/fleet_master_' . $event_id . '.zip'?>" download><font color="white">Download</font></a></button>
                        <?php }?>
                        <?php if($event_details->save_file != NULL){?>
                            <span class="btn btn-danger pull-right"><a href="<?php echo $event_details->save_file;?>" target="_blank"><font color="white">Download</font></a></span>
                        <?php }?>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>