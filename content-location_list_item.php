<?php
/**
 * The default template for displaying a location list item for the appointment form.
 */
?>

<?php 

	//Meta boxes
	$pm_ln_location_address_meta = get_post_meta( get_the_ID(), 'pm_ln_location_address_meta', true );
	$pm_ln_location_city_meta = get_post_meta( get_the_ID(), 'pm_ln_location_city_meta', true );
	$pm_ln_location_province_meta = get_post_meta( get_the_ID(), 'pm_ln_location_province_meta', true );
	$pm_ln_location_zip_meta = get_post_meta( get_the_ID(), 'pm_ln_location_zip_meta', true );
		
?>

<option value="<?php echo esc_attr($pm_ln_location_address_meta); ?> - <?php echo esc_attr($pm_ln_location_city_meta); ?>, <?php echo esc_attr($pm_ln_location_province_meta); ?>"><?php echo esc_attr($pm_ln_location_address_meta); ?> - <?php echo esc_attr($pm_ln_location_city_meta); ?>, <?php echo esc_attr($pm_ln_location_province_meta); ?></option>