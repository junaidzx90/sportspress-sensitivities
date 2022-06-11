jQuery(function ($) {
    $(".sc_slider").each(function(){
        let _R = $(this), _O = _R.prev();
        _R.on("input", function(e){
            _O.val(_R.val()+"%");
        } );
    });
});
