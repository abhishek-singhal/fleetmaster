<div class="content-wrapper">
	<section class="content-header">
		<h1>View Profiles<small></small></h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Profiles</h3>
						
					</div>
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover table-bordered">
							<tr>
								<th>User ID</th>
								<th>Name</th>
								<th>Steam</th>
							</tr>
							<?php foreach($profiles as $profile){?>
							<tr>
							<td><?php echo $profile->user_id;?></td>
							<td><a href="<?php echo URL . 'user/profile/' . $profile->user_id;?>" target="_blank"><?php echo $profile->steam_name;?></a></td>
							
							<td>
								<a href="http://steamcommunity.com/profiles/<?php echo $profile->steam_id;?>" title="Steam Profile" target="_blank"><i class="fa fa-steam-square"></i></a>
							</td>
							</tr>
							<?php }?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>