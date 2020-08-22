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
            <a href="<?php echo URL ?>events/calendar">Home</a>
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
                        Lista de Usuarios
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="clearfix">
                        <div class="pull-right">
                            <div class="btn-toolbar inline middle no-margin">
                                <div data-toggle="buttons" class="btn-group no-margin">
                                    <a href="#" class="btn btn-danger" id="add_new_user">
                                        <icon class="ace-icon fa fa-plus white "></icon>
                                        Nuevo
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-sm-12 col-xs-12 col-lg-2 ">
                    <div class="form-group">
                        <label for="">Rol</label>
                        <select class="form-control" id="sel_role" name="sale_role">
                            <option value="">Todas</option>
                            <?php foreach ($arrRoles as $key => $value) {
                                $selected = ((isset($_REQUEST["role"]) ? $_REQUEST["role"] : null) == $value["id"]) ? "selected" : null;
                                ?>
                                <option value="<?php echo $value["id"] ?>" <?php echo $selected; ?> ><?php echo $value["name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12 col-xs-12 col-lg-2">
                    <div class="form-group">
                        <label for="">Pais</label>
                        <select class="form-control" id="sel_country" name="sel_country">
                            <option value="">Todas</option>
                            <?php foreach ($arrCountries as $key => $value) {
                                $selected = ((isset($_REQUEST["country"]) ? $_REQUEST["country"] : null) == $value["id"]) ? "selected" : null;
                                ?>
                                <option value="<?php echo $value["id"] ?>" <?php echo $selected; ?> ><?php echo $value["name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-header">
                        Resultados
                    </div>
                    <div>
                        <table id="example" class="display table table-hover " style="width:100%">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Franquicia</th>
                                <th>Rol</th>
                                <th>Pais</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($arraUsers as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $value["name"] ?></td>
                                    <td><?php echo $value["email"] ?></td>
                                    <td><?php echo $value["es_name"] ?></td>
                                    <td><?php echo $value["role_desc"] ?></td>
                                    <td><?php echo $value["country_desc"] ?></td>
                                    <td>
                                        <div class="hidden-sm hidden-xs action-buttons">
                                            <a class="blue" href="#" user="<?php echo $value["id"]; ?>" id="edit_user">
                                                <i class="ace-icon fa fa-edit bigger-130"></i>
                                            </a>
                                        </div>
                                        <div class="hidden-md hidden-lg">
                                            <div class="inline pos-rel">
                                                <button class="btn btn-minier btn-yellow dropdown-toggle"
                                                        data-toggle="dropdown" data-position="auto">
                                                    <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                </button>

                                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                    <li>
                                                        <a href="#" class="tooltip-info" data-rel="tooltip" title=""
                                                           data-original-title="View">
                                                        <span class="blue" user="<?php echo $value["id"]; ?>"
                                                              id="edit_user">
                                                            <i class="ace-icon fa fa-edit bigger-120"></i>
                                                        </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $("#sel_role ,#sel_country ").change(function () {

            var arreglo = {
                url: "<?php echo URL ?>user",
                params: {},
                method: "GET"
            }
            if ($("#sel_role").val() !== "")
                arreglo.params.role = $("#sel_role").val();

            if ($("#sel_country").val() !== "")
                arreglo.params.country = $("#sel_country").val();

            send_submit(arreglo);
        })

        $("a#edit_user").click(function () {

            var arreglo = {
                title: "Editar Usuario",
                url: "<?php echo URL ?>user/edit",
                params: {
                    id: $(this).attr("user")
                }
            }

            ajax_on_popup(arreglo);
        })

        $("#add_new_user").click(function () {

            var arreglo = {
                url: "<?php echo URL ?>user/create",
                params: {},
                method: "POST",
                title: "Nuevo Usuario"
            }
            ajax_on_popup(arreglo);
        })

        $('#example').DataTable({});
    });

</script>