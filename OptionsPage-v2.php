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
					?>
			</div>
		
		<?php
	
	}

?>