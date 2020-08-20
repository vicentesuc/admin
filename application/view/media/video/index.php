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
                </li>
            <?php }
        } ?>
    </ul>
</div>
