<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Fleet Master Events</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo URL; ?>bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo URL; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="<?php echo URL; ?>dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo URL; ?>dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo URL; ?>css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo URL; ?>plugins/daterangepicker/daterangepicker.css">
</head>
<?php
$this->model->updateIP($_SESSION['user_id'], $this->getuserIP());
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <a href="<?php echo URL; ?>user/index" class="logo">
      <span class="logo-mini"><b>FME</b></span>
      <span class="logo-lg">Fleet Master Events</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $avatar; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $user_details->steam_name; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="<?php echo $avatar; ?>" class="img-circle" alt="User Image">
                <p><?php echo $user_details->steam_name; ?>
                  <small>Member since <?php echo date("F j, Y", $user_details->register_time); ?></small>
                </p>
              </li>
              <!--
							<li class="user-body">
								<div class="row">
									<div class="col-xs-4 text-center">
										<a href="#">Followers</a>
									</div>
									<div class="col-xs-4 text-center">
										<a href="#">Sales</a>
									</div>
									<div class="col-xs-4 text-center">
										<a href="#">Friends</a>
									</div>
								</div>
							</li>-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo URL . 'user/profile/' . $_SESSION['user_id']; ?>"
                     class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo URL; ?>user/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $avatar; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user_details->steam_name; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>

        <li<?php if ($page == 1) { ?> class="active"<?php } ?>>
          <a href="<?php echo URL; ?>user/index">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li<?php if ($page == 2) { ?> class="active"<?php } ?>>
          <a href="<?php echo URL; ?>user/upcoming">
            <i class="fa fa-calendar"></i> <span>Upcoming Events</span>
            <span class="pull-right-container">
								<small class="label pull-right bg-blue"><?php echo $this->model->countFutureEvents(time()); ?></small>
							</span>
          </a>
        </li>

        <li<?php if ($page == 3) { ?> class="active"<?php } ?>>
          <a href="<?php echo URL; ?>user/create">
            <i class="fa fa-calendar-plus-o"></i> <span>Create Event</span>
          </a>
        </li>

        <li<?php if ($page == 6) { ?> class="active"<?php } ?>>
          <a href="<?php echo URL; ?>user/past">
            <i class="fa fa-calendar-check-o"></i> <span>Past Events</span>
          </a>
        </li>

        <li<?php if ($page == 4) { ?> class="active"<?php } ?>>
          <a href="<?php echo URL; ?>user/profiles">
            <i class="fa fa-users"></i> <span>Members</span>
          </a>
        </li>

        <li<?php if ($page == 7) { ?> class="active"<?php } ?>>
          <a href="<?php echo URL; ?>user/attendance">
            <i class="fa fa-user-plus"></i> <span>Attendance</span>
          </a>
        </li>

        <li<?php if ($page == 5) { ?> class="active"<?php } ?>>
          <a href="<?php echo URL; ?>user/absent">
            <i class="fa fa-child"></i> <span>Absence Notice</span>
          </a>
        </li>
				<?php if ($rank > 1) { ?>
          <li<?php if ($page == 8) { ?> class="active"<?php } ?>>
            <a href="<?php echo URL; ?>user/newmembers">
              <i class="fa fa-user-secret"></i> <span>New Logins</span>
              <span class="pull-right-container">
								<small class="label pull-right bg-red"><?php echo $this->model->countNewMembers(); ?></small>
							</span>
            </a>
          </li>
				<?php } ?>
				<?php if ($rank > 1) { ?>
          <li<?php if ($page == 9) { ?> class="active"<?php } ?>>
            <a href="<?php echo URL; ?>user/contact">
              <i class="fa fa-comments"></i> <span>Contact</span>
              <span class="pull-right-container">
								<small class="label pull-right bg-yellow"><?php echo $this->model->countUnread();?></small>
							</span>
            </a>
          </li>
				<?php } ?>
				<?php if ($rank > 1) { ?>
          <li<?php if ($page == 10) { ?> class="active"<?php } ?>>
            <a href="<?php echo URL; ?>user/editdash">
              <i class="fa fa-wrench"></i> <span>Edit Dashboard</span>
            </a>
          </li>
				<?php } ?>
    </section>
  </aside>