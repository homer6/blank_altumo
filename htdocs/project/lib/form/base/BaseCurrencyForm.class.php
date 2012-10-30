<?php

/**
 * Currency form base class.
 *
 * @method Currency getObject() Returns the current form's model object
 *
 * @package    blank
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseCurrencyForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormInputText(),
      'iso_code'   => new sfWidgetFormInputText(),
      'iso_number' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 64)),
      'iso_code'   => new sfValidatorString(array('max_length' => 3)),
      'iso_number' => new sfValidatorString(array('max_length' => 3)),
    ));

    $this->widgetSchema->setNameFormat('currency[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Currency';
  }


}
