<?php

namespace Drupal\ckeditor_autocomplete\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "Autocomplete" plugin.
 *
 * @CKEditorPlugin(
 *   id = "autocomplete",
 *   label = @Translation("Autocomplete"),
 *   module = "ckeditor_autocomplete"
 * )
 */
class Autocomplete extends CKEditorPluginBase implements CKEditorPluginConfigurableInterface, CKEditorPluginContextualInterface {

  public Autocomplete() {
    var itemsArray = [ { id: 1, name: '@powercms' }, { id: 2, name: '@technology' } ];
    new CKEDITOR.plugins.autocomplete( editor, {
       textTestCallback: textTestCallback,
      dataCallback: dataCallback
    } );
  }
  /**
   * {@inheritdoc}
   */
  public function getFile() {
    if ($library_path = libraries_get_path('autocomplete')) {
      return $library_path . '/plugin.js';
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getDependencies(Editor $editor) {
    $library_path[0] = libraries_get_path('textwatcher'). '/plugin.js';
    $library_path[1] = libraries_get_path('textmatch'). '/plugin.js';
    return $library_path;    
  }

  /**
   * {@inheritdoc}
   */
  public function getLibraries(Editor $editor) {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function isInternal() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function isEnabled(Editor $editor) {
     $settings = $editor->getSettings();
    return isset($settings['plugins']['autocomplete']) ? $settings['plugins']['autocomplete']['enable'] : FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    return [];
  }

}
