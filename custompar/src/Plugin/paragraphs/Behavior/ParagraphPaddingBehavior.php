<?php


namespace Drupal\custompar\Plugin\paragraphs\Behavior;


use Drupal\Core\Entity\Display\EntityViewDisplayInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\paragraphs\Entity\ParagraphsType;
use Drupal\paragraphs\ParagraphInterface;
use Drupal\paragraphs\ParagraphsBehaviorBase;

/**
 * @package Drupal\custompar\Plugin\paragraphs\Behavior
 * @ParagraphsBehavior(
 *   id = "custompar_paragraph_padding",
 *   label = @Translation("Paragraph padding element"),
 *   description = @Translation("Allows to select padding for paragraphs."),
 *   weight = 10,
 * )
 */

class ParagraphPaddingBehavior extends ParagraphsBehaviorBase
{

    /**
     * {@inheritdoc}
     */
    public static function isApplicable(ParagraphsType $paragraphs_type) {
        return TRUE;
    }

    public function buildBehaviorForm(ParagraphInterface $paragraph, array &$form, FormStateInterface $form_state) {
        $form['padding_container'] = [
            '#type' => 'container',
            '#attributes' => array(
                'class' => array(
                    'container-inline',
                ),
            ),
        ];
        $form['padding_container']['padding_top_element'] = [
            '#type' => 'select',
            '#title' => $this->t('Pdding top'),
            '#options' => $this->getPaddingTopOptions(),
            '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'padding_container', 'none'),
        ];
        $form['padding_container']['padding_bottom_element'] = [
            '#type' => 'select',
            '#title' => $this->t('Pdding bottom'),
            '#options' => $this->getPaddingBottomOptions(),
            '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'padding_container', 'none'),
        ];
        $form['padding_container']['padding_left_element'] = [
            '#type' => 'select',
            '#title' => $this->t('Pdding left'),
            '#options' => $this->getPaddingLeftOptions(),
            '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'padding_container', 'none'),
        ];
        $form['padding_container']['padding_right_element'] = [
            '#type' => 'select',
            '#title' => $this->t('Pdding right'),
            '#options' => $this->getPaddingRightOptions(),
            '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'padding_container', 'none'),
         ];

        $form['margin_container'] = [
            '#type' => 'container',
            '#attributes' => array(
                'class' => array(
                    'container-inline',
                ),
            ),
        ];
        $form['margin_container']['margin_top_element'] = [
            '#type' => 'select',
            '#title' => $this->t('Margin top'),
            '#options' => $this->getMarginTopOptions(),
            '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'margin_container', 'none'),
        ];
        $form['margin_container']['margin_bottom_element'] = [
            '#type' => 'select',
            '#title' => $this->t('Margin bottom'),
            '#options' => $this->getMarginBottomOptions(),
            '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'margin_container', 'none'),
        ];
        $form['margin_container']['margin_left_element'] = [
            '#type' => 'select',
            '#title' => $this->t('Margin left'),
            '#options' => $this->getMarginLeftOptions(),
            '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'margin_container', 'none'),
        ];
        $form['margin_container']['margin_right_element'] = [
            '#type' => 'select',
            '#title' => $this->t('Margin right'),
            '#options' => $this->getMarginRightOptions(),
            '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'margin_container', 'none'),
        ];

        return $form;
    }

    public function view(array &$build, Paragraph $paragraph, EntityViewDisplayInterface $display, $view_mode)
    {
        $padding_top = $paragraph->getBehaviorSetting($this->getPluginId(), 'padding_container')['padding_top_element'];
        $padding_bottom = $paragraph->getBehaviorSetting($this->getPluginId(), 'padding_container')['padding_bottom_element'];
        $padding_left = $paragraph->getBehaviorSetting($this->getPluginId(), 'padding_container')['padding_left_element'];
        $padding_right = $paragraph->getBehaviorSetting($this->getPluginId(), 'padding_container')['padding_right_element'];

        if($padding_top != 'none') $build['#attributes']['class'][] = str_replace('_', '-', $padding_top);
        if($padding_bottom != 'none') $build['#attributes']['class'][] = str_replace('_', '-', $padding_bottom);
        if($padding_left != 'none') $build['#attributes']['class'][] = str_replace('_', '-', $padding_left);
        if($padding_right != 'none') $build['#attributes']['class'][] = str_replace('_', '-', $padding_right);

        $margin_top = $paragraph->getBehaviorSetting($this->getPluginId(), 'margin_container', 'none')['margin_top_element'];
        $margin_bottom = $paragraph->getBehaviorSetting($this->getPluginId(), 'margin_container', 'none')['margin_bottom_element'];
        $margin_left = $paragraph->getBehaviorSetting($this->getPluginId(), 'margin_container', 'none')['margin_left_element'];
        $margin_right = $paragraph->getBehaviorSetting($this->getPluginId(), 'margin_container', 'none')['margin_right_element'];

        if($margin_top != 'none') $build['#attributes']['class'][] = str_replace('_', '-', $margin_top);
        if($margin_bottom != 'none') $build['#attributes']['class'][] = str_replace('_', '-', $margin_bottom);
        if($margin_left != 'none') $build['#attributes']['class'][] = str_replace('_', '-', $margin_left);
        if($margin_right != 'none') $build['#attributes']['class'][] = str_replace('_', '-', $margin_right);

    }

    private function getPaddingTopOptions() {
        return [
            'none' => 'none',
            'pt_1' => 'pt-1',
            'pt_2' => 'pt-2',
            'pt_3' => 'pt-3',
            'pt_4' => 'pt-4',
            'pt_5' => 'pt-5',
        ];
    }
    private function getPaddingBottomOptions() {
        return [
            'none' => 'none',
            'pb_1' => 'pb-1',
            'pb_2' => 'pb-2',
            'pb_3' => 'pb-3',
            'pb_4' => 'pb-4',
            'pb_5' => 'pb-5',
        ];

    }
    private function getPaddingLeftOptions() {
        return [
            'none' => 'none',
            'pl_1' => 'pl-1',
            'pl_2' => 'pl-2',
            'pl_3' => 'pl-3',
            'pl_4' => 'pl-4',
            'pl_5' => 'pl-5',
        ];

    }
    private function getPaddingRightOptions() {
        return [
            'none' => 'none',
            'pr_1' => 'pr-1',
            'pr_2' => 'pr-2',
            'pr_3' => 'pr-3',
            'pr_4' => 'pr-4',
            'pr_5' => 'pr-5',
        ];

    }


    private function getMarginTopOptions() {
        return [
            'none' => 'none',
            'mt_1' => 'mt-1',
            'mt_2' => 'mt-2',
            'mt_3' => 'mt-3',
            'mt_4' => 'mt-4',
            'mt_5' => 'mt-5',
        ];
    }
    private function getMarginBottomOptions() {
        return [
            'none' => 'none',
            'mb_1' => 'mb-1',
            'mb_2' => 'mb-2',
            'mb_3' => 'mb-3',
            'mb_4' => 'mb-4',
            'mb_5' => 'mb-5',
        ];

    }
    private function getMarginLeftOptions() {
        return [
            'none' => 'none',
            'ml_1' => 'ml-1',
            'ml_2' => 'ml-2',
            'ml_3' => 'ml-3',
            'ml_4' => 'ml-4',
            'ml_5' => 'ml-5',
        ];

    }
    private function getMarginRightOptions() {
        return [
            'none' => 'none',
            'mr_1' => 'mr-1',
            'mr_2' => 'mr-2',
            'mr_3' => 'mr-3',
            'mr_4' => 'mr-4',
            'mr_5' => 'mr-5',
        ];

    }
}