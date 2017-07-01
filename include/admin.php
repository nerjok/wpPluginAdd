<?php

	function add2plug_admin_page() {

	if ( ! current_user_can( 'manage_options' ) ) {
					 return;
					 }
		  
				 if ( isset( $_GET['settings-updated'] ) ) {
				 add_settings_error( 'add2plug_messages', 'add2plug_message', __( 'Settings Saved', 'add2plug' ), 'updated' );
				 }
		 
		 settings_errors( 'add2plug_messages' );
		 ?>
		 <div class="wrap">
		 <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		 <form action="options.php" method="post">
		 <?php

		 settings_fields( 'add2plug' );

		 do_settings_sections( 'add2plug' );

		 submit_button( 'Save Settings' );
		 ?>
		 </form>
		 </div>
		 <?php
	}
	
	/**
	 *
	 * admin panel construction
	 */
	function addParserAdmin() 
	{

		register_setting( 'add2plug', RSSFEED );
		 
			 add_settings_section(
			 'add2plug_admine_panel',
			 __( 'This is a section title.', 'add2plug' ),
			 'add2plug_section_admin',
			 'add2plug'
			 );
		 
				 add_settings_field(
				 'count_field',
				 __( 'Entry count per view', 'add2plug' ),
				 'add2plug_admin_fields',
				 'add2plug',
				 'add2plug_admine_panel',
				 
				 [
				 'label_for' => 'count',
				 'class' => 'count_row',
				 'count_custom_data' => 'custom',
				 'type' => 'number',
				 ]
				 );
		 
			 add_settings_field(
				 'wporg_field_pill2',
				 __( 'URL to parse', 'add2plug' ),
				 'add2plug_admin_fields',
				 'add2plug',
				 'add2plug_admine_panel',
				 [
				 'label_for' => 'url',
				 'class' => 'url_row',
				 'url_custom_data' => 'custom',
				 'type' => 'url',
				 ]
				 );
		}
		
	/**
	 *
	 *  subsidiary functions to help register admin panel
	 */
	 function add2plug_section_admin( $args ) {
		 ?>
		 <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Please edit following options.', 'add2plug' ); ?></p>
		 <?php
	}


	function add2plug_admin_fields( $args ) {

		 $options = get_option(RSSFEED);
		 ?>
		 
		 <input name="<?php echo RSSFEED.'['.esc_attr( $args['label_for'] ).']'; ?>" 
		 type="<?php echo esc_attr( $args['type'] ); ?>" 
		 id="<?php echo esc_attr( $args['label_for'] ); ?>" 
		 value="<?php echo $options[$args['label_for']]; ?>" />
		 
		 
		 <?php
	}