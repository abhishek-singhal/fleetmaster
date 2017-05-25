<div class="content-wrapper">
    <section class="content-header">
        <h1>New Logins<small></small></h1>
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
                                <th>Action</th>
                            </tr>
                            <?php foreach($profiles AS $profile){?>
                                <tr>
                                    <td><?php echo $profile->user_id;?></td>
                                    <td><a href="<?php echo URL . 'user/profile/' . $profile->user_id;?>" target="_blank"><?php echo $profile->steam_name;?></a></td>
                                    <td><a href="http://steamcommunity.com/profiles/<?php echo $profile->steam_id;?>" title="Steam Profile" target="_blank"><i class="fa fa-steam-square"></i></a></td>
                                    <td>
                                        <a href="<?php echo URL . 'user/confirmuser/' . $profile->user_id;?>" title="Allow Access"><span class="label label-success"><i class="fa fa-check-circle"></i></span></a>
                                        <a href="<?php echo URL . 'user/removeuser/' . $profile->user_id;?>" title="Remove User"><span class="label label-danger"><i class="fa fa-trash"></i></span></a>
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