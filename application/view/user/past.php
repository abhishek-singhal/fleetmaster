<div class="content-wrapper">
    <section class="content-header">
        <h1>Past Events<small></small></h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Event Details</h3>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>Event Name</th>
                                <th>Server</th>
                                <th>Source</th>
                                <th>Destination</th>
                                <th>Time</th>
                                <th>Trailer</th>
                                <th>Route Map</th>
                                <th>ETS2C.COM</th>
                            </tr>
                            <?php foreach($fetch_events AS $fetch_event){?>
                            <tr>
                                <td><?php echo $fetch_event->event_id;?></td>
                                <td><a href="<?php echo URL . 'user/pastevent/' . $fetch_event->event_id;?>"><?php echo $fetch_event->event_name;?></a></td>
                                <td><?php echo $fetch_event->server;?></td>
                                <td><?php echo $fetch_event->source;?></td>
                                <td><?php echo $fetch_event->destination;?></td>
                                <td><?php echo date("F j, Y H:i",$fetch_event->time);?> GMT</td>
                                <td><?php echo $fetch_event->trailer;?></td>
                                <td><?php if($fetch_event->route_map == '0'){ echo "Not Available"; }else{?><a href="<?php echo $fetch_event->route_map;?>" target="_blank"><i class="fa fa-external-link"></i></a><?php }?></td>
                                <td><?php if($fetch_event->event_page == '0'){ echo "Not Available"; }else{?><a href="<?php echo $fetch_event->event_page;?>" target="_blank"><i class="fa fa-external-link"></i></a><?php }?></td>
                                <?php if($rank>1){?>
                                <td><a href="<?php echo URL . 'user/event/' . $fetch_event->event_id;?>" title="Edit"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a></td>
                                <?php }?>
                            </tr>
                            <?php }?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>