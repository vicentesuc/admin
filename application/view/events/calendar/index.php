<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h1>
                    Calendario
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Eventos
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 ">
                            <div class="form-group">
                                <label for="">Franquicia</label>
                                <select class="form-control" id="sel_franchise" name="sel_franchise">
                                    <option value="">Todas</option>
                                    <?php foreach ($arrFranchise as $key => $value) {
                                        $selected = ((isset($_REQUEST["franchise"]) ? $_REQUEST["franchise"] : null) == $value["id"]) ? "selected" : null;
                                        ?>
                                        <option value="<?php echo $value["id"] ?>" <?php echo $selected; ?> ><?php echo $value["es_name"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 ">
                            <div class="form-group">
                                <label for="input_fr_language">Idioma:</label>
                                <select class="form-control" id="sel_language" name="sel_language">
                                    <option value="">Todas</option>
                                    <?php foreach ($arrLanguages as $key => $value) {
                                        $selected = (((isset($_REQUEST["language"])) ? $_REQUEST["language"] : null) == $value) ? "selected" : "";
                                        $languaje = ($value == "es") ? "español" : "ingles";
                                        ?>
                                        <option value="<?php echo $value ?>" <?php echo $selected; ?> ><?php echo $languaje; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-10 col-xs-12 col-lg-10 ">
                    <div class="space"></div>

                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(function ($) {

        $("#sel_franchise ,#sel_language ").change(function () {

            var arreglo = {
                url: "<?php echo URL ?>events/calendar",
                params: {},
                method: "GET"
            }
            if ($("#sel_franchise").val() !== "")
                arreglo.params.franchise = $("#sel_franchise").val();

            if ($("#sel_language").val() !== "")
                arreglo.params.language = $("#sel_language").val();

            send_submit(arreglo);
        })


        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();


        var calendar = $('#calendar').fullCalendar({

            buttonHtml: {
                prev: '<i class="ace-icon fa fa-chevron-left"></i>',
                next: '<i class="ace-icon fa fa-chevron-right"></i>'
            },

            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: <?php echo json_encode($events, JSON_PRETTY_PRINT); ?>
            ,

            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (date) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');
                var $extraEventClass = $(this).attr('data-class');


                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = false;
                if ($extraEventClass) copiedEventObject['className'] = [$extraEventClass];

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }

            }
            ,
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {

                bootbox.prompt("New Event Title:", function (title) {
                    if (title !== null) {
                        calendar.fullCalendar('renderEvent',
                            {
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay,
                                className: 'label-info'
                            },
                            true // make the event "stick"
                        );
                    }
                });


                calendar.fullCalendar('unselect');
            }
            ,
            eventClick: function (calEvent, jsEvent, view) {

                //display a modal
                var modal =
                    '<div class="modal fade">\
                      <div class="modal-dialog">\
                       <div class="modal-content">\
                         <div class="modal-body">\
                           <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>\
                           <form class="no-margin">\
                              <label>Change event name &nbsp;</label>\
                              <input class="middle" autocomplete="off" type="text" value="' + calEvent.title + '" />\
					 <button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Save</button>\
				   </form>\
				 </div>\
				 <div class="modal-footer">\
					<button type="button" class="btn btn-sm btn-danger" data-action="delete"><i class="ace-icon fa fa-trash-o"></i> Delete Event</button>\
					<button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>\
				 </div>\
			  </div>\
			 </div>\
			</div>';

                var modal = $(modal).appendTo('body');
                modal.find('form').on('submit', function (ev) {
                    ev.preventDefault();

                    calEvent.title = $(this).find("input[type=text]").val();
                    calendar.fullCalendar('updateEvent', calEvent);
                    modal.modal("hide");
                });
                modal.find('button[data-action=delete]').on('click', function () {
                    calendar.fullCalendar('removeEvents', function (ev) {
                        return (ev._id == calEvent._id);
                    })
                    modal.modal("hide");
                });

                modal.modal('show').on('hidden', function () {
                    modal.remove();
                });

            }
        });
    })
</script>
