<?php
	
	//Let's build a modern options page. 
	add_action('admin_menu', 'citethis_admin_page');
	function citethis_admin_page() {
		//Add that options page title, menu item title, user level required to use, the options slug, the output function
		add_options_page('Cite This Plugin Options', 'Cite This Options', 'manage_options', 'citethis', 'citethis_options_page');
	
	}
	
	//create and display the options administration page. 
	function citethis_options_page() {
	
		?>
		
			<div>
				<h2>Cite This Options</h2>
				Options for the Cite This Plugin.
				<form action="options.php" method="post">
					<?php //Create a storage for the option set. 
						settings_fields('citethis_options'); ?>
					<?php //Initiate the option sets. 
						do_settings_sections('citethis_manager');
						//do_settings_sections('citethis_styles');
						//do_settings_sections('citethis_generals');
						//do_settings_sections('citethis_citations');
						//Then the submit button.
						
						//jQuery code to make it function.
						//add_jquery();
						//CTAddOptionsJS();
					?>
					<br />
					<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
				</form>
				
				<p>Origonally created by Yu-Jie Lin. Updated by Aram Zucker-Scharff</p>
			</div>
		
		<?php
/**		
		if ( 'reset' == $_REQUEST['action'] ) {
			//protext against request forgery
			check_admin_referer('citethis-reset');
			//delete the options
			foreach ($gOptions as $value) {
				delete_option( $value['id'] ); }
				
				header("Location: options-general.php?page=citethis&reset=true");
				die;
				
		}
**/	
	}
	
	//Let's initate the options for this plugin.
	add_action('admin_init', 'citethis_admin_init');
	function citethis_admin_init(){
	
		//the name of the group, the name of the option (array), the name of the validation function.
		register_setting('citethis_options', 'citethis_options', 'citethis_options_validate');
		//Slug for the section, title of the section, call to generate the section title, menu page section associated with.
		add_settings_section('citethis_manage', 'Manage Cite This', 'citethis_manage_text', 'citethis_manager');
			//The first entry in the manage section of the admin page.
			//The id for the reset button, The reset button label, the function to generate the reset button, the settings section call, the settings section name
			//add_settings_field('citethis_reset_button', 'Reset Settings', 'citethis_reset_gen', 'citethis_manager', 'citethis_manage');
			add_settings_field('citethis_institution_field', 'Institution associated with this blog', 'citethis_institution_entry', 'citethis_manager', 'citethis_manage');		
	}
	
	function citethis_manage_text() {
	
		echo '<p>Manage the settings for Cite This</p>';
	
	}
	
	function citethis_institution_entry() {
		$gOptions = get_option('citethis_options');
		?>
			<input type="text" id="citethis_institution_field" name="citethis_options[institution]" size="20" value="<?php if (!empty($gOptions['institution'])) esc_attr_e($gOptions['institution']); ?>"/>
		<?php
	}

	//Validate the input.
	function citethis_options_validate($input) 
	{
		$gOptions = get_option('citethis_options');
		$gOptions['institution'] = trim($input['institution']);
		//die( preg_match( '!\w!i', $newinput['syndicate'] ) );
		if(!preg_match('/^[-_\w\/]+$/i', $gOptions['institution'])) {
			$gOptions['institution'] = '';
		}
		
		return $gOptions;
	
	}	

?>