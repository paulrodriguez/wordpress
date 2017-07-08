<?php
/*
Plugin Name: Add Document Type Styles New
Plugin URI: http://newinternetorder.com/plugins
Description: Detects URLs in your posts and pages and displays nice
document type icons next to them. Includes support for PDF, DOC, MP3,
and ZIP.
Version: 1.0
Author: Karol K
Author URI: http://karol.cc/
Text Domain: add_doctype_styles_new
License: GNU General Public License v2 or later
*/

// this function does the magic
function doctype_styles_new_regex($text) {
$text = preg_replace('/href=([\'|"][[:alnum:]|[:punct:]]*)\.(pdf|doc|mp3|zip)([\'|"])/', 'href=\\1.\\2\\3class="link \\2"', $text);
return $text;
}
// this functions adds the stylesheet to the head
function doctype_styles_new_styles() {
  wp_register_style('doctypes_styles', plugins_url('doctype_styles_new.css', __FILE__));
  wp_enqueue_style('doctypes_styles');
}

function set_supportedtypes_options() {
  add_option("doctype_styles_new_supportedtypes","pdf,doc,mp3,zip");
}

function unset_supportedtypes_options () {
  delete_option("doctype_styles_new_supportedtypes");
}

function ahs_doctypes_regex($text) {
  $types = get_option('doctype_styles_new_supportedtypes');
  $types = preg_replace('/,\s*/', '|', $types);
  $text = preg_replace('/href=([\'|"][[:alnum:]|[:punct:]]*)\.('.$types.')([\'|"])/i', 'href=\\1.\\2\\3class="link \\2"', $text);
  return $text;
}

// add new item to settings menu
function modify_menu_for_supportedtypes() {
  add_submenu_page(
  'options-general.php', //The new options page will be added as a submenu to the Settings menu.
  'Document Type Styles', //Page <title>
  'Document Type Styles', //Menu title
  'manage_options', //Capability
  'add_doctype_styles_new', //Slug
  'supportedtypes_options' //Function to call
  );
}

function supportedtypes_options() {
  echo '<div class="wrap"><h2>Supported Document Types</h2>';
  if (isset($_POST['submit'])) {
    update_supportedtypes_options();
  }
  print_supportedtypes_form();
  echo '</div>';
}

function update_supportedtypes_options() {
  $updated = false;
  if ($_POST['doctype_styles_new_supportedtypes']) {
    $safe_val = addslashes(strip_tags($_POST
    ['doctype_styles_new_supportedtypes']));
    update_option('doctype_styles_new_supportedtypes',$safe_val);
    $updated = true;
  }
  if ($updated) {
    echo '<div id="message" class="updated fade">';
    echo '<p>Supported types successfully updated!</p>';
    echo '</div>';
  } else {
    echo '<div id="message" class="error fade">';
    echo '<p>Unable to update supported types!</p>';
    echo '</div>';
  }
}

function print_supportedtypes_form() {
$val_doctype_styles_new_supportedtypes =
stripslashes(get_option('
doctype_styles_new_supportedtypes'));
echo <<<EOF
<p>Document types supported by the Add Document Type Styles New
plugin are listed below.<br />To add a new type to be linked, take
the following steps, in this order:
<ol>
<li>Upload the icon file for the new doctype to <i>wpcontent/plugins/add_doctype_styles_new/</i></li>
<li>Add a line for the new doctype to the stylesheet at
<i>wp-content/plugins/add_doctype_styles_new/
doctype_styles_new.css</i></li>
<li>Add the extension of the new doctype to the list
below, keeping with the comma-separated format.</li>
</ol>
</p>
<form method="post">
<input type="text" name=
"doctype_styles_new_supportedtypes" size="50" value="$val_
doctype_styles_new_supportedtypes" />
<input type="submit" name="submit" value="Save Changes"
/>
</form>
EOF;
}

// HOOKS =============
add_filter('the_content', 'doctype_styles_new_regex', 9);
add_action('wp_enqueue_scripts', 'doctype_styles_new_styles');

add_action('admin_menu', 'modify_menu_for_supportedtypes');
register_activation_hook(__FILE__, "set_supportedtypes_options");
register_deactivation_hook(__FILE__,"unset_supportedtypes_options");
