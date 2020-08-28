<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <form class="form-horizontal" role="form" id="form-media">
            <input type="hidden" id="input_media_id" name="input_media_id" value="<?php echo $arrMedia["id"]; ?>">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="input_user_name">Nombre </label>
                <div class="col-sm-9">
                    <input type="text" id="input_media_name" name="input_media_name"
                           class="col-xs-10 col-sm-5" required value="<?php echo $arrMedia["name"]; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Descripcion</label>
                <div class="col-sm-9">
                    <textarea id="input_media_desc" name="input_media_desc"
                              class="col-xs-10 col-sm-5"><?php echo $arrMedia["description"]; ?></textarea>
                </div>
            </div>
        </form>
        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <button class="btn btn-info" type="button" id="btn_edit_image">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Guardar
                </button>
                <button class="btn" type="reset">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    Limpiar
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#btn_edit_image").click(function () {

        valid_form("form-media", () => {
            var arreglo = {
                url: "<?php echo URL ?>media/editPost",
                params: form_to_json("form-media"),
                image: "file",
                method: "POST"
            }
            ajax_send_file(arreglo, (resp) => {
                var response = JSON.parse(resp);

                messages(response)
                if (response.code === "OK") {
                    //window.location.href = "<?php //echo URL ?>//user"
                    $("modalIni").modal("hide");
                }
            });
        })
    })
</script>