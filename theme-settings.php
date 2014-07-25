<?php
/**
 * Implements hook_form_system_theme_settings_alter().
 *
 * @param $form
 *   Nested array of form elements that comprise the form.
 * @param $form_state
 *   A keyed array containing the current state of the form.
 */
function zen_subtheme_form_system_theme_settings_alter(&$form, &$form_state, $form_id = NULL)  {
  // Work-around for a core bug affecting admin themes. See issue #943212.
  if (isset($form_id)) {
    return;
  }

  // Create the form using Forms API: http://api.drupal.org/api/7

  /* -- Delete this line if you want to use this setting
  $form['STARTERKIT_example'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('STARTERKIT sample setting'),
    '#default_value' => theme_get_setting('STARTERKIT_example'),
    '#description'   => t("This option doesn't do anything; it's just an example."),
  );
  // */

  // Remove some of the base theme's settings.
  /* -- Delete this line if you want to turn off this setting.
  unset($form['themedev']['zen_wireframes']); // We don't need to toggle wireframes on this site.
  // */

 // We are editing the $form in place, so we don't need to return anything.

  $form['zen_subtheme_responsive_settings'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Responsive app settings'),
  );

 $form['zen_subtheme_settings'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Additionally custom theme settings'),
  );

  $form['zen_subtheme_settings']['zen_subtheme_ms_tile_color'] = array(
    '#type'          => 'textfield',
    '#field_prefix'  => '#',
    '#title' => t('Meta tag color used for Windows background tile'),
    '#default_value' => theme_get_setting('zen_subtheme_ms_tile_color'),
    '#size'          => 6,
    '#maxlength'     => 6,
  );

  $form['zen_subtheme_settings']['zen_subtheme_to_top'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Add scroll to top button.'),
    '#description'   => t('Includes jQuery Smooth Scroll.'),
    '#default_value' => theme_get_setting('zen_subtheme_to_top'),
  );

  $form['zen_subtheme_responsive_settings']['zen_subtheme_accordion_menu'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Collapse menu into accordion on small viewports'),
    '#default_value' => theme_get_setting('zen_subtheme_accordion_menu'),
  );

  $form['zen_subtheme_responsive_settings']['zen_subtheme_compass_grid'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Include CSS3 grid via Compass mixin. Toggle with the') . '<code>g</code>' . t(' key.'),
    '#description'   => t('Note: Sub-pixel rounding can lead to several pixels of variation between browsers. Viewable by admin users only. Adjust grid in the grid.scss file.'),
    '#default_value' => theme_get_setting('zen_subtheme_compass_grid'),
  );

  // Custom option for toggling the main content blog on the front page.
  $form['zen_subtheme_settings']['zen_subtheme_toggle_front_page_content'] = array(
    '#type' => 'checkbox',
    '#title' => t('Front page content'),
    '#description' => t('Allow the main content block to be rendered on the front page.'),
    '#default_value' => theme_get_setting('zen_subtheme_toggle_front_page_content'),
  );

  $form['zen_subtheme_settings']['zen_subtheme_browser_width_indicator'] = array(
    '#type' => 'checkbox',
    '#title' => t('Browser width indicator'),
    '#description' => t('Adds a small box at the bottom of the browser window that displays the current width of the browser window. This can be very useful when writing media queries for a responsive website.'),
    '#default_value' => theme_get_setting('zen_subtheme_browser_width_indicator'),
  );
  $form['zen_subtheme_settings']['zen_subtheme_conditional_classes_html'] = array(
    '#type' => 'checkbox',
    '#title' => t('Add conditional classes for Internet Explorer'),
    '#description' => t('Adds conditional classes (for Internet Explorer) to the &lt;html&gt;.'),
    '#default_value' => theme_get_setting('zen_subtheme_conditional_classes_html'),
  );

}
