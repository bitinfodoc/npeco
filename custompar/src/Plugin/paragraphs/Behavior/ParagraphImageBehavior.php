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
 *   id = "custompar_image",
 *   label = @Translation("Paragraph Image and Text settings"),
 *   description = @Translation("Allows to select image size and position."),
 *   weight = 0,
 * )
 */
class ParagraphImageBehavior extends ParagraphsBehaviorBase {

    /**
     * {@inheritdoc}
     */
    public static function isApplicable(ParagraphsType $paragraphs_type) {
        if ($paragraphs_type->id() == 'image_and_text') {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * {@inheritdoc}
     */
    public function view(array &$build, Paragraph $paragraph, EntityViewDisplayInterface $display, $view_mode) {

        $image_size = $paragraph->getBehaviorSetting($this->getPluginId(), 'image_size', 'col_sm_4');
        $image_position = $paragraph->getBehaviorSetting($this->getPluginId(), 'image_position', 'left');

        $build['field_image']['#attributes']['class'][] = str_replace('_', '-', $image_size);
        $build['field_image']['#attributes']['class'][] = str_replace('_', '-', $image_position);

        if (!empty($build['field_image']['#object']) and $build['field_image']['#formatter'] == 'image') {

            switch ($image_size) {
                case 'w_30':
                    $build['field_image']['#image_style'] = 'w_30';
                    break;

                case 'w_50':
                    $build['field_image']['#image_style'] = 'w_50';
                    break;

                case 'w_100':
                    $build['field_image']['#image_style'] = 'w_100';
                    break;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function buildBehaviorForm(ParagraphInterface $paragraph, array &$form, FormStateInterface $form_state) {

        $form['image_size'] = [
            '#type' => 'select',
            '#title' => $this->t('Image size'),
            '#options' => $this->getImageSizeOptions(),
            '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'image_size', 'w_30'),
        ];

        $form['image_position'] = [
            '#type' => 'select',
            '#title' => $this->t('Image position'),
            '#options' => $this->getImagePositionOptions(),
            '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'image_position', 'float_left'),
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function settingsSummary(Paragraph $paragraph) {

        $image_size = $paragraph->getBehaviorSetting($this->getPluginId(), 'image_size', 'w_30');
        $image_size_options = $this->getImageSizeOptions();

        $image_position = $paragraph->getBehaviorSetting($this->getPluginId(), 'image_position', 'float_left');
        $image_position_options = $this->getImagePositionOptions();

        $summary = [];
        $summary[] = $this->t('Image size: @value', ['@value' => $image_size_options[$image_size]]);
        $summary[] = $this->t('Image posiion: @value', ['@value' => $image_position_options[$image_position]]);
        return $summary;
    }

    /**
     * Return options for image size.
     */
    private function getImageSizeOptions() {
        return [
            'w_30' => $this->t('4'),
            'w_50' => $this->t('6'),
            'w_100' => $this->t('12'),
        ];
    }

    /**
     * Return options for image position.
     */
    private function getImagePositionOptions() {
        return [
            'float_left' => $this->t('Left'),
            'float_right' => $this->t('Right'),
        ];
    }

}