<form action="<?php echo URL ?>stand/postMedia"
      class="dropzone well"
      id="dropzoneStand">
    <input type="hidden" value="<?php echo $_REQUEST["id"]; ?>" id="input_stand_id" name="input_stand_id">

    <div class="fallback">
        <input name="file" type="file" multiple=""/>
    </div>
</form>
<script type="text/javascript">

    try {
        Dropzone.autoDiscover = false;

        var myDropzone = new Dropzone("#dropzoneStand", {

            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 10.0, // MB
            addRemoveLinks: true,
            previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-details\">\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n    <div class=\"dz-size\" data-dz-size></div>\n    <img data-dz-thumbnail />\n  </div>\n  <div class=\"progress progress-small progress-striped active\"><div class=\"progress-bar progress-bar-success\" data-dz-uploadprogress></div></div>\n  <div class=\"dz-success-mark\"><span></span></div>\n  <div class=\"dz-error-mark\"><span></span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n</div>",
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF",
            maxFiles: 1,
            init: function () {
                this.on("success", function (file, responseText) {
                    $("#stand_image").trigger("click");
                    array = responseText.split("|");
                });
            },
        });
    } catch (e) {
        // alert('Dropzone.js does not support older browsers!');
    }
</script>
