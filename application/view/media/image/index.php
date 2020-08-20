<div>
    <ul class="ace-thumbnails clearfix" id="image_list" >
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


        $(document).one('ajaxloadstart.page', function (e) {
            $('#colorbox, #cboxOverlay').remove();
        });
    })
</script>