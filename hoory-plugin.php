<?php
/**
 * Plugin Name:     Hoory Plugin
 * Plugin URI:      https://www.hoory.com/
 * Description:     Hoory Plugin for WordPress. This plugin helps you to quickly integrate Hoory live-chat widget on Wordpress websites.
 * Author:          antpb
 * Author URI:      hoory.com
 * Text Domain:     hoory-plugin
 * Version:         0.2.0
 *
 * @package         hoory-plugin
 */

add_action('admin_enqueue_scripts', 'admin_styles');
/**
 * Load Hoory Admin CSS.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function admin_styles() {
  wp_enqueue_style('admin-styles', plugin_dir_url(__FILE__) . '/admin.css');
}

 add_action( 'wp_enqueue_scripts', 'hoory_assets' );
/**
 * Load Hoory Assets.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function hoory_assets() {
    wp_enqueue_script( 'hoory-client', plugins_url( '/js/hoory.js' , __FILE__ ) );
}

add_action( 'wp_enqueue_scripts', 'hoory_load' );
/**
 * Initialize embed code options.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function hoory_load() {

  // Get our site options for site url and token.
  $hoory_url = get_option('hoorySiteURL');
  $hoory_token = get_option('hoorySiteToken');
  $hoory_widget_locale = get_option('hooryWidgetLocale');
  $hoory_widget_type = get_option('hooryWidgetType');
  $hoory_widget_position = get_option('hooryWidgetPosition');
  $hoory_launcher_text = get_option('hooryLauncherText');

  // Localize our variables for the Javascript embed code.
  wp_localize_script('hoory-client', 'hoory_token', $hoory_token);
  wp_localize_script('hoory-client', 'hoory_url', $hoory_url);
  wp_localize_script('hoory-client', 'hoory_widget_locale', $hoory_widget_locale);
  wp_localize_script('hoory-client', 'hoory_widget_type', $hoory_widget_type);
  wp_localize_script('hoory-client', 'hoory_launcher_text', $hoory_launcher_text);
  wp_localize_script('hoory-client', 'hoory_widget_position', $hoory_widget_position);
}

add_action('admin_menu', 'hoory_setup_menu');
/**
 * Set up Settings options page.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function hoory_setup_menu(){
    add_options_page('Option', 'Hoory Settings', 'manage_options', 'hoory-plugin-options', 'hoory_options_page');
}

add_action( 'admin_init', 'hoory_register_settings' );
/**
 * Register Settings.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function hoory_register_settings() {
  add_option('hoorySiteToken', '');
  add_option('hoorySiteURL', '');
  add_option('hooryWidgetLocale', 'en');
  add_option('hooryWidgetType', 'standard');
  add_option('hooryWidgetPosition', 'right');
  add_option('hooryLauncherText', '');

  register_setting('hoory-plugin-options', 'hoorySiteToken' );
  register_setting('hoory-plugin-options', 'hoorySiteURL');
  register_setting('hoory-plugin-options', 'hooryWidgetLocale' );
  register_setting('hoory-plugin-options', 'hooryWidgetType' );
  register_setting('hoory-plugin-options', 'hooryWidgetPosition' );
  register_setting('hoory-plugin-options', 'hooryLauncherText' );
}

/**
 * Render page.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function hoory_options_page() {
  ?>
  <div>
    <h2>Hoory Settings</h2>
    <form method="post" action="options.php" class="hoory--form">
      <?php settings_fields('hoory-plugin-options'); ?>
      <div class="form--input">
        <label for="hoorySiteToken">Hoory Website Token</label>
        <input
          type="text"
          name="hoorySiteToken"
          value="<?php echo get_option('hoorySiteToken'); ?>"
        />
      </div>
      <div class="form--input">
        <label for="hoorySiteURL">Hoory Installation URL</label>
        <input
          type="text"
          name="hoorySiteURL"
          value="<?php echo get_option('hoorySiteURL'); ?>"
        />
      </div>
      <hr />

      <div class="form--input">
        <label for="hooryWidgetType">Widget Design</label>
        <select name="hooryWidgetType">
          <option value="standard" <?php selected(get_option('hooryWidgetType'), 'standard'); ?>>Standard</option>
          <option value="expanded_bubble" <?php selected(get_option('hooryWidgetType'), 'expanded_bubble'); ?>>Expanded Bubble</option>
        </select>
      </div>
      <div class="form--input">
        <label for="hooryWidgetPosition">Widget Position</label>
        <select name="hooryWidgetPosition">
          <option value="left" <?php selected(get_option('hooryWidgetPosition'), 'left'); ?>>Left</option>
          <option value="right" <?php selected(get_option('hooryWidgetPosition'), 'right'); ?>>Right</option>
        </select>
      </div>
      <div class="form--input">
        <label for="hooryWidgetLocale">Language</label>
        <select name="hooryWidgetLocale">
          <option <?php selected(get_option('hooryWidgetLocale'), 'ar'); ?> value="ar">العربية (ar)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'ca'); ?> value="ca">Català (ca)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'cs'); ?> value="cs">čeština (cs)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'da'); ?> value="da">dansk (da)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'de'); ?> value="de">Deutsch (de)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'el'); ?> value="el">ελληνικά (el)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'en'); ?> value="en">English (en)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'es'); ?> value="es">Español (es)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'fa'); ?> value="fa">فارسی (fa)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'fi'); ?> value="fi">suomi, suomen kieli (fi)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'fr'); ?> value="fr">Français (fr)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'hi'); ?> value="hi'">हिन्दी (hi)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'hu'); ?> value="hu">magyar nyelv (hu)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'id'); ?> value="id">Bahasa Indonesia (id)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'it'); ?> value="it">Italiano (it)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'ja'); ?> value="ja">日本語 (ja)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'ko'); ?> value="ko">한국어 (ko)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'ml'); ?> value="ml">മലയാളം (ml)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'nl'); ?> value="nl">Nederlands (nl) </option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'no'); ?> value="no">norsk (no)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'pl'); ?> value="pl">język polski (pl)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'pt_BR'); ?> value="pt_BR">Português Brasileiro (pt-BR)
          <option <?php selected(get_option('hooryWidgetLocale'), 'pt'); ?> value="pt">Português (pt)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'ro'); ?> value="ro">Română (ro)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'ru'); ?> value="ru">русский (ru)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'sv'); ?> value="sv">Svenska (sv)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'ta'); ?> value="ta">தமிழ் (ta)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'tr'); ?> value="tr">Türkçe (tr)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'vi'); ?> value="vi">Tiếng Việt (vi)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'zh_CN'); ?> value="zh_CN">中文 (zh-CN)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'zh_TW'); ?> value="zh_TW">中文 (台湾) (zh-TW)</option>
          <option <?php selected(get_option('hooryWidgetLocale'), 'zh'); ?> value="zh'">中文 (zh)</option>
        </select>
      </div>
      <?php if (get_option('hooryWidgetType') == 'expanded_bubble') : ?>
        <div class="form--input">
          <label for="hooryLauncherText">Launcher Text (Optional)</label>
          <input
            type="text"
            name="hooryLauncherText"
            value="<?php echo get_option('hooryLauncherText'); ?>"
          />
        </div>
      <?php endif; ?>
      <?php submit_button(); ?>
    </form>
  </div>
<?php
}
