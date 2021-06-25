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
 *   id = "custompar_paragraph_inner",
 *   label = @Translation("Paragraph inner element"),
 *   description = @Translation("Allows to select HTML wrapper for inner."),
 *   weight = 0,
 * )
 */
class ParagraphInnerBehavior extends ParagraphsBehaviorBase {

    /**
     * {@inheritdoc}
     */
    public static function isApplicable(ParagraphsType $paragraphs_type) {
        if ($paragraphs_type->id() == 'features' or $paragraphs_type->id() == 'columns') {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * {@inheritdoc}
     */
    public function view(array &$build, Paragraph $paragraph, EntityViewDisplayInterface $display, $view_mode)
    {
        if ($paragraph->getType() == 'features' || $paragraph->getType() == 'columns') {

            $inner_width_xs = $paragraph->getBehaviorSetting($this->getPluginId(), 'inner_width_xs', '12');
            $inner_width_sm = $paragraph->getBehaviorSetting($this->getPluginId(), 'inner_width_sm', '6');
            $inner_width_md = $paragraph->getBehaviorSetting($this->getPluginId(), 'inner_width_md', '4');
            $inner_width_lg = $paragraph->getBehaviorSetting($this->getPluginId(), 'inner_width_lg', '4');
            $inner_width_xl = $paragraph->getBehaviorSetting($this->getPluginId(), 'inner_width_xl', '4');


            $build['#attributes']['class'] = array(
                'col-xs-' . str_replace('_', '-', $inner_width_xs),
                'col-sm-' . str_replace('_', '-', $inner_width_sm),
                'col-md-' . str_replace('_', '-', $inner_width_md),
                'col-lg-' . str_replace('_', '-', $inner_width_lg),
                'col-xl-' . str_replace('_', '-', $inner_width_xl),
            );

            $build['field_features_bottom']['#attributes']['class'][] = 'pb-2';
        }
    }
    /**
     * {@inheritdoc}
     */
    public function buildBehaviorForm(ParagraphInterface $paragraph, array &$form, FormStateInterface $form_state) {
//        if ($paragraph->getType() == 'features' or $paragraph->getType() == 'columns') {

            /**
             * {@inheritdoc}
             */

            $form['inner_width_xs'] = [

                '#type' => 'select',
                '#title' => $this->t('xs'),
                '#description' => $this->t('Bootstrap width colls'),
                '#options' => $this->getInnerWidthOptions(),
                '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'inner_width_xs', '12'),
                '#wrapper_attributes' => array(
                    'class' => array(
                        'container-inline',
                    ),
                ),
            ];
            $form['inner_width_sm'] = [
                '#type' => 'select',
                '#title' => $this->t('sm'),
                '#description' => $this->t('Bootstrap width colls'),
                '#options' => $this->getInnerWidthOptions(),
                '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'inner_width_sm', '6'),
                '#wrapper_attributes' => array(
                    'class' => array(
                        'container-inline',
                    ),
                ),
            ];
            $form['inner_width_md'] = [
                '#type' => 'select',
                '#title' => $this->t('md'),
                '#description' => $this->t('Bootstrap width colls'),
                '#options' => $this->getInnerWidthOptions(),
                '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'inner_width_md', '4'),
                '#wrapper_attributes' => array(
                    'class' => array(
                        'container-inline',
                    ),
                ),
            ];
            $form['inner_width_lg'] = [
                '#type' => 'select',
                '#title' => $this->t('lg'),
                '#description' => $this->t('Bootstrap width colls'),
                '#options' => $this->getInnerWidthOptions(),
                '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'inner_width_lg', '4'),
                '#wrapper_attributes' => array(
                    'class' => array(
                        'container-inline',
                    ),
                ),
            ];
            $form['inner_width_xl'] = [
                '#type' => 'select',
                '#title' => $this->t('xl'),
                '#description' => $this->t('Bootstrap width colls'),
                '#options' => $this->getInnerWidthOptions(),
                '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'inner_width_xl', '4'),
                '#wrapper_attributes' => array(
                    'class' => array(
                        'container-inline',
                    ),
                ),
            ];



//        }

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function settingsSummary(Paragraph $paragraph) {
        $inner_width_md = $paragraph->getBehaviorSetting($this->getPluginId(), 'inner_width_md');
        return [$inner_width_md ? $this->t('Col md width: @element', ['@element' => $inner_width_md]) : '4'];
    }
    /**
     * Return options for heading elements.
     */
    private function getInnerWidthOptions() {
        return [
            'ROOT' => $this->t('root CSS'),
            '1' => $this->t('col-1'),
            '2' => $this->t('col-2'),
            '3' => $this->t('col-3'),
            '4' => $this->t('col-4'),
            '5' => $this->t('col-5'),
            '6' => $this->t('col-6'),
            '7' => $this->t('col-7'),
            '8' => $this->t('col-8'),
            '9' => $this->t('col-9'),
            '10' => $this->t('col-10'),
            '11' => $this->t('col-11'),
            '12' => $this->t('col-12'),
        ];
    }


}