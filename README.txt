=== Microsoft AJAX Translation ===
Contributors: lovelucy
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&amp;business=zx0071%40163%2ecom&amp;item_name=Microsoft%20Ajax%20Translation%20WP%20Plugin&amp;item_number=Support%20Open%20Source%20Software%20Development&amp;no_shipping=0&amp;no_note=1&amp;tax=0&amp;currency_code=USD&amp;lc=US&amp;bn=PP%2dDonationsBF&amp;charset=UTF%2d8
Tags: microsoft, bing, google, ajax, jquery, translate, translation, i18n, international, global, language, multilingual, seo
Requires at least: 2.8
Tested up to: 3.3
Stable tag: 0.1.1

A quick, simple, and light way for your readers to translate your blog by using the Microsoft Translator API.

== Description ==

The Microsoft AJAX Translation WordPress plugin offers a "Translate" button that allows readers to translate your blog's posts into a specified language with a quick, light ajax call to the Microsoft Translator API.

= Why Microsoft AJAX Translation? =

As of December 1, 2011, Google Translate API v1 is no longer available; it was officially deprecated due to the substantial economic burden. Google Translate API v2 is now available as a paid service only, and the number of requests your application can make per day is limited.

This is dramatic news. All of those "free" programs that hitchhiked on Google Translate are history. A lot of wordpress plugins that depended on the free Google Translation Engine also not work any more. 

Fortunately, Microsoft still provide a free translation API for programmer. That's why I decide to develop this plugin, which uses Microsoft Translator API. It is a surprisingly adequate substitute for Google Translate.

= Features =

* **38 languages supported.** Powered by Microsoft's state-of-the-art statistical machine translation system.
* **Detects your source language automatically.** If your source text changes to more than one language it may get confused.
* **Detects visitor's language automatically.** Show the translate button in your readers' prefered language according to their broswer UA.
* **AJAX translation.** Better user experience as no refresh is needed.
* **On demand translation.** The plugin can translate just the content of the post, and full page translation is also supported.
* **Flexible to exclude certain posts and pages.** Even a section of a page can be excluded from being translated by a jQuery selector.
 
= Related Links =

* For the latest information and changelog visit <a href="http://www.lovelucy.info/microsoft-ajax-translation-wordpress-plugin.html" target="_blank">the developer's website</a>
* <a href="http://code.google.com/apis/language/translate/v2/terms.html" target="_blank">Google Translate API v2 Terms of Service</a>
* <a href="http://www.microsofttranslator.com/dev/tou/" target="_blank">Microsoft Translator API Terms of Use</a>


== Installation ==

1. Download the plugin archive and expand it.
2. Upload the `microsoft-ajax-translation` folder into your `wp-content/plugins/` directory.
3. Activate the plugin.
4. Get a Microsoft Bing Application ID - it's free and takes only two minutes.
4. Fill in your AppID in Options -> Microsoft Translation, then save changes of settings.
5. Enjoy with your blog readers.


== Frequently Asked Questions ==

= Why an AppID is needed? =

In order to avoid extensive abuse, Microsoft requires you to include a valid API key when you make programmatic calls to the translation APIs.

= How can I get an AppID? =

It is free and takes only two minutes.

1. Go to <a href="http://bing.com/developers" target="_blank">http://bing.com/developers</a>, then click "Create your AppID".
2. Sign up with your Windows Live ID.
3. Click "Get a new App ID".
4. Fill in some basic info and submit.
5. Congratulations! You get your AppID, which is long string and you can use it in this plugin.

= Can I customize the position of Translate button? =

Yes. You can position the "Translate" button anywhere within the WordPress loop as shown below:

<pre>
&lt;?php
if( method_exists( $MicrosoftTranslation, 'microsoft_ajax_translate_button' ) ) {
	$MicrosoftTranslation -> microsoft_ajax_translate_button();
}
?&gt;
</pre>

= Can I translate the whole page? =

Yes. Just click the "powered by bing" image on the translate popup, and your reader will get a full translated website.

= Why is the quality of the translation not as good as I would like it to be? =

You should understand that the translation your reader sees is raw machine translation. Currently, it still requires human skills to translate sentences without errors.

= Translation not working? =

1. Have you filled in your AppID in the settings page?
2. There are so many visitors requesting translation that Microsoft suspended your AppID.
3. This plugin automatically uses the jQuery library supplied by your WordPress installation. If your theme or another plugin has another copy of jQuery hard coded into it this plugin may not work.
4. Ask in the forums.

== Screenshots ==

1. Translate popup with language flag icons and text
2. Translate whole page if click "powered by bing"
3. The settings page

== Credits ==

This plugin is forked from the <a href="http://wordpress.org/extend/plugins/google-ajax-translation/" target="_blank">Google AJAX Translation</a> wordpress plugin. Thanks Libin, alquanto and monodistortion for their previous work.

This plugin uses the <a href="http://code.google.com/p/jquery-translate/" target="_blank">jquery-translate plugin</a> and the <a href="http://api.microsofttranslator.com" target="_blank">Microsoft Translator API</a> .

== Support ==

Have questions or suggestions for this plugin? 

Please ask in the forums here.

1. Please start a new thread for your question, problem, or suggestion. Use the tag `microsoft-ajax-translation` so that it shows up in the same list.
2. Please include as much information as possible like:
   WordPress version, Microsoft AJAX Translation version, a link to your web page
3. Most problems seem to be theme related so check to see if the plugin works in the default theme.

== Changelog ==

= 0.1.1 =

* Fix bug: The website may be messed up with missing and misplaced tags in the translation if the original HTML is not well formatted.

= 0.1.0 =

* Initial Release

== Upgrade Notice ==

= 0.1.1 =

* This version fixes a bug. Upgrade if your website messed up in the translation.