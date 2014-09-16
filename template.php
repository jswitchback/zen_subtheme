<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * A QUICK OVERVIEW OF DRUPAL THEMING
 *
 *   The default HTML for all of Drupal's markup is specified by its modules.
 *   For example, the comment.module provides the default HTML markup and CSS
 *   styling that is wrapped around each comment. Fortunately, each piece of
 *   markup can optionally be overridden by the theme.
 *
 *   Drupal deals with each chunk of content using a "theme hook". The raw
 *   content is placed in PHP variables and passed through the theme hook, which
 *   can either be a template file (which you should already be familiary with)
 *   or a theme function. For example, the "comment" theme hook is implemented
 *   with a comment.tpl.php template file, but the "breadcrumb" theme hooks is
 *   implemented with a theme_breadcrumb() theme function. Regardless if the
 *   theme hook uses a template file or theme function, the template or function
 *   does the same kind of work; it takes the PHP variables passed to it and
 *   wraps the raw content with the desired HTML markup.
 *
 *   Most theme hooks are implemented with template files. Theme hooks that use
 *   theme functions do so for performance reasons - theme_field() is faster
 *   than a field.tpl.php - or for legacy reasons - theme_breadcrumb() has "been
 *   that way forever."
 *
 *   The variables used by theme functions or template files come from a handful
 *   of sources:
 *   - the contents of other theme hooks that have already been rendered into
 *     HTML. For example, the HTML from theme_breadcrumb() is put into the
 *     $breadcrumb variable of the page.tpl.php template file.
 *   - raw data provided directly by a module (often pulled from a database)
 *   - a "render element" provided directly by a module. A render element is a
 *     nested PHP array which contains both content and meta data with hints on
 *     how the content should be rendered. If a variable in a template file is a
 *     render element, it needs to be rendered with the render() function and
 *     then printed using:
 *       <?php print render($variable); ?>
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. With this file you can do three things:
 *   - Modify any theme hooks variables or add your own variables, using
 *     preprocess or process functions.
 *   - Override any theme function. That is, replace a module's default theme
 *     function with one you write.
 *   - Call hook_*_alter() functions which allow you to alter various parts of
 *     Drupal's internals, including the render elements in forms. The most
 *     useful of which include hook_form_alter(), hook_form_FORM_ID_alter(),
 *     and hook_page_alter(). See api.drupal.org for more information about
 *     _alter functions.
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   If a theme hook uses a theme function, Drupal will use the default theme
 *   function unless your theme overrides it. To override a theme function, you
 *   have to first find the theme function that generates the output. (The
 *   api.drupal.org website is a good place to find which file contains which
 *   function.) Then you can copy the original function in its entirety and
 *   paste it in this template.php file, changing the prefix from theme_ to
 *   STARTERKIT_. For example:
 *
 *     original, found in modules/field/field.module: theme_field()
 *     theme override, found in template.php: STARTERKIT_field()
 *
 *   where STARTERKIT is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_field() function.
 *
 *   Note that base themes can also override theme functions. And those
 *   overrides will be used by sub-themes unless the sub-theme chooses to
 *   override again.
 *
 *   Zen core only overrides one theme function. If you wish to override it, you
 *   should first look at how Zen core implements this function:
 *     theme_breadcrumbs()      in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called theme hook suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node--forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and theme hook suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440 and http://drupal.org/node/1089656
 */


/**
  * Adding js via Drupal libraries for better control over where they are aggregated (SYSTEM, LIBRARIES or THEME)
 *  Implements hook_library().
 */
function zen_subtheme_library() {

  // Feature detection and conditional script loading
  $libraries['modernizr'] = array(
    'title' => 'modernizr',
    'website' => 'modernizr',
    'version' => '1.0',
    'js' => array(
      drupal_get_path('theme', 'zen_subtheme') . '/js/lib-vendor/modernizr.dev.js' => array(
        'type' => 'file',
        'weight' => 1000,
        'group' => JS_LIBRARY),
    ),
  );

  $libraries['matchMedia_polyfill'] = array(
    'title' => 'Polyfill matchMedia in IE9',
    'website' => 'https://github.com/paulirish/matchMedia.js/',
    'version' => '1.0',
    'js' => array(
      drupal_get_path('theme', 'zen_subtheme') . '/js/lib-vendor/media.match.min.js' => array(
        'type' => 'file',
        'weight' => 1002,
        'group' => JS_LIBRARY),
    ),
  );
  // Responsive JS framework via Javascript matchMedia API
  $libraries['enquire'] = array(
    'title' => 'Javasript matchMedia API Framework',
    'website' => 'http://wicky.nillia.ms/enquire.js/',
    'version' => '1.0',
    'js' => array(
      drupal_get_path('theme', 'zen_subtheme') . '/js/lib-vendor/enquire.min.js' => array(
        'type' => 'file',
        'weight' => 1003,
        'group' => JS_LIBRARY),
    ),
  );

  $libraries['to_top'] = array(
    'title' => 'To top scroll button',
    'version' => '1.0',
    'js' => array(
      drupal_get_path('theme', 'zen_subtheme') . '/js/lib-conditional/to-top-button.js' => array(
        'type' => 'file',
        'group' => JS_THEME),
    ),
    'css' => array(
      drupal_get_path('theme', 'zen_subtheme') . '/css/lib-conditional/to-top-button.css' => array(
        'type' => 'file',
        'media' => 'screen',
      ),
    ),
  );

  $libraries['responsive_js'] = array(
    'title' => 'Responsive JS',
    'version' => '1.0',
    'js' => array(
      drupal_get_path('theme', 'zen_subtheme') . '/js/lib-base/responsive-app.js' => array(
        'type' => 'file',
        'weight' => 1004,
        'group' => JS_LIBRARY),
    ),
  );

  $libraries['touch'] = array(
    'title' => 'Touch Device JS',
    'version' => '1.0',
    'js' => array(
      drupal_get_path('theme', 'zen_subtheme') . '/js/lib-conditional/touch.js' => array(
        'type' => 'file',
        'weight' => 1005,
        'group' => JS_LIBRARY),
    ),
  );
      
  return $libraries;
}


/**
 * Override or insert variables into the html template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered. This is usually "html", but can
 *   also be "maintenance_page" since zen_subtheme_preprocess_maintenance_page() calls
 *   this function to have consistent variables.
 */
function zen_subtheme_preprocess_html(&$variables, $hook) {
  // Add variables and paths needed for HTML5 and responsive support.
  $variables['base_path'] = base_path();
  $variables['path_to_zen_subtheme'] = drupal_get_path('theme', 'zen_subtheme');

  $viewport_indicator = theme_get_setting('zen_subtheme_browser_width_indicator');

  $variables['to_top'] = theme_get_setting('zen_subtheme_to_top');
  $to_top = $variables['to_top'];

  $variables['accordion_menu'] = theme_get_setting('zen_subtheme_accordion_menu');
  $accordion_menu = $variables['accordion_menu'];

  $variables['compass_grid'] = theme_get_setting('zen_subtheme_compass_grid');
  $compass_grid = $variables['compass_grid'];

  $variables['ms_tile_color'] = theme_get_setting('zen_subtheme_ms_tile_color');
  $ms_tile_color = $variables['ms_tile_color'];

  if ($to_top) {
    drupal_add_js(drupal_get_path('theme', 'd7theme') . '/js/lib-vendor/jquery.smooth-scroll.js',  array('type' => 'file','weight' => 1045,'group' => JS_LIBRARY));
    drupal_add_library('zen_subtheme', 'to_top');
  }

  if ($compass_grid && $variables['is_admin'] ) {
      $variables['attributes_array']['data-development-grid'][] = 'hide';
      drupal_add_js(drupal_get_path('theme', 'zen_subtheme') . '/js/lib-conditional/grid.js', array('group' => JS_THEME, 'weight' => -10, 'every_page' => TRUE));
      drupal_add_css(drupal_get_path('theme', 'zen_subtheme') . '/css/lib-conditional/grid.css', array('group' => CSS_THEME, 'weight' => -10, 'every_page' => TRUE));
  }

  if ($viewport_indicator) {
    if ($variables['is_admin'] && !module_exists('overlay')) {
      $variables['attributes_array']['class'][] = 'zen_subtheme_browser-width-indicator';
      drupal_add_js(drupal_get_path('theme', 'zen_subtheme') . '/js/lib-conditional/viewport-indicator.js', array('group' => JS_THEME, 'weight' => -10, 'every_page' => TRUE));
      drupal_add_css(drupal_get_path('theme', 'zen_subtheme') . '/css/lib-conditional/viewport-indicator.css', array('group' => CSS_THEME, 'weight' => -10, 'every_page' => TRUE));
    }
  }

  if (!empty($variables['page']['theming_sidebar']) && $variables['is_admin']) {
    $variables['classes_array'][] = 'has-theming-sidebar';
    drupal_add_css(drupal_get_path('theme','zen_subtheme') . '/css/lib-conditional/theming-sidebar.css');
  } 

  // Add body class, css and js when offcanvas sidebar has block content.
  if (!empty($variables['page']['offcanvas_sidebar'])) {
    $variables['classes_array'][] = 'has-offcanvas-sidebar';
    drupal_add_js(drupal_get_path('theme', 'zen_subtheme') . '/js/lib-conditional/offcanvas-sidebar.js', array('type' => 'file','weight' => 1050,'group' => JS_LIBRARY));
    drupal_add_css(drupal_get_path('theme','zen_subtheme') . '/css/lib-conditional/offcanvas-sidebar.css');
  } 

  if ($accordion_menu) {
    drupal_add_js(drupal_get_path('theme', 'zen_subtheme') . '/js/lib-conditional/toggle-menu.js', array('type' => 'file','weight' => 1055,'group' => JS_LIBRARY));
    drupal_add_css(drupal_get_path('theme','zen_subtheme') . '/css/lib-conditional/toggle-menu.css');
  }

  drupal_add_library('zen_subtheme', 'modernizr');
  drupal_add_library('zen_subtheme', 'matchMedia_polyfill');
  drupal_add_library('zen_subtheme', 'enquire');
  drupal_add_library('zen_subtheme', 'responsive_js');
  drupal_add_library('zen_subtheme', 'touch');

}


/**
 * Override or insert variables into the page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function zen_subtheme_preprocess_page(&$variables) {
  // Expose theme setting for conditionally loaded markup in page template.
  $variables['accordion_menu'] = theme_get_setting('zen_subtheme_accordion_menu');
  $add_accordion_menu = $variables['accordion_menu'];

  $variables['add_to_top'] = theme_get_setting('zen_subtheme_to_top');
  $add_to_top = $variables['add_to_top'];

}

/**
 * Preprocess variables for region.tpl.php
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
// function zen_subtheme_preprocess_region(&$variables, $hook) {
//  if ($variables['region'] == 'navigation') {
//     $variables['theme_hook_suggestions'][] = 'region__no_wrapper';
//   }
//   //dpm($variables);
//  if ($variables['region'] == 'mobile_sidebar') {
//     $variables['theme_hook_suggestions'][] = 'region__no_wrapper';
//   }
// }


/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
// function zen_subtheme_preprocess_node(&$variables, $hook) {
  // if ($variables['type'] == 'NODE_MACHINE_NAME' && $variables['view_mode'] == 'teaser') {
  //   $variables['title_attributes_array']['class'][] = 'grid-title';
  // }
  
  // Optionally, run node-type-specific preprocess functions, like
  // STARTERKIT_preprocess_node_page() or STARTERKIT_preprocess_node_story().
  // $function = __FUNCTION__ . '_' . $variables['node']->type;
  // if (function_exists($function)) {
  //   $function($variables, $hook);
  // }

// }

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
function zen_subtheme_preprocess_block(&$variables, $hook) {
  // Add block class so we don't have to style by an id.
  // dpm($variables['block']->module);
  // ... to add blocks from other modules
  switch ($variables['block']->module) {
    case 'system':
    case 'menu':
    case 'menu_block':
    case 'block':
    case 'views':      
      // Add a class equal to the id minus "block-"
      $block_id = $variables['block_html_id'];
      $block_id = str_replace('block-', '', $block_id);
      $variables['classes_array'][] = $block_id;
      break;
  }

  // Change theme templates, add classes and/or replace IDs 
  // Output block id's with devel
  // dpm ($variables);
  // dpm ($variables['block_html_id']);
  // switch ($variables['block_html_id']) {
  //    // case 'block-block-7':
  //    // case 'block-8':
  //    // case 'block-9':
  //    //     $variables['classes_array'][] = 'new-class';
  //    //     $variables['block_html_id'] = 'replace-id';
  //    //     $variables['theme_hook_suggestions'][] = 'block__new_template';
  //    //     break;
  //     break;
  // }
}


/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/**
 * Implements hook_block_list_alter().
 */
function zen_subtheme_block_list_alter(&$blocks) {

  // Hide the main content block on the front page if the theme settings are
  // configured that way.
  if (!theme_get_setting('zen_subtheme_toggle_front_page_content') && drupal_is_front_page()) {
    foreach ($blocks as $key => $block) {
      if ($block->module == 'system' && $block->delta == 'main') {
        unset($blocks[$key]);
      }
    }
    drupal_set_page_content();
  }
}


/**
 * Alter forms.
 *
 */
function zen_subtheme_form_alter(&$form, &$form_state, $form_id) {
  // dpm ($form);
  // dpm ($form_id);

  if ($form_id == 'search_block_form') {
    // HTML5 placeholder attribute
    $form['search_block_form']['#attributes']['placeholder'] = t('Search');
  }

  if (in_array( $form_id, array( 'user_login', 'user_login_block'))) {
    // Add "Username" & "Password" placeholders
    $form['name']['#attributes']['placeholder'] = t( 'Username' );
    $form['pass']['#attributes']['placeholder'] = t( 'Password' );

    // Add links back in that were removed from tabs in hook_menu_alter
    $form['links']['#markup'] = '<div id="reset-password"><a class="user-password" href="'.url('user/password').'">' . t('Forgot your password?') . '</a></div><div id="create-account"><a class="user-login" href="'.url('user').'">' . t('Already have an account?') . '</a></div>';
    $form['links']['#weight'] = 540;
  }

  if ($form_id == 'user_pass') {
    // Add links back in that were removed from tabs in hook_menu_alter
    $form['links']['#markup'] = '<a class="user-login" href="'.url('user').'">' . t('Already have an account?') . '</a>';
    $form['links']['#weight'] = 540;
  }

}

// Remove tabs from login pages because links are added in a hook_form_alter
function zen_subtheme_menu_alter(&$items) {
  $items['user']['type'] = MENU_CALLBACK;
  $items['user/register']['type'] = MENU_CALLBACK;
  $items['user/password']['type'] = MENU_CALLBACK;

}

function zen_subtheme_css_alter(&$css) {

  // if (isset($css[drupal_get_path('system', 'lang_dropdown') .'/msdropdown/dd_after.css'])) {
  //   $css[drupal_get_path('module', 'lang_dropdown') .'/msdropdown/dd_after.css']['data'] = drupal_get_path('theme', 'custom') . '/css/custom-dd_after.css';
  // }
  // // Remove defaults.css file.
  // unset($css[drupal_get_path('module', 'lang_dropdown') . '/msdropdown/dd_after.css']);
  
  
  // Omega Team: the CSS_SYSTEM aggregation group doesn't make any sense. Therefore, we are
  // pre-pending it to the CSS_DEFAULT group. This has the same effect as giving
  // it a separate (low-weighted) group but also allows it to be aggregated
  // together with the rest of the CSS.
  foreach ($css as &$item) {
    if ($item['group'] == CSS_SYSTEM) {
      $item['group'] = CSS_DEFAULT;
      $item['weight'] = $item['weight'] - 100;
    }
  }

  // Clean up core and contrib module CSS.
  $overrides = array(
    'aggregator' => array(
      'aggregator.css' => array(
        'theme' => 'aggregator.theme.css',
      ),
      'aggregator-rtl.css' => array(
        'theme' => 'aggregator.theme-rtl.css',
      ),
    ),
    'block' => array(
      'block.css' => array(
        'admin' => 'block.admin.css',
        'demo' => 'block.demo.css',
      ),
    ),
    'book' => array(
      'book.css' => array(
        'theme' => 'book.theme.css',
        'admin' => 'book.admin.css',
      ),
      'book-rtl.css' => array(
        'theme' => 'book.theme-rtl.css',
      ),
    ),
    'color' => array(
      'color.css' => array(
        'admin' => 'color.admin.css',
      ),
      'color-rtl.css' => array(
        'admin' => 'color.admin-rtl.css',
      ),
    ),
    'comment' => array(
      'comment.css' => array(
        'theme' => 'comment.theme.css',
      ),
      'comment-rtl.css' => array(
        'theme' => 'comment.theme-rtl.css',
      ),
    ),
    'contextual' => array(
      'contextual.css' => array(
        'base' => 'contextual.base.css',
        'theme' => 'contextual.theme.css',
      ),
      'contextual-rtl.css' => array(
        'base' => 'contextual.base-rtl.css',
        'theme' => 'contextual.theme-rtl.css',
      ),
    ),
    'field' => array(
      'theme/field.css' => array(
        'theme' => 'field.theme.css',
      ),
      'theme/field-rtl.css' => array(
        'theme' => 'field.theme-rtl.css',
      ),
    ),
    'field_ui' => array(
      'field_ui.css' => array(
        'admin' => 'field_ui.admin.css',
      ),
      'field_ui-rtl.css' => array(
        'admin' => 'field_ui.admin-rtl.css',
      ),
    ),
    'file' => array(
      'file.css' => array(
        'theme' => 'file.theme.css',
      ),
    ),
    'filter' => array(
      'filter.css' => array(
        'theme' => 'filter.theme.css',
      ),
    ),
    'forum' => array(
      'forum.css' => array(
        'theme' => 'forum.theme.css',
      ),
      'forum-rtl.css' => array(
        'theme' => 'forum.theme-rtl.css',
      ),
    ),
    'image' => array(
      'image.css' => array(
        'theme' => 'image.theme.css',
      ),
      'image-rtl.css' => array(
        'theme' => 'image.theme-rtl.css',
      ),
      'image.admin.css' => array(
        'admin' => 'image.admin.css',
      ),
    ),
    'locale' => array(
      'locale.css' => array(
        'admin' => 'locale.admin.css',
      ),
      'locale-rtl.css' => array(
        'admin' => 'locale.admin-rtl.css',
      ),
    ),
    'openid' => array(
      'openid.css' => array(
        'base' => 'openid.base.css',
        'theme' => 'openid.theme.css',
      ),
      'openid-rtl.css' => array(
        'base' => 'openid.base-rtl.css',
        'theme' => 'openid.theme-rtl.css',
      ),
    ),
    'poll' => array(
      'poll.css' => array(
        'admin' => 'poll.admin.css',
        'theme' => 'poll.theme.css',
      ),
      'poll-rtl.css' => array(
        'theme' => 'poll.theme-rtl.css',
      ),
    ),
    'search' => array(
      'search.css' => array(
        'theme' => 'search.theme.css',
      ),
      'search-rtl.css' => array(
        'theme' => 'search.theme-rtl.css',
      ),
    ),
    'system' => array(
      'system.base.css' => array(
        'base' => 'system.base.css',
      ),
      'system.base-rtl.css' => array(
        'base' => 'system.base-rtl.css',
      ),
      'system.theme.css' => array(
        'theme' => 'system.theme.css',
      ),
      'system.theme-rtl.css' => array(
        'theme' => 'system.theme-rtl.css',
      ),
      'system.admin.css' => array(
        'admin' => 'system.admin.css',
      ),
      'system.admin-rtl.css' => array(
        'admin' => 'system.admin-rtl.css',
      ),
      'system.menus.css' => array(
        'theme' => 'system.menus.theme.css',
      ),
      'system.menus-rtl.css' => array(
        'theme' => 'system.menus.theme-rtl.css',
      ),
      'system.messages.css' => array(
        'theme' => 'system.messages.theme.css',
      ),
      'system.messages-rtl.css' => array(
        'theme' => 'system.messages.theme-rtl.css',
      ),
    ),
    'taxonomy' => array(
      'taxonomy.css' => array(
        'admin' => 'taxonomy.admin.css',
      ),
    ),
    'user' => array(
      'user.css' => array(
        'base' => 'user.base.css',
        'admin' => 'user.admin.css',
        'theme' => 'user.theme.css',
      ),
      'user-rtl.css' => array(
        'admin' => 'user.admin-rtl.css',
        'theme' => 'user.theme-rtl.css',
      ),
    ),
  );
}


