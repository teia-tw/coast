<?php
// $Id:

/**
 * Preprocess function to build the isotope grid
 */
function template_preprocess_views_isotope_grid(&$vars) {
  template_preprocess_views_view_list($vars);

  $items = array();
  foreach ($vars['view']->result as $key => $value) {
    $item['value'] = $vars['rows'][$key];
    foreach($vars['options']['data_fields'] as $fieldname){
      if(!empty($fieldname)){
        $item['data'][$fieldname] = views_isotope_helper_get_field_value($value, $fieldname);
      }
    }
    $items[] = $item;
  }

  $output = array(
    '#theme' => 'isotope_grid',
    '#items' => $items,
    '#instance' => $vars['options']['instance_id'],
    '#config' => $vars['options']['config'],
    //@TODO: Remove this call to example CSS once testing is complete.
    '#attached' => array(
      'css' => array(drupal_get_path('module', 'views_isotope_example') . '/views_isotope_example.css')
      ),
  );
  $vars['isotope_grid'] = render($output);
}

/**
 * Preprocess function to build isotope filter blocks
 */
function template_preprocess_views_isotope_filter(&$vars) {
  template_preprocess_views_view_list($vars);

  $items = array();
  foreach ($vars['view']->result as $key => $value) {
    $label = $vars['rows'][$key];
    $fieldname = $vars['options']['data_fields'];
    $filter_value = views_isotope_helper_get_field_value($value, $fieldname);
    $items[$filter_value] = $label;
  }

  $output = array(
    '#theme' => 'isotope_filter',
    '#items' => $items,
    '#instance' => $vars['options']['instance_id'],
    '#filtername' => $vars['options']['filter_group'],
    '#filtertitle' => $vars['options']['filter_group'],
  );

  $vars['isotope_filter'] = render($output);

}

/**
 * Preprocess function for isotope sort blocks
 */
function template_preprocess_views_isotope_sorter(&$vars) {
  template_preprocess_views_view_list($vars);

  $items = array();
  foreach ($vars['options']['data_fields'] as $fieldname) {
    if(!empty($fieldname)){
      //@TODO: Somehow get a label for each item.
      $label = $fieldname;
      $items[$label] = $fieldname;
    }
  }

  $output = array(
    '#theme' => 'isotope_sorter',
    '#sorts' => $items,
    '#instance' => $vars['options']['instance_id'],
    '#original' => $vars['options']['original'],
  );

  $vars['isotope_sorter'] = render($output);
}

function views_isotope_helper_get_field_value($entity, $fieldname){

    //@TODO: this seems very messy - there must be a better way to do it?
    if(isset($entity->{'field_'.$fieldname})){
      $field = $entity->{'field_'.$fieldname}[0]['rendered'];
    } else if (isset($entity->{'taxonomy_term_data_'.$fieldname})) {
      //Term title is not a real field in D7
      $field = $entity->{'taxonomy_term_data_'.$fieldname};
    }

    if(isset($field)){
      $filter_value = render($field);
      return trim(check_plain(strip_tags($filter_value)));
    }

    return '';
}
