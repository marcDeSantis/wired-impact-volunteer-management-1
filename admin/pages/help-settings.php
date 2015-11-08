<?php

/**
 * Output the HTML for our help & settings page.
 * 
 * Utilizes the WI_Volunteer_Management_Form class to generate the necessary HTML.
 * Every setting added here needs a default in the WI_Volunteer_Management_Options() class.
 *
 * @link       http://wiredimpact.com
 * @since      0.1
 *
 * @package    WI_Volunteer_Management
 * @subpackage WI_Volunteer_Management/Admin
 */

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'class-form.php';

$wi_form = new WI_Volunteer_Management_Form();
$wi_form->admin_header();
?>
	
	<h2 class="nav-tab-wrapper" id="wivm-tabs">
		<a class="nav-tab" id="help-tab" href="#top#help"><span class="dashicons dashicons-editor-help"></span> <?php _e( 'Help', 'wivm' ); ?></a>
		<a class="nav-tab" id="general-tab" href="#top#general"><span class="dashicons dashicons-admin-tools"></span> <?php _e( 'General', 'wivm' ); ?></a>
		<a class="nav-tab" id="defaults-tab" href="#top#defaults"><span class="dashicons dashicons-admin-generic"></span> <?php _e( 'Opportunity Defaults', 'wivm' ); ?></a>
		<a class="nav-tab" id="email-tab" href="#top#email"><span class="dashicons dashicons-email-alt"></span> <?php _e( 'Email', 'wivm' ); ?></a>
	</h2>

	<?php
	//Display hidden fields and nonces
	settings_fields( 'wivm-settings-group' );

	//Display a Help tab
	$wi_form->form_table_start( 'help' ); ?>

		<h2>FAQs and Get Started</h2>
		<p>Check out the <a target="_blank" href="https://wordpress.org/plugins/wired-impact-volunteer-management/faq/">FAQs on the WordPress plugin repository</a> to get help and learn how to get started.</p>

		<h2>Need More Help?</h2>
		<p>If the FAQs aren't cutting it and you need more help reach out to us on the <a target="_blank" href="https://wordpress.org/support/plugin/wired-impact-volunteer-management">WordPress support forums.</a></p> 
	
	<?php do_action( 'wivm_display_help_settings', $wi_form );

	$wi_form->form_table_end();

	//Display General settings tab
	$wi_form->form_table_start( 'general' );

		$wi_form->radio( 'use_css', array( 1 => __( 'Yes, please provide basic styling.', 'wivm' ), 0 => __( 'No, I\'ll code my own styling.', 'wivm' ) ), 'Load Plugin CSS?' );

		do_action( 'wivm_display_general_settings', $wi_form );

	$wi_form->form_table_end();

	//Display Defaults settings tab
	$wi_form->form_table_start( 'defaults' );

		$wi_form->section_heading( __( 'Default Contact Information', 'wivm' ), __( 'These contact settings will be loaded by default for all new volunteer opportunities, but you can customize each opportunity individually.', 'wivm' ) );
		$wi_form->textinput( 'default_contact_name', 	__( 'Default Contact Name', 'wivm' ) );
		$wi_form->textinput( 'default_contact_phone',	__( 'Default Contact Phone', 'wivm' ), array(), "format_phone_number" );
		$wi_form->textinput( 'default_contact_email', 	__( 'Default Contact Email', 'wivm' ) );

		$wi_form->section_heading( __( 'Default Location Information', 'wivm' ), __( 'These location settings will be loaded by default for all new volunteer opportunities, but you can customize each opportunity individually.', 'wivm' ) );
		$wi_form->textinput( 'default_location', 	__( 'Default Location Name', 'wivm' ) );
		$wi_form->textinput( 'default_street', 		__( 'Default Street', 'wivm' ) );
		$wi_form->textinput( 'default_city', 		__( 'Default City', 'wivm' ) );
		$wi_form->textinput( 'default_state', 		__( 'Default State', 'wivm' ) );
		$wi_form->textinput( 'default_zip', 		__( 'Default Zip', 'wivm' ) );

		do_action( 'wivm_display_defaults_settings', $wi_form );

	$wi_form->form_table_end();

	//Display Email settings tab
	$wi_form->form_table_start( 'email' );

		$wi_form->textinput( 		'from_email_address', 				__( 'From Email Address', 'wivm'), 									array( 'description' => sprintf( __( 'The email address you\'d like to send from. If blank "%s" will be used from the General Settings.', 'wivm'), get_option( 'admin_email' ) ) ) );
		$wi_form->textinput( 		'from_email_name', 					__( 'From Email Name', 'wivm'), 									array( 'description' => sprintf( __( 'The name of the person you\'d like the emails to be sent from. If blank "%s" will be used from the General Settings.', 'wivm'), get_option( 'blogname' ) ) ) );
		$wi_form->textinput( 		'volunteer_signup_email_subject', 	__( 'Volunteer Signup Email Subject', 'wivm'), 						array( 'description' => __( 'The subject of the email to a volunteer after they sign up.', 'wivm') ) );
    	$wi_form->wysiwyg_editor( 	'volunteer_signup_email', 			__( 'Volunteer Signup Email', 'wivm'), 								array( 'description' => __( 'The email to a volunteer who just RSVPed. You can use the variables {volunteer_first_name}, {volunteer_last_name}, {volunteer_phone}, {volunteer_email}, {opportunity_name}, {opportunity_date_time}, {opportunity_location}, {contact_name}, {contact_phone} and {contact_email} which will be replaced when the email is sent.', 'wivm') ) );
		$wi_form->textinput( 		'admin_email_address', 				__( 'Admin Email Address', 'wivm'), 								array( 'description' => __( 'The person to notify when volunteers sign up. The contact for the volunteer opportunity will also be notified. If this field is blank then only the contact will be notified.', 'wivm') ) );
    	$wi_form->textinput( 		'admin_signup_email_subject', 		__( 'Admin Signup Email Subject', 'wivm'), 							array( 'description' => __( 'The subject of the email to the admin after someone RSVPs.', 'wivm') ) );
    	$wi_form->wysiwyg_editor( 	'admin_signup_email', 				__( 'Admin Signup Email', 'wivm'), 									array( 'description' => __( 'The email to the admin after someone RSVPs. You can use the variables {volunteer_first_name}, {volunteer_last_name}, {volunteer_phone}, {volunteer_email}, {opportunity_name}, {opportunity_date_time}, {opportunity_location}, {contact_name}, {contact_phone} and {contact_email} which will be replaced when the email is sent.', 'wivm') ) );
		$wi_form->textinput( 		'days_prior_reminder', 				__( 'Number of Days Prior to Opportunity to Send Reminder', 'wivm'),array( 'description' => __( 'The number of days prior to a one-time volunteer opportunity to send a reminder. Flexible opportunities do not send a reminder email. Ex: 4', 'wivm') ) );
		$wi_form->textinput( 		'volunteer_reminder_email_subject',	__( 'Volunteer Reminder Email Subject', 'wivm'), 					array( 'description' => __( 'The subject of the reminder email sent to volunteers prior to their opportunity.', 'wivm') ) );
    	$wi_form->wysiwyg_editor( 	'volunteer_reminder_email', 		__( 'Volunteer Reminder Email', 'wivm'), 							array( 'description' => __( 'The reminder email to volunteers before their opportunity arrives. This is sent to the admins with the volunteers BCC\'ed. That way you know when the email has gone out. You can use the variables {opportunity_name}, {opportunity_date_time}, {opportunity_location}, {contact_name}, {contact_phone} and {contact_email} which will be replaced when the email is sent. Since only one email is sent do not use any of the volunteer specific variables.', 'wivm') ) );

    	do_action( 'wivm_display_email_settings', $wi_form );

	$wi_form->form_table_end();

$wi_form->admin_footer();