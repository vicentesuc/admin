<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
        try {
            ace.settings.check('breadcrumbs', 'fixed')
        } catch (e) {
        }
    </script>

    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="<?php echo URL ?>home">Home</a>
        </li>
        <li>
            <a href="<?php echo URL ?>user">Usuarios</a>
        </li>
        <li class="active">Nuevo</li>
    </ul>
</div>

<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="page-header">
                <h1>
                    Usuario
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Crear nuevo usuario
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" role="form">

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nombre </label>
                            <div class="col-sm-9">
                                <input type="text" id="form-field-1" class="col-xs-10 col-sm-5"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Correo</label>
                            <div class="col-sm-9">
                                <input type="text" id="form-field-1" class="col-xs-10 col-sm-5"/>
                            </div>
                        </div>
                        <div class="space-4"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Password</label>
                            <div class="col-sm-9">
                                <input type="password" id="form-field-2" class="col-xs-10 col-sm-5"/>
                            </div>
                        </div>
                        <div class="space-4"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Rol </label>
                            <div class="col-sm-9">
                                <select type="text" id="form-field-1" class="col-xs-10 col-sm-5">
                                </select>
                            </div>
                        </div>
                        <div class="space-4"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right"
                                   for="form-field-1">Franquicia </label>
                            <div class="col-sm-9">
                                <select type="text" id="form-field-1" class="col-xs-10 col-sm-5">
                                </select>
                            </div>
                        </div>
                        <div class="space-4"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-tags">Foto</label>
                            <div class="col-sm-9">
                                <div class="inline">
                                    <input type="file" name="tags" id="form-field-tags"/>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="button">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Guardar
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    Limpiar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->