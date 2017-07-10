<div class="content-wrapper">
  <section class="content-header">
    <h1>Dashboard
      <small></small>
    </h1>
  </section>
  <section class="content">
    <div class="row">
			<?php if ($count_event != 0) { ?>
        <div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Other Events</h3>
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-bordered">
                <tr>
                  <th>Hosted By</th>
                  <th>Server</th>
                  <th>Source</th>
                  <th>Destination</th>
                  <th>Time</th>
                  <th>Trailer</th>
                  <th>Notes</th>
                  <th>Event Page</th>
                </tr>
                <?php foreach($other_events AS $other_event){?>
                <tr>
                  <td><?php echo $other_event->planner;?></td>
                  <td><?php echo $other_event->server;?></td>
                  <td><?php echo $other_event->source;?></td>
                  <td><?php echo $other_event->destination;?></td>
                  <td><?php echo date("F j, Y H:i",$other_event->time);?> GMT</td>
                  <td><?php echo $other_event->trailer;?></td>
                  <td><?php echo $other_event->notes;?></td>
                  <td><a href="<?php echo $other_event->event_page;?>" target="_blank"><i class="fa fa-external-link"></i></a></td>
                  <?php if($rank>1){?>
                  <td><a href="<?php echo URL . 'user/deleteother/' . $other_event->id;?>" title="Delete"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button></a></td>
                  <?php }?>
                </tr>
                <?php }?>
              </table>
            </div>
          </div>
        </div>
			<?php } ?>
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">How to plan a Convoy for FME</h3>
          </div>
          <div class="box-body">
            <ol>
							<?php foreach ($points AS $point) { ?>
                <li><?php echo $point->content; ?></li>
							<?php } ?>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>