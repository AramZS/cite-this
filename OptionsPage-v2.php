<?php

	//Let's build a modern options page. 
	add_action('admin_menu', 'citethis_admin_page');
	function citethis_admin_page() {
		//Add that options page title, menu item title, user level required to use, the options slug, the output function
		add_options_page('Cite This Plugin Options', 'Cite This Options', 'manage_options', 'citethis', 'citethis_options_page')
	
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
						do_settings_sections('citethis_styles');
						do_settings_sections('citethis_generals');						
						//Then the submit button.
					?>
					<br />
					<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
				</form>
				
				<p>Origonally created by Yu-Jie Lin. Updated by Aram Zucker-Scharff</p>
			</div>
		
		<?php
	
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
			add_settings_section('citethis_reset_button', 'Reset Settings', 'citethis_reset_gen', 'citethis_manager', 'citethis_manage');
			add_settings_section('citethis_institution_field', 'Institution associated with this blog', 'citethis_institution_entry', 'citethis_manager', 'citethis_manage');
		add_settings_section('citethis_stylelist', 'Tags for Citation Styles', 'citethis_styles_text', 'citethis_styles');
			add_settings_section('citethis_style_list', ' ', 'citethis_stylelister', 'citethis_styles', 'citethis_stylelist');
		add_settings_section('citethis_general', 'General Options', 'citethis_general_text', 'citethis_generals');
			add_settings_section('citethis_single_mode', 'Providing method in Single Post Mode', 'citethis_singlemode_gen', 'citethis_generals', 'citethis_general');	
	}
	
	function citethis_manage_text() {
	
		echo '<p>Manage the settings for Cite This</p>';
	
	}

?>