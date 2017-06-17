<div class="content-wrapper">
  <section class="content-header">
    <h1>Dashboard
      <small></small>
    </h1>
  </section>
  <section class="content">
    <div class="row">
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