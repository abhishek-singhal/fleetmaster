<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>css/jquery.datetimepicker.min.css">
<div class="content-wrapper">
  <section class="content-header">
    <h1>Create Event
      <small></small>
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Enter Details</h3>
          </div>
          <form role="form" method="POST" action="">
            <div class="box-body">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Event Name</label>
                  <input type="text" class="form-control" placeholder="Enter Name" name="event_name" required>
                </div>

                <div class="form-group">
                  <label>Server</label>
                  <select class="form-control" name="server">
                    <option value="ETS2 EU1">ETS2 EU1</option>
                    <option value="ETS2 EU2">ETS2 EU2</option>
                    <option value="ETS2 EU3">ETS2 EU3</option>
                    <option value="ATS EU2">ATS EU2</option>
                    <option value="ATS US1">ATS US1</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Source</label>
                  <input type="text" class="form-control" placeholder="Enter Starting Location" name="source" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Destination</label>
                  <input type="text" class="form-control" placeholder="Enter End Point" name="destination" required>
                </div>

                <div class="form-group">
                  <label>Trailer Required?</label>
                  <div class="input-group">
                    <label>
                      <input type="checkbox" name="trailer" class="minimal">
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Spreadsheet Link</label>
                  <input type="text" class="form-control" placeholder="Enter the URL here" name="spreadsheet" required>
                  <p class="help-block">Enter 0 if not available. Can be edited later.</p>
                </div>

              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Event Time</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                    <input type="text" class="form-control" name="time" id="datetimepicker" required>
                  </div>
                  <p class="help-block">UTC timezone only.</p>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Route Map</label>
                  <input type="text" class="form-control"
                         placeholder="Enter URL of Image. Example http://i.imgur.com/abcd.png" name="route_map"
                         required>
                  <p class="help-block">Enter 0 if not available. Can be edited later.</p>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">ETS2C.com page</label>
                  <input type="text" class="form-control" placeholder="Enter the URL here" name="event_page" required>
                  <p class="help-block">Enter 0 if not available. Can be edited later.</p>
                </div>
                <div class="form-group">
                  <label>Additional Notes:</label>
                  <textarea class="form-control" rows="4" name="notes"
                            placeholder="DLC required? or any additional information you want to provide"
                            required></textarea>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Roles Needed?</label>
                  <div class="input-group">
                    <input type="checkbox" name="lead" class="minimal" checked> Lead &emsp;
                    <input type="checkbox" name="colead" class="minimal" checked> Co-Lead &emsp;
                    <input type="checkbox" name="cc1" class="minimal" checked> OU1 &emsp;
                    <input type="checkbox" name="cc2" class="minimal" checked> OU2 &emsp;
                    <input type="checkbox" name="cc3" class="minimal" checked> OU3 &emsp;
                    <input type="checkbox" name="cc4" class="minimal" checked> OU4 &emsp;
                    <input type="checkbox" name="cc5" class="minimal" checked> OU5 &emsp;
                    <input type="checkbox" name="cc6" class="minimal"> OU6 &emsp;
                    <input type="checkbox" name="cc7" class="minimal"> OU7 &emsp;
                    <input type="checkbox" name="cc8" class="minimal"> OU8 &emsp;
                    <input type="checkbox" name="cc9" class="minimal"> OU9 &emsp;
                    <input type="checkbox" name="cc10" class="minimal"> OU10 &emsp;
                    <input type="checkbox" name="middle" class="minimal" checked> Middle &emsp;
                    <input type="checkbox" name="tail" class="minimal" checked> Tail &emsp;
                    <input type="checkbox" name="reserve" class="minimal" checked> Reserve
                  </div>
                  <p class="help-block">Roles cannot be edited after event is created.</p>
                </div>
              </div>
            </div>
            <div class="box-footer" align="center">
              <button type="submit" class="btn btn-primary" name="create_event">Create Event</button>
              <button type="reset" class="btn btn-default">Reset</button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-xs-12">
				<?php if (isset($success)) { ?>
					<?php if ($success == 1) { ?>
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-check"></i> Success!</h4>
              Event Created & Published Successfully.
            </div>
					<?php } else { ?>
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-ban"></i> Oops!</h4>
              Make sure you are entering the correct date and time. Event wasn't created.
            </div>
					<?php }
				} ?>
      </div>
    </div>
  </section>

</div>
<script src="<?php echo URL; ?>js/jquery.js"></script>
<script src="<?php echo URL; ?>js/jquery.datetimepicker.full.min.js"></script>
<script>/*
   window.onerror = function(errorMsg) {
   $('#console').html($('#console').html()+'<br>'+errorMsg)
   }*/

  $.datetimepicker.setLocale('en');

  $('#datetimepicker_format').datetimepicker({
    value: '<?php echo date('Y/m/d H:i', time());?>',
    format: $("#datetimepicker_format_value").val()
  });
  console.log($('#datetimepicker_format').datetimepicker('getValue'));

  $("#datetimepicker_format_change").on("click", function (e) {
    $("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
  });
  $("#datetimepicker_format_locale").on("change", function (e) {
    $.datetimepicker.setLocale($(e.currentTarget).val());
  });

  $('#datetimepicker').datetimepicker({
    dayOfWeekStart: 1,
    lang: 'en',
    disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
    startDate: '<?php echo date('Y/m/d', time())?>'
  });
  $('#datetimepicker').datetimepicker({value: '<?php echo date('Y/m/d 0:0', time());?>', step: 10});

  $('.some_class').datetimepicker();

  $('#default_datetimepicker').datetimepicker({
    formatTime: 'H:i',
    formatDate: 'd.m.Y',
    //defaultDate:'8.12.1986', // it's my birthday
    defaultDate: '+01.01.2017', // it's my birthday
    defaultTime: '10:00',
    timepickerScrollbar: false
  });

  $('#datetimepicker10').datetimepicker({
    step: 5,
    inline: true
  });
  $('#datetimepicker_mask').datetimepicker({
    mask: '9999/19/39 29:59'
  });

  $('#datetimepicker1').datetimepicker({
    datepicker: false,
    format: 'H:i',
    step: 5
  });
  $('#datetimepicker2').datetimepicker({
    yearOffset: 222,
    lang: 'ch',
    timepicker: false,
    format: 'd/m/Y',
    formatDate: 'Y/m/d',
    minDate: '-1970/01/02', // yesterday is minimum date
    maxDate: '+1970/01/02' // and tommorow is maximum date calendar
  });
  $('#datetimepicker3').datetimepicker({
    inline: true
  });
  $('#datetimepicker4').datetimepicker();
  $('#open').click(function () {
    $('#datetimepicker4').datetimepicker('show');
  });
  $('#close').click(function () {
    $('#datetimepicker4').datetimepicker('hide');
  });
  $('#reset').click(function () {
    $('#datetimepicker4').datetimepicker('reset');
  });
  $('#datetimepicker5').datetimepicker({
    datepicker: false,
    allowTimes: ['12:00', '13:00', '15:00', '17:00', '17:05', '17:20', '19:00', '20:00'],
    step: 5
  });
  $('#datetimepicker6').datetimepicker();
  $('#destroy').click(function () {
    if ($('#datetimepicker6').data('xdsoft_datetimepicker')) {
      $('#datetimepicker6').datetimepicker('destroy');
      this.value = 'create';
    } else {
      $('#datetimepicker6').datetimepicker();
      this.value = 'destroy';
    }
  });
  var logic = function (currentDateTime) {
    if (currentDateTime && currentDateTime.getDay() == 6) {
      this.setOptions({
        minTime: '11:00'
      });
    } else
      this.setOptions({
        minTime: '8:00'
      });
  };
  $('#datetimepicker7').datetimepicker({
    onChangeDateTime: logic,
    onShow: logic
  });
  $('#datetimepicker8').datetimepicker({
    onGenerate: function (ct) {
      $(this).find('.xdsoft_date')
        .toggleClass('xdsoft_disabled');
    },
    minDate: '-1970/01/2',
    maxDate: '+1970/01/2',
    timepicker: false
  });
  $('#datetimepicker9').datetimepicker({
    onGenerate: function (ct) {
      $(this).find('.xdsoft_date.xdsoft_weekend')
        .addClass('xdsoft_disabled');
    },
    weekends: ['01.01.2014', '02.01.2014', '03.01.2014', '04.01.2014', '05.01.2014', '06.01.2014'],
    timepicker: false
  });
  var dateToDisable = new Date();
  dateToDisable.setDate(dateToDisable.getDate() + 2);
  $('#datetimepicker11').datetimepicker({
    beforeShowDay: function (date) {
      if (date.getMonth() == dateToDisable.getMonth() && date.getDate() == dateToDisable.getDate()) {
        return [false, ""]
      }

      return [true, ""];
    }
  });
  $('#datetimepicker12').datetimepicker({
    beforeShowDay: function (date) {
      if (date.getMonth() == dateToDisable.getMonth() && date.getDate() == dateToDisable.getDate()) {
        return [true, "custom-date-style"];
      }

      return [true, ""];
    }
  });
  $('#datetimepicker_dark').datetimepicker({theme: 'dark'})


</script>