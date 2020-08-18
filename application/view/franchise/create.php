<div class="row">
    <div class="col-xs-12">

        <form class="form-horizontal" role="form" id="form-franchise">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="input_franchise_es">Nombre en
                    español </label>
                <div class="col-sm-9">
                    <input type="text" id="input_franchise_es" name="input_franchise_es" required
                           class="col-xs-10 col-sm-5"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="input_franchise_en">Nombre en ingles</label>
                <div class="col-sm-9">
                    <input type="text" id="input_franchise_en" name="input_franchise_en" required
                           class="col-xs-10 col-sm-5"/>
                </div>
            </div>

            <div class="clearfix form-actions">
                <div class="col-md-offset-3 col-md-9">
                    <button class="btn btn-info" id="btn_franchise_add" type="button">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Guardar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $("#btn_franchise_add").click(function () {
        valid_form("form-franchise", () => {
            var arreglo = {
                url: "<?php  echo URL ?>franchise/createPost",
                method: "POST",
                params: form_to_json("form-franchise")
            }


            ajax_send(arreglo, (resp) => {
                var response = JSON.parse(resp);
                console.log(response);
            });
        })
    })
</script>