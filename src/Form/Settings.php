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
    $form['general']['seria'] = [
      '#title' => $this->t('Серия'),
      '#default_value' => $config->get('seria'),
      '#maxlength' => 20,
      '#size' => 15,
      '#type' => 'textfield',
    ];
    $form['general']['number'] = [
      '#title' => $this->t('Номер'),
      '#default_value' => $config->get('number'),
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
      ->set('seria', $form_state->getValue('seria'))
      ->set('number', $form_state->getValue('number'))
      ->save();
  }

}
