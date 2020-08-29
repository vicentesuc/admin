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
            <a href="<?php echo URL ?>events">Eventos</a>
        </li>
        <li class="active">Lista</li>
    </ul>
</div>

<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="page-header">
                <h1>
                    Eventos
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Lista de Eventos
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="clearfix">
                    <div class="pull-right">
                        <div class="btn-toolbar inline middle no-margin">
                            <div data-toggle="buttons" class="btn-group no-margin">

                                <label class="btn btn-sm btn-info" id="btAddEvent">
                                        <span class="bigger-110" title="Nuevo Evento">
                                             <a href="#" id="add_new_user">
                                                <icon class="ace-icon fa fa-plus white "></icon>
                                             </a>
                                        </span>
                                </label>
                                <label class="btn btn-sm btn-success" id="span_calendar">
									<span class="bigger-110" title="Calendario">
										<icon class="ace-icon fa fa-calendar white ">
										</icon></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-sm-12 col-xs-12 col-lg-2 ">
                    <div class="form-group">
                        <label for="">Franquicia</label>
                        <select class="form-control" id="sel_franchise" name="sel_franchise">
                            <option value="">Todas</option>
                            <?php foreach ($arrFranchise as $key => $value) {
                                $selected = ((isset($_REQUEST["franchise"]) ? $_REQUEST["franchise"] : null) == $value["id"]) ? "selected" : null;
                                ?>
                                <option value="<?php echo $value["id"] ?>" <?php echo $selected; ?> ><?php echo $value["es_name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="input_fr_language">Idioma:</label>
                        <select class="form-control" id="sel_language" name="sel_language">
                            <option value="">Todas</option>
                            <?php foreach ($arrLanguages as $key => $value) {
                                $selected = (((isset($_REQUEST["language"])) ? $_REQUEST["language"] : null) == $value) ? "selected" : "";
                                $languaje = ($value == "es") ? "español" : "ingles";
                                ?>
                                <option value="<?php echo $value ?>" <?php echo $selected; ?> ><?php echo $languaje; ?></option>
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
                                <th>No.</th>
                                <th>Titulo</th>
                                <th>Descripcion</th>
                                <th>Fecha Hora</th>
                                <th>Lenguaje</th>
                                <th>Franquicia</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($arrEvents as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $value["id"] ?></td>
                                    <td><?php echo $value["title"] ?></td>
                                    <td><?php echo $value["description"] ?></td>
                                    <td><?php echo $value["event_date"] ?></td>
                                    <td><?php echo $value["language"] ?></td>
                                    <td><?php echo $value["es_name"] ?></td>
                                    <td>
                                        <div class="hidden-sm hidden-xs action-buttons">
                                            <a class="blue"
                                               href="<?php echo URL ?>events/edit?id=<?php echo $value["id"]; ?>"
                                               title="editar">
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
                                                        <a href="<?php echo URL ?>events/edit?id<?php echo $value["id"]; ?>"
                                                           class="tooltip-info" data-rel="tooltip" title="editar"
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

        $("#sel_franchise ,#sel_language ").change(function () {

            var arreglo = {
                url: "<?php echo URL ?>events",
                params: {},
                method: "GET"
            }
            if ($("#sel_franchise").val() !== "")
                arreglo.params.franchise = $("#sel_franchise").val();

            if ($("#sel_language").val() !== "")
                arreglo.params.language = $("#sel_language").val();

            send_submit(arreglo);
        })


        $("#btAddEvent").click(function () {

            var arreglo = {
                url: "<?php echo URL ?>events/create",
                params: {},
                method: "POST",
                title: "Agregar Evento"
            }
            ajax_on_popup(arreglo);
        })

        $('#example').DataTable({
            "order": [[ 0, "desc" ]]
        });

        $("#span_calendar").click(function () {
            window.location.href = "<?php echo URL ?>events/calendar";
        })

    });


</script>