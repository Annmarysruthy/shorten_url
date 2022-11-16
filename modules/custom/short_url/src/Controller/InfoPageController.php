<?php

namespace Drupal\short_url\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * A controller for displaying info page.
 */
class InfoPageController extends ControllerBase {

  /**
   * Returns a render-able array for an info page.
   */
  public function infoPage() {
    $build = [
    '#markup' => $this->t('Succesfully submited!'),
    ];
    $short_url = \Drupal::request()->query->get('short_url');

    // $form['longurl'] = array(
		// 	'#type' => 'textfield',
		// 	'#title' => t('Long URL'),
		// 	'#value' => $long_url,
		// 	"#disabled" => 'disabled',
    // );
		$form['shorturl'] = array(
			'#type' => 'textfield',
			'#title' => t('Short URL'),
			'#value' => $short_url,
			"#disabled" => 'disabled',
		);
    return $form;
  }

}