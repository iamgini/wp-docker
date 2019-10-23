wp.customize.controlConstructor['bam-slider'] = wp.customize.Control.extend({

    ready: function() {

        'use strict';
        
        var control             = this,
            // changeAction        = ( 'postMessage' === control.setting.transport ) ? 'mousemove change' : 'change',
            rangeInput          = control.container.find( '.bam-slider' ),
            textInput           = control.container.find( '.bam-slider-text' ),
			resetBtn            = control.container.find( '.bam-slider-reset' ),
            value               = control.setting._value;
            
        // Set the initial value in the text input.
        textInput.attr( 'value', value );
        
		// If the range input value changes copy the value to the text input.
		rangeInput.on( 'mousemove change', function() {
			textInput.attr( 'value', rangeInput.val() );
		} );

		// Save the value when the range input value changes.
		// This is separate from the above because of the postMessage differences.
		// If the control refreshes the preview pane,
		// we don't want a refresh for every change
		// but 1 final refresh when the value is changed.
		// rangeInput.on( changeAction, function() {
        //     control.setting.set( rangeInput.val() );
		// } );

        // If the text input value changes,
		// copy the value to the range input
		// and then save.
		textInput.on( 'input paste change', function() {
			rangeInput.attr( 'value', textInput.val() );
			control.setting.set( textInput.val() );
		} );

		// If the reset button is clicked,
		// set slider and text input values to default
		// and then save.
		resetBtn.on( 'click', function() {
            textInput.attr( 'value', control.params.default );
			rangeInput.attr( 'value', control.params.default );
			control.setting.set( textInput.val() );
		} );

    }

});