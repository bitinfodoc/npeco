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
 *   id = "custompar_paragraph_align",
 *   label = @Translation("Paragraph align all element"),
 *   description = @Translation("Allows to select CSS wrapper for align all."),
 *   weight = 0,
 * )
 */
class ParagraphAlignBehavior extends ParagraphsBehaviorBase {

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

        $align_all = $paragraph->getBehaviorSetting($this->getPluginId(), 'align_all', 'NONE');
        if($align_all != 'NONE')
        $build['#attributes']['class'][] = str_replace('_', '-', $align_all);
    }

    /**
     * {@inheritdoc}
     */
    public function buildBehaviorForm(ParagraphInterface $paragraph, array &$form, FormStateInterface $form_state) {

        if ($paragraph->getType() != 'features' or $paragraph->getType() != 'columns') {
            $form['align_all'] = [
                '#type' => 'select',
                '#title' => $this->t('Paragraph align class'),
                '#description' => $this->t('Bootstrap align element'),
                '#options' => $this->getInnerAlignOptions(),
                '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'align_all', 'NONE'),
            ];
        }


        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function settingsSummary(Paragraph $paragraph) {

        $align_all = $paragraph->getBehaviorSetting($this->getPluginId(), 'align_all', 'NONE');
        $getInnerAlignOptions = $this->getInnerAlignOptions();

        $summary[] = $this->t('Paragraph align: @align_all', ['@value' => $getInnerAlignOptions[$align_all]]);
        return $summary;
    }
    /**
     * Return options for heading elements.
     */
    private function getInnerAlignOptions() {
        return [
            'NONE' => $this->t('None'),
            'text_left' => $this->t('Left'),
            'text_center' => $this->t('Center'),
            'text_right' => $this->t('Right'),

        ];
    }

}