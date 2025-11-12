<?php 
//accessibility mode styles
$tools = get_option('perfmatters_tools');
if(!empty($tools['accessibility_mode'])) {
	echo '<style>#perfmatters-admin .perfmatters-tooltip-subtext{display: none;}</style>';
}

//settings wrapper
echo '<div id="perfmatters-admin" class="wrap">';

	//hidden h2 for admin notice placement
	echo '<h2 style="display: none;"></h2>';

	//flex container
	echo '<div id="perfmatters-admin-container">';

		echo '<div id="perfmatters-admin-header">';

			//header
			echo '<div class="perfmatters-admin-block">';

				echo '<div id="perfmatters-logo-bar">';

					//logo
					echo file_get_contents(plugins_url('img/logo-dark.svg', dirname(__FILE__)));

					//menu toggle
					echo '<a href="#" id="perfmatters-menu-toggle"><span class="dashicons dashicons-menu"></span></a>';
				echo '</div>';

				//menu
				echo '<div id="perfmatters-menu">';

					if(!is_network_admin()) {

						//options
						echo '<a href="#" rel="options-general" class="active"><span class="dashicons dashicons-dashboard"></span>' . __('General', 'perfmatters') . '</a>';
						echo '<a href="#js" rel="options-js"><span class="dashicons dashicons-media-code"></span>' . __('JavaScript', 'perfmatters') . '</a>';
						echo '<a href="#css" rel="options-css"><span class="dashicons dashicons-admin-appearance"></span>' . __('CSS', 'perfmatters') . '</a>';
						echo '<a href="#preload" rel="options-preload"><span class="dashicons dashicons-clock"></span>' . __('Preloading', 'perfmatters') . '</a>';
						echo '<a href="#lazyload" rel="options-lazyload"><span class="dashicons dashicons-images-alt2"></span>' . __('Lazy Loading', 'perfmatters') . '</a>';
						echo '<a href="#fonts" rel="options-fonts"><span class="dashicons dashicons-editor-paste-text"></span>' . __('Fonts', 'perfmatters') . '</a>';
						echo '<a href="#cdn" rel="options-cdn"><span class="dashicons dashicons-admin-site-alt2"></span>' . __('CDN', 'perfmatters') . '</a>';
						echo '<a href="#analytics" rel="options-analytics"><span class="dashicons dashicons-chart-bar"></span>' . __('Analytics', 'perfmatters') . '</a>';
						echo '<a href="#code" rel="options-code"><span class="dashicons dashicons-editor-code"></span>' . __('Code', 'perfmatters') . '</a>';

						//spacer
						echo '<hr style="border-top: 1px solid #f2f2f2; border-bottom: 0px; margin: 10px 0px;" />';

						//tools
						echo '<a href="#tools" rel="tools-plugin"><span class="dashicons dashicons-admin-tools"></span>' . __('Tools', 'perfmatters') . '</a>';
						echo '<a href="#database" rel="tools-database"><span class="dashicons dashicons-database"></span>' . __('Database', 'perfmatters') . '</a>';
					}
					else {

						//network
						echo '<a href="#" rel="network-network" class="active"><span class="dashicons dashicons-admin-settings"></span>' . __('Network', 'perfmatters') . '</a>';
					}

					//license
					if(!is_multisite() || is_network_admin()) {
						echo '<a href="#license" rel="license-license"><span class="dashicons dashicons-admin-network"></span>' . __('License', 'perfmatters') . '</a>';
					}

					//support
					echo '<a href="#support" rel="support-support"><span class="dashicons dashicons-editor-help"></span>' . __('Support', 'perfmatters') . '</a>';

				echo '</div>';
			echo '</div>';

			//cta
			if(!get_option('perfmatters_close_cta')) {
				echo '<a href="https://novashare.io/perfmatters-discount/?utm_campaign=plugin-cta&utm_source=perfmatters" target="_blank" id="perfmatters-cta" class="perfmatters-admin-block perfmatters-mobile-hide">';
					echo '<span class="dashicons dashicons-tag" style="margin-right: 10px;"></span>';
					echo '<span>' . __('Get 25% off our social sharing plugin.') . '</span>';
					echo '<span id="perfmatters-cta-close" class="dashicons dashicons-no-alt"></span>';
				echo '</a>';
			}

		echo '</div>';

		echo '<div style="flex-grow: 1;">';
			echo '<div class="perfmatters-admin-block">';

				//version number
				echo '<span id="pm-version" class="perfmatters-mobile-hide">' . __('Version', 'perfmatters') . ' ' . PERFMATTERS_VERSION . '</span>';

				if(!is_network_admin()) {

					//main settings form
					echo '<form method="post" id="perfmatters-options-form" enctype="multipart/form-data" data-pm-option="options">';

						//options
						echo '<div id="perfmatters-options"' . (empty($tools['show_advanced']) ? ' class="pm-hide-advanced"' : '') . '>';

							//general
							echo '<section id="options-general" class="section-content active">';
								perfmatters_settings_header(__('General', 'perfmatters'), 'dashicons-dashboard');
						    	perfmatters_settings_section('perfmatters_options', 'perfmatters_options');
						    	perfmatters_settings_section('perfmatters_options', 'login_url');
						    	perfmatters_settings_section('perfmatters_options', 'perfmatters_woocommerce');
						    echo '</section>';

						    //javascript
						    echo '<section id="options-js" class="section-content">';
						    	perfmatters_settings_header(__('JavaScript', 'perfmatters'), 'dashicons-media-code');
						    	perfmatters_settings_section('perfmatters_options', 'assets_js_defer');
						    	perfmatters_settings_section('perfmatters_options', 'assets_js_delay');
						    	perfmatters_settings_section('perfmatters_options', 'assets_js_minify');
						    echo '</section>';

						    //css
						    echo '<section id="options-css" class="section-content">';
						    	perfmatters_settings_header(__('CSS', 'perfmatters'), 'dashicons-admin-appearance');
						    	perfmatters_settings_section('perfmatters_options', 'assets_css');
						    	perfmatters_settings_section('perfmatters_options', 'assets_css_minify');
						    echo '</section>';

						    //preloading
						    echo '<section id="options-preload" class="section-content">';
						    	perfmatters_settings_header(__('Preloading', 'perfmatters'), 'dashicons-clock');
						    	perfmatters_settings_section('perfmatters_options', 'preload');
						    echo '</section>';

						    //lazyload
						    echo '<section id="options-lazyload" class="section-content">';
						    	perfmatters_settings_header(__('Lazy Loading', 'perfmatters'), 'dashicons-images-alt2');
						    	perfmatters_settings_section('perfmatters_options', 'lazyload');
						    	echo '<div class="pm-advanced-option">';
						    		perfmatters_settings_section('perfmatters_options', 'lazyload_elements');
						    	echo '</div>';
						    echo '</section>';

						    //fonts
						    echo '<section id="options-fonts" class="section-content">';
						    	perfmatters_settings_header(__('Fonts', 'perfmatters'), 'dashicons-editor-paste-text');
						    	perfmatters_settings_section('perfmatters_options', 'perfmatters_fonts');
						    echo '</section>';

						    //cdn
						    echo '<section id="options-cdn" class="section-content">';
						    	perfmatters_settings_header(__('CDN', 'perfmatters'), 'dashicons-admin-site-alt2');
						    	perfmatters_settings_section('perfmatters_options', 'perfmatters_cdn');
						    echo '</section>';

						    //analytics
						    echo '<section id="options-analytics" class="section-content">';
						    	perfmatters_settings_header(__('Google Analytics', 'perfmatters'), 'dashicons-chart-bar');
						    	perfmatters_settings_section('perfmatters_options', 'perfmatters_analytics');
						    echo '</section>';

						    //code
						    echo '<section id="options-code" class="section-content">';
						    	perfmatters_settings_header(__('Code', 'perfmatters'), 'dashicons-editor-code');
						    	perfmatters_settings_section('perfmatters_options', 'assets_code');
						    echo '</section>';

					    echo '</div>';

					    //tools
						echo '<div id="perfmatters-tools">';

							echo '<section id="tools-plugin" class="section-content">';
								perfmatters_settings_header(__('Tools', 'perfmatters'), 'dashicons-admin-tools');
								perfmatters_settings_section('perfmatters_options', 'assets');
								perfmatters_settings_section('perfmatters_tools', 'plugin');
						    	perfmatters_settings_section('perfmatters_tools', 'settings');

						    echo '</section>';

						    echo '<section id="tools-database" class="section-content">';
						    	perfmatters_settings_header(__('Database', 'perfmatters'), 'dashicons-database');
						    	perfmatters_settings_section('perfmatters_tools', 'database');
						    echo '</section>';

						echo '</div>';

							echo '<div id="perfmatters-save" style="margin-top: 20px;">';
							perfmatters_action_button('save_settings', __('Save Changes', 'perfmatters'));
					    echo '</div>';

					echo '</form>';
				}
				else {

					echo '<div id="perfmatters-options">';

						//network
						echo '<section id="network-network" class="section-content active">';
							require_once('network.php');
						echo '</section>';

					echo '</div>';
				}

				//license
				if(!is_plugin_active_for_network('perfmatters/perfmatters.php') || is_network_admin()) {
					echo '<section id="license-license" class="section-content">';					
						require_once('license.php');
					echo '</section>';
				}

				//support
				echo '<section id="support-support" class="section-content">';	
					require_once('support.php');
				echo '</section>';

				//display correct section based on URL anchor
				echo '<script>
					!(function (t) {
					    var a = t.trim(window.location.hash);
					    if (a) {
					    	t("#perfmatters-menu > a.active").removeClass("active");
					    	var selectedNav = t(\'#perfmatters-menu > a[href="\' + a + \'"]\');
					    	t("#perfmatters-options-form").attr("data-pm-option", selectedNav.attr("rel").split("-")[0]); 
					    	t(selectedNav).addClass("active");
					    	var activeSection = t("#perfmatters-options .section-content.active");
					    	activeSection.removeClass("active");
					    	t("#" + selectedNav.attr("rel")).addClass("active");
					    }
					})(jQuery);
				</script>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
echo '</div>';