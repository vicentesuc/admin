<div class="tabbable">
    <ul class="nav nav-tabs" id="myTab">
        <li class="active">
            <a data-toggle="tab" href="#tabImagesStand" id="tabImagesStandHref">
                <i class="green ace-icon fa fa-image bigger-120"></i>
                Imagenes
            </a>
        </li>
        <li>
            <a data-toggle="tab" href="#tabStandVideo" id="tabStandVideoHref">
                <i class="blue ace-icon fa fa-video-camera bigger-120"></i>
                Video
            </a>
        </li>
        <li>
            <a data-toggle="tab" href="#tabStandDocument" id="tabStandDocumentHref">
                <i class="purple ace-icon fa fa-file-pdf-o bigger-120"></i>
                Document
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
        <div id="tabStandVideo" class="tab-pane fade ">
            <div id="div_stand_video"></div>
        </div>
        <div id="tabStandDocument" class="tab-pane fade ">
            <div id="div_stand_document"></div>
        </div>
        <div id="tabUploadStands" class="tab-pane fade">
            <form action="<?php echo URL ?>stand/postMedia"
                  class="dropzone well"
                  id="dropzoneStand">
                <input type="hidden" value="<?php echo $_REQUEST["id"]; ?>" id="input_stand_id" name="input_stand_id">

                <div class="fallback">
                    <input name="file" type="file" multiple=""/>
                </div>
            </form>
        </div>
    </div>
</div>

<script>


    var startImagesStand = function () {
        var arreglo = {
            url: "<?php echo URL ?>stand/images",
            params: {
                id: "<?php echo isset($_REQUEST["id"]) ? $_REQUEST["id"] : "0"; ?>"
            },
            method: "POST",
            div: "div_stand_image"
        }
        ajax_on_div(arreglo);
    }

    var startVideoStand = function () {
        var arreglo = {
            url: "<?php echo URL ?>stand/video",
            params: {
                id: "<?php echo isset($_REQUEST["id"]) ? $_REQUEST["id"] : "0"; ?>"
            },
            method: "POST",
            div: "div_stand_video"
        }
        ajax_on_div(arreglo);
    }

    var startDocsStand = function () {
        var arreglo = {
            url: "<?php echo URL ?>stand/document",
            params: {
                id: "<?php echo isset($_REQUEST["id"]) ? $_REQUEST["id"] : "0"; ?>"
            },
            method: "POST",
            div: "div_stand_document"
        }
        ajax_on_div(arreglo);
    }

    startImagesStand();

    $("#tabImagesStandHref").click(function () {
        startImagesStand();
    })

    $("#tabStandVideoHref").click(function () {
        startVideoStand();
    })

    $("#tabStandDocumentHref").click(function () {
        startDocsStand();
    })

    try {
        var myDropzone = new Dropzone("#dropzoneStand", {

            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 10.0, // MB
            addRemoveLinks: true,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF,.pdf,.mp4",
            maxFiles: 1,
            init: function () {
                this.on("success", function (file, responseText) {
                    array = responseText.split("|");
                    // console.log(array);
                });
            },
        });
    } catch (e) {
    }
</script>
