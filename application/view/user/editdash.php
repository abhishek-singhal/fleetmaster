<div class="content-wrapper">
  <section class="content-header">
    <h1>Edit Dashboard
      <small></small>
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Current Points</h3>
          </div>
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-bordered">
              <tr>
                <th>Serial</th>
                <th>Content</th>
                <th>Action</th>
              </tr>
							<?php foreach ($contents AS $content) { ?>
                <tr>
                  <td><?php echo $content->serial; ?></td>
                  <td><?php echo $content->content; ?></td>
                  <td>
                    <a href="<?php echo URL . 'user/editdash/' . $content->serial; ?>" title="Edit"><span
                        class="label label-primary"><i class="fa fa-pencil"></i></span></a>
                    <a href="<?php echo URL . 'user/deletedash/' . $content->serial; ?>" title="Delete"><span
                        class="label label-danger"><i class="fa fa-trash-o"></i></span></a>
                  </td>
                </tr>
							<?php } ?>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-6">
				<?php if (isset($input)) { ?>
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Update Point</h3>
            </div>
            <form method="POST" action="">
              <div class="box-body">
                <div class="form-group">
                  <label>Enter:</label>
                  <textarea class="form-control" rows="3" name="point"
                            required><?php echo $this->model->fetchContentPoint($input); ?></textarea>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-warning" name="update_point">Update Point</button>
              </div>
            </form>
          </div>
				<?php } ?>
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Insert New Point</h3>
          </div>
          <form method="POST" action="">
            <div class="box-body">
              <div class="form-group">
                <label>Enter:</label>
                <textarea class="form-control" rows="3" name="new_point" required></textarea>
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-success" name="insert_point">Insert Point</button>
              <button type="reset" class="btn btn-default pull-right">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>