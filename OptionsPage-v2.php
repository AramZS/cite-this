<?php
	
	//Let's build a modern options page. 
	add_action('admin_menu', 'citethis_admin_page');
	function citethis_admin_page() {
		//Add that options page title, menu item title, user level required to use, the options slug, the output function
		add_options_page('Cite This Plugin Options', 'Cite This Options', 'manage_options', 'citethis', 'citethis_options_page');
	
	}
	
	//create and display the options administration page. 
	function citethis_options_page() {
	
		if ( 'reset' == $_REQUEST['action'] ) {
			//protect against request forgery
			check_admin_referer('citethis-reset');
			//reset to default the options
			//This does not work, but I'll build a new function to set the defaults. 
			$gOptions = GetDefaultGeneralOptions();
			$citations = GetDefaultCitationStyles();
			 echo '<div id="message" class="updated fade"><p>All options are reset!</p></div>';
		}		
	
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
				<form method="post">		
				<?php wp_nonce_field('citethis-reset'); ?>
					<p class="submit">
						<input name="reset" type="submit" value="Reset" />
						<input type="hidden" name="action" value="reset" />
					</p>
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
			//add_settings_field('citethis_reset_button', 'Reset Settings', 'citethis_reset_gen', 'citethis_manager', 'citethis_manage');
			add_settings_field('citethis_institution_field', 'Institution associated with this blog', 'citethis_institution_entry', 'citethis_manager', 'citethis_manage');
/**	
		add_settings_section('citethis_stylelist', 'Tags for Citation Styles', 'citethis_styles_text', 'citethis_styles');
			add_settings_field('citethis_style_list', 'List of current citation styles.', 'citethis_stylelister', 'citethis_styles', 'citethis_stylelist');
			
		add_settings_section('citethis_general', 'General Options', 'citethis_general_text', 'citethis_generals');
			add_settings_section('citethis_single_mode', 'Providing method in Single Post Mode', 'citethis_singlemode_gen', 'citethis_generals', 'citethis_general');
			add_settings_section('citethis_single_setting', 'Settings for Single Post Mode', 'citethis_singlesetting_gen', 'citethis_generals', 'citethis_general');
			
			add_settings_section('citethis_multi_mode', 'Providing method in Multi-Post Mode', 'citethis_multimode_gen', 'citethis_generals', 'citethis_general');
			add_settings_section('citethis_multi_setting', 'Settings for Multi-Post Mode', 'citethis_multisetting_gen', 'citethis_generals', 'citethis_general');
			
			add_settings_section('citethis_widget_setting', 'Settings for Widget Mode', 'citethis_widgetsetting_gen', 'citethis_generals', 'citethis_general');
			
			add_settings_section('citethis_button_set', ' ', 'citethis_buttonset_gen', 'citethis_manager', 'citethis_manage');
		
		add_settings_section('citethis_citation', 'Citation Styles', 'citethis_citation_text', 'citethis_citations');	
			add_settings_section('citethis_citations_set', ' ', 'citethis_citations_gen', 'citethis_citations', 'citethis_citation');
			add_settings_section('citethis_button_set', ' ', 'citethis_buttonset_gen', 'citethis_citations', 'citethis_citation');
**/					
	}
	
	function citethis_manage_text() {
	
		echo '<p>Manage the settings for Cite This</p>';
	
	}
	
/**	function citethis_reset_gen() {
	?>
		 

		
	<?php
	}
**/	
	function citethis_institution_entry() {
		$gOptions = get_option('citethis_options');
		?>
			<input type="text" id="citethis_institution_field" name="citethis_options[institution]" size="20" value="<?php if (!empty($gOptions['institution'])) esc_attr_e($gOptions['institution']); ?>"/>
		<?php
	}
	
	
	function citethis_stylelister() {
	
		?>
		
           <!-- <fieldset id="tagsCitationStyles" class="dbx-box"> -->
                    <div class="dbx-content">
                        <dl>
                        <dt>%pagename%</dt>
                        <dd>The post title.</dd>
                        <dt>%author%</dt>
                        <dd>Name of post's author.</dd>
                        <dt>%publisher%</dt>
                        <dd>This blog's name.</dd>
                        <dt>%institution%</dt>
                        <dd>Institution associated with this blog.</dd>
                        <dt>%date:format%</dt>
                        <dd>Published date or last updated date. <a href="http://www.php.net/date">format</a></dd>
                        <dt>%retdate:format%</dt>
                        <dd>Requesting date. <a href="http://www.php.net/date">format</a></dd>
                        <dt>%permalink%</dt>
                        <dd>URI to the post.</dd>
                        <dt>&amp;lt;</dt>
                        <dd>Display &lt;</dd>
                        <dt>&amp;gt;</dt>
                        <dd>Display &gt;</dd>
                        <dt>&amp;#39;</dt>
                        <dd>Display &#39; (single quote)</dd>
                        </dl>
                    </div>
            <!-- </fieldset> -->			
		
		<?php
	
	}
	
	function add_jquery() {
		?>	
		<script type="text/javascript">
			//<![CDATA[
		jQuery('#citationStyles').Sortable({
			accept : 'citation',
			handle : '.handle',
			opacity: 	0.5,
			fit :	false
			})

		function RemoveCitation(citation){
			jQuery('#'+citation.id).remove();
			}

		function AddCitation(){
			var id;
			do {
				id = 'citation-' + Math.round(10000*Math.random()).toString();
			} while (jQuery('#'+id).size()>0);
			
			var newCitation = '<div class="citation" id="' + id + '">\n' +
							  '<span class="handle">&#11021;<\/span>\n' +
							  '<select name="' + id + '-show"><option value="false">Hide<\/option><option selected="selected" value="true" >Show<\/option><\/select>\n' +
							  '<input name="' + id + '-id" type="text" size="10" value=""\/>\n' +
							  '<input name="' + id + '-name" type="text" size="10" value=""\/>\n' +
							  '<input name="' + id + '-styleURI" type="text" size="30" value=""\/>\n' +
							  '<input name="' + id + '-style" type="text" size="30" value=""\/>\n' +
							  '<input type="button" value="Remove" onclick="RemoveCitation(this.parentNode)"\/>\n' +
							  '<\/div>';
			jQuery('#citationStyles')
				.append(newCitation)
				.SortableAddItem(document.getElementById(id));
			}
			
		function SubmitCitationStyles(form) {
			var serial = jQuery.SortSerialize('citationStyles');
			form.updateCitationStyles.value = 'Save';
			form.order.value = serial.o['citationStyles'].join(',');
			form.submit();
			}
		function ResetCitationStyles(form) {
			form.updateCitationStyles.value = 'Reset';
			form.submit();
			}
			//]]>
	</script>
			<?php 
	}
	

	//Validate the input.
	function citethis_options_validate($input) 
	{
		//print_r($input);
		
		$gOptions = get_option('citethis_options');
		foreach ($gOptions as $optName => $option){
		
			$gOptions[$optName] = trim($input[$optName]);
			//print_r($gOptions[$optName]);
			if(!preg_match('/^[-_\w\/]+$/i', $gOptions[$optName])) {
				$gOptions[$optName] = '';
			}
		
		}
		
		//die();
		return $gOptions;
	
	}

	function citethis_admin_enqueue_scripts( $hook_suffix ) {


		wp_enqueue_style( 'citethis-theme-options', get_bloginfo('wpurl') . '/wp-content/plugins/CiteThis/OptionsPage.css', false, '1.0' );

		wp_enqueue_script('interface', plugins_url('interface.js',__FILE__), array('jquery') );

	}
	add_action( 'admin_print_styles-settings_page_citethis', 'citethis_admin_enqueue_scripts' );	 //not sure about this hook yet. 	


?>