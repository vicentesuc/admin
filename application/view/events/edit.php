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
            <a href="<?php echo URL ?>user">Eventos</a>
        </li>
        <li class="active">Nuevo</li>
    </ul>
</div>
<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h1>
                    Evento #<?php echo (isset($_REQUEST["id"])) ? $_REQUEST["id"] : null; ?>
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Fecha y Hora &nbsp; <?php echo $arrEvent["event_date"] ?>
                    </small>
                </h1>
            </div>
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="tabbable">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                                <a data-toggle="tab" href="#home">
                                    <i class="green ace-icon fa fa-edit bigger-120"></i>
                                    General
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#images" id="tabImages">
                                    <i class="red ace-icon fa fa-image bigger-120"></i>
                                    Imagenes
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#video" id="tabVideo">
                                    <i class="blue ace-icon fa fa-video-camera bigger-120"></i>
                                    Videos
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#documents" id="tabDocuments">
                                    <i class="orange ace-icon fa fa-file-pdf-o bigger-120"></i>
                                    Documentos
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#speaker" id="tabSpeaker">
                                    <i class="purple ace-icon fa fa-user-circle-o bigger-120"></i>
                                    Speakers
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#stand" id="tabStand">
                                    <i class="blue ace-icon fa fa-building-o bigger-120"></i>
                                    Stands
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#uploads">
                                    <i class="grey ace-icon fa fa-upload bigger-120"></i>
                                    Uploads
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                                <form class="form-horizontal" role="form" id="form-event">
                                    <input type="hidden" id="input_event_id" name="input_event_id"
                                           value="<?php echo $arrEvent["id"]; ?>">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="input_event_title">Titulo </label>
                                        <div class="col-sm-9">
                                            <input type="text" id="input_event_title" name="input_event_title"
                                                   class="col-xs-10 col-sm-5" value="<?php echo $arrEvent["title"]; ?>"
                                                   required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right"
                                               for="input_event_description">
                                            Descripcion</label>
                                        <div class="col-sm-9">
                                         <textarea class="col-xs-10 col-sm-5" id="input_event_description"
                                                   name="input_event_description"
                                                   required><?php echo $arrEvent["description"]; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="space-4"></div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right"
                                               for="input_event_franchise"> Franquicia</label>
                                        <div class="col-sm-9">
                                            <select class="col-xs-10 col-sm-5" id="input_event_franchise"
                                                    name="input_event_franchise" required>
                                                <option value="">Todas</option>
                                                <?php foreach ($arrFranchise as $key => $value) {
                                                    $selected = ((isset($arrEvent["franchise_id"]) ? $arrEvent["franchise_id"] : null) == $value["id"]) ? "selected" : null;
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
                                            <input type="text" class="col-xs-10 col-sm-5" id="input_event_date"
                                                   name="input_event_date"
                                                   required value="<?php echo $arrEvent["event_date"]; ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right"
                                               for="input_event_description">Encuesta (Url)</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="col-xs-10 col-sm-5" id="input_event_survey"
                                                   name="input_event_survey"
                                                   value="<?php echo $arrEvent["survey_url"]; ?>"
                                                   required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right"
                                               for="input_event_link">Evento (Url)</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="col-xs-10 col-sm-5" id="input_event_link"
                                                   name="input_event_link"
                                                   value="<?php echo $arrEvent["event_link"]; ?>"
                                                   required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right"
                                               for="input_event_hashtag">Hashtag</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="col-xs-10 col-sm-5" id="input_event_hashtag"
                                                   name="input_event_hashtag"
                                                   value="<?php echo $arrEvent["hashtag"]; ?>"
                                                   required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right"
                                               for="input_event_language">Idioma</label>
                                        <div class="col-sm-9">
                                            <select class="col-xs-10 col-sm-5" id="input_event_language"
                                                    name="input_event_language" required>
                                                <?php foreach ($arrLanguages as $key => $value) {
                                                    $selected = (((isset($arrEvent["language"])) ? $arrEvent["language"] : null) == $value) ? "selected" : "";
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
                                                <input type="file" name="file" id="file"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-tags">Vista
                                            Previa</label>
                                        <div class="col-sm-9">
                                            <img id="prev_image"
                                                 src="<?php echo IMAGES . "/" . $arrEvent["media_url"]; ?>"
                                                 alt="your image"
                                                 width="100" height="75">
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
                            <div id="video" class="tab-pane ">
                                <div id="div_video"></div>
                            </div>
                            <div id="images" class="tab-pane ">
                                <div id="div_images"></div>
                            </div>
                            <div id="documents" class="tab-pane ">
                                <div id="div_documents"></div>
                            </div>
                            <div id="speaker" class="tab-pane ">
                                <div id="div_speakers"></div>
                            </div>
                            <div id="stand" class="tab-pane ">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div id="div_stands"></div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="tabbable">
                                            <ul class="nav nav-tabs" id="myTab">
                                                <li class="active">
                                                    <a data-toggle="tab" href="#tabImagesStand">
                                                        <i class="green ace-icon fa fa-image bigger-120"></i>
                                                        Imagenes
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-toggle="tab" href="#tabUploadStands">
                                                        <i class="blue ace-icon fa fa-upload bigger-120"></i>
                                                        Upload
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="tabImagesStand" class="tab-pane fade in active">
                                                    <div id="div_stand_image"></div>
                                                </div>
                                                <div id="tabUploadStands" class="tab-pane fade">
                                                    <div id="div_stand_img_upload"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="uploads" class="tab-pane ">

                                <div class="alert alert-info">
                                    <i class="ace-icon fa fa-hand-o-right"></i>

                                    Sube tus imagenes y video nosotros nos encargaremos de separarlos
                                    <button class="close" data-dismiss="alert">
                                        <i class="ace-icon fa fa-times"></i>
                                    </button>
                                </div>

                                <div>
                                    <form action="<?php echo URL ?>events/postMedia" class="dropzone well"
                                          id="dropzone">
                                        <input type="hidden" id="media_event_id" name="media_event_id"
                                               value="<?php echo $arrEvent['id'] ?>">
                                        <div class="fallback">
                                            <input name="file" type="file" multiple=""/>
                                        </div>
                                    </form>
                                </div>

                                <div id="preview-template" class="hide">
                                    <div class="dz-preview dz-file-preview">
                                        <div class="dz-image">
                                            <img data-dz-thumbnail=""/>
                                        </div>

                                        <div class="dz-details">
                                            <div class="dz-size">
                                                <span data-dz-size=""></span>
                                            </div>

                                            <div class="dz-filename">
                                                <span data-dz-name=""></span>
                                            </div>
                                        </div>

                                        <div class="dz-progress">
                                            <span class="dz-upload" data-dz-uploadprogress=""></span>
                                        </div>

                                        <div class="dz-error-message">
                                            <span data-dz-errormessage=""></span>
                                        </div>

                                        <div class="dz-success-mark">
											<span class="fa-stack fa-lg bigger-150">
												<i class="fa fa-circle fa-stack-2x white"></i>

												<i class="fa fa-check fa-stack-1x fa-inverse green"></i>
											</span>
                                        </div>

                                        <div class="dz-error-mark">
											<span class="fa-stack fa-lg bigger-150">
												<i class="fa fa-circle fa-stack-2x white"></i>

												<i class="fa fa-remove fa-stack-1x fa-inverse red"></i>
											</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    url: "<?php echo URL ?>events/editPost",
                    params: form_to_json("form-event"),
                    image: "file",
                    method: "POST"
                }
                ajax_send_file(arreglo, (resp) => {
                    var response = JSON.parse(resp);

                    messages(response)
                    if (response.code === "OK") {
                        $("modalIni").modal("hide");
                    }
                });
            })
        })

        $("#file").change(function () {
            readURL(this);
        });

        $("#tabImages").click(function () {

            var arreglo = {
                url: "<?php echo URL ?>media/images",
                method: "POST",
                div: "div_images",
                params: {
                    id: $("#input_event_id").val()
                }
            }
            ajax_on_div(arreglo);
        })

        $("#tabVideo").click(function () {

            var arreglo = {
                url: "<?php echo URL ?>media/video",
                method: "POST",
                div: "div_video",
                params: {
                    id: $("#input_event_id").val()
                }
            }
            ajax_on_div(arreglo);
        })

        $("#tabDocuments").click(function () {

            var arreglo = {
                url: "<?php echo URL ?>media/documents",
                method: "POST",
                div: "div_documents",
                params: {
                    id: $("#input_event_id").val()
                }
            }
            ajax_on_div(arreglo);
        })

        $("#tabSpeaker").click(function () {

            var arreglo = {
                url: "<?php echo URL ?>events/speakers",
                method: "POST",
                div: "div_speakers",
                params: {
                    id: $("#input_event_id").val()
                }
            }
            ajax_on_div(arreglo);
        })

        $("#tabStand").click(function () {
            var arreglo = {
                url: "<?php echo URL ?>stand",
                method: "POST",
                div: "div_stands",
                params: {
                    id: $("#input_event_id").val()
                }
            }
            $("#div_stand_image").val("");
            $("#div_stand_img_upload").val("");
            ajax_on_div(arreglo);
        })


    </script>
    <script type="text/javascript">


        try {
            Dropzone.autoDiscover = false;

            var myDropzone = new Dropzone("#dropzone", {

                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 10.0, // MB
                addRemoveLinks: true,
                previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-details\">\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n    <div class=\"dz-size\" data-dz-size></div>\n    <img data-dz-thumbnail />\n  </div>\n  <div class=\"progress progress-small progress-striped active\"><div class=\"progress-bar progress-bar-success\" data-dz-uploadprogress></div></div>\n  <div class=\"dz-success-mark\"><span></span></div>\n  <div class=\"dz-error-mark\"><span></span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n</div>",
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF",
                maxFiles: 1,
                init: function () {
                    this.on("success", function (file, responseText) {
                        array = responseText.split("|");

                        console.log(array);
                    });
                },
            });
        } catch (e) {
            // alert('Dropzone.js does not support older browsers!');
        }
    </script>

