<?php

namespace Drupal\custompar\Plugin\paragraphs\Behavior;

use Drupal\Core\Entity\Display\EntityViewDisplayInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\paragraphs\Annotation\ParagraphsBehavior;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\paragraphs\Entity\ParagraphsType;
use Drupal\paragraphs\ParagraphInterface;
use Drupal\paragraphs\ParagraphsBehaviorBase;

/**
 * @package Drupal\custompar\Plugin\paragraphs\Behavior
 * @ParagraphsBehavior(
 *   id = "custompar_paragraph_button",
 *   label = @Translation("Paragraph button element"),
 *   description = @Translation("Allows to select CSS wrapper for button."),
 *   weight = 0,
 * )
 */
class ParagraphButtonBehavior extends ParagraphsBehaviorBase {

    /**
     * {@inheritdoc}
     */
    public static function isApplicable(ParagraphsType $paragraphs_type) {
          return TRUE;
    }

    /**
     * {@inheritdoc}
     */
    public function view(array &$build, Paragraph $paragraph, EntityViewDisplayInterface $display, $view_mode) {
        $inner_button = $paragraph->getBehaviorSetting($this->getPluginId(), 'inner_button', 'btn_sucsess');
        $build['field_button']['#attributes']['class'][] = str_replace('_', '-', $inner_button);

        $inner_button_modal = $paragraph->getBehaviorSetting($this->getPluginId(), 'inner_button_modal', '_self');
        if($inner_button_modal === '_self' or $inner_button_modal === '_blank' ) {
            $build['field_button']['#attributes']['target'][] = $inner_button_modal;
        } elseif( $inner_button_modal === 'open_modal') {
            $build['#attached']['library'][] = 'core/drupal.dialog.ajax';
            $build['field_button']['#attributes']['data-dialog-type'][] = 'modal';
            $build['field_button']['#attributes']['class'][] = 'use-ajax';
        }
    }

    /**
     * {@inheritdoc}
     */
    public function buildBehaviorForm(ParagraphInterface $paragraph, array &$form, FormStateInterface $form_state) {


        if ($paragraph->hasField('field_button')) {
            $form['inner_button'] = [
                '#type' => 'select',
                '#title' => $this->t('Inner button class'),
                '#description' => $this->t('Bootstrap button element'),
                '#options' => $this->getInnerButtonOptions(),
                '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'inner_button', 'btn_success'),
            ];
            $form['inner_button_modal'] = [
                '#type' => 'select',
                '#title' => $this->t('Open in '),
                '#description' => $this->t('Open in modal _self or _blank'),
                '#options' => $this->getInnerButtonModalOptions(),
                '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'inner_button_modal', '_self'),
            ];
        }
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function settingsSummary(Paragraph $paragraph) {

        $inner_button = $paragraph->getBehaviorSetting($this->getPluginId(), 'inner_button');
        return [$inner_button ? $this->t('Title element: @element', ['@element' => $inner_button]) : ''];

    }
    /**
     * Return options for heading elements.
     */

    private function getInnerButtonOptions() {
        return [
            'btn_primary' => $this->t('Primary'),
            'btn_secondary' => $this->t('Secondary'),
            'btn_success' => $this->t('Success'),
            'btn_danger' => $this->t('Danger'),
            'btn_warning' => $this->t('Warning'),
            'btn_info' => $this->t('Info'),
            'btn_light' => $this->t('Light'),
            'btn_dark' => $this->t('Dark'),
            'button' => $this->t('Button'),
        ];
    }

    private function getInnerButtonModalOptions() {
        return [
            'open_modal' => $this->t('Open modal'),
            '_self' => $this->t('Open _self'),
            '_blank' => $this->t('Open _blank'),
        ];
    }
}