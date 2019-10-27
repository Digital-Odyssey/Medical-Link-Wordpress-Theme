<?php
// Appointment form template
 
 global $medicallink_options;
 
 $terms = '';
 
 if( post_type_exists( 'post_locations' ) ) :
 	$terms = get_terms( 'locations_countries');
 endif;
 
?>

<!-- Request appointment form -->
<div class="pm-request-appointment-form" id="pm-appointment-form-container">

    <?php 
    
        $recipient_email = $medicallink_options['opt-appointment-form-recipient-email'];
		$displayConsentCheckbox = get_theme_mod('displayConsentCheckbox', 'off');
		$consentMessage = get_theme_mod('consentMessage');
    
    ?>
    
    <div class="container">
        <div class="row">
            
            <form action="#" method="post" id="pm-appointment-form">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <input name="pm_app_form_name" id="pm_app_form_name" type="text" class="pm-request-appointment-form-textfield" placeholder="<?php esc_attr_e('Full Name', 'medicallinktheme') ?>">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <input name="pm_app_form_email" id="pm_app_form_email" type="email" class="pm-request-appointment-form-textfield" placeholder="<?php esc_attr_e('Email Address', 'medicallinktheme') ?>">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <input name="pm_app_form_phone" id="pm_app_form_phone" type="text" class="pm-request-appointment-form-textfield" placeholder="<?php esc_attr_e('Phone Number', 'medicallinktheme') ?>">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <input name="pm_app_form_date" id="pm_app_form_date" class="pm-request-appointment-form-textfield appointment-form-datepicker" type="text" placeholder="<?php esc_attr_e('Date of Appointment', 'medicallinktheme') ?>">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <input name="pm_app_form_time" id="pm_app_form_time" class="pm-request-appointment-form-textfield" type="text" placeholder="<?php esc_attr_e('Time of Appointment (ex. 10:30am)', 'medicallinktheme') ?>">
                </div>
                
                <?php if( post_type_exists( 'post_locations' ) ) : ?>
                
                	<?php $pm_ln_activate_country_list = get_option('pm_ln_activate_country_list'); ?>
                    
                    <?php if( $pm_ln_activate_country_list === 'yes' ) : ?>
                    
                    	<?php if( is_array($terms) && count($terms) > 0 ) : ?>
                    
                            <div class="col-lg-6 col-md-6 col-sm-12">
                        
                                <select class="pm-request-appointment-form-select-field" name="pm_app_form_country" id="pm_app_form_country">
                                    <option value="default"><?php esc_attr_e('-- Choose a location --', 'medicallinktheme') ?></option>
                                    <?php
                                        foreach ($terms as $term) {
                                            echo '<option value="'.htmlentities($term->name).'">'.$term->name.'</option>';	
                                        }
                                    ?>
                                </select>
                                
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div id="pm_app_form_locations_container">
                                    <select class="pm-request-appointment-form-select-field" name="pm_app_form_locations" id="pm_app_form_locations" disabled="disabled">
                                        <option value="default"><?php esc_attr_e('-- Choose an address --', 'medicallinktheme') ?></option>
                                    </select>
                                </div>
                            </div>
                        
                        <?php endif; ?>
                    
                    <?php endif; ?>
                
                <?php endif; ?>
                
                <?php if($displayConsentCheckbox === 'on') : ?>
                
                	<div class="col-lg-12 pm-clear-element pm-containerMargin-top-30">
                    	<div class="form-group pm-center">
                            <input type="checkbox" name="pm_appointment_form_consent_box" id="pm_appointment_form_consent_box" />
                            <span class="pm-appointment-form-notice"><?php echo $consentMessage; ?></span>
                        </div>
                    </div>
                
                <?php endif; ?>
                
                <div class="col-lg-12 pm-clear-element">
                
                    <div id="pm-appointment-form-response"></div>
                
                    <input type="submit" value="<?php esc_attr_e('Submit Request', 'medicallinktheme') ?>" class="pm-square-btn appointment-form" id="pm-appointment-form-btn" />
                    <p class="pm-appointment-form-notice"><?php esc_attr_e('All fields are required.', 'medicallinktheme') ?></p>
                    <a href="#" class="pm-appointment-form-close" id="pm-close-appointment-form"><i class="fa fa-close"></i> <?php esc_attr_e('Close Appointment form', 'medicallinktheme') ?></a>
                    
                </div>
                
                <input type="hidden" value="<?php echo esc_attr($recipient_email); ?>" name="pm_app_form_recipient" id="pm_app_form_recipient" />
                
                <?php wp_nonce_field('pm_ln_nonce_action','pm_ln_send_appointment_nonce');  ?>
                
            </form>
            
        </div>
    </div>
    
</div>
<!-- Request appointment form end -->