<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <form class="form-horizontal" role="form" id="form-event">

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="input_event_title">Titulo </label>
                <div class="col-sm-9">
                    <input type="text" id="input_event_title" name="input_event_title"
                           class="col-xs-10 col-sm-5" required/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="input_event_description">
                    Descripcion</label>
                <div class="col-sm-9">
                    <textarea class="col-xs-10 col-sm-5" id="input_event_description"
                              name="input_event_description" required></textarea>
                </div>
            </div>
            <div class="space-4"></div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="input_event_franchise"> Franquicia</label>
                <div class="col-sm-9">
                    <select class="col-xs-10 col-sm-5" id="input_event_franchise" name="input_event_franchise" required>
                        <option value="">Todas</option>
                        <?php foreach ($arrFranchise as $key => $value) {
                            $selected = ((isset($_REQUEST["role"]) ? $_REQUEST["role"] : null) == $value["id"]) ? "selected" : null;
                            ?>
                            <option value="<?php echo $value["id"] ?>" <?php echo $selected; ?> ><?php echo $value["es_name"] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="space-4"></div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right"
                       for="input_event_description">Fecha Evento</label>
                <div class="col-sm-9">
                    <input type="text" class="col-xs-10 col-sm-5" id="input_event_date" name="input_event_date"
                           required/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right"
                       for="input_event_description">Encuesta (Url)</label>
                <div class="col-sm-9">
                    <input type="text"  class="col-xs-10 col-sm-5" id="input_event_survey" name="input_event_survey"
                           required/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right"
                       for="input_event_link">Evento (Url)</label>
                <div class="col-sm-9">
                    <input type="text"  class="col-xs-10 col-sm-5" id="input_event_link" name="input_event_link"
                           required/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right"
                       for="input_event_hashtag">Hashtag</label>
                <div class="col-sm-9">
                    <input type="text"  class="col-xs-10 col-sm-5" id="input_event_hashtag" name="input_event_hashtag"
                           required/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="input_event_language">Idioma</label>
                <div class="col-sm-9">
                    <select class="col-xs-10 col-sm-5" id="input_event_language" name="input_event_language" required>
                        <?php foreach ($arrLanguages as $key => $value) {
                            $selected = (((isset($_REQUEST["language"])) ? $_REQUEST["language"] : null) == $value) ? "selected" : "";
                            $languaje = ($value == "es") ? "español" : "ingles";
                            ?>
                            <option value="<?php echo $value ?>" <?php echo $selected; ?> ><?php echo $languaje; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="space-4"></div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-tags">Foto</label>
                <div class="col-sm-9">
                    <div class="inline">
                        <input type="file" name="file" id="file" required/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-tags">Vista Previa</label>
                <div class="col-sm-9">
                    <img id="prev_image" class="img img-responsive " src="#" alt="your image" width="100" height="75"/>
                </div>
            </div>
        </form>
        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <button class="btn btn-info" type="button" id="btn_event">
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

    $("#btn_event").click(function () {

        valid_form("form-event", () => {
            var arreglo = {
                url: "<?php echo URL ?>events/createPost",
                params: form_to_json("form-event"),
                image: "file",
                method: "POST"
            }
            ajax_send_file(arreglo, (resp) => {
                var response = JSON.parse(resp);
                messages(response)
                if (response.code === "OK") {
                    window.location.href = "<?php echo URL ?>events"
                }
            });
        })

    })

    $("#file").change(function () {
        readURL(this);
    });


    $('#input_event_date').datetimepicker({
        icons: {
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-arrows ',
            clear: 'fa fa-trash',
            close: 'fa fa-times'
        },
        format: 'YYYY-MM-DD HH:mm'
    }).next().on(ace.click_event, function () {
        $(this).prev().focus();
    });

</script>