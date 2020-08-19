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
                                <a data-toggle="tab" href="#video">
                                    <i class="blue ace-icon fa fa-video-camera bigger-120"></i>
                                    Videos
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#images">
                                    <i class="red ace-icon fa fa-image bigger-120"></i>
                                    Imagenes
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#speaker">
                                    <i class="purple ace-icon fa fa-user-circle-o bigger-120"></i>
                                    Speakers
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
                                                <input type="file" name="file" id="file" />
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
                                <p>Video.</p>
                            </div>
                            <div id="images" class="tab-pane ">
                                <p>Images</p>
                            </div>
                            <div id="speaker" class="tab-pane ">
                                <p>Speakers</p>
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
                                    <form action="./dummy.html" class="dropzone well" id="dropzone">
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

    </script>
    <script type="text/javascript">
        jQuery(function($){

            try {
                Dropzone.autoDiscover = false;

                var myDropzone = new Dropzone('#dropzone', {
                    previewTemplate: $('#preview-template').html(),

                    thumbnailHeight: 120,
                    thumbnailWidth: 120,
                    maxFilesize: 0.5,


                    dictDefaultMessage :
                        '<span class="bigger-150 bolder"><i class="ace-icon fa fa-caret-right red"></i> Drop files</span> to upload \
                        <span class="smaller-80 grey">(or click)</span> <br /> \
                        <i class="upload-icon ace-icon fa fa-cloud-upload blue fa-3x"></i>'
                    ,

                    thumbnail: function(file, dataUrl) {
                        if (file.previewElement) {
                            $(file.previewElement).removeClass("dz-file-preview");
                            var images = $(file.previewElement).find("[data-dz-thumbnail]").each(function() {
                                var thumbnailElement = this;
                                thumbnailElement.alt = file.name;
                                thumbnailElement.src = dataUrl;
                            });
                            setTimeout(function() { $(file.previewElement).addClass("dz-image-preview"); }, 1);
                        }
                    }

                });


                //simulating upload progress
                var minSteps = 6,
                    maxSteps = 60,
                    timeBetweenSteps = 100,
                    bytesPerStep = 100000;

                myDropzone.uploadFiles = function(files) {
                    var self = this;

                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];
                        totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

                        for (var step = 0; step < totalSteps; step++) {
                            var duration = timeBetweenSteps * (step + 1);
                            setTimeout(function(file, totalSteps, step) {
                                return function() {
                                    file.upload = {
                                        progress: 100 * (step + 1) / totalSteps,
                                        total: file.size,
                                        bytesSent: (step + 1) * file.size / totalSteps
                                    };

                                    self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
                                    if (file.upload.progress == 100) {
                                        file.status = Dropzone.SUCCESS;
                                        self.emit("success", file, 'success', null);
                                        self.emit("complete", file);
                                        self.processQueue();
                                    }
                                };
                            }(file, totalSteps, step), duration);
                        }
                    }
                }


                //remove dropzone instance when leaving this page in ajax mode
                $(document).one('ajaxloadstart.page', function(e) {
                    try {
                        myDropzone.destroy();
                    } catch(e) {}
                });

            } catch(e) {
                alert('Dropzone.js does not support older browsers!');
            }

        });
    </script>
