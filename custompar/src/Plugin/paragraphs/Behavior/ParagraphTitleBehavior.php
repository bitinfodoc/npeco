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
 *   id = "custompar_paragraph_title",
 *   label = @Translation("Paragraph title element"),
 *   description = @Translation("Allows to select HTML wrapper for title."),
 *   weight = 0,
 * )
 */
class ParagraphTitleBehavior extends ParagraphsBehaviorBase {

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
    }

    /**
     * {@inheritdoc}
     */
    public function buildBehaviorForm(ParagraphInterface $paragraph, array &$form, FormStateInterface $form_state)
    {
        if ($paragraph->hasField('field_title') and $paragraph->getType() != 'features') {

            $form['title_element'] = [
                '#type' => 'select',
                '#title' => $this->t('Title element'),
                '#description' => $this->t('Wrapper HTML element'),
                '#options' => $this->getTitleOptions(),
                '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'title_element', 'h2'),
            ];

            $form['title_element_align'] = [
                '#type' => 'select',
                '#title' => $this->t('Title element align'),
                '#description' => $this->t('CSS element align'),
                '#options' => $this->getTitleAlignOptions(),
                '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'title_element_align', 'text-center'),
            ];

            $form['title_element_wow'] = [
                '#type' => 'select',
                '#title' => $this->t('Title element WOW effect'),
                '#description' => $this->t('Title element WOW effect'),
                '#options' => $this->getTitleWowOptions(),
                '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'title_element_wow', 'fadeIn'),
            ];

        } elseif ($paragraph->getType() == 'features') {

            $form['title_element'] = [
                '#type' => 'select',
                '#title' => $this->t('Title element'),
                '#description' => $this->t('Wrapper HTML element'),
                '#options' => $this->getTitleOptions(),
                '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'title_element', 'h4'),
            ];
        }
        return $form;
    }


    /**
     * {@inheritdoc}
     */



    /**
     * {@inheritdoc}
     */
    public function settingsSummary(Paragraph $paragraph) {

        $title_element = $paragraph->getBehaviorSetting($this->getPluginId(), 'title_element');
        return [$title_element ? $this->t('Title element: @element', ['@element' => $title_element]) : ''];

        $title_element_align = $paragraph->getBehaviorSetting($this->getPluginId(), 'title_element_align');
        return [$title_element_align ? $this->t('Title element align: @element', ['@element' => $title_element_align]) : ''];
    }
    /**
     * Return options for heading elements.
     */
    private function getTitleOptions() {
        return [
            'h2' => '<h2>',
            'h3' => '<h3>',
            'h4' => '<h4>',
            'h5' => '<h5>',
        ];
    }
    private function getTitleAlignOptions() {
        return [
            'text-center' => 'Centred element',
            'text-left' => 'Left align',
            'text-right' => 'Right align',
        ];
    }
    private function getTitleWowOptions() {
        return [
            'fadeIn' => 'Fade In',
            'zoomIn' => 'Zoom In',
            'zoomOut' => 'Zoom Out',
        ];
    }
}