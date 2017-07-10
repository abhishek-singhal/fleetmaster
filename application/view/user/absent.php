<div class="content-wrapper">
  <section class="content-header">
    <h1>Absence Notice
      <small></small>
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Book Leave</h3>
          </div>
          <form role="form" method="POST" action="">
            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" placeholder="<?php echo $user_details->steam_name; ?>" disabled>
              </div>

              <div class="form-group">
                <label>Time Period</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="date" id="reservation" required>
                </div>
                <p class="help-block">Start date - Return Date</p>
              </div>

              <div class="form-group">
                <label>Reason?</label>
                <textarea class="form-control" rows="4" name="reason" required></textarea>
              </div>
            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-danger pull-right" name="absent">Submit</button>
              <button type="reset" class="btn btn-default">Reset</button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Current Absentees</h3>
          </div>
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-bordered">
              <tr>
                <th>Name</th>
                <th>Return Date</th>
								<?php if ($rank > 1) { ?>
                  <th>Reason</th><?php } ?>
              </tr>
							<?php foreach ($current_absents AS $current_absent) { ?>
                <tr>
                  <td><?php echo $this->model->fetchUser($current_absent->user_id)->steam_name; ?></td>
                  <td><?php echo date("F j, Y", $current_absent->end_date); ?></td>
									<?php if ($rank > 1) { ?>
                    <td>
                      <div class="dropdown pull-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-question-circle"></i></a>
                        <ul class="dropdown-menu">
                          <li>
                            <ul class="menu"><?php echo $current_absent->reason; ?></ul>
                          </li>
                        </ul>
                      </div>
                    </td>
                    <td>
                      <a href="<?php echo URL . 'user/deleteabsent/' . $current_absent->serial; ?>" title="Delete">
                        <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                      </a>
                    </td>
									<?php } ?>
                </tr>
							<?php } ?>

            </table>

          </div>

        </div>
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Future Absentees</h3>
          </div>
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-bordered">
              <tr>
                <th>Name</th>
                <th>Start Date</th>
                <th>Return Date</th>
								<?php if ($rank > 1) { ?>
                  <th>Reason</th><?php } ?>
              </tr>
							<?php foreach ($future_absents AS $future_absent) { ?>
                <tr>
                  <td><?php echo $this->model->fetchUser($future_absent->user_id)->steam_name; ?></td>
                  <td><?php echo date("F j, Y", $future_absent->start_date); ?></td>
                  <td><?php echo date("F j, Y", $future_absent->end_date); ?></td>
									<?php if ($rank > 1) { ?>
                    <td>
                      <div class="dropdown pull-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-question-circle"></i></a>
                        <ul class="dropdown-menu">

                          <li>
                            <ul class="menu"><?php echo $future_absent->reason; ?></ul>
                          </li>
                        </ul>
                      </div>
                    </td>
                    <td>
                    <a href="<?php echo URL . 'user/deleteabsent/' . $future_absent->serial; ?>" title="Delete">
                      <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                    </a>
                    </td><?php } ?>
                </tr>
							<?php } ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Made By</b><strong> <a href="http://steamcommunity.com/id/orang-e" target="_blank">Orange</a></strong>
  </div>
  <strong>Copyright &copy; 2017</strong> All rights reserved. <strong><a href="<?php echo URL; ?>home/index">FME
      Homepage</a></strong>
</footer>
</div>
<!-- jQuery 2.2.3 -->
<script src="<?php echo URL; ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo URL; ?>bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo URL; ?>plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?php echo URL; ?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo URL; ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo URL; ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo URL; ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo URL; ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo URL; ?>plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo URL; ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo URL; ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo URL; ?>plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="<?php echo URL; ?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo URL; ?>dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo URL; ?>dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>