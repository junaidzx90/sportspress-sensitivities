jQuery(document).ready(function ($) {
    $(document).on("click", ".add_cs_field", function(e){
        e.preventDefault();
        let which = $(this).data('pos');
        let ID = new Date().getTime();

        let element = `<div class="sc_input"> <span class="remove_cs_field">+</span> <input type="text" placeholder="Description" name="cs_fields[${which}][${ID}]"> </div>`;

        // If input is not there, remove the alert
        if($(this).parents(".sensitivity__contents").find(".input_fields").children(".sc_input").length === 0){
            $(this).parents(".sensitivity__contents").find(".input_fields").html("");
        }

        // Adding new input
        $(this).parents(".sensitivity__contents").find(".input_fields").append(element);
    });
    
    function emptyDataAlert(){
        $(".input_fields").each(function(){
            if($(this).children().length === 0){
                $(this).html('<p>No fields are added.</p>');
            }
        })
    }

    $(document).on("click", ".remove_cs_field", function(){
        $(this).parent().remove();
        emptyDataAlert();
    });
});