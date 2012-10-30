<?php

/**
 * Contact form base class.
 *
 * @method Contact getObject() Returns the current form's model object
 *
 * @package    blank
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseContactForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                        => new sfWidgetFormInputHidden(),
      'first_name'                => new sfWidgetFormInputText(),
      'last_name'                 => new sfWidgetFormInputText(),
      'company_name'              => new sfWidgetFormInputText(),
      'email_address'             => new sfWidgetFormInputText(),
      'phone_main_number'         => new sfWidgetFormInputText(),
      'phone_other_number'        => new sfWidgetFormInputText(),
      'mailing_address'           => new sfWidgetFormInputText(),
      'mailing_address_latitude'  => new sfWidgetFormInputText(),
      'mailing_address_longitude' => new sfWidgetFormInputText(),
      'city'                      => new sfWidgetFormInputText(),
      'state_id'                  => new sfWidgetFormPropelChoice(array('model' => 'State', 'add_empty' => false)),
      'zip_code'                  => new sfWidgetFormInputText(),
      'created_at'                => new sfWidgetFormDateTime(),
      'updated_at'                => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                        => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'first_name'                => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'last_name'                 => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'company_name'              => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'email_address'             => new sfValidatorString(array('max_length' => 150)),
      'phone_main_number'         => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'phone_other_number'        => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'mailing_address'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'mailing_address_latitude'  => new sfValidatorNumber(array('required' => false)),
      'mailing_address_longitude' => new sfValidatorNumber(array('required' => false)),
      'city'                      => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'state_id'                  => new sfValidatorPropelChoice(array('model' => 'State', 'column' => 'id')),
      'zip_code'                  => new sfValidatorString(array('max_length' => 7, 'required' => false)),
      'created_at'                => new sfValidatorDateTime(array('required' => false)),
      'updated_at'                => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contact[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contact';
  }


}
