<?php

/**
 * User filter form base class.
 *
 * @package    blank
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseUserFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'password_reset_key' => new sfWidgetFormFilterInput(),
      'sf_guard_user_id'   => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'contact_id'         => new sfWidgetFormPropelChoice(array('model' => 'Contact', 'add_empty' => true)),
      'active'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'password_reset_key' => new sfValidatorPass(array('required' => false)),
      'sf_guard_user_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'contact_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Contact', 'column' => 'id')),
      'active'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'password_reset_key' => 'Text',
      'sf_guard_user_id'   => 'ForeignKey',
      'contact_id'         => 'ForeignKey',
      'active'             => 'Boolean',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
    );
  }
}
