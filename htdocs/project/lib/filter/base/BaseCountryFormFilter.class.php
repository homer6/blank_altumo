<?php

/**
 * Country filter form base class.
 *
 * @package    blank
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseCountryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'iso_code'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'iso_short_code'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'demonym'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'default_currency_id' => new sfWidgetFormPropelChoice(array('model' => 'Currency', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'                => new sfValidatorPass(array('required' => false)),
      'iso_code'            => new sfValidatorPass(array('required' => false)),
      'iso_short_code'      => new sfValidatorPass(array('required' => false)),
      'demonym'             => new sfValidatorPass(array('required' => false)),
      'default_currency_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Currency', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('country_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Country';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'name'                => 'Text',
      'iso_code'            => 'Text',
      'iso_short_code'      => 'Text',
      'demonym'             => 'Text',
      'default_currency_id' => 'ForeignKey',
    );
  }
}
