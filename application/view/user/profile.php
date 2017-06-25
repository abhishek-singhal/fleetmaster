<div class="content-wrapper">
	<section class="content-header">
		<h1>Profile<small></small></h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-3">
				<div class="box box-primary">
					<div class="box-body box-profile">
						<img class="profile-user-img img-responsive img-circle" src="<?php echo $profile->avatar;?>" alt="User profile picture">
						<h5 class="profile-username text-center"><?php echo $profile->steam_name;?></h5>
						<p class="text-muted text-center">
							<?php if($profile->rank > 1){echo "Admin<br>";}?>
              <?php if($profile->rank == 0){echo "Guest";}else{if($profile->role == NULL){echo "Member";}else{echo $profile->role;}}?>

            </p>
						<ul class="list-group list-group-unbordered">
							<li class="list-group-item"><b>Hours Played</b> <a class="pull-right"><?php echo $playtime;?></a></li>
							<!--<li class="list-group-item"><b>Followers</b> <a class="pull-right"></a></li>
							<li class="list-group-item"><b>Following</b> <a class="pull-right"></a></li>
						</ul>
						<button class="btn btn-primary btn-block"><b>Coming Soon!</b>-->
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#info" data-toggle="tab">Information</a></li>
						<?php if($rank>1){?>
						<li><a href="#settings" data-toggle="tab">Settings</a></li>
						<?php }?>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="info">
							<dl class="dl-horizontal">
								<dt><div align="left">Steam Profile</div></dt>
								<dd><a href="<?php echo $profile_url;?>" target="_blank"><?php echo $profile_url;?></a></dd>
							</dl>
							<?php if($rank>1){?>
							<dl class="dl-horizontal">
								<dt><div align="left">Steam ID</div></dt>
								<dd><?php echo $profile->steam_id;?></dd>
							</dl>
							<dl class="dl-horizontal">
								<dt><div align="left">Previous Bans</div></dt>
								<dd><a href="<?php echo 'https://api.truckersmp.com/v2/bans/' . $profile->steam_id;?>" target="_blank">Click Here</a></dd>
							</dl>
							<?php }?>
							<dl class="dl-horizontal">
								<dt><div align="left">Joining Date</div></dt>
								<dd><?php echo date("F j, Y",$profile->register_time);?></dd>
							</dl>
							<dl class="dl-horizontal">
								<dt><div align="left">Truckers MP ID</div></dt>
								<dd><?php echo $profile->truckersmp_id;?></dd>
							</dl>
							<dl class="dl-horizontal">
								<dt><div align="left">Truckers MP Join Date</div></dt>
								<dd><?php echo date("F j, Y",strtotime($profile->truckersmp_joindate));?></dd>
							</dl>
						</div>
						<?php if($rank>1){?>
						<div class="tab-pane" id="settings">
							<form role="form" action="" method="POST" class="form-horizontal">
								<div class="form-group">
									<label for="inputName" class="col-sm-2 control-label">Update Rank</label>
									<div class="col-sm-5">
										<select class="form-control" name="rank">
											<option value="0">Guest</option>
											<option value="1">Member</option>
											<option value="2">Admin</option>
										</select>
									</div>
									<div class="col-sm-2">
										<button type="submit" class="btn btn-danger" name="update_rank">Submit</button>
									</div>
								</div>
							</form>
              <form role="form" action="" method="POST" class="form-horizontal">
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Update Role</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" placeholder="Enter Role" value="<?php echo $profile->role;?>" name="role_val" required>
                  </div>
                  <div class="col-sm-2">
                    <button type="submit" class="btn btn-danger" name="update_role">Submit</button>
                  </div>
                </div>
              </form>
						</div>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>