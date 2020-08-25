<div class="row">
    <div class="col-md-12">
        <div class="clearfix">
            <div class="pull-left">
                <div class="btn-toolbar inline middle no-margin">
                    <div data-toggle="buttons" class="btn-group no-margin">
                        <label class="btn btn-sm btn-info" id="btnAddStand">
                        <span class="bigger-110" title="Nuevo Stand">
                             <a href="#" id="add_new_stand">
                                <icon class="ace-icon fa fa-plus white "></icon>
                             </a>
                        </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <ul class="ace-thumbnails clearfix" id="document_list">
            <?php foreach ($arrStands as $key => $value) {
                $imageFileType = pathinfo($value["media_url"], PATHINFO_EXTENSION);
                if (in_array($imageFileType, $valid_extensions)) {
                    ?>
                    <li>
                        <a id="stand_image" stand="<?php echo $value["stand_id"]; ?>" data-rel="colorbox">
                            <img width="150" height="150" alt="150x150"
                                 src="<?php echo IMAGES . "/avatars/pdf.png" ?>"/>
                            <div class="text">
                                <div class="inner"><?php echo $value["media_name"]; ?></div>
                            </div>
                        </a>
                        <div class="tools">
                            <a href="#"
                               stand="<?php echo $value["stand_id"] ?>"
                               event="<?php echo $value["event_id"] ?>"
                               id="mystandDoc">
                                <i class="ace-icon fa fa-times red"></i>
                            </a>
                        </div>
                    </li>
                <?php }
            } ?>
        </ul>
    </div>
</div>
<script>

    $("#btnAddStand").click(function () {
        var arreglo = {
            url: "<?php echo URL ?>stand/create",
            params: {
                id: "<?php echo $_REQUEST["id"]; ?>",
            },
            method: "POST",
            title: "Agregar Stand"
        }
        ajax_on_popup(arreglo);
    })

    $("a#stand_image").click(function () {

        var arreglo = {
            url: "<?php echo URL ?>stand/list",
            params: {
                id: $(this).attr("stand")
            },
            method: "POST",
            div: "div_stand_image"
        }
        ajax_on_div(arreglo);


        var arreglo = {
            url: "<?php echo URL ?>stand/upload",
            params: {
                id: $(this).attr("stand")
            },
            method: "POST",
            div: "div_stand_img_upload"
        }
        ajax_on_div(arreglo);

    })

</script>