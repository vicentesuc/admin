<div>
    <ul class="ace-thumbnails clearfix" id="document_list">
        <?php foreach ($arrStandsMedia as $key => $value) {
            $imageFileType = pathinfo($value["media_url"], PATHINFO_EXTENSION);
            if (in_array($imageFileType, $valid_extensions)) {
                ?>
                <li>
                    <a target="_blank" href="<?php echo IMAGES . "/" . $value["media_url"] ?>" data-rel="colorbox">
                        <img width="150" height="150" alt="150x150"
                             src="<?php echo IMAGES . "/avatars/pdf.png" ?>"/>
                        <div class="text">
                            <div class="inner"><?php echo $value["media_name"]; ?></div>
                        </div>
                    </a>
                    <div class="tools">
                        <a href="#"
                           media="<?php echo $value["media_id"] ?>"
                           stand="<?php echo $value["stand_id"] ?>"
                           id="mypdfdocu">
                            <i class="ace-icon fa fa-times red"></i>
                        </a>
                        <a href="#"
                           media="<?php echo $value["media_id"] ?>"
                           stand="<?php echo $value["stand_id"] ?>"
                           id="mypdfdocuEdit"
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

        $("a#mypdfdocu").click(function () {

            var arreglo = {
                url: "<?php echo URL ?>media/stand_media_delete",
                params: {
                    media: $(this).attr("media"),
                    stand: $(this).attr("stand")
                }
            }

            ajax_send(arreglo, (resp) => {
                var response = JSON.parse(resp);

                messages(response)

                if (response.code === "OK") {
                    $("#tabStandDocumentHref").trigger("click");
                }
            });
        })

        $("a#mypdfdocuEdit").click(function () {
            var arreglo = {
                url: "<?php echo URL ?>media/edit",
                params: {
                    media: $(this).attr("media"),
                    stand: $(this).attr("stand")
                },
                title: "Editar"
            }
            ajax_on_popup(arreglo)
        })

        $(document).one('ajaxloadstart.page', function (e) {
            $('#colorbox, #cboxOverlay').remove();
        });
    })
</script>