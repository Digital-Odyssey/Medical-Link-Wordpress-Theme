(function($) {

	$('#pm_app_form_name').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	$('#pm_app_form_email').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	$('#pm_app_form_phone').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	$('#pm_app_form_date').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	$('#pm_app_form_time').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	$('#pm_app_form_country').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	$('#pm_app_form_locations').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
		
		
	
	$('#pm-appointment-form-btn').on('click', function(e) {
							
		e.preventDefault();
								
		//var $this = $(this);
		
		$('#pm-appointment-form-response').html(wordpressOptionsObject.fieldValidation);
		
		// Collect data from inputs
		var reg_nonce = $('#pm_ln_send_appointment_nonce').val();
		var reg_full_name = $('#pm_app_form_name').val();
		var reg_email_address =  $('#pm_app_form_email').val();
		var reg_phone =  $('#pm_app_form_phone').val();
		var reg_date = $('#pm_app_form_date').val();
		var reg_time = $('#pm_app_form_time').val();
		var reg_recipient_email =  $('#pm_app_form_recipient').val();
		var reg_app_form_country = '';
		var reg_app_form_locations = '';
		var reg_location_post_type_active = 'no';
		
		if( $('#pm_app_form_country').length > 0 ) {
			reg_app_form_country = $('#pm_app_form_country').val();
			reg_app_form_locations = $('#pm_app_form_locations').val();
			reg_location_post_type_active = 'yes';
		} 
		
		var reg_consent_box = 'null';
		
		if($('#pm_appointment_form_consent_box').length > 0) {
			reg_consent_box = $('#pm_appointment_form_consent_box').attr('checked') ? 'checked' : 'unchecked';
		}

		
		/**
		 * AJAX URL where to send data 
		 * (from localize_script)
		 */
		var ajax_url = pm_ln_register_vars.pm_ln_ajax_url;
	
		// Data to send
		var data = {
		  action: 'send_appointment_form',
		  nonce: reg_nonce,
		  full_name: reg_full_name,
		  email_address: reg_email_address,
		  phone: reg_phone,
		  date: reg_date,
		  time: reg_time,
		  recipient: reg_recipient_email,
		  country: reg_app_form_country,
		  location: reg_app_form_locations,
		  locationActive: reg_location_post_type_active,
		  consent: reg_consent_box
		};	
				
		
		// Do AJAX request
		$.post( ajax_url, data, function(response) {
	
		  // If we have response
		  if(response) {
			  			  				
			if(response === "name_error") {
				
				$('#pm-appointment-form-response').html(wordpressOptionsObject.appForm1);
				$('#pm_app_form_name').addClass('invalid_field');
				
			} else if(response === "email_error") {
				
				$('#pm-appointment-form-response').html(wordpressOptionsObject.appForm2);
				$('#pm_app_form_email').addClass('invalid_field');
				
			} else if(response === "phone_error") {
				
				$('#pm-appointment-form-response').html(wordpressOptionsObject.appForm3);
				$('#pm_app_form_phone').addClass('invalid_field');
				
			} else if(response === "date_error") {
				
				$('#pm-appointment-form-response').html(wordpressOptionsObject.appForm4);
				$('#pm_app_form_date').addClass('invalid_field');
				
			} else if(response === "time_error") {
				
				$('#pm-appointment-form-response').html(wordpressOptionsObject.appForm5);
				$('#pm_app_form_time').addClass('invalid_field');
				
			
			} else if(response === "country_error") {
				
				$('#pm-appointment-form-response').html(wordpressOptionsObject.appForm6);
				$('#pm_app_form_country').addClass('invalid_field');
				
				
			} else if(response === "location_error") {
				
				$('#pm-appointment-form-response').html(wordpressOptionsObject.appForm7);
				$('#pm_app_form_locations').addClass('invalid_field');
				
			} else if( response === 'consent_error' ){
				
			  	$('#pm-appointment-form-response').html(wordpressOptionsObject.consentError);				
				
			} else if(response === "success"){
				
				$('#pm-appointment-form-response').html(wordpressOptionsObject.successMessage);
				$('#pm-appointment-form-btn').fadeOut();
				
			} else if(response === "failed"){
				
				$('#pm-appointment-form-response').html(wordpressOptionsObject.failedMessage);
				$('#pm-appointment-form-btn').fadeOut();
				
			}
			
		  }
		});
		
		
	});
	
})(jQuery);