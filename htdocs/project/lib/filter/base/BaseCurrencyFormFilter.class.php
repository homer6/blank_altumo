<?php

/**
 * Currency filter form base class.
 *
 * @package    blank
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseCurrencyFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'iso_code'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'iso_number' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'       => new sfValidatorPass(array('required' => false)),
      'iso_code'   => new sfValidatorPass(array('required' => false)),
      'iso_number' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('currency_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Currency';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'name'       => 'Text',
      'iso_code'   => 'Text',
      'iso_number' => 'Text',
    );
  }
}
