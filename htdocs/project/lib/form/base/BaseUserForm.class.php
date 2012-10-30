<?php

/**
 * User form base class.
 *
 * @method User getObject() Returns the current form's model object
 *
 * @package    blank
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseUserForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'password_reset_key' => new sfWidgetFormInputText(),
      'sf_guard_user_id'   => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'contact_id'         => new sfWidgetFormPropelChoice(array('model' => 'Contact', 'add_empty' => true)),
      'active'             => new sfWidgetFormInputCheckbox(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'password_reset_key' => new sfValidatorString(array('max_length' => 16, 'required' => false)),
      'sf_guard_user_id'   => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'contact_id'         => new sfValidatorPropelChoice(array('model' => 'Contact', 'column' => 'id', 'required' => false)),
      'active'             => new sfValidatorBoolean(array('required' => false)),
      'created_at'         => new sfValidatorDateTime(array('required' => false)),
      'updated_at'         => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'User', 'column' => array('password_reset_key'))),
        new sfValidatorPropelUnique(array('model' => 'User', 'column' => array('sf_guard_user_id'))),
      ))
    );

    $this->widgetSchema->setNameFormat('user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }


}
