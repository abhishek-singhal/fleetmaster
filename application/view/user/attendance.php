<div class="content-wrapper">
    <section class="content-header">
        <h1>Attendance Tracker<small></small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Attendance</h3>
                        <div class="box-tools">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                Total Events: <?php echo $this->model->totalevents($time);?>
                            </ul>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Events Attended
                                </th>
                                <th>
                                    Last Event Attended On
                                </th>
                                <th>
                                    Events Attended in Past 4 weeks (CC)
                                </th>
                                <th>
                                    Events Attended in Past 4 weeks (Driver)
                                </th>
                                <th>
                                    Last Event Page
                                </th>

                            </tr>
                            <?php foreach($attendCC AS $a){?>
                                <tr>
                                    <td>
                                      <a href="<?php echo URL . 'user/profile/' . $a->user_id; ?>" target="_blank"><?php echo $this->model->fetchUser($a->user_id)->steam_name;?></a>
                                    </td>
                                    <td>
                                        <?php if($a->user_id == 1){?>
                                            <a href="https://www.youtube.com/watch?v=26bcRNifIOM" target="_blank" title="Infinityyyyyyy"><b>&infin;</b></a>
                                        <?php }else if($a->user_id == 6){?>
                                            <b>&infin;</b>
                                        <?php }else if($a->user_id == 15){?>
                                            <b>&infin;</b>
                                        <?php }else{?>
                                        <?php echo $a->attendance + $this->model->countAttendDriver($a->user_id, $time)->attendance;}?>
                                    </td>
                                    <td>
                                        <?php if($a->user_id == 1){?>
                                            <img src="<?php echo URL . 'images/troll.png';?>">
                                            <?php }else if($a->user_id == 6){?>
                                            <a href="https://www.youtube.com/watch?v=OKxTH107jgs" target="_blank"><img src="<?php echo URL . 'images/malcom.jpg';?>" title="Malcom"></a>
                                            <?php }else if($a->user_id == 15){?>
                                            <?php }else{?>
                                        <?php $cc_time = $this->model->fetchLatestEventCC($a->user_id, $time);
                                        $driver_time = $this->model->fetchLatestEventDriver($a->user_id, $time);
                                        $ti = $cc_time > $driver_time ? $cc_time : $driver_time;
                                        if($ti != NULL){
                                            echo date("F j, Y", $ti);}?>


                                        <?php }?>
                                    </td>
                                    <td>
                                        <?php if($this->model->fetchUser($a->user_id)->rank > 1){?>
                                        <?php }else{?>
                                        <?php echo $this->model->countAttendCC4($a->user_id, $time);?>
                                        <?php }?>
                                    </td>
                                    <td>
                                        <?php if($this->model->fetchUser($a->user_id)->rank > 1){?>
                                        <?php }else{?>
                                        <?php echo $this->model->countAttendDriver4($a->user_id, $time);?>
                                        <?php }?>
                                    </td>
                                    <td>
                                        <?php if($this->model->fetchUser($a->user_id)->rank > 1){?>

                                        <?php }else{?>
                                        <?php if($ti != NULL){?>
                                            <a href="<?php echo URL . 'user/pastevent/' . $this->model->fetchEventID($ti);?>"><i class="fa fa-external-link" title="Event Page"></i></a>
                                        <?php }?>
                                        <?php }?>
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