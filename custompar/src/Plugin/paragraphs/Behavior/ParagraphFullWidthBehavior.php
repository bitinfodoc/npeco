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
 * @ParagraphsBehavior(
 *   id = "custompar_fullwidth",
 *   label = @Translation("Paragraph Full width settings"),
 *   description = @Translation("Allows to select image size and position."),
 *   weight = 0,
 * )
 */



class ParagraphFullWidthBehavior extends ParagraphsBehaviorBase {

    /**
     * {@inheritdoc}
     */
    public static function isApplicable(ParagraphsType $paragraphs_type) {
        if ($paragraphs_type->id() == 'fullwidth') {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * {@inheritdoc}
     */
    public function view(array &$build, Paragraph $paragraph, EntityViewDisplayInterface $display, $view_mode) {

        $text_color = $paragraph->getBehaviorSetting($this->getPluginId(), 'text_color', 'white');

        $build['#attributes']['class'][] = 'text-color-' . str_replace('_', '-', $text_color);
        $build['field_subtitle']['#attributes']['class'][] = 'pb-4';

    }

    /**
     * {@inheritdoc}
     */
    public function buildBehaviorForm(ParagraphInterface $paragraph, array &$form, FormStateInterface $form_state) {

        $form['text_color'] = [
            '#type' => 'select',
            '#title' => $this->t('Text color'),
            '#options' => $this->getTextColorOptions(),
            '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'Text color', 'white'),
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function settingsSummary(Paragraph $paragraph) {

        $text_color = $paragraph->getBehaviorSetting($this->getPluginId(), 'text_color', '');
        $text_color_options = $this->getTextColorOptions();

        $summary[] = $this->t('Text color: @value', ['@value' => $text_color_options[$text_color]]);
        return $summary;
    }


    /**
     * Return options for image position.
     */
    private function getTextColorOptions() {
        return [
            'white' => $this->t('White'),
            'black' => $this->t('Black'),
        ];
    }

}