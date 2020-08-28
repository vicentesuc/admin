<div>
    <ul class="ace-thumbnails clearfix">
        <?php foreach ($arrMediaImages as $key => $value) {
            $videoFileType = pathinfo($value["media_url"], PATHINFO_EXTENSION);
            if (in_array($videoFileType, $valid_extensions)) {
                ?>
                <li>
                    <a href="<?php echo IMAGES . "/" . $value["media_url"] ?>" data-rel="colorbox">
                        <video width="400" controls>
                            <source src="<?php echo IMAGES . "/" . $value["media_url"] ?>" type="video/mp4">
                        </video>
                    </a>
                    <div class="tools tools-top">
                        <a href="#"
                           media="<?php echo $value["media_id"] ?>"
                           event="<?php echo $value["id"] ?>"
                           id="myvideodocu"
                        >
                            <i class="ace-icon fa fa-times red"></i>
                        </a>
                        <a href="#"
                           media="<?php echo $value["media_id"] ?>"
                           event="<?php echo $value["id"] ?>"
                           id="myvideodocuEdit"
                        >
                            <i class="ace-icon fa fa-edit blue"></i>
                        </a>
                    </div>
                </li>
            <?php }
        } ?>
    </ul>
</div>
<script>
    jQuery(function ($) {

        $("a#myvideodocu").click(function () {

            var arreglo = {
                url: "<?php echo URL ?>media/delete",
                params: {
                    media: $(this).attr("media"),
                    event: $(this).attr("event")
                }
            }

            ajax_send(arreglo, (resp) => {
                var response = JSON.parse(resp);

                messages(response)

                if (response.code === "OK") {
                    $("#tabVideo").trigger("click");
                }
            });
        })

        $("a#myvideodocuEdit").click(function () {
            var arreglo = {
                url: "<?php echo URL ?>media/edit",
                params: {
                    media: $(this).attr("media"),
                    event: $(this).attr("event")
                },
                title: "Editar"
            }
            ajax_on_popup(arreglo)
        })

    })
</script>