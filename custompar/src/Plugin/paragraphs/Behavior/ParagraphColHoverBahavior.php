<?php


namespace Drupal\custompar\Plugin\paragraphs\Behavior;


use Drupal\Core\Annotation\Translation;
use Drupal\Core\Entity\Display\EntityViewDisplayInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\paragraphs\Annotation\ParagraphsBehavior;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\paragraphs\Entity\ParagraphsType;
use Drupal\paragraphs\ParagraphInterface;
use Drupal\paragraphs\ParagraphsBehaviorBase;

/**
 * Class ParagraphColHoverBahavior
 * @package Drupal\custompar\Plugin\paragraphs\Behavior
 * @ParagraphsBehavior(
 *     id = "custompar_paragraph_hover",
 *     label= @Translation("Paragraph hover effect"),
 *     description=@Translation("Allows hover effect to features or columns paragraph"),
 *     weight=50,
 * )
 */
class ParagraphColHoverBahavior extends ParagraphsBehaviorBase
{
    public function buildBehaviorForm(ParagraphInterface $paragraph, array &$form, FormStateInterface $form_state)
    {
        dsm($this->getPluginId());
        $form['hover_effect'] = [

            '#type' => 'select',
            '#title' => $this->t('Hover effect'),
            '#description' => $this->t('Animate hover effect'),
            '#options' => $this->getHoverOptions(),
            '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'hover_effect', ''),
        ];
        return $form;
    }

    /**
     * @inheritDoc
     */
    public function view(array &$build, Paragraph $paragraph, EntityViewDisplayInterface $display, $view_mode)
    {
//        $hover_effect = $paragraph->getBehaviorSetting($this->getPluginId(), 'hover_effect', '');
//        $build['#attributes']['class'][] = $hover_effect;
    }

    public static function isApplicable(ParagraphsType $paragraphs_type)
    {
        if($paragraphs_type->id()=='features' || $paragraphs_type->id()=='columns') {
            return TRUE;
        }
        return false;
    }

    private function getHoverOptions(){
        return [
            '' => $this->t('none'),
            'flip' => $this->t('flip'),
            'flipInX' => $this->t('flipInX'),
            'flipInY' => $this->t('flipInY'),
            'flipOutX' => $this->t('flipOutX'),
            'flipOutY' => $this->t('flipOutY'),
            'heartBeat' => $this->t('heartBeat'),
        ];
    }
}