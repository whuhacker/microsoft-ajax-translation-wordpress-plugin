<?php
/*
Plugin Name: Microsoft AJAX Translation
Plugin URI: http://wordpress.org/extend/plugins/microsoft-ajax-translation/
Description: A quick, simple, and light plugin for your readers to translate your blog by using the Microsoft Translator API. It is an alternative to Google AJAX Translation plugin, since Google closed its free translation API. <a href="http://www.lovelucy.info/microsoft-ajax-translation-wordpress-plugin.html" target="_blank">Detail...</a>
Author: lovelucy
Version: 0.1.1
Author URI: http://www.lovelucy.info/
	
TODO:
	put admin page functions into separate file

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
*/

if (!class_exists('MicrosoftTranslation')) {
	class MicrosoftTranslation {

		var $optionPrefix = 'microsoft_translation_';
		var $version      = '0.1.0';
		var $pluginUrl    = 'http://wordpress.org/extend/plugins/microsoft-ajax-translation/';
		var $authorUrl    = 'http://www.lovelucy.info/';

		var $languages = array(
			'ar' => 'Arabic',
			'bg' => 'Bulgarian',
			'ca' => 'Catalan',
			'zh-CHS' => 'Chinese (Simplified)',
			'zh-CHT' => 'Chinese (Traditional)',
			'cs' => 'Czech',
			'da' => 'Danish',
			'nl' => 'Dutch',
			'en' => 'English',
			'et' => 'Estonian',
			'fi' => 'Finnish',
			'fr' => 'French',
			'de' => 'German',
			'el' => 'Greek',
			'ht' => 'Haitian Creole',
			'he' => 'Hebrew',
			'hi' => 'Hindi',
			'hu' => 'Hungarian',
			'id' => 'Indonesian',
			'it' => 'Italian',
			'ja' => 'Japanese',
			'ko' => 'Korean',
			'lv' => 'Latvian',
			'lt' => 'Lithuanian',
			'no' => 'Norwegian',
			'pl' => 'Polish',
			'pt' => 'Portuguese',
			'ro' => 'Romanian',
			'ru' => 'Russian',
			'sk' => 'Slovak',
			'sl' => 'Slovenian',
			'es' => 'Spanish',
			'sv' => 'Swedish',
			'th' => 'Thai',
			'tr' => 'Turkish',
			'uk' => 'Ukrainian',
			'vi' => 'Vietnamese',
		);
		var $target_languages = array(
			'ar',     // Arabic
			'bg',     // Bulgarian
			'ca',     // Catalan
			'cs',     // Czech
			'da',     // Danish
			'de',     // German
			'el',     // Greek
			'en',     // English
			'et',     // Estonian
			'fa',     // Persian
			'fi',     // Finnish
			'fr',     // French
			'ga',     // Irish
			'gl',     // Galician
			'he',     // Hebrew
			'hi',     // Hindi
			'hr',     // Croatian
			'hu',     // Hungarian
			'id',     // Indonesian
			'is',     // Icelandic
			'it',     // Italian
			'ja',     // Japanese
			'ko',     // Korean
			'lt',     // Lithuanian
			'lv',     // Latvian
			'mk',     // Macedonian
			'ms',     // Malay
			'mt',     // Maltese
			'nl',     // Dutch
			'no',     // Norwegian
			'pl',     // Polish
			'pt',     // Portuguese
			'ro',     // Romanian
			'ru',     // Russian
			'sk',     // Slovak
			'sl',     // Slovenian
			'sq',     // Albanian
			'sr',     // Serbian
			'sv',     // Swedish
			'sw',     // Swahili
			'th',     // Thai
			'tl',     // Filipino
			'tr',     // Turkish
			'uk',     // Ukrainian
			'vi',     // Vietnamese
			'yi',     // Yiddish
			'zh-CHS',  // Chinese (Simplified)
			'zh-CHT'   // Chinese (Traditional)
		);
		var $display_name = array(
			'af' => 'Afrikaans',
			'ar' => 'العربية',
			'be' => 'Беларуская',
			'bg' => 'български',
			'ca' => 'català',
			'cs' => 'česky',
			'cy' => 'Cymraeg',
			'da' => 'dansk',
			'de' => 'Deutsch',
			'el' => 'ελληνική',
			'en' => 'English',
			'es' => 'español',
			'et' => 'eesti',
			'fa' => 'فارسی',
			'fi' => 'suomi',
			'fr' => 'français',
			'ga' => 'Gaeilge',
			'gl' => 'galego',
			'he' => 'עברית',
			'hi' => 'हिन्दी',
			'hr' => 'hrvatski',
			'hu' => 'magyar',
			'id' => 'bahasa Indonesia',
			'is' => 'íslenska',
			'it' => 'italiano',
			'ja' => '日本語',
			'ko' => '한국어',
			'lt' => 'lietuvių',
			'lv' => 'latviešu',
			'mk' => 'македонски',
			'ms' => 'bahasa Melayu',
			'mt' => 'Malti',
			'nl' => 'Nederlands',
			'no' => 'norsk',
			'pl' => 'polski',
			'pt' => 'português',
			'ro' => 'română',
			'ru' => 'русский',
			'sk' => 'slovenčina',
			'sl' => 'slovenščina',
			'sq' => 'shqipe',
			'sr' => 'српски',
			'sv' => 'svenska',
			'sw' => 'Kiswahili',
			'th' => 'ภาษาไทย',
			'tl' => 'Filipino',
			'tr' => 'Türkçe',
			'uk' => 'українська',
			'vi' => 'tiếng Việt',
			'yi' => 'ייִדיש',
			'zh-CHS' => '中文 (简体)',
			'zh-CHT' => '中文 (繁體)'
		);
		var $translate_message = array(
			'af' => 'Vertaal',
			'ar' => 'ترجمة',
			'be' => 'Перакладаць',
			'bg' => 'Преводач',
			'ca' => 'Traductor',
			'cs' => 'Překladač',
			'cy' => 'Cyfieithu',
			'da' => 'Oversæt',
			'de' => 'Übersetzung',
			'el' => 'Μετάφραση',
			'en' => 'Translate',
			'es' => 'Traductor',
			'et' => 'Tõlkima',
			'fa' => 'ترجمه',
			'fi' => 'Kääntäjä',
			'fr' => 'Traduction',
			'ga' => 'Aistrigh',
			'gl' => 'Traducir',
			'he' => 'תרגם',
			'hi' => 'अनुवाद करें',
			'hr' => 'Prevoditelj',
			'hu' => 'Fordítás',
			'id' => 'Menerjemahkan',
			'is' => 'Þýða',
			'it' => 'Traduttore',
			'ja' => '翻訳',
			'ko' => '번역',
			'lt' => 'Versti',
			'lv' => 'Tulkotājs',
			'mk' => 'Преведува',
			'ms' => 'Menerjemahkan',
			'mt' => 'Traduċi',
			'nl' => 'Vertaal',
			'no' => 'Oversetter',
			'pl' => 'Tłumacz',
			'pt' => 'Tradutor',
			'ro' => 'Traducere',
			'ru' => 'Переводчик',
			'sk' => 'Prekladač',
			'sl' => 'Prevajalnik',
			'sq' => 'Përkthej',
			'sr' => 'преводилац',
			'sv' => 'Översätt',
			'sw' => 'Tafsiri',
			'th' => 'แปล',
			'tl' => 'Pagsasalin',
			'tr' => 'Tercüme etmek',
			'uk' => 'Перекладач',
			'vi' => 'Dịch',
			'yi' => 'זעץ',
			'zh-CHS' => '翻译',
			'zh-CHT' => '翻譯',
		);

		var $options = array(  // default values for options
			'bingAppId' => '', // string of Microsoft Bing AppID 
			'linkStyle' => 'text', // is stored as 'text', 'image', or 'imageandtext'
			'linkPosition' => 'bottom', // is stored as 'top', 'bottom', or 'none'
			'hlineEnable' => true, // is stored as "1" and "0" in database or returns false if the option doesn't exist
			'copyBodyBackgroundColor' => false, // is stored as "1" and "0" in database or returns false if the option doesn't exist
			'backgroundColor' => NULL, // is stored as NULL or CSS color in the format #5AF or #55AAFF
			'postEnable' => true, // is stored as "1" and "0" in database or returns false if the option doesn't exist
			'excludeHome' => false, // is stored as "1" and "0" in database or returns false if the option doesn't exist
			'pageEnable' => true, // is stored as "1" and "0" in database or returns false if the option doesn't exist
			'excludePages' => array(), // array of post and page id's to exclude
			'commentEnable' => false, // is stored as "1" and "0" in database or returns false if the option doesn't exist
			'doNotTranslateSelector' => NULL, // is stored as "" or string in the style of a jQuery selector
			'languages' => array() // array of language codes to display in popup
		);

		var $textDomain = 'wpbt'; // not used currently
		var $languageFileLoaded = false; // not used currently
		var $pluginRoot = '';
		
		var $before_translate = '['; // text to display before and after "Translate" link
		var $after_translate = ']';
		var $browser_lang = 'en';

		/**
		 * php 4 Constructor
		 */
		function MicrosoftTranslation() {
			$this -> pluginRoot = plugins_url( '/', __FILE__ );

			/*foreach ( $this -> options as $k => $v ) { // delete old style options from database from before version 0.5.0
				delete_option( $this -> optionPrefix.$k );
			}*/
			//delete_option( $this -> optionPrefix . 'options' );

			$current_options = get_option( $this -> optionPrefix . 'options' );
			//echo var_dump($current_options) . "<br />\n";
			
			if ( $current_options ) {
				foreach ( $current_options as $k => $v ) {
					if ( false !== $current_options[$k] ) // Checks to skip false options (missing from database) (probably not necessary after version 0.5.0)
						$this -> options[$k] = $current_options[$k];
				}
			}
			//echo var_dump($this -> options) . "<br />\n";

			$browser_lg = $this -> browser_lang = $this -> preferred_language( $this -> target_languages ); // find browser's preferred language
			$browser_lg_index = array_search ( $browser_lg  , $this -> options['languages'] ); // find index of preferred language in options array
			if ( FALSE !== $browser_lg_index ) { // if preferred language is in options array, move it to the first element
				array_splice( $this -> options['languages']  , $browser_lg_index  , 1 );
				array_unshift( $this -> options['languages']  , $browser_lg );
			}

			// Add action and filter hooks to WordPress
			wp_register_style( 'microsoft-ajax-translation', $this->pluginRoot . 'style/microsoft-ajax-translation.css', false, '20120229', 'screen' );
			//wp_register_script( 'jquery-translate', $this->pluginRoot . 'js/jquery.translate-1.4.7.min.js', array('jquery'), '1.4.7', true );
			wp_register_script( 'jquery-translate', $this->pluginRoot . 'js/jquery.translate-1.4.7.js', array('jquery'), '1.4.7', true ); // for debugging
			if ( is_admin() ) {
				add_action( 'admin_menu', array( &$this, 'addOptionsPage' ) );
				add_action( 'admin_init', array( &$this, 'register_translation_settings' ) );
				$plugin = plugin_basename(__FILE__); 
				add_filter('plugin_action_links_'.$plugin, array( &$this, 'translation_settings_link') );
			} else {
				wp_enqueue_style( 'microsoft-ajax-translation' );
				wp_enqueue_script( 'jquery-translate' );
				wp_localize_script('jquery-translate', 'bingApp', array(
					'appId' => $this -> options['bingAppId'],
				));
				
				if ( ( $this -> options['postEnable'] || $this -> options['pageEnable'] ) && ( 'none' != $this -> options['linkPosition'] ) ) {
					add_filter( 'the_content', array( &$this, 'processContent' ), 50 );
				}
				if ( $this -> options['commentEnable'] ) {
					add_filter( 'comment_text', array( &$this, 'processComment' ), 50 );
				}
				add_filter( 'wp_footer', array( &$this, 'getLanguagePopup' ), 5 );
				add_filter( 'wp_footer', array( &$this, 'getFooterJS' ), 5 );
			}
		}

		/**
		 * adds Microsoft Translation to Options menu in Administration Panel and adds scripts and css to one page
		 */
		function addOptionsPage(){
			$plugin_page = add_options_page('Microsoft Translation', 'Microsoft Translation', 'manage_options', basename(__FILE__), array(&$this, 'outputOptionsPanel'));
			if ( 'ajaxtranslation.php' == $_GET['page'] ) { // add only to one admin page
				add_action( 'admin_footer-'. $plugin_page, array( &$this, 'admin_js' ) );
				wp_enqueue_style( 'microsoft-ajax-translation' );
				//wp_enqueue_script( 'jquery-translate' );
			}
		}
		
		/**
		 * adds settings link on plugin page
		 */
		function translation_settings_link($links) {
			$settings_link = '<a href="options-general.php?page=ajaxtranslation.php">' . __('Settings') . '</a>';
			array_push( $links, $settings_link ); // after other links
			//array_unshift( $links, $settings_link ); // before other links
			return $links;
		}

		/**
		 * whitelist and sanitize options
		 */
		function register_translation_settings() {
			register_setting( 'microsoft-ajax-translation', $this -> optionPrefix . 'options', array( &$this, 'sanitize_options' ) );
		}

		/**
		 * sanitize options array
		 * @return array of sanitized options
		 * @param $value array of unsanitized options
		 */
		function sanitize_options($value) {
			$value['bingAppId'] = $this -> sanitize_bingAppId( $value['bingAppId'] );
			$value['linkStyle'] = $this -> sanitize_linkStyle( $value['linkStyle'] );
			$value['linkPosition'] = $this -> sanitize_linkPosition( $value['linkPosition'] );
			$value['hlineEnable'] = $this -> sanitize_checkbox( $value['hlineEnable'] );
			$value['copyBodyBackgroundColor'] = $this -> sanitize_checkbox( $value['copyBodyBackgroundColor'] );
			$value['backgroundColor'] = $this -> sanitize_backgroundColor( $value['backgroundColor'] );
			$value['postEnable'] = $this -> sanitize_checkbox( $value['postEnable'] );
			$value['excludeHome'] = $this -> sanitize_checkbox( $value['excludeHome'] );
			$value['pageEnable'] = $this -> sanitize_checkbox( $value['pageEnable'] );
			$value['excludePages'] = $this -> sanitize_excludePages( $value['excludePages'] );
			$value['commentEnable'] = $this -> sanitize_checkbox( $value['commentEnable'] );
			$value['doNotTranslateSelector'] = $this -> sanitize_selector( $value['doNotTranslateSelector'] );
			$value['languages'] = $this -> sanitize_languages( $value['languages'] );
			return $value;
		}

		function sanitize_bingAppId($value) { // sanitize bingAppId option value
			$value = str_replace( array( "'", '"' ), "", $value ); // get rid of single and double quotes
			return $value;
		}
		
		function sanitize_linkStyle($value) { // sanitize linkStyle option value
			$possible_values = array( 'text', 'image', 'imageandtext' );
			return ( in_array( $value, $possible_values ) ) ? $value : NULL;
		}

		function sanitize_linkPosition($value) { // sanitize linkPosition option value
			$possible_values = array( 'top', 'bottom', 'none' );
			return ( in_array( $value, $possible_values ) ) ? $value : NULL;
		}

		function sanitize_checkbox($value) { // sanitize checkbox option values
			return ( $value ) ? 1 : 0;
		}

		function sanitize_backgroundColor($value) { // sanitize backgroundColor string
			$value = strtoupper( $value );
			if ( preg_match( "/^#[\dA-F]{3}$|^#[\dA-F]{6}$/", $value ) ) // only allow strings in the format #5AF or #55AAFF
				return $value;
			else
				return null;
		}

		function sanitize_excludePages($value) { // sanitize excludePages string
			$value = explode( ",", $value );
			$index = 0;
			while ( $index < sizeof( $value ) ) {
				$page_id_int = absint( $value[$index] );
				if ( $page_id_int ) {
					$value[$index] = $page_id_int;
					$index++;
				} else {
					array_splice( $value, $index, 1 );
				}
			}
			return $value;
		}

		function sanitize_selector($value) { // sanitize jQuery selector
			$value = str_replace( array( "'", '"' ), "", $value ); // get rid of single and double quotes
			return $value;
		}

		function sanitize_languages($value) { // sanitize languages option array
			if ( is_array($value) ) {
				$index = 0;
				foreach ( $value as $lg ) {
					if ( ! in_array( $lg, $this -> target_languages ) ) {
						array_splice( $value, $index , 1 );
						$index--;
					}
					$index++;
				}
			} else {
				$value = array(); // no languages checked sends a null string so this sets it to an empty array
			}
			return $value;
		}

		/**
		 * uninstall function called by uninstall.php
		 */
		function uninstall() {
			/*foreach ( $this -> options as $k => $v ) { // delete options from wp_options table
				delete_option( $this -> optionPrefix . $k );
			}*/
			delete_option( $this -> optionPrefix . 'options' ); // delete options from wp_options table
		}

		function loadLanguageFile() { // loads language files according to locale (NOT WORKING YET)
			if(!$this->languageFileLoaded) {
				load_plugin_textdomain($this->textDomain, $this->pluginRoot . 'languages', 'microsoft-ajax-translation/languages' );
				$this->languageFileLoaded = true;
			}
		}

		/**
		 * attach jQuery click events to admin buttons
		 */
		function admin_js() {
			$browser_lg = $this -> browser_lang;
			?>
			<script type="text/javascript">
			//<![CDATA[
				jQuery(document).ready(function($) {
<?php
				if ( 'en' != $browser_lg ) :
?>
					jQuery('#translate_button').click(function() { // translate panel into browser's preferred language
						jQuery('.wrap').translate( 'en', '<?php echo $browser_lg ?>', {
							not: 'img, input, #translate_button',
							start: function() { jQuery('#translate_loading_admin').show(); },
							complete: function() { jQuery('#translate_loading_admin').hide(); },
							error: function() { jQuery('#translate_loading_admin').hide(); }
						});
					});
<?php
				endif;
?>
					jQuery('input[name="microsoft_translation_options[postEnable]"]').click(function() { // disable and enable excludeHome checkbox
						if ( jQuery(this).is(':checked') ) {
							jQuery('input[name="microsoft_translation_options[excludeHome]"]').removeAttr('disabled');
						} else {
							jQuery('input[name="microsoft_translation_options[excludeHome]"]').attr('disabled', 'disabled');
						}
					});
					jQuery('input[name="microsoft_translation_options[copyBodyBackgroundColor]"]').click(function() { // disable and enable backgroundColor text field
						if ( jQuery(this).is(':checked') ) {
							jQuery('input[name="microsoft_translation_options[backgroundColor]"]').attr('disabled', 'disabled');
						} else {
							jQuery('input[name="microsoft_translation_options[backgroundColor]"]').removeAttr('disabled');
						}
					});
					jQuery('#languages_all').click(function() { // check all languages
						jQuery('.translate_links input').attr('checked', 'checked');
					});
					jQuery('#languages_none').click(function() { // uncheck all languages
						jQuery('.translate_links input').removeAttr('checked');
					});
				});
			//]]>
			</script>
			<?php
		}

		function outputOptionsPanel() {
			$domain = $this -> textDomain;
			$p = $this -> optionPrefix;
			$excludePages_str = implode( ", ", (array) $this -> options['excludePages'] );
			echo '<div class="wrap">
			<h2>' . __('Microsoft Ajax Translation', $domain) . '</h2>
			<p>' . __('Version', $domain) . ' ' . $this->version . ' | <a href="' . $this -> authorUrl . '" target="_blank" title="' . __('Visit author\'s homepage', $domain) . '">Author</a> | <a href="' . $this -> pluginUrl . '" target="_blank" title="' . __('Visit plugin homepage', $domain) . '">Plugin Homepage</a> | 
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_donations">
				<input type="hidden" name="business" value="zx0071@163.com">
				<input type="hidden" name="lc" value="US">
				<input type="hidden" name="item_name" value="Microsoft Ajax Translation WP Plugin">
				<input type="hidden" name="no_note" value="0">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
				</form>
			</p>
			';
			echo '<form method="post" action="options.php">
			<table class="form-table"> 
			<tr valign="top">
				<th scope="row">' . __('Microsoft Bing AppID', $domain) . '</th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span>' . __('Microsoft Bing App ID', $domain) . '</span></legend>
						<input name="' . $p . 'options[bingAppId]" size="65" type="text" value="' . $this -> options['bingAppId'] . '" />
						<br />
						<span class="description">' . __('Required to make this plugin work. <a href="http://bing.com/developers" target="_blank">Get AppID</a>', $domain) . '</span>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">' . __('Link style', $domain) . '</th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span>' . __('Link style', $domain) . '</span></legend>
						<label><input name="' . $p . 'options[linkStyle]" type="radio" value="text" ' . ( ( 'text' == $this -> options['linkStyle'] ) ? 'checked="checked" ' : '' ) . '/> <span>' . __('Language Text', $domain) . '</span></label><br />
						<label><input name="' . $p . 'options[linkStyle]" type="radio" value="image" ' . ( ( 'image' == $this -> options['linkStyle'] ) ? 'checked="checked" ' : '' ) . '/> <span>' . __('Flag Icon', $domain) . '</span></label><br />
						<label><input name="' . $p . 'options[linkStyle]" type="radio" value="imageandtext" ' . ( ( 'imageandtext' == $this -> options['linkStyle'] ) ? 'checked="checked" ' : '' ) . '/> <span>' . __('Flag Icon and Text', $domain) . '</span></label>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">' . __('Translate button position', $domain) . '</th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span>' . __('Translate button position', $domain) . '</span></legend>
						<label><input name="' . $p . 'options[linkPosition]" type="radio" value="top" ' . ( ( 'top' == $this -> options['linkPosition'] ) ? 'checked="checked" ' : '' ) . '/> <span>' . __('Top of posts and pages', $domain) . '</span></label><br />
						<label><input name="' . $p . 'options[linkPosition]" type="radio" value="bottom" ' . ( ( 'bottom' == $this -> options['linkPosition'] ) ? 'checked="checked" ' : '' ) . '/> <span>' . __('Bottom of posts and pages', $domain) . '</span></label><br />
						<label><input name="' . $p . 'options[linkPosition]" type="radio" value="none" ' . ( ( 'none' == $this -> options['linkPosition'] ) ? 'checked="checked" ' : '' ) . '/> <span>' . __('none', $domain) . '</span></label><br />
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">' . __('Horizontal line', $domain) . '</th>
				<td>
					<label>
						<input name="' . $p . 'options[hlineEnable]" type="checkbox" ' . ( ( $this -> options['hlineEnable'] ) ? 'checked="checked" ' : '' ) . '/>
						<span>' . __('Show line above or below Translate button', $domain) . '</span>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">' . __('Background color', $domain) . '</th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span>' . __('Background color', $domain) . '</span></legend>
						<label>
							<input name="' . $p . 'options[copyBodyBackgroundColor]" type="checkbox" ' . ( ( $this -> options['copyBodyBackgroundColor'] ) ? 'checked="checked" ' : '' ) . '/>
							<span>' . __('Copy background color from page body', $domain) . '</span>
						</label><br />
						<input name="' . $p . 'options[backgroundColor]" type="text" value="' . $this -> options['backgroundColor'] . '" ' . ( ! ( $this -> options['copyBodyBackgroundColor'] ) ? '' : 'disabled="disabled"' ) . ' />
						<span class="description">' . __('Background color in the format #5AF or #55AAFF', $domain) . '</span>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">' . __('Posts', $domain) . '</th>
				<td>
					<label>
						<input name="' . $p . 'options[postEnable]" type="checkbox" ' . ( ( $this -> options['postEnable'] ) ? 'checked="checked" ' : '' ) . '/>
						<span>' . __('Enable post translation', $domain) . '</span>
					</label>
					<br />
					<label>
						<input name="' . $p . 'options[excludeHome]" type="checkbox" ' . ( ( $this -> options['excludeHome'] ) ? 'checked="checked" ' : '' ) . ( ( $this -> options['postEnable'] ) ? '' : 'disabled="disabled"' ) . '/>
						<span>' . __('Exclude home page', $domain) . '</span>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">' . __('Pages', $domain) . '</th>
				<td>
					<label>
						<input name="' . $p . 'options[pageEnable]" type="checkbox" ' . ( ( $this -> options['pageEnable'] ) ? 'checked="checked" ' : '' ) . '/>
						<span>' . __('Enable page translation', $domain) . '</span>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">' . __('Exclude posts and pages', $domain) . '</th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span>' . __('Exclude posts and pages', $domain) . '</span></legend>
						<input name="' . $p . 'options[excludePages]" size="65" type="text" value="' . $excludePages_str . '" />
						<br />
						<span class="description">' . __('A comma separated list of post and page ID’s', $domain) . '</span>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">' . __('Comments', $domain) . '</th>
				<td>
					<label>
						<input name="' . $p . 'options[commentEnable]" type="checkbox" ' . ( ( $this -> options['commentEnable'] ) ? 'checked="checked" ' : '' ) . '/>
						<span>' . __('Enable comment translation', $domain) . '</span>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">' . __('Do not translate', $domain) . '</th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span>' . __('Do not translate', $domain) . '</span></legend>
						<input name="' . $p . 'options[doNotTranslateSelector]" type="text" value="' . htmlspecialchars( $this -> options['doNotTranslateSelector'] ) . '" />
						<span class="description">' . __('Selector in jQuery format (See the FAQ)', $domain) . '</span>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">' . __('Languages', $domain) . '</th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span>' . __('Languages', $domain) . '</span></legend>
						<table class="translate_links"><tr><td valign="top">
						';
						$numberof_languages = count( $this -> languages );
						$index = 0;
						foreach ( $this -> languages as $lg => $v ) {
							echo '<label title="' . $this -> display_name[$lg] . '"><input type="checkbox" name="' . $p . 'options[languages][]" value="' . $lg . '" ';
							if ( in_array( $lg, (array) $this -> options['languages'] ) ) echo 'checked="checked" ';
							echo '/> <img class="translate_flag ' . $lg . '" src="' . $this -> pluginRoot . 'images/transparent.gif" alt="' . $this -> display_name[$lg] . '" width="16" height="11" /> <span>' . $v . '</span></label><br />
							';
							if ( ( 0 == ++$index % 13) && ( $index < $numberof_languages ) ) { // columns should be 13 tall
								echo '</td><td valign="top">' . "\n";
							}
						}
				echo '</td></tr>
						</table>
						<p>
							<input type="button" class="button" id="languages_all" value="' . __('All', $domain) . '" />
							<input type="button" class="button" id="languages_none" value="' . __('None', $domain) . '" />
						</p>
					</fieldset>
				</td></tr>
			</table>
			';
			if ( 'en' != $this -> browser_lang ) {
				echo '<input type="button" class="button" id="translate_button" value="' . $this -> translate_message[$this -> browser_lang] . '" /> <img src="' . $this -> pluginRoot . 'images/transparent.gif" id="translate_loading_admin" class="translate_loading" style="display: none;" width="16" height="16" alt="" />
			';
			}
			echo '<p class="submit">
				' , settings_fields('microsoft-ajax-translation') , '
				<input type="submit" name="submit" class="button-primary" value="' . __('Save Changes', $domain) . '" />
			</p></form></div>';
		}

		/**
		 * Filter to add Translate button to posts and pages
		 * @return $content string
		 * @param $content string
		 */
		function processContent($content = '') {
			$backtrace = debug_backtrace();
			if ( !is_feed() && // ignore feeds
			( "the_excerpt" != $backtrace[7]["function"] ) && // ignore excerpts
			( ( !is_page() && $this -> options['postEnable'] ) || ( is_page() && $this -> options['pageEnable'] ) ) && // apply to posts or pages
			! ( in_array( get_the_ID(), $this -> options['excludePages'] ) ) && // exclude certain pages and posts
			! ( $this -> options['excludeHome'] && is_home() ) ) { // if option is set exclude home page
				$translate_block = $this -> generate_translate_block('post');
				$translate_hr = ( $this -> options['hlineEnable'] ) ? ( '<hr class="translate_hr" />' . "\n" ) : "";
				$id = get_the_ID();
				$content = '<div id="content_div-' . $id . '">' . "\n" . $content . "</div>\n";
				//$content = $content . "\n<br />\nis_page: " . is_page() . "\n<br />\nis_attachment: " . is_attachment() . "\n<br />\nis_single: " . is_single() . "\n<br />\nis_home: " . is_home() . "\n<br />\nget_the_ID: " . get_the_ID() . "\n<br />";
				switch ( $this -> options['linkPosition'] ) {
					case 'top':
						$content = '<div class="translate_block" style="display: none;">' . "\n" .
							$translate_block . 
							$translate_hr . 
							"</div>\n" .
							$content;
					break;
					case 'bottom':
						$content = $content . 
							'<div class="translate_block" style="display: none;">' . "\n" .
							$translate_hr . 
							$translate_block . 
							"</div>\n";
					break;
				}
			}
			return $content;
		}

		/**
		 * Filter to add Translate button to comments
		 * @return $content string
		 * @param $content string
		 */
		function processComment($content = '') {
			if ( !is_feed() ) { // ignore feeds
				$translate_block = $this -> generate_translate_block('comment');
				$translate_hr = ( $this -> options['hlineEnable'] ) ? ( '<hr class="translate_hr" />' . "\n" ) : "";
				$content = $content .
					'<div class="translate_block" style="display: none;">' . "\n" .
					$translate_hr .
					$translate_block .
					"</div>\n";
			}
			return $content;
		}

		/**
		 * get a translate button that can be used anywhere in a post or page as needed by a custom theme. This should be in the WordPress loop.
		 */
		function get_microsoft_ajax_translate_button() {
			$backtrace = debug_backtrace();
			if ( !is_feed() && // ignore feeds
			( "the_excerpt" != $backtrace[7]["function"] ) && // ignore excerpts
			( ( !is_page() && $this -> options['postEnable'] ) || ( is_page() && $this -> options['pageEnable'] ) ) && // apply to posts or pages
			! ( in_array( get_the_ID(), $this -> options['excludePages'] ) ) && // exclude certain pages and posts
			! ( $this -> options['excludeHome'] && is_home() ) ) { // if option is set exclude home page
				$translate_block = $this -> generate_translate_block('post');
				return '<div class="translate_block" style="display: none;">' . "\n" .
					$translate_block .
					"</div>\n";
			}
		}

		/**
		 * echo a translate button for current post. This should be in the WordPress loop.
		 */
		function microsoft_ajax_translate_button() {
			echo $this -> get_microsoft_ajax_translate_button();
		}

		/**
		 * generate translate_block 
		 * @return $translate_block string
		 * @param $type string a 'post or 'comment'
		 */
		function generate_translate_block($type = 'post') {
			if ( 'post' == $type ) {
				$id = get_the_ID();
			} elseif ( 'comment' == $type ) {
				global $comment;
				$id = $comment -> comment_ID;
			} else {
				return NULL;
			}
			$browser_lg = $this -> browser_lang;
			$translate_block = '<a class="translate_translate" id="translate_button_' . $type . '-' . $id . '" lang="' . $browser_lg . '" xml:lang="' . $browser_lg . '" href="javascript:show_translate_popup(\'' . $browser_lg . '\', \'' . $type . '\', ' . $id . ');">' . ($this -> before_translate) . ($this -> translate_message[$browser_lg]) . ($this -> after_translate) . '</a><img src="' . $this -> pluginRoot . 'images/transparent.gif" id="translate_loading_' . $type . '-' . $id . '" class="translate_loading" style="display: none;" width="16" height="16" alt="" />' . "\n";
			return $translate_block;
		}

		/**
		 * echoes the language popup in the wp_footer
		 */
		function getLanguagePopup() {
			$numberof_languages = count( $this -> options['languages'] );
			$languages_per_column = ceil( ( $numberof_languages + 2 ) / 3 );
			$index = 0;
			$output = '<div id="translate_popup" style="display: none;' .
				( $this -> options['backgroundColor'] ? ( ' background-color: ' . $this -> options['backgroundColor'] ) : "" ) .
				'">' . "\n\t" .
				'<table class="translate_links"><tr><td valign="top">' . "\n";
			switch ( $this->options['linkStyle'] ) {
				case 'text':
					foreach( $this -> options['languages'] as $lg ) {
						$output .= "\t\t" . '<a class="languagelink" lang="' . $lg . '" xml:lang="' . $lg . '" href="#" title="' .
							$this -> languages[$lg] . '">' . $this -> display_name[$lg] . '</a>' . "\n";
						if ( 0 == ++$index % $languages_per_column) {
							$output .= "\t" . '</td><td valign="top">' . "\n";
						}
					}
					break;
				case 'image':
					foreach( $this -> options['languages'] as $lg ) {
						$output .= "\t\t" . '<a class="languagelink" lang="' . $lg . '" xml:lang="' . $lg . '" href="#" title="' . 
							$this -> languages[$lg] . '"><img class="translate_flag ' . $lg . '" src="' . 
							$this -> pluginRoot . 'images/transparent.gif" alt="' . 
							$this -> display_name[$lg] . '" width="16" height="11" /></a>' . "\n";
						if ( 0 == ++$index % $languages_per_column ) {
							$output .= "\t" . '</td><td valign="top">' . "\n";
						}
					}
					break;
				case 'imageandtext':
					foreach( $this -> options['languages'] as $lg ) {
						$output .= "\t\t" . '<a class="languagelink" lang="' . $lg . '" xml:lang="' . $lg . '" href="#" title="' . 
							$this -> languages[$lg] . '"><img class="translate_flag ' . $lg . '" src="' . 
							$this -> pluginRoot . 'images/transparent.gif" alt="' . 
							$this -> display_name[$lg] . '" width="16" height="11" /> ' . 
							$this -> display_name[$lg] . '</a>' . "\n";
						if ( 0 == ++$index % $languages_per_column ) {
							$output .= "\t" . '</td><td valign="top">' . "\n";
						}
					}
					break;
			}
			$output .= "\t\t" . '<a class="bing_branding" rel="nofollow" target="_blank" href="http://www.microsofttranslator.com/bv.aspx?from=&amp;to=' .
				$this -> browser_lang . '&amp;a=' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] . '" title="translate whole page">' .
				__('powered by', $this -> textDomain ) .
				'<img src="http://search.microsoft.com/global/search/en-us/PublishingImages/bing_logo.png" alt="Bing" title="" width="40" height="15" /></a>' . 
				"\n\t</td></tr></table>\n</div>\n";
			echo $output;
		}

		/**
		 * echoes one or two JavaScripts in wp_footer
		 */
		function getFooterJS() {
			if ( $this -> options['copyBodyBackgroundColor'] ) { // Copy css background-color to popup if option is set
?>
				<script type="text/javascript">
					jQuery( function($) {
						jQuery('#translate_popup').css('background-color', jQuery('body').css('background-color'));
					});
				</script>
<?php
			}
			if ( $this -> options['doNotTranslateSelector'] ) {
?>
				<script type="text/javascript">
					//<![CDATA[
					var ga_translation_options = {
						do_not_translate_selector: '<?php echo $this -> options['doNotTranslateSelector'] ?>'
						};
					//]]>
				</script>
<?php
			}
		}

		/**
		 * function from: http://us.php.net/manual/en/function.http-negotiate-language.php
		 * determine which language out of an available set the user prefers most
		 * @param array $available_languages An array with language-tag-strings (must be lowercase) that are available
		 * @param string $http_accept_language An HTTP_ACCEPT_LANGUAGE string (read from $_SERVER['HTTP_ACCEPT_LANGUAGE'] if left out)
		 * @return string Best language chosen from $available_languages
		 */
		function preferred_language($available_languages, $http_accept_language="auto") {
			// if $http_accept_language was left out, read it from the HTTP-Header
			if ($http_accept_language == "auto")
				$http_accept_language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

			// standard  for HTTP_ACCEPT_LANGUAGE is defined under
			// http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html#sec14.4
			// pattern to find is therefore something like this:
			//    1#( language-range [ ";" "q" "=" qvalue ] )
			// where:
			//    language-range  = ( ( 1*8ALPHA *( "-" 1*8ALPHA ) ) | "*" )
			//    qvalue         = ( "0" [ "." 0*3DIGIT ] )
			//            | ( "1" [ "." 0*3("0") ] )
			preg_match_all("/([[:alpha:]]{1,8})(-([[:alpha:]|-]{1,8}))?" . "(\s*;\s*q\s*=\s*(1\.0{0,3}|0\.\d{0,3}))?\s*(,|$)/i",
				$http_accept_language, $hits, PREG_SET_ORDER);

			// default language (in case of no hits) is 'en'
			$bestlang = 'en';
			$bestqval = 0;

			foreach ($hits as $arr) {
				// read data from the array of this hit
				$langprefix = strtolower ($arr[1]);
				if (!empty($arr[3])) {
					$langrange = strtolower ($arr[3]);
					$language = $langprefix . "-" . $langrange;
				}
				else $language = $langprefix;
				$qvalue = 1.0;
				if (!empty($arr[5]))
					$qvalue = floatval($arr[5]);

				// find q-maximal language 
				if (in_array($language,$available_languages) && ($qvalue > $bestqval)) {
					$bestlang = $language;
					$bestqval = $qvalue;
				}
				// if no direct hit, try the prefix only but decrease q-value by 10% (as http_negotiate_language does)
				else if (in_array($langprefix,$available_languages) && (($qvalue * 0.9) > $bestqval)) {
					$bestlang = $langprefix;
					$bestqval = $qvalue * 0.9;
				}
			}
			return $bestlang;
		}
	}
}

if ( class_exists( 'MicrosoftTranslation' ) ) { // instantiate the class
	$MicrosoftTranslation = new MicrosoftTranslation();
}
?>