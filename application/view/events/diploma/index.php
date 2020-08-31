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
        <li class="active">Diplomas</li>
    </ul>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="page-header">
            <h1>
                Eventos
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Registrar Diplomas
                </small>
            </h1>
        </div>
        <br>
        <form class="form-horizontal" action="<?php echo URL ?>events/uploadDiploma" role="form" id="form-diploma"
              method="POST"
              enctype="multipart/form-data">
            <div class="row">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="input_event_language">Idioma</label>
                    <div class="col-sm-9">
                        <select class="col-xs-10 col-sm-5 chosen-select " id="input_event_id" name="input_event_id"
                                data-placeholder="Choose a State..."
                                required>
                            <option value="">Seleccione un evento</option>
                            <?php foreach ($arrEvents as $key => $value) {
                                $selected = (((isset($_REQUEST["event"])) ? $_REQUEST["event"] : null) == $value["id"]) ? "selected" : "";
                                ?>
                                <option value="<?php echo $value["id"] ?>" <?php echo $selected; ?> ><?php echo $value["title"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-tags">Foto</label>
                    <div class="col-sm-9">
                        <div class="inline">
                            <input name="file" id="file" type="file" accept=".csv" required/>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <button class="btn btn-info" type="button" id="btnUploadDiploma">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#btnUploadDiploma").click(function () {
            var form = $("#form-diploma");
            var rp = {msg: "", event: "", title: ""}
            form.validate().settings.ignore = ":disabled,:hidden";


            if (form.valid()) {

                if ($("#input_event_id").val() !== "") {
                    document.getElementById("form-diploma").submit();
                } else {
                    rp.msg = "seleccione un evento ";
                    rp.title = "Aviso";
                    rp.event = "error";
                    messages(rp)
                }
            } else {
                rp.msg = "Debe llenar todos los campos";
                rp.title = "Aviso";
                rp.event = "error";
                messages(rp)
            }
            return false;
        })

        $('.chosen-select').chosen({allow_single_deselect: true});
    })
</script>