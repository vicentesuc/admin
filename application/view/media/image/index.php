<div>
    <ul class="ace-thumbnails clearfix" id="image_list">
        <?php foreach ($arrMediaImages as $key => $value) {
            $imageFileType = pathinfo($value["media_url"], PATHINFO_EXTENSION);
            if (in_array($imageFileType, $valid_extensions)) {
                ?>
                <li>
                    <a href="<?php echo IMAGES . "/" . $value["media_url"] ?>" data-rel="colorbox">
                        <img width="150" height="150" alt="150x150"
                             src="<?php echo IMAGES . "/" . $value["media_url"] ?>"/>
                        <div class="text">
                            <div class="inner"><?php echo $value["media_name"]; ?></div>
                        </div>
                    </a>
                    <div class="tools">
                        <a href="#"
                           media="<?php echo $value["media_id"] ?>"
                           event="<?php echo $value["id"] ?>"
                           id="myimagedocu"
                        >
                            <i class="ace-icon fa fa-times red"></i>
                        </a>

                        <a href="#"
                           media="<?php echo $value["media_id"] ?>"
                           event="<?php echo $value["id"] ?>"
                           id="myimagedocuEdit"
                        >
                            <i class="ace-icon fa fa-edit blue"></i>
                        </a>
                    </div>
                </li>
            <?php }
        } ?>
    </ul>
</div>
<script type="text/javascript">
    jQuery(function ($) {
        var $overflow = '';
        var colorbox_params = {
            rel: 'colorbox',
            reposition: true,
            scalePhotos: true,
            scrolling: false,
            previous: '<i class="ace-icon fa fa-arrow-left"></i>',
            next: '<i class="ace-icon fa fa-arrow-right"></i>',
            close: '&times;',
            current: '{current} of {total}',
            maxWidth: '100%',
            maxHeight: '100%',
            onOpen: function () {
                $overflow = document.body.style.overflow;
                document.body.style.overflow = 'hidden';
            },
            onClosed: function () {
                document.body.style.overflow = $overflow;
            },
            onComplete: function () {
                $.colorbox.resize();
            }
        };

        $('#image_list [data-rel="colorbox"]').colorbox(colorbox_params);
        $("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon

        $("a#myimagedocu").click(function () {

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
                    $("#tabImages").trigger("click");
                }
            });
        })

        $(document).one('ajaxloadstart.page', function (e) {
            $('#colorbox, #cboxOverlay').remove();
        });

        $("a#myimagedocuEdit").click(function () {
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