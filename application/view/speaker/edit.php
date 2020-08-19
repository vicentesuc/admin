<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <form class="form-horizontal" role="form" id="form-speaker">
            <input type="hidden" id="input_speaker_id" name="input_speaker_id"
                   value="<?php echo $arrSpeaker["id"]; ?> ">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="input_user_name">Nombre </label>
                <div class="col-sm-9">
                    <input type="text" maxlength="255" id="input_speaker_name" name="input_speaker_name"
                           class="col-xs-10 col-sm-5" value="<?php echo $arrSpeaker["name"]; ?>" required/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Especialidad (ES)</label>
                <div class="col-sm-9">
                    <input type="text" maxlength="255" id="input_speaker_es_specialty" name="input_speaker_es_specialty"
                           class="col-xs-10 col-sm-5" value="<?php echo $arrSpeaker["es_specialty"]; ?>" required/>
                </div>
            </div>
            <div class="space-4"></div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Especialidad (EN)</label>
                <div class="col-sm-9">
                    <input type="text" maxlength="255" id="input_speaker_en_specialty" name="input_speaker_en_specialty"
                           class="col-xs-10 col-sm-5" value="<?php echo $arrSpeaker["en_specialty"]; ?>" required/>
                </div>
            </div>

            <div class="space-4"></div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-tags">Foto</label>
                <div class="col-sm-9">
                    <div class="inline">
                        <input type="file" name="file" id="file"/>
                            <img id="prev_image" src="<?php echo IMAGES . "/" . $arrMedia["description"]; ?>"
                                 alt="your image" width="100" height="75"/>
                    </div>
                </div>
            </div>
        </form>
        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <button class="btn btn-info" type="button" id="btn_speaker">
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

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#prev_image').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#btn_speaker").click(function () {

        valid_form("form-speaker", () => {

            var arreglo = {
                url: "<?php echo URL ?>speaker/editPost",
                params: form_to_json("form-speaker"),
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

    $("#file").change(function () {
        readURL(this);
    });
</script>