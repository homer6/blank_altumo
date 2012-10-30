<?php

/**
 * SystemEventSubscription filter form base class.
 *
 * @package    blank
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseSystemEventSubscriptionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'system_event_id'     => new sfWidgetFormPropelChoice(array('model' => 'SystemEvent', 'add_empty' => true)),
      'user_id'             => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'type'                => new sfWidgetFormChoice(array('choices' => array(''=>'all',0=>'request',1=>'email',))),
      'remote_url'          => new sfWidgetFormFilterInput(),
      'subject'             => new sfWidgetFormFilterInput(),
      'template'            => new sfWidgetFormFilterInput(),
      'authorization_token' => new sfWidgetFormFilterInput(),
      'enabled'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'system_event_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SystemEvent', 'column' => 'id')),
      'user_id'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'type'                => new sfValidatorChoice(array('required' => false, 'choices' => array(0=>0,1=>1,))),
      'remote_url'          => new sfValidatorPass(array('required' => false)),
      'subject'             => new sfValidatorPass(array('required' => false)),
      'template'            => new sfValidatorPass(array('required' => false)),
      'authorization_token' => new sfValidatorPass(array('required' => false)),
      'enabled'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('system_event_subscription_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SystemEventSubscription';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'system_event_id'     => 'ForeignKey',
      'user_id'             => 'ForeignKey',
      'type'                => 'Text',
      'remote_url'          => 'Text',
      'subject'             => 'Text',
      'template'            => 'Text',
      'authorization_token' => 'Text',
      'enabled'             => 'Boolean',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
    );
  }
}
