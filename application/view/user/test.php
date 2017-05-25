<div class="content-wrapper">
    <section class="content-header">
        <h1>Testing something<small></small></h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Run Code</h3>
                    </div>
                    <form method="POST" action="">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Enter Code:</label>
                            <textarea class="form-control" rows="10" name="source" required><?php if(isset($raw_source)){echo $raw_source;}?></textarea>
                        </div>
                        <div class="form-group">
                            <label>STDIN:</label>
                            <textarea class="form-control" rows="4" name="stdin" required><?php if(isset($raw_stdin)){echo $raw_stdin;}?></textarea>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right" name="run_code">Run Code</button>
                    </div>
                    </form>
                </div>
            </div>
            <?php if(isset($message)){?>
            <div class="col-md-6">
                <?php echo $message;?>
            </div>
            <?php }?>
        </div>
    </section>
</div>