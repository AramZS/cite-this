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
					<?php //Initiate a check on the settings to insure they are safe. 
						do_settings_sections('citethis_checks');
						//The submit button.
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
	
		
	
	}

?>