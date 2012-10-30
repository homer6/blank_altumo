<?php

/**
 * SystemEventSubscription form base class.
 *
 * @method SystemEventSubscription getObject() Returns the current form's model object
 *
 * @package    blank
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseSystemEventSubscriptionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'system_event_id'     => new sfWidgetFormPropelChoice(array('model' => 'SystemEvent', 'add_empty' => false)),
      'user_id'             => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'type'                => new sfWidgetFormChoice(array('choices' => array(''=>'','request'=>'request','email'=>'email',))),
      'remote_url'          => new sfWidgetFormInputText(),
      'subject'             => new sfWidgetFormInputText(),
      'template'            => new sfWidgetFormInputText(),
      'authorization_token' => new sfWidgetFormInputText(),
      'enabled'             => new sfWidgetFormInputCheckbox(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'system_event_id'     => new sfValidatorPropelChoice(array('model' => 'SystemEvent', 'column' => 'id')),
      'user_id'             => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'type'                => new sfValidatorChoice(array('choices' => array(0=>'request',1=>'email',))),
      'remote_url'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'subject'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'template'            => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'authorization_token' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'enabled'             => new sfValidatorBoolean(),
      'created_at'          => new sfValidatorDateTime(array('required' => false)),
      'updated_at'          => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('system_event_subscription[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SystemEventSubscription';
  }


}
