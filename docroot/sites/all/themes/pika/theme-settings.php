<?php
include_once(drupal_get_path('theme', 'pika') . '/include/typography.php');
function typography()
{
    $googlefont = Gfontsjson();
    reset($googlefont);
    $fonts = array();
    while (list($key, $val) = each($googlefont)) {
        $fonts = array_merge($fonts, array(
            $val['family'] => $val['family']
        ));
    }
    return $fonts;
}
function pika_form_system_theme_settings_alter(&$form, &$form_state)
{
	include_once 'template.php';
    drupal_add_js(drupal_get_path('theme', 'pika') . '/js/theme.js');
    drupal_add_css(drupal_get_path('theme', 'pika') . '/css/theme.css');
    drupal_add_library('system', 'ui');
    drupal_add_library('system', 'farbtastic');
    drupal_add_library('system', 'ui.sortable');
    drupal_add_library('system', 'ui.draggable');
    drupal_add_library('system', 'ui.dialog');
	
	
    $form['theme_settings']['#collapsible'] = TRUE;
    $form['theme_settings']['#collapsed']   = TRUE;
    $form['logo']['#collapsible']           = TRUE;
    $form['logo']['#collapsed']             = TRUE;
    $form['favicon']['#collapsible']        = TRUE;
    $form['favicon']['#collapsed']          = TRUE;
    
    $form_state['build_info']['files'][]                          = drupal_get_path('theme', 'pika') . '/theme-settings.php';
    $form['#validate'][]                                          = 'pika_settings_validate';
    $form['#submit'][]                                            = 'pika_settings_submit';
    $settings['slider']                                           = theme_get_setting('slider', 'pika');
    $form['theme_settings']['#collapsible']                       = TRUE;
    $form['theme_settings']['#collapsed']                         = TRUE;
    $form['logo']['#collapsible']                                 = TRUE;
    $form['logo']['#collapsed']                                   = TRUE;
    $form['favicon']['#collapsible']                              = TRUE;
    $form['favicon']['#collapsed']                                = TRUE;
    $form['InspiroSettings']                                           = array(
        '#type' => 'vertical_tabs',
        '#title' => t('Theme settings'),
        '#weight' => 0,
        '#collapsible' => TRUE,
        '#collapsed' => FALSE
    );
    /*--------------- General Settings --------------*/
    $form['InspiroSettings']['general-settings']                       = array(
        '#type' => 'fieldset',
        '#title' => t('General'),
        '#weight' => -11
    );
    // Breadcrumb elements
    $form['InspiroSettings']['general-settings']['slider-show']        = array(
        '#type' => 'select',
        '#title' => t('Select default slider'),
        '#description' => t('Select front page slider'),
        '#options' => array(
            "rev" => t('Revolution Slider'),
            "pan" => t('Panel Slider'),
            "ref" => t('Refine Slider'),
			"none" => t('None'),
        ),
        '#default_value' => theme_get_setting('slider-show', 'pika')
    );
    $form['InspiroSettings']['general-settings']['breadcrumb_title']   = array(
        '#type' => 'select',
        '#title' => t('Breadcrumb title'),
        '#description' => t('Do you want to show the title of the page in the breadcrumb?'),
        '#options' => array(
            0 => t('No'),
            1 => t('Yes')
        ),
        '#default_value' => theme_get_setting('breadcrumb_title', 'pika')
    );
    //Choose sidebar positions 
    $form['InspiroSettings']['general-settings']['sidebar_mode']       = array(
        '#prefix' => "<div id='sidebar_mode'>",
        '#attributes' => array(
            "style" => "display: none;"
        ),
        '#type' => 'radios',
        '#title' => t('Choose sidebar positions'),
        '#options' => array(
            'left' => "<img width='60' height='62' id='selected-sidebar-left' class='' src=" . base_path(). drupal_get_path('theme', 'pika') . "/images/config/sidebar-left.png" . " />",
            'fullWidth' => "<img width='60' height='62' id='selected-full-width' class='' src=" . base_path().drupal_get_path('theme', 'pika') . "/images/config/full-width.png" . " />",
            'right' => "<img width='60' height='62' id='selected-sidebar-right' class='' src=" . base_path(). drupal_get_path('theme', 'pika') . "/images/config/sidebar-right.png" . " />"
        ),
        '#default_value' => theme_get_setting('sidebar_mode', 'pika'),
        '#suffix' => "</div>"
    );
    /*--------------- Portfolio & Gallery --------------*/
    $form['InspiroSettings']['contact-page']                           = array(
        '#type' => 'fieldset',
        '#title' => t('Contact page'),
        '#weight' => 7
    );
    $form['InspiroSettings']['contact-page']['contact-text']           = array(
        '#type' => 'textarea',
        '#title' => t('Get in touch'),
        '#default_value' => theme_get_setting('contact-text', 'pika')
    );
    $form['InspiroSettings']['contact-page']['contact-map']            = array(
        '#type' => 'textfield',
        '#title' => t('Address'),
        '#description' => t('This address also will be used to create google map on website contact page!'),
        '#default_value' => theme_get_setting('contact-map', 'pika')
    );
    $form['InspiroSettings']['contact-page']['map']                    = array(
        '#title' => t('Contact Map'),
        '#prefix' => $contact_map
    );
    $form['InspiroSettings']['contact-page']['contact-map-status']     = array(
        '#type' => 'checkbox',
        '#title' => t('Show map on contact page'),
        '#default_value' => theme_get_setting('contact-map-status', 'pika')
    );
    $form['InspiroSettings']['contact-page']['contact-phone']          = array(
        '#type' => 'textfield',
        '#title' => t('Phone'),
        '#default_value' => theme_get_setting('contact-phone', 'pika')
    );
    $form['InspiroSettings']['contact-page']['contact-phone-status']   = array(
        '#type' => 'checkbox',
        '#title' => t('Show this phone number on front page'),
        '#default_value' => theme_get_setting('contact-phone-status', 'pika')
    );
    $form['InspiroSettings']['contact-page']['contact-email']          = array(
        '#type' => 'textfield',
        '#title' => t('Email'),
        '#default_value' => theme_get_setting('contact-email', 'pika')
    );
    $form['InspiroSettings']['contact-page']['contact-email-status']   = array(
        '#type' => 'checkbox',
        '#title' => t('Show this email on front page'),
        '#default_value' => theme_get_setting('contact-email-status', 'pika')
    );
    /*--------------- Portfolio & Gallery --------------*/
    $form['InspiroSettings']['portfolio-gallery']                      = array(
        '#type' => 'fieldset',
        '#title' => t('Portfolio & Gallery '),
        '#weight' => 1
    );
    $form['InspiroSettings']['portfolio-gallery']['portfolio-columns'] = array(
        '#type' => 'select',
        '#title' => t('Portfolio display'),
        '#description' => t('Select how many columns would you like to be displayed on portfolio page!'),
        '#options' => array(
            2 => t('Two columns'),
            3 => t('Three columns'),
            4 => t('Four columns'),
            5 => t('Five columns')
        ),
        '#default_value' => theme_get_setting('portfolio-columns', 'pika')
    );
    $form['InspiroSettings']['portfolio-gallery']['gallery-columns']   = array(
        '#type' => 'select',
        '#title' => t('Gallery display'),
        '#description' => t('Select how many columns would you like to be displayed on gallery page!'),
        '#options' => array(
            2 => t('Two columns'),
            3 => t('Three columns'),
            4 => t('Four columns'),
            5 => t('Five columns')
        ),
        '#default_value' => theme_get_setting('gallery-columns', 'pika')
    );
    /*--------------- Layout settings: Boxed or Wide --------------*/
    $form['InspiroSettings']['layout']                                 = array(
        '#type' => 'fieldset',
        '#title' => t('Layout'),
        '#weight' => 1
    );
    $form['InspiroSettings']['layout']['layout_mode']                  = array(
        '#attributes' => array(
            "style" => "display: none;"
        ),
        '#type' => 'radios',
        '#title' => t('Choose layout mode'),
        '#options' => array(
            'wide' => "<img width='74' height='55' id='selected-image-wide' class='' src=" .base_path(). drupal_get_path('theme', 'pika') . "/images/config/wide.png" . " />",
            'boxed' => "<img width='74' height='55' id='selected-image-boxed' class='' src=" .base_path(). drupal_get_path('theme', 'pika') . "/images/config/boxed.png" . " />"
        ),
        '#default_value' => theme_get_setting('layout_mode', 'pika')
    );
    //Choose background type
    $form['InspiroSettings']['layout']['layout_background']            = array(
        '#prefix' => "<div id='layout_background_div'>",
        '#attributes' => array(
            "style" => "display: none;"
        ),
        '#type' => 'radios',
        '#title' => t('Choose background type'),
        '#options' => array(
            'layout_color' => "<img width='60' height='50' id='selected-layout-color' class='' src=" .base_path(). drupal_get_path('theme', 'pika') . "/images/config/layout-color.png" . " />",
            'layout_pattern' => "<img width='60' height='50' id='selected-layout-pattern' class='' src=" .base_path(). drupal_get_path('theme', 'pika') . "/images/config/layout-pattern.png" . " />",
            'layout_image' => "<img width='60' height='50' id='selected-layout-image' class='' src=" .base_path(). drupal_get_path('theme', 'pika') . "/images/config/layout-image.png" . " />"
        ),
        '#default_value' => theme_get_setting('layout_background', 'pika')
    );
    /*--------------- Background image --------------*/
    $form['InspiroSettings']['layout']['site_bg_preview']              = array(
        '#prefix' => "<div id='site_bg_preview_div'>",
        '#type' => 'textfield',
        '#title' => t('Webiste background image'),
        '#suffix' => "<img height='200' id='site_bg_preview' src=" . base_path() . theme_get_setting('site_bg_preview', 'pika') . " />",
        '#default_value' => theme_get_setting('site_bg_preview', 'pika'),
        '#attributes' => array(
            "style" => "display: none;"
        )
    );
    $form['InspiroSettings']['layout']['site_bg_image']                = array(
        '#type' => 'file',
        '#title' => t('Upload site background image'),
        '#size' => 40,
        '#attributes' => array(
            'enctype' => 'multipart/form-data',
            'id' => 'site_bg_image_form'
        ),
        '#description' => t('Upload your desired background image'),
        '#element_validate' => array(
            'site_bg_validate'
        )
    );
    $form['InspiroSettings']['layout']['delete_site_bg_image']         = array(
        '#type' => 'checkbox',
        '#title' => t('Delete background image'),
        '#element_validate' => array(
            'site_bg_validate'
        ),
        '#default_value' => FALSE,
        '#suffix' => "</div>"
    );
    $header_line_bg                                               = array(
        'pika_line.png' => 'Default (CMYK colors)',
        'pika_line1.png' => 'Blue',
        'pika_line2.png' => 'Orange',
        'pika_line3.png' => 'Red',
        'pika_line4.png' => 'Green',
        'pika_line5.png' => 'Pink',
        'color' => 'Chose color'
    );
    //Pattern background image
    $form['InspiroSettings']['layout']['layout_background_pattern']    = array(
        '#prefix' => "<div id='layout_background_pattern_div'>",
        '#attributes' => array(
            "style" => "display: none;"
        ),
        '#type' => 'radios',
        '#title' => t('Choose background pattern'),
        '#options' => array(
            'pattern1' => "<img width='100' height='100' id='selected-layout-pattern1' class='' src=" . base_path() . drupal_get_path('theme', 'pika') . "/images/patterns/pattern1.png" . " />",
            'pattern2' => "<img width='100' height='100' id='selected-layout-pattern2' class='' src=" . base_path() . drupal_get_path('theme', 'pika') . "/images/patterns/pattern2.png" . " />",
            'pattern3' => "<img width='100' height='100' id='selected-layout-pattern3' class='' src=" . base_path() .drupal_get_path('theme', 'pika') . "/images/patterns/pattern3.png" . " />",
            'pattern4' => "<img width='100' height='100' id='selected-layout-pattern4' class='' src=" . base_path() .drupal_get_path('theme', 'pika') . "/images/patterns/pattern4.png" . " />",
            'pattern5' => "<img width='100' height='100' id='selected-layout-pattern5' class='' src=" . base_path() .drupal_get_path('theme', 'pika') . "/images/patterns/pattern5.png" . " />",
            'pattern6' => "<img width='100' height='100' id='selected-layout-pattern6' class='' src=" . base_path() .drupal_get_path('theme', 'pika') . "/images/patterns/pattern6.png" . " />",
            'pattern7' => "<img width='100' height='100' id='selected-layout-pattern7' class='' src=" . base_path() .drupal_get_path('theme', 'pika') . "/images/patterns/pattern7.png" . " />",
            'pattern8' => "<img width='100' height='100' id='selected-layout-pattern8' class='' src=" . base_path() .drupal_get_path('theme', 'pika') . "/images/patterns/pattern8.png" . " />",
            'pattern9' => "<img width='100' height='100' id='selected-layout-pattern9' class='' src=" . base_path() .drupal_get_path('theme', 'pika') . "/images/patterns/pattern9.png" . " />",
            'pattern10' => "<img width='100' height='100' id='selected-layout-pattern10' class='' src=" . base_path() .drupal_get_path('theme', 'pika') . "/images/patterns/pattern10.png" . " />",
            'pattern11' => "<img width='100' height='100' id='selected-layout-pattern11' class='' src=" . base_path() .drupal_get_path('theme', 'pika') . "/images/patterns/pattern11.png" . " />",
            'pattern12' => "<img width='100' height='100' id='selected-layout-pattern12' class='' src=" . base_path() .drupal_get_path('theme', 'pika') . "/images/patterns/pattern12.png" . " />",
            'pattern13' => "<img width='100' height='100' id='selected-layout-pattern13' class='' src=" . base_path() .drupal_get_path('theme', 'pika') . "/images/patterns/pattern13.png" . " />",
            'pattern14' => "<img width='100' height='100' id='selected-layout-pattern14' class='' src=" . base_path() .drupal_get_path('theme', 'pika') . "/images/patterns/pattern14.png" . " />",
            'pattern15' => "<img width='100' height='100' id='selected-layout-pattern15' class='' src=" . base_path() .drupal_get_path('theme', 'pika') . "/images/patterns/pattern15.png" . " />",
            'pattern16' => "<img width='100' height='100' id='selected-layout-pattern16' class='' src=" . base_path() .drupal_get_path('theme', 'pika') . "/images/patterns/pattern16.png" . " />",
            'pattern17' => "<img width='100' height='100' id='selected-layout-pattern17' class='' src=" . base_path() .drupal_get_path('theme', 'pika') . "/images/patterns/pattern17.png" . " />"
        ),
        '#default_value' => theme_get_setting('layout_background_pattern', 'pika'),
        '#suffix' => "</div>"
    );
    $form['InspiroSettings']['layout']['layout_background_color']      = array(
        '#prefix' => "<div id='layout_background_color_div'>",
        '#type' => 'textfield',
        '#title' => t('Click and choose background color'),
        '#default_value' => theme_get_setting('layout_background_color', 'pika'),
        '#attributes' => array(
            'class' => array(
                'input color'
            ),
            'style' => 'background-color:' . theme_get_setting('layout_background_color', 'pika') . ';'
        ),
        '#suffix' => "</div>"
    );
    // Google fonts setting	
    $form['InspiroSettings']['style']                                  = array(
        '#type' => 'fieldset',
        '#title' => t('Styling options'),
        '#description' => t('You can customize easly feel and look of website by selecting a new color, or inserting a hex number and the new color value will be implemented on selected area of site.'),
        '#weight' => 3
    );
    /*--------------- Header line --------------*/
    $header_line_bg                                               = array(
        'pika_line.png' => 'Default (CMYK colors)',
        'pika_line1.png' => 'Blue',
        'pika_line2.png' => 'Orange',
        'pika_line3.png' => 'Red',
        'pika_line4.png' => 'Green',
        'pika_line5.png' => 'Pink',
        'color' => 'Chose color'
    );
    $form['InspiroSettings']['style']['header_line_bg']                = array(
        '#type' => 'select',
        '#title' => t('Header line pattern'),
        '#description' => t('Select predefined background color for header top line.'),
        '#options' => $header_line_bg,
        '#default_value' => theme_get_setting('header_line_bg', 'pika')
    );
    $form['InspiroSettings']['style']['header_line_bg_color']          = array(
        '#type' => 'textfield',
        '#title' => t('Click and choose color'),
        '#default_value' => theme_get_setting('header_line_bg_color', 'pika'),
        '#attributes' => array(
            'class' => array(
                'input color'
            ),
            'style' => 'background-color:' . theme_get_setting('header_line_bg_color', 'pika') . ';'
        )
    );
    $form['InspiroSettings']['style']['body_font_color']               = array(
        '#type' => 'textfield',
        '#title' => t('Text color'),
        '#description' => t('Default color: #555555'),
        '#default_value' => theme_get_setting('body_font_color', 'pika'),
        '#attributes' => array(
            'class' => array(
                'input color'
            ),
            'style' => 'background-color:' . theme_get_setting('body_font_color', 'pika') . ';'
        )
    );
    $form['InspiroSettings']['style']['body_font_link_color']          = array(
        '#type' => 'textfield',
        '#title' => t('Link color'),
        '#description' => t('Default color: #326d9b'),
        '#default_value' => theme_get_setting('body_font_link_color', 'pika'),
        '#attributes' => array(
            'class' => array(
                'input color'
            ),
            'style' => 'background-color:' . theme_get_setting('body_font_link_color', 'pika') . ';'
        )
    );
    $form['InspiroSettings']['style']['body_font_link_color_hover']    = array(
        '#type' => 'textfield',
        '#title' => t('On hover link color'),
        '#description' => t('Default color: #3f9be2'),
        '#default_value' => theme_get_setting('body_font_link_color_hover', 'pika'),
        '#attributes' => array(
            'class' => array(
                'input color'
            ),
            'style' => 'background-color:' . theme_get_setting('body_font_link_color_hover', 'pika') . ';'
        )
    );
    $form['InspiroSettings']['style']['heading_font_color']            = array(
        '#type' => 'textfield',
        '#title' => t('Heading color'),
        '#description' => t('Default color: #444444'),
        '#default_value' => theme_get_setting('heading_font_color', 'pika'),
        '#attributes' => array(
            'class' => array(
                'input color'
            ),
            'style' => 'background-color:' . theme_get_setting('heading_font_color', 'pika') . ';'
        )
    );
    $form['InspiroSettings']['style']['style_menu_color']              = array(
        '#type' => 'textfield',
        '#title' => t('Navigation background & font color'),
        '#description' => t('Default color: #326E9B'),
        '#default_value' => theme_get_setting('style_menu_color', 'pika'),
        '#attributes' => array(
            'class' => array(
                'input color'
            ),
            'style' => 'background-color:' . theme_get_setting('style_menu_color', 'pika') . ';'
        )
    );
    $form['InspiroSettings']['style']['style_menu_color_hover']        = array(
        '#type' => 'textfield',
        '#title' => t('Navigation item on Hover color'),
        '#description' => t('Default color: #1AA1DA'),
        '#default_value' => theme_get_setting('style_menu_color_hover', 'pika'),
        '#attributes' => array(
            'class' => array(
                'input color'
            ),
            'style' => 'background-color:' . theme_get_setting('style_menu_color_hover', 'pika') . ';'
        )
    );
    $form['InspiroSettings']['style']['style_menu_font']               = array(
        '#type' => 'textfield',
        '#title' => t('Navigation item font color'),
        '#description' => t('Default color: #ffffff'),
        '#default_value' => theme_get_setting('style_menu_font', 'pika'),
        '#attributes' => array(
            'class' => array(
                'input color'
            ),
            'style' => 'background-color:' . theme_get_setting('style_menu_font', 'pika') . ';'
        )
    );
    $form['InspiroSettings']['style']['style_page_title_color']        = array(
        '#type' => 'textfield',
        '#title' => t('Page title font color'),
        '#description' => t('Default color: #ffffff'),
        '#default_value' => theme_get_setting('style_page_title_color', 'pika'),
        '#attributes' => array(
            'class' => array(
                'input color'
            ),
            'style' => 'background-color:' . theme_get_setting('style_page_title_color', 'pika') . ';'
        )
    );
    $form['InspiroSettings']['style']['style_page_title_bgcolor']      = array(
        '#type' => 'textfield',
        '#title' => t('Page title background color'),
        '#description' => t('Default color: #326E9B'),
        '#default_value' => theme_get_setting('style_page_title_bgcolor', 'pika'),
        '#attributes' => array(
            'class' => array(
                'input color'
            ),
            'style' => 'background-color:' . theme_get_setting('style_page_title_bgcolor', 'pika') . ';'
        )
    );
    $form['InspiroSettings']['style']['style_breadcrumb_font_color']   = array(
        '#type' => 'textfield',
        '#title' => t('Breadcrumb font color'),
        '#description' => t('Default color: #DAF8FE'),
        '#default_value' => theme_get_setting('style_breadcrumb_font_color', 'pika'),
        '#attributes' => array(
            'class' => array(
                'input color'
            ),
            'style' => 'background-color:' . theme_get_setting('style_breadcrumb_font_color', 'pika') . ';'
        )
    );
    $form['InspiroSettings']['style']['style_footer_top_border_color'] = array(
        '#type' => 'textfield',
        '#title' => t('Footer top border color'),
        '#description' => t('Default color: #326E9B'),
        '#default_value' => theme_get_setting('style_footer_top_border_color', 'pika'),
        '#attributes' => array(
            'class' => array(
                'input color'
            ),
            'style' => 'background-color:' . theme_get_setting('style_footer_top_border_color', 'pika') . ';'
        )
    );
    $form['InspiroSettings']['style']['style_footer_bgcolor']          = array(
        '#type' => 'textfield',
        '#title' => t('Footer background color'),
        '#description' => t('Default color: #292C30'),
        '#default_value' => theme_get_setting('style_footer_bgcolor', 'pika'),
        '#attributes' => array(
            'class' => array(
                'input color'
            ),
            'style' => 'background-color:' . theme_get_setting('style_footer_bgcolor', 'pika') . ';'
        )
    );
    $form['InspiroSettings']['style']['style_footer_font_color']       = array(
        '#type' => 'textfield',
        '#title' => t('Footer font color'),
        '#description' => t('Default color: #ffffff'),
        '#default_value' => theme_get_setting('style_footer_font_color', 'pika'),
        '#attributes' => array(
            'class' => array(
                'input color'
            ),
            'style' => 'background-color:' . theme_get_setting('style_footer_font_color', 'pika') . ';'
        )
    );
    // Google fonts setting	
    $form['InspiroSettings']['typography']                             = array(
        '#type' => 'fieldset',
        '#title' => t('Typography options'),
        '#description' => t('These typography options gives you ability, how your website typoography want to be displayed. There are a 570+ google fonts loaded in lists!'),
        '#weight' => 3
    );
    $form['InspiroSettings']['typography']['body_font']                = array(
        '#type' => 'select',
        '#title' => t('Body font family'),
        '#description' => t('Change body font family by selecting google font from list!'),
        '#default_value' => theme_get_setting('body_font', 'pika'),
        '#options' => typography()
    );
    $form['InspiroSettings']['typography']['heading_font']             = array(
        '#type' => 'select',
        '#title' => t('Heading font family'),
        '#description' => t('Change heading font family by selecting google font from list!'),
        '#default_value' => theme_get_setting('heading_font', 'pika'),
        '#options' => typography()
    );
    $form['InspiroSettings']['typography']['menu_font']                = array(
        '#type' => 'select',
        '#title' => t('Main menu font family'),
        '#description' => t('Change menu font family by selecting google font from list!'),
        '#default_value' => theme_get_setting('menu_font', 'pika'),
        '#options' => typography()
    );
    include_once(drupal_get_path('theme', 'pika') . '/js/rs-plugin/RevolutionSlider.slider.inc');
}
/* Settings form Validator */
function pika_settings_validate($form, &$form_state)
{
    $settings['slider'] = theme_get_setting('slider', 'pika');
    $BuildSettingTheme  = $form_state['build_info']['args'][0];
    $validateFile       = array(
        'file_validate_is_image' => array()
    );
    // Validate Layer 
    if (!empty($form_state['values']['slider']['layers'])) {
        foreach ($form_state['values']['slider']['layers'] as $SlideId => &$Slide) {
            if (is_array($Slide)) {
                $UploadedFile = file_save_upload("backgrounds-" . $SlideId, $validateFile);
                //Upload new slide background
                if (isset($UploadedFile)) {
                    if ($UploadedFile) {
                        $Slide['background'] = $UploadedFile;
                        if (isset($Slide['background'])) {
                            @drupal_unlink($Slide['background']);
                        }
                    } else {
                        form_set_error("backgrounds-" . $SlideId, t('The background could not be uploaded.'));
                    }
                }
                // Process Validate Layer 
                if (isset($Slide['sublayers'])) {
                    foreach ($Slide['sublayers'] as $LayerId => &$sublayer) {
                        foreach ($sublayer['properties'] as $key => &$property) {
                            if (empty($property) || $property == '_none') {
                                unset($sublayer['properties'][$key]);
                            }
                            unset($property);
                        }
                        $UploadedFile = file_save_upload("sublayers-" . $SlideId . "-" . $LayerId, $validateFile);
                        if (isset($UploadedFile)) {
                            if ($UploadedFile) {
                                $Slide['sublayers'][$LayerId]['image']['file'] = $UploadedFile;
                                @drupal_unlink($sublayer['image']['path']);
                            } else {
                                form_set_error("sublayers-" . $SlideId . "-" . $LayerId, t('The sublayer could not be uploaded.'));
                            }
                        }
                        unset($sublayer);
                    }
                }
                unset($Slide['delete']);
                unset($Slide['background_upload']);
                unset($Slide['create_sublayer']);
            }
            unset($Slide);
        }
    }
}
/* Submit form Settings form */
function pika_settings_submit($form, &$form_state)
{
	if(!empty($form_state['values']['slider']['layers'])){
    foreach ($form_state['values']['slider']['layers'] as $SlideId => &$Slide) {
        if (isset($Slide['background']) && is_object($Slide['background'])) {
            $UploadedFile        = $Slide['background'];
            $Slide['background'] = file_unmanaged_copy($UploadedFile->uri, 'public://pika/' . $UploadedFile->filename);
        }
        if (isset($Slide['sublayers'])) {
            foreach ($Slide['sublayers'] as $LayerId => &$sublayer) {
                // If the user uploaded a new sublayer image, save it to a permanent location.
                if (isset($sublayer['image']['file']) && is_object($sublayer['image']['file'])) {
                    $UploadedFile              = $sublayer['image']['file'];
                    $sublayer['image']['path'] = file_unmanaged_copy($UploadedFile->uri, 'public://pika/' . $UploadedFile->filename);
                    // Unset unnecessary data
                    unset($form_state['values']['slider']['layers'][$SlideId]['sublayers'][$LayerId]['image']['file']);
                    unset($form_state['values']['slider']['layers'][$SlideId]['sublayers'][$LayerId]['image']['upload']);
                }
            }
        }
    }
    // If the user uploaded a new custom background, save it to a permanent location.
    if (isset($form_state['values']['style']['custom_bg']['file']) && is_object($form_state['values']['style']['custom_bg']['file'])) {
        $UploadedFile                                       = $form_state['values']['style']['custom_bg']['file'];
        $form_state['values']['style']['custom_bg']['path'] = file_unmanaged_copy($UploadedFile->uri, 'public://pika/' . $UploadedFile->filename);
        // Unset unnecessary data
        unset($form_state['values']['style']['custom_bg']['file']);
        unset($form_state['values']['style']['custom_bg']['upload']);
    }
    $BuildSettingTheme = $form_state['build_info']['args'][0];
    $path              = variable_get('theme_' . $BuildSettingTheme . '_files_directory');
    @file_unmanaged_delete_recursive($path);
    // Prepare target location for generated files.
    $id   = $BuildSettingTheme . '-' . substr(hash('sha256', serialize($BuildSettingTheme) . microtime()), 0, 8);
    $path = 'public://pika/' . $id;
    file_prepare_directory($path, FILE_CREATE_DIRECTORY);
    variable_set('theme_' . $BuildSettingTheme . '_files_directory', $path);
	}
}
function pika_slide_iupd($form, &$form_state)
{
    $action        = $form_state['triggering_element']['#name'];
    $exploded_name = explode('-', $form_state['triggering_element']['#name']);
    $action        = isset($exploded_name[1]) ? $exploded_name[0] : $action;
    switch ($action) {
        case 'create':
            $Slide_count                                = isset($form_state['values']['slider']['layers']) ? count($form_state['values']['slider']['layers']) : 0;
            $form_state['values']['slider']['layers'][] = array(
                'sublayers' => array()
            );
            break;
        case 'delete':
            $SlideId = $form_state['clicked_button']['#parents'][2];
            @$Slide = $form_state['values']['slider']['layers'][$SlideId];
            @drupal_unlink($Slide['background']);
            // Delete layer image and itself
            if (isset($Slide['sublayers'])) {
                foreach ($Slide['sublayers'] as $sublayer) {
                    @drupal_unlink($sublayer['image']['path']);
                }
            }
            unset($form_state['values']['slider']['layers'][$SlideId]);
            break;
    }
    end($form_state['values']['slider']['layers']);
    $form_state['lid'] = key($form_state['values']['slider']['layers']);
    variable_set($form_state['values']['var'], $form_state['values']);
}
/* Add Layer to slide */
function pika_sublayer_create($form, &$form_state)
{
    $SlideId        = $form_state['triggering_element']['#parents'][2];
    $type           = $form_state['triggering_element']['#parents'][4];
    $sublayer_count = 0;
    if (isset($form_state['values']['slider']['layers'][$SlideId]['sublayers'])) {
        $sublayer_count = count($form_state['values']['slider']['layers'][$SlideId]['sublayers']);
    }
    if ($type == "text-html") {
        $layerName = "Caption ";
    }
    if ($type == "image") {
        $layerName = "Image ";
    }
    if ($type == "video") {
        $layerName = "Video ";
    }
    $form_state['values']['slider']['layers'][$SlideId]['sublayers'][] = array(
        'title' => t($layerName . '@number', array(
            '@number' => $sublayer_count
        )),
        'x' => 50,
        'y' => 50,
        'weight' => 0,
        'form'
    );
    drupal_set_message("New layer " . $layerName . " is created successfuly!");
    $LayerId                                                                           = count($form_state['values']['slider']['layers'][$SlideId]['sublayers']) - 1;
    $LayerId2                                                                          = count($form_state['values']['slider']['layers'][$SlideId]['sublayers']) + 1;
    $form_state['values']['slider']['layers'][$SlideId]['sublayers'][$LayerId]['type'] = $type;
    variable_set($form_state['values']['var'], $form_state['values']);
}
/* Delete Layer from slide */
function pika_sublayer_delete($form, &$form_state)
{
    $SlideId = $form_state['triggering_element']['#parents'][2];
    $LayerId = $form_state['triggering_element']['#parents'][4];
    @drupal_unlink($form_state['values']['slider']['layers'][$SlideId]['sublayers'][$LayerId]['image']['path']);
    unset($form_state['values']['slider']['layers'][$SlideId]['sublayers'][$LayerId]);
    variable_set($form_state['values']['var'], $form_state['values']);
    drupal_set_message(t('Layer deleted.'));
}
function site_bg_validate($element, &$form_state)
{
    global $base_url;
    $validateFile = array(
        'file_validate_is_image' => array()
    );
    $UploadedFile = file_save_upload('site_bg_image', $validateFile, "public://", FILE_EXISTS_REPLACE);
    if ($form_state['values']['delete_site_bg_image'] == TRUE) {
        // Delete layer file
        file_unmanaged_delete($form_state['values']['site_bg_preview']);
        $form_state['values']['site_bg_preview'] = NULL;
    }
    if ($UploadedFile) {
        // change file's status from temporary to permanent and update file database
        $UploadedFile->status = FILE_STATUS_PERMANENT;
        file_save($UploadedFile);
        $file_url                                = file_create_url($UploadedFile->uri);
        $file_url                                = str_ireplace($base_url, '', $file_url);
        // set to form
        $form_state['values']['site_bg_preview'] = $file_url;
    }
}

/**
 * Implements theme_menu_link().
 */
function pika_menu_link(array $variables) {
  return 'hello';
  $element = $variables['element'];
  if (strpos($element['#title'], '.png') !== false
    || strpos($element['#title'], '.jpg') !== false
    || strpos($element['#title'], '.gif') !== false
  ) {
    $output = l('<img alt="'. $element['#description'] .'" title="'. $element['#description'] .'" src="'. url($element['#title']) .'" />', $element['#href'], $element['#localized_options']);
    return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
  }
}

