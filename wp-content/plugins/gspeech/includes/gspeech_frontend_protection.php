<?php

// no direct access!
defined('ABSPATH') or die("No direct access");

// ===== Safe script tag flags for our handles =====
add_filter('script_loader_tag', function ($tag, $handle) {
    if ($handle === 'wpgs-script776' || $handle === 'wpgs-script777') {
        $tag = str_replace([' defer', ' async'], '', $tag);
        $tag = str_replace('<script ', '<script data-no-defer="1" data-no-optimize="1" data-no-minify="1" data-cfasync="false" nowprocket ', $tag);
        if (strpos($tag, ' id=') === false) {
            $tag = str_replace('<script ', '<script id="'.$handle.'-js" ', $tag);
        }
    }
    return $tag;
}, 10, 2);

// ===== Frontend fallback if optimizers stripped our inline/localize/enqueue =====
add_action('wp_print_footer_scripts', function () {

	if (wp_doing_ajax()) return;
    if (is_admin()) return;
    if (strpos($_SERVER['REQUEST_URI'] ?? '', '/wp-admin/') !== false) return;

    $cache_key = 'gspeech_footer_settings_cache';
    $settings  = get_transient($cache_key);

    if ($settings === false) {
        $settings = [
            'widget_id'      => (string) get_option('gspeech_widget_id', ''),
            'version'        => defined('GSPEECH_PLG_VERSION') ? GSPEECH_PLG_VERSION : '1.0.0',
            'lazy_load'      => (int) get_option('gspeech_lazy_load', 1),
            'reload_session' => (int) get_option('gspeech_reload_session', 0),
            'version_index'  => (int) get_option('gspeech_version_index', 0),
            'gtranslate'     => get_option('GTranslate', []),
        ];

        set_transient($cache_key, $settings, 5 * MINUTE_IN_SECONDS);
    }

    $widget_id       = $settings['widget_id'];
    $version         = $settings['version'];
    $lazy_load       = $settings['lazy_load'];
    $reload_session  = $settings['reload_session'];
    $version_index_1 = $settings['version_index'];
    $gtranslate      = $settings['gtranslate'];

    if ($widget_id === '') return;

    $plugin_main = realpath(dirname(__DIR__) . '/gspeech.php');
	$front_src   = plugin_dir_url($plugin_main) . 'includes/js/gspeech_front.js';
    $jquery_url = includes_url('js/jquery/jquery.min.js');

    $ajax_url   = admin_url('admin-ajax.php');
    $ajax_nonce = wp_create_nonce('wpgsp_ajax_nonce_value_1');
    $referer    = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

    $wrapper_selector = 'gsp_clgtranslate_wrapper';
    if (!empty($gtranslate) && !empty($gtranslate['wrapper_selector'])) {
        $ws = sanitize_text_field($gtranslate['wrapper_selector']);
        $ws = str_replace('.', 'gsp_cl', $ws);
        $ws = str_replace('#', 'gsp_id', $ws);
        $wrapper_selector = $ws;
    }
    ?>
    <script type="text/javascript" id="wpgs-script777-js-extra-fallback" data-no-defer="1" data-no-optimize="1" data-no-minify="1" data-cfasync="false" nowprocket>var gsp_ajax_obj = {"ajax_url": <?php echo json_encode($ajax_url); ?>, "nonce": <?php echo json_encode($ajax_nonce); ?>};if (!window.gsp_ajax_obj) { window.gsp_ajax_obj = gsp_ajax_obj; }</script>
	<script id="wpgs-fallback-init" data-no-defer="1" data-no-optimize="1" data-no-minify="1" data-cfasync="false" nowprocket>(function(){try{var scripts=document.scripts,exists=false;for(var i=0;i<scripts.length;i++){if(/gspeech_front\.js/i.test(scripts[i].src)){exists=true;break;}}if(window.gspeechFront||document.getElementById("wpgs-script777-js")||exists){console.log("[GSpeech] gspeech_front.js already loaded");return;}function ensureDataDiv(){if(!document.getElementById('gsp_data_html')){var d=document.createElement('div');d.id='gsp_data_html';d.setAttribute('data-g_version',<?php echo json_encode($version); ?>);d.setAttribute('data-w_id',<?php echo json_encode($widget_id); ?>);d.setAttribute('data-s_enc','');d.setAttribute('data-h_enc','');d.setAttribute('data-hh_enc','');d.setAttribute('data-lazy_load',<?php echo json_encode($lazy_load); ?>);d.setAttribute('data-reload_session',<?php echo json_encode($reload_session); ?>);d.setAttribute('data-gt-w',<?php echo json_encode($wrapper_selector); ?>);d.setAttribute('data-vv_index',<?php echo json_encode($version_index_1); ?>);d.setAttribute('data-ref',encodeURI(<?php echo json_encode($referer); ?>));(document.body||document.documentElement).appendChild(d);}}if(document.readyState==='loading'){document.addEventListener('DOMContentLoaded',ensureDataDiv);}else{ensureDataDiv();}console.warn("[GSpeech] gspeech_front.js not found — loading fallback");function loadScript(src,id,cb){var s=document.createElement("script");if(id)s.id=id;s.setAttribute("data-no-defer","");s.setAttribute("data-no-optimize","");s.setAttribute("data-cfasync","false");s.src=src;s.onload=function(){cb&&cb();};s.onerror=function(){cb&&cb();};(document.head||document.documentElement).appendChild(s);}if(!window.jQuery){loadScript(<?php echo json_encode($jquery_url.(strpos($jquery_url,'?')===false?'?v=':'&v=').$version); ?>,"wpgs-jquery-fallback",function(){loadScript(<?php echo json_encode($front_src.(strpos($front_src,"?")===false?"?v=":"&v=").$version); ?>,"wpgs-script777-js");});}else{loadScript(<?php echo json_encode($front_src.(strpos($front_src,"?")===false?"?v=":"&v=").$version); ?>,"wpgs-script777-js");}}catch(e){console.error("[GSpeech] fallback error:",e);}})();</script>
    <?php
}, 999);

?>