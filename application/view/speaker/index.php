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
            <a href="<?php echo URL ?>speaker">Speakers</a>
        </li>
    </ul>
</div>
<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h1>
                    Speaker
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Lista principal
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="clearfix">
                        <div class="pull-right">
                            <div class="btn-toolbar inline middle no-margin">
                                <div data-toggle="buttons" class="btn-group no-margin">
                                    <a href="#" class="btn btn-info" id="add_new_speaker">
                                        <icon class="ace-icon fa fa-plus white "></icon>
                                        Nuevo
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-header">
                        Resultados
                    </div>
                    <div>
                        <table id="example" class="display table table-hover " style="width:100%">
                            <thead>
                            <tr>
                                <th>Fotografia</th>
                                <th>Nombre</th>
                                <th>Especialidad ES</th>
                                <th>Especialidad En</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($arrSpekers as $key => $value) { ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo IMAGES . "/" . $value["media_description"]; ?>"
                                             alt="<?php $value["media_name"] ?>"
                                             width="25"
                                             height="25">
                                    </td>
                                    <td><?php echo $value["name"]; ?></td>
                                    <td><?php echo $value["es_specialty"]; ?></td>
                                    <td><?php echo $value["en_specialty"]; ?></td>

                                    <td>
                                        <div class="hidden-sm hidden-xs action-buttons">
                                            <a class="blue" href="#" id="edit_speaker"
                                               speaker="<?php echo $value["id"]; ?>">
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
                                                        <span class="blue">
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


        $("a#edit_speaker").click(function () {

            var arreglo = {
                title: "Editar Speaker",
                url: "<?php echo URL ?>speaker/edit",
                params: {
                    id: $(this).attr("speaker")
                }
            }

            ajax_on_popup(arreglo);
        })


        $("#add_new_speaker").click(function () {
            var arreglo = {
                url: "<?php echo URL ?>speaker/create",
                params: {},
                method: "POST",
                title: "Nuevo Speaker"
            }
            ajax_on_popup(arreglo);
        })

        $('#example').DataTable({});
    });
</script>