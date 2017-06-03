<div class="content-wrapper">
	<section class="content-header">
		<h1>Event Details<small></small></h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-4">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo $event_details->event_name;?></h3>
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
							<dd><?php if($event_details->route_map == '0'){ echo "Coming Soon"; }else{?><a href="<?php echo $event_details->route_map;?>" target="_blank">Click Here</a><?php }?></dd>
						</dl>
						<dl class="dl-horizontal">
							<dt><div align="left">ETS2C.COM</div></dt>
							<dd><?php if($event_details->event_page == '0'){ echo "Coming Soon"; }else{?><a href="<?php echo $event_details->event_page;?>" target="_blank">Click Here</a><?php }?></dd>
						</dl>
                        <dl class="dl-horizontal">
                            <dt><div align="left">Additional Notes:</div></dt>
                            <dd><?php echo $event_details->notes;?></dd>
                        </dl>
					</div>
				</div>
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Download Save</h3>
					</div>
					<div class="box-body">
						<?php if($event_details->save_file != NULL){?>
							Save file is available for download.
						<?php }
						else if($file_check == 1){?>
							Save file is available for download.
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
			
			<div class="col-md-4">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Event Details</h3>
                        <div class="box-tools">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                Created By: <a href="<?php echo URL . 'user/profile/' . $event_details->user_id;?>" target="_blank"><?php echo $this->model->fetchUser($event_details->user_id)->steam_name;?></a>
                            </ul>
                        </div>
					</div>
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover table-bordered">
							<tr>
								<th>Role</th>
								<th>Status</th>
							</tr>
							<?php foreach ($event_roles AS $event_role){?>
							<tr>
								<td><?php echo $this->model->fetchRole($event_role->role_id);?><?php if($event_role->user_id != 0){?><?php if($event_role->confirm == 0){?><i class="fa fa-times pull-right" title="Not Confirmed"></i><?php }else if($event_role->confirm == 1){?><i class="fa fa-check pull-right" title="Confirmed"></i><?php }}?></td>
								<td><?php if($event_role->user_id != 0){echo $this->model->fetchUser($event_role->user_id)->steam_name;?><?php if($rank>1){?><a href="<?php echo URL . 'user/deleterole/' . $event_id . '-' . $event_role->role_id;?>" title="Delete" class="pull-right"><span class="label label-danger"><i class="fa fa-trash-o"></i></span></a><?php if($event_role->confirm == 0){?><a href="<?php echo URL . 'user/confirm/' . $event_id . '-' . $event_role->role_id;?>" title="Confirm" class="pull-right"><span class="label label-success"><i class="fa fa-check-circle"></i></span></a><?php }else if($event_role->confirm == 1){?><a href="<?php echo URL . 'user/unconfirm/' . $event_id . '-' . $event_role->role_id;?>" title="Unconfirm" class="pull-right"><span class="label label-warning"><i class="fa fa-ban"></i></span></a><?php }}?><?php }else{?><span class="label label-success">Available</span><?php }?></td>
							</tr>
							<?php }?>
							<tr><form method="POST" action="">
								<td>Drivers<br><?php if($safety_check->count_role == 0 && $this->model->checkDriver($event_id, $_SESSION['user_id'])->count_drivers == 0){?><button class="btn btn-danger btn-xs" name="register_driver">Become Driver</button><?php }?>
								<?php if($this->model->checkDriver($event_id, $_SESSION['user_id'])->count_drivers != 0){?><button class="btn btn-danger btn-xs" name="remove_driver">Delete Role</button><?php }?>
								</td>
								<td>
                                    <?php $outputs = $this->model->fetchDrivers($event_id);?><?php foreach ($outputs AS $output){ echo $this->model->fetchUser($output->user_id)->steam_name;?><?php if($rank>1){?><a href="<?php echo URL . 'user/deletedriver/' . $event_id . '-' . $output->user_id;?>" title="Delete" class="pull-right"><span class="label label-danger"><i class="fa fa-trash-o"></i></span></a><br><?php }}?>
                                </td>
							</form>
							</tr>
						</table>
					</div>
				</div>
			</div>
			
			<div class="col-md-4">
				<?php if($this->model->checkDriver($event_id, $_SESSION['user_id'])->count_drivers == 0){?>
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Your Role</h3>
						<div class="box-tools">
							<ul class="pagination pagination-sm no-margin pull-right">
								<?php if($this->model->findUserRole($event_id, $_SESSION['user_id'])->role_id == NULL){ echo "None";}else{echo $this->model->fetchRole($this->model->findUserRole($event_id, $_SESSION['user_id'])->role_id);}?>
							</ul>
						</div>
					</div>
					<form action="" method="POST">
					<div class="box-body">
						<div class="form-group">
							<label>Choose a Role</label>
							<select class="form-control select2" name="role">
								<?php foreach ($available_roles AS $available_role){?>
								<option value="<?php echo $available_role->role_id;?>" <?php if($available_role->user_id != 0){?>disabled="disabled"<?php }?>><?php echo $available_role->role_name;?></option>
								<?php }?>
							</select>
						</div>
						<?php if(isset($message1)){
							echo $message1;
						}?>
					</div>
					<div class="box-footer">
						<?php if($safety_check->count_role != 0){?>
							<button type="submit" class="btn btn-danger" name="remove_role">Delete Role</button>
						<?php }?>
						<button type="submit" class="btn btn-danger pull-right" name="pick_role">Submit</button>
					</div>
					</form>
				</div>
				<?php }?>
                <?php if($rank > 1){?>
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Give Role</h3>
                        </div>
                        <form action="" method="POST">
                    <div class="box-body">
                        <div class="form-group">
                            <select class="form-control select2" name="role">
                                <option value="0">SELECT ROLE</option>
                                <?php foreach ($available_roles AS $available_role){?>
                                    <option value="<?php echo $available_role->role_id;?>" <?php if($available_role->user_id != 0){?>disabled="disabled"<?php }?>><?php echo $available_role->role_name;?></option>
                                <?php }?>
                                <option value="20">Driver</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control select2" name="user">
                                <option value="0">SELECT MEMBER</option>
                                <?php foreach ($all_members AS $member){?>
                                    <option value="<?php echo $member->user_id;?>"><?php echo $member->steam_name;?></option>
                                <?php }?>
                            </select>
                        </div>
                        <?php if(isset($showmessage)){
                            echo $showmessage;
                        }?>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-danger pull-right" name="give_role">Submit</button>
                    </div>
                        </form>
                    </div>
                <?php }?>
				<?php if($event_details->user_id == $_SESSION['user_id'] || $rank>1){?>
				<?php if($event_details->save_file == NULL){?>
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Upload Save File</h3>
						<div class="box-tools">
						</div>
					</div>
					<form method="POST" action="" enctype="multipart/form-data">
						<div class="box-body">
							<?php if($file_check == 0){?>
							<div class="form-group">
								<input type="file" name="save_file">
								Only zip files allowed. Size limit 128 MB.
							</div>
							<?php }?>
							<?php if(isset($message)){
								echo $message;
							}?>
							<?php if($file_check == 1){?>
							Save File has been uploaded.
							<?php }?>
						</div>
						<div class="box-footer">
							<?php if($file_check == 0){?>
							<button class="btn btn-danger pull-right" name="upload_save">Upload</button><?php }else{?>
							<button class="btn btn-danger pull-right" name="delete_save">Delete File</button><?php }?>
						</div>
					</form>
				</div>
				<?php }?>
				<?php if($file_check == 0){?>
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Enter Direct Download Link</h3>
					</div>
					<form method="POST" action="">
						<div class="box-body">
							<?php if($event_details->save_file == NULL){?>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Enter Direct Download Link" name="save_link" required>
							</div>
							<?php }else{?>
							<a href="<?php echo $event_details->save_file;?>" target = "_blank"><?php echo $event_details->save_file;?></a>
							<?php }?>
							
						</div>
						<div class="box-footer">
							<?php if($event_details->save_file == NULL){?>
							<button class="btn btn-danger pull-right" name="submit_link">Submit</button><?php }else{?>
							<button class="btn btn-danger" name="remove_link">Remove Link</button><?php }?>
						</div>
					</form>
				</div>
				<?php }}?>
			</div>
			
		</div>
	</section>
</div>