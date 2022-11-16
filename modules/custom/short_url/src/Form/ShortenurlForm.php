<?php
/**
 * @file
 * Contains \Drupal\short_url\Form\ShortenurlForm.
 */
namespace Drupal\short_url\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Database\Database;

class ShortenurlForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'shortenurl_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['long_url'] = array(
      '#type' => 'url',
      '#title' => t('Long URL:'),
      '#url' => Url::fromRoute('entity.node.canonical', ['node' => 1]),
      '#required' => TRUE,
    );

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $charset = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $base_url = "https:/shrt/";
    $charset_shuffle = str_shuffle($charset);
    $shorter = substr($charset_shuffle, 0, 6);
    $short = $base_url.$shorter;
    $conn = Database::getConnection();
    $conn->insert('urlshorten')->fields(
      array(
        'long_url' => $form_state->getValue('long_url'),
        'short_url' => $short,
      )
    )->execute();
    $form_state -> setRedirect('shorturl.info_page', ['short_url' => $short]);

   }
}