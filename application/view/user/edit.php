<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <form class="form-horizontal" role="form" id="form-user">
            <input type="hidden" id="input_user_id" name="input_user_id" value="<?php echo $arrUser["id"]; ?>">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="input_user_name">Nombre </label>
                <div class="col-sm-9">
                    <input type="text" id="input_user_name" name="input_user_name"
                           class="col-xs-10 col-sm-5" required value="<?php echo $arrUser["name"]; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Correo</label>
                <div class="col-sm-9">
                    <input type="email" id="input_user_email" name="input_user_email"
                           class="col-xs-10 col-sm-5" value="<?php echo $arrUser["email"]; ?>" required/>
                </div>
            </div>
            <div class="space-4"></div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Password</label>
                <div class="col-sm-9">
                    <input type="password" id="input_user_pwd" name="input_user_pwd"
                           class="col-xs-10 col-sm-5" value="*****" required/>
                </div>
            </div>
            <div class="space-4"></div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Rol </label>
                <div class="col-sm-9">
                    <select class="col-xs-10 col-sm-5" id="sel_user_role" name="sel_user_role" required>
                        <option value="">Todas</option>
                        <?php foreach ($arrRoles as $key => $value) {
                            $selected = ((isset($arrUser["role_id"]) ? $arrUser["role_id"] : null) == $value["id"]) ? "selected" : null;
                            ?>
                            <option value="<?php echo $value["id"] ?>" <?php echo $selected; ?> ><?php echo $value["name"] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pais</label>
                <div class="col-sm-9">
                    <select class="col-xs-10 col-sm-5" id="sel_user_country" name="sel_user_country"
                            required>
                        <option value="">Todas</option>
                        <?php foreach ($arrCountries as $key => $value) {
                            $selected = ((isset($arrUser["country_id"]) ? $arrUser["country_id"] : null) == $value["id"]) ? "selected" : null;
                            ?>
                            <option value="<?php echo $value["id"] ?>" <?php echo $selected; ?> ><?php echo $value["name"] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="space-4"></div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right"
                       for="form-field-1">Franquicia </label>
                <div class="col-sm-9">
                    <select class="col-xs-10 col-sm-5" id="sel_user_franchise" name="sel_user_franchise"
                            required>
                        <option value="">Todas</option>
                        <?php foreach ($arrFranchises as $key => $value) {
                            $selected = ((isset($arrUser["franchise_id"]) ? $arrUser["franchise_id"] : null) == $value["id"]) ? "selected" : null;
                            ?>
                            <option value="<?php echo $value["id"] ?>" <?php echo $selected; ?> ><?php echo $value["es_name"] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="space-4"></div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Status </label>
                <div class="col-sm-9">
                    <div class="col-xs-3">
                        <?php $checked = ($arrUser["status"] == 1) ? "checked" : ""; ?>
                        <label>
                            <input <?php echo $checked; ?>  name="chk_user_status" id="chk_user_status" class="ace ace-switch" type="checkbox"/>
                            <span class="lbl"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="space-4"></div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-tags">Foto</label>
                <div class="col-sm-9">
                    <div class="inline">
                        <input type="file" name="file" id="file"/>
                        <img id="prev_image" src="<?php echo IMAGES . "/" . $arrMedia["url"]; ?>"
                             alt="your image" width="100" height="75"/>
                    </div>
                </div>
            </div>
        </form>
        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <button class="btn btn-info" type="button" id="btn_user">
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

    $("#btn_user").click(function () {

        valid_form("form-user", () => {

            var arreglo = {
                url: "<?php echo URL ?>user/editPost",
                params: form_to_json("form-user"),
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