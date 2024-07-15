<?php
header("Access-Control-Allow-Origin: *");
?>
<section class="content-header">
    <h1>eCart Purchase Code <a href='purchase-code.php'></h1>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>
    <hr />
</section>
<section class="content">
    <div class="row">
        <!-- <div class="col-md-6"> -->

        <?php
        $isAuthWeb = $fn->get_settings('doctor_brown_web');
        if (!empty($isAuthWeb)) {

        ?>

            <div class="col-sm-4">
                <p class="alert alert-success"> Website is Already registerd!</p>
            </div>
            <div class="col-sm-4">
                <button type="submit" class="btn btn-primary" name="webDeregister" id="webDeregister" value="33201609">De-register web</button>
            </div>
    </div>
    <div class="row">
        <br><br>
        <div class="col-sm-4">
            <div><br>
                <p id="result_success" class="alert alert-success"></p>
            </div>
            <div><br>
                <p id="result_fail" class="alert alert-danger"></p>
            </div>
        </div>


        <?php } else { ?>

        <!-- general form elements -->
        <div class=" col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Validate the authentic purchase of customer website</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form id="validate_code_website" method="GET">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Enter the Purchase Code shared by the customer for eCart</label>
                            <input type="text" class="form-control" id="purchase_code" name="purchase_code" placeholder="Enter the purchase code here" required>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="btnValidate" id="btnValidate">Validate Now</button>
                            <input type="reset" class="btn-warning btn" value="Clear" />
                            <div class="form-group">
                                <div><br>
                                    <p id="result_success" class="alert alert-success"></p>
                                </div>
                                <div><br>
                                    <p id="result_fail" class="alert alert-danger"></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.box -->
        </div><br><br><br><br><br><br><br><br><br>
        <?php } ?>
    </div>
    <div class="row">
        <!-- app -->
        <?php

        $isAuthApp = $fn->get_settings('doctor_brown');
        if (!empty($isAuthApp)) {

        ?>

            <div class="col-sm-4">
                <p class="alert alert-success"> App is Already registerd!</p>
            </div>
            <div class="col-sm-4">
                <button type="submit" class="btn btn-primary" name="appDeregister" id="appDeregister" value="31977632">De-register app</button>
            </div>
    </div>
            <div class="row">
                <br><br>
                <div class="col-sm-4">
                    <div><br>
                        <p id="result_success_app" class="alert alert-success"></p>
                    </div>
                    <div><br>
                        <p id="result_fail_app" class="alert alert-danger"></p>
                    </div>
                </div>
            </div>
            <div class="row">
            <?php } else { ?>
                <!-- general form elements -->
                <br><br><br><br><br>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Validate the authentic purchase of customer app</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <form id="validate_code_app" method="GET">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Enter the Purchase Code shared by the customer for eCart</label>
                                    <input type="text" class="form-control" id="purchase_code_app" name="purchase_code_app" placeholder="Enter the purchase code here" required>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary" name="btnValidateApp" id="btnValidateApp">Validate Now</button>
                                    <input type="reset" class="btn-warning btn" value="Clear" />
                                    <div class="form-group">
                                        <div><br>
                                            <p id="result_success_app" class="alert alert-success"></p>
                                        </div>
                                        <div><br>
                                            <p id="result_fail_app" class="alert alert-danger"></p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.box -->
                </div>
            <?php } ?>

            <!-- </div> -->
            </div>
</section>


<div class="separator"> </div>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
    var domain_url = '<?= DOMAIN_URL ?>';
</script>
<script src="dist/js/de-register.js"></script>
<script src="dist/js/covert.js"></script>
<?php $db->disconnect(); ?>