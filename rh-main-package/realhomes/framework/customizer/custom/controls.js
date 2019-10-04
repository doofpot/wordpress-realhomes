jQuery( document ).ready( function() {

    /**
     * Multiple Checkbox Control
     */

    function RhTrigerChange(){
        var checkbox_values = jQuery( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
            function() {
                return this.value;
            }
        ).get().join( ',' );

        jQuery( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
    }

    jQuery( '.customize-control-multiple-checkbox input[type="checkbox"]' ).on('change',RhTrigerChange);

    $( "#rh_sortable" ).sortable({
        // placeholder: "ui-state-highlight",
        update: RhTrigerChange
    });



} ); // jQuery( document ).ready
