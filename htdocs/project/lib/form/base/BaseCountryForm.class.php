<?php

/**
 * Country form base class.
 *
 * @method Country getObject() Returns the current form's model object
 *
 * @package    blank
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseCountryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'name'                => new sfWidgetFormInputText(),
      'iso_code'            => new sfWidgetFormInputText(),
      'iso_short_code'      => new sfWidgetFormInputText(),
      'demonym'             => new sfWidgetFormInputText(),
      'default_currency_id' => new sfWidgetFormPropelChoice(array('model' => 'Currency', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'                => new sfValidatorString(array('max_length' => 64)),
      'iso_code'            => new sfValidatorString(array('max_length' => 12)),
      'iso_short_code'      => new sfValidatorString(array('max_length' => 2)),
      'demonym'             => new sfValidatorString(array('max_length' => 128)),
      'default_currency_id' => new sfValidatorPropelChoice(array('model' => 'Currency', 'column' => 'id', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'Country', 'column' => array('iso_short_code'))),
        new sfValidatorPropelUnique(array('model' => 'Country', 'column' => array('iso_code'))),
      ))
    );

    $this->widgetSchema->setNameFormat('country[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Country';
  }


}
