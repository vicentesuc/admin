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
                        Lista de Usuarios
                    </small>
                </h1>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <h3 class="header smaller lighter blue">Listado de usuarios</h3>

                    <div class="clearfix">
                        <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="table-header">
                        Resultados
                    </div>
                    <div>
                        <table id="example" class="display table " style="width:100%">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Franquicia</th>
                                <th>Rol</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#example').DataTable({});
    });

</script>