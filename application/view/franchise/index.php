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
            <a href="<?php echo URL ?>user">Franquicias</a>
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
                    Franquicias
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
                                    <a href="#" class="btn btn-success" id="btnAddFranchise">
                                        <icon class="ace-icon fa fa-plus white "></icon>
                                        Agregar
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
                                <th>Id</th>
                                <th>es_name</th>
                                <th>en_name</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($arrFranchise as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $value["id"]; ?></td>
                                    <td><?php echo $value["es_name"]; ?></td>
                                    <td><?php echo $value["en_name"]; ?></td>
                                    <td>
                                        <div class="hidden-sm hidden-xs action-buttons">
                                            <a class="blue" href="#" id="editFranchise"
                                               franchise="<?php echo $value["id"]; ?>">
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

        $("#input_fr_language").change(function () {
            var arreglo = {
                url: "<?php echo URL ?>franchise",
                params: {
                    language: $(this).val()
                },
                method: "GET"
            }

            send_submit(arreglo);
        })

        $("#btnAddFranchise").click(function () {
            var arreglo = {
                title: "Agregar Franquicia",
                url: "<?php echo URL ?>franchise/create",
                params: {}
            }
            ajax_on_popup(arreglo);
        })

        $("a#editFranchise").click(function () {

            var arreglo = {
                title: "Editar Franquicia",
                url: "<?php echo URL ?>franchise/edit",
                params: {
                    id: $(this).attr("franchise")
                }
            }
            ajax_on_popup(arreglo);
        })

        $('#example').DataTable({});
    });
</script>