<?php
unset($_SESSION['logueado']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <title>Eventos</title>
    <meta name="description" content="User login page"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <link rel="stylesheet" href="<?php echo URL; ?>/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo URL; ?>/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo URL; ?>/css/ace.min.css"/>
    <link rel="stylesheet" href="<?php echo URL; ?>/css/ace-rtl.min.css"/>
    <link rel="stylesheet" href="<?php echo URL; ?>/css/jquery.gritter.css"/>
</head>
<body class="login-layout light-login">
<div class="main-container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="login-container">
                    <div class="center">
                        <h1>
                            <span class="red">Eventos</span>
                            <span class="blue" id="id-text2"><?php echo date("Y") ?></span>
                        </h1>
                    </div>
                    <div class="space-6"></div>
                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="space-6"></div>
                                    <form method="POST" id="from_validate" action="<?php echo URL ?>login/validate">
                                        <center>
                                            <img src="<?php echo URL; ?>/avatars/icon-user.png" alt="..."
                                                 class="img-circle img-responsive">
                                        </center>
                                        <div class="space-6"></div>
                                        <h4 class="header blue lighter bigger">
                                            <center>Acceso al Sistema</center>
                                        </h4>
                                        <fieldset>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text"
                                                                   id="input_email"
                                                                   name="input_email"
                                                                   class="form-control"
                                                                   required
                                                                   placeholder="Email"/>
															<i class="ace-icon fa fa-user"></i>
														</span>
                                            </label>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password"
                                                                   id="input_pwd"
                                                                   required
                                                                   name="input_pwd"
                                                                   class="form-control" placeholder="Password"/>
															<i class="ace-icon fa fa-lock"></i>
														</span>
                                            </label>
                                            <div class="space"></div>
                                            <div class="clearfix">
                                                <button type="submit" id="btn_ingresar" name="btn_ingresar"
                                                        class="btn  btn-lg btn-block btn-primary">
                                                    <i class="ace-icon fa fa-key"></i>
                                                    <span class="bigger-110">Ingresar</span>
                                                </button>
                                            </div>
                                            <div class="space-4"></div>
                                        </fieldset>
                                    </form>
                                    <div class="space-6"></div>
                                </div><!-- /.widget-main -->
                                <div class="toolbar clearfix">
                                </div>
                            </div><!-- /.widget-body -->
                        </div><!-- /.login-box -->
                    </div><!-- /.position-relative -->
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.main-content -->
    <input id="gritter-light" checked="" type="checkbox" class="ace ace-switch ace-switch-5"/>
</div>
<!-- /.main-container -->
<script src="<?php echo URL; ?>/js/jquery.min.js"></script>
<script src="<?php echo URL; ?>/js/bootbox.min.js"></script>
<script src="<?php echo URL; ?>/js/jquery.gritter.min.js"></script>
<script src="<?php echo URL; ?>/js/jquery.validate.min.js"></script>
<script src="<?php echo URL; ?>/custom/jquery.crm.functions.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#btn_ingresar").click(function () {

            valid_form("from_validate", () => {
                document.getElementById("from_validate").submit();
            })
        });
    })
</script>
</body>

</html>
