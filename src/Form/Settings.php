<?php

namespace Drupal\node_kassa\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements the form controller.
 */
class Settings extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'node_kassa';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['node_kassa.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('node_kassa.settings');

    $form['general'] = [
      '#type' => 'details',
      '#title' => $this->t('General settings'),
      '#open' => TRUE,
    ];
    $form["general"]['indexation'] = array(
      '#title' => $this->t('Индексация запрещена'),
      '#description' => $this->t('Не забываем снимать при старте сайта!'),
      '#type' => 'checkbox',
      '#maxlength' => 20,
      '#required' => FALSE,
      '#size' => 15,
      '#default_value' => $config->get('indexation'),
    );

    $form['general']['gtm_id'] = [
      '#title' => $this->t('GTM-ID'),
      '#default_value' => $config->get('gtm-id'),
      '#maxlength' => 20,
      '#size' => 15,
      '#type' => 'textfield',
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * Implements a form submit handler.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('node_kassa.settings');
    $config
      ->set('indexation', $form_state->getValue('indexation'))
      ->set('gtm-id', $form_state->getValue('gtm_id'))
      ->save();
  }

}
