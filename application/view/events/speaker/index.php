<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active">
                    <a data-toggle="tab" href="#moderaror">
                        Moderador(es)
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#expositor">
                        Expositor(es)
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="moderaror" class="tab-pane fade in active">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 ">
                            <form id="formSelected" action="#" class="wizard-big">
                                <select id="selModerator" class="form-control dual_select" multiple>
                                    <?php foreach ($arrSpeakers as $key => $value) {
                                        $selected = array_key_exists($value["id"], $arrModerator) ? "selected" : "";
                                        ?>
                                        <option value="<?php echo $value["id"]; ?>" <?php echo $selected; ?> ><?php echo $value["name"] ?></option>
                                    <?php } ?>
                                </select>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 ">
                            <div class="clearfix form-actions">
                                <div class="col-md-offset-8 col-md-9">
                                    <button class="btn btn-info btn-sm" id="btn_save_moderator" type="button">
                                        <i class="ace-icon fa fa-save bigger-110"></i>
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="expositor" class="tab-pane fade">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 ">
                            <form id="formSelected" action="#" class="wizard-big">
                                <select id="selExpositor" class="form-control dual_select" multiple>
                                    <?php foreach ($arrSpeakers as $key => $value) {
                                        $selected = array_key_exists($value["id"], $arrExpositor) ? "selected" : "";
                                        ?>
                                        <option value="<?php echo $value["id"]; ?>" <?php echo $selected; ?> ><?php echo $value["name"] ?></option>
                                    <?php } ?>
                                </select>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 ">
                            <div class="clearfix form-actions">
                                <div class="col-md-offset-8 col-md-9">
                                    <button class="btn btn-info btn-sm" id="btn_save_expositor" type="button">
                                        <i class="ace-icon fa fa-save bigger-110"></i>
                                        Guardar
                                    </button>
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
    jQuery(function ($) {


        $('.dual_select').bootstrapDualListbox({
            selectorMinimalHeight: 400,
            // nonSelectedListLabel: 'Non-selected',
            // selectedListLabel: 'Selected',
            preserveSelectionOnMove: 'moved',
            moveOnSelect: false,
        });

        $("#btn_save_moderator").click(function () {
            let arreglo = {
                url: "<?php echo URL ?>events/postSpeaker",
                params: {
                    speaker: $("#selModerator").val(),
                    event: "<?php echo isset($_REQUEST["id"]) ? $_REQUEST["id"] : 0; ?>",
                    profile: "<?php echo MODERATOR ?>"
                }
            }

            ajax_send(arreglo, (resp) => {
                var response = JSON.parse(resp);
                messages(response)
                if (response.code === "OK") {

                }
            })
        })

        $("#btn_save_expositor").click(function () {
            let arreglo = {
                url: "<?php echo URL ?>events/postSpeaker",
                params: {
                    speaker: $("#selModerator").val(),
                    event: "<?php echo isset($_REQUEST["id"]) ? $_REQUEST["id"] : 0; ?>",
                    profile: "<?php echo EXPOSITOR ?>"
                }
            }

            ajax_send(arreglo, (resp) => {
                var response = JSON.parse(resp);
                messages(response)
                if (response.code === "OK") {

                }
            })
        })

    })
</script>