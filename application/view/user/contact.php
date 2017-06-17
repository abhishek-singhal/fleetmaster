<div class="content-wrapper">
  <section class="content-header">
    <h1>Contact
      <small></small>
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Contact</h3>
          </div>
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-bordered">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Status</th>
                <th>Time</th>
                <th>Action</th>
              </tr>
							<?php foreach ($all_messages AS $all_message) { ?>
                <tr>
                  <td><?php echo $all_message->serial; ?></td>
                  <td><?php echo $all_message->name; ?></td>
                  <td><?php if (isset($id)) {
											if ($id == $all_message->serial) { ?>
                        <span class="label label-primary">Now Viewing</span>
											<?php }
										} else {
											if ($all_message->status == 0) { ?><span
                        class="label label-warning">New</span><?php } else { ?><span
                        class="label label-success">Seen</span><?php } ?>
										<?php } ?></td>
                  <td><?php echo date("F j, Y H:i",$all_message->time);?> GMT</td>
                  <td><a href="<?php echo URL . 'user/contact/' . $all_message->serial; ?>" title="Open"><span
                        class="label label-primary"><i class="fa fa-envelope-open-o"></i></span></a>
										<?php if ($all_message->status == 0) { ?>
                      <a href="<?php echo URL . 'user/updateContactUs/' . $all_message->serial . '-1'; ?>"
                         title="Mark as Read"><span
                          class="label label-success"><i class="fa fa-check"></i></span></a>
										<?php } else { ?>

                    <a href="<?php echo URL . 'user/updateContactUs/' . $all_message->serial . '-0'; ?>"
                       title="Mark as Unread"><span
                          class="label label-warning"><i class="fa fa-low-vision"></i></span></a><?php } ?>
                    <a href="<?php echo URL . 'user/deleteContactUs/' . $all_message->serial; ?>" title="Delete"><span
                        class="label label-danger"><i class="fa fa-trash-o"></i></span></a></td>
                </tr>
							<?php } ?>
            </table>
          </div>
        </div>
      </div>
			<?php if (isset($id)) { ?>
        <div class="col-md-6">
          <div class="box box-success">
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>
                <div align="left">#</div>
                </dt>
                <dd><?php echo $message->serial; ?></dd>
              </dl>
              <dl class="dl-horizontal">
                <dt>
                <div align="left">Name</div>
                </dt>
                <dd><?php echo $message->name; ?></dd>
              </dl>
              <dl class="dl-horizontal">
                <dt>
                <div align="left">Email</div>
                </dt>
                <dd><?php echo $message->email; ?></dd>
              </dl>
              <dl class="dl-horizontal">
                <dt>
                <div align="left">Message</div>
                </dt>
                <dd><?php echo $message->message; ?></dd>
              </dl>
              <dl class="dl-horizontal">
                <dt>
                <div align="left">Time</div>
                </dt>
                <dd><?php echo date("F j, Y H:i",$message->time); ?></dd>
              </dl>

            </div>
          </div>
        </div>
			<?php } ?>
    </div>
  </section>
</div>