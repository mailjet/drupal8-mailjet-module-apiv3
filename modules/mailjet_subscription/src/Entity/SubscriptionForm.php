<?php

namespace Drupal\mailjet_subscription\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Subscription form entity.
 *
 *
 * @ingroup mailjet_subscription
 *
 * @ConfigEntityType(
 *   id = "mailjet_subscription_form",
 *   label = @Translation("Subscription Form"),
 *   admin_permission = "administer subscriptions",
 *   handlers = {
 *     "access" = "Drupal\mailjet_subscription\SubscriptionFormController",
 *     "list_builder" = "Drupal\mailjet_subscription\Controller\SubscriptionFormBuilder",
 *     "form" = {
 *       "add" = "Drupal\mailjet_subscription\Form\SubscriptionFormAddForm",
 *       "edit" = "Drupal\mailjet_subscription\Form\SubscriptionFormEditForm",
 *       "delete" = "Drupal\mailjet_subscription\Form\SubscriptionFormDeleteForm"
 *     }
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "plugin",
 *     "configuration",
 *     "conditions",
 *     "conditionOperator",
 *   },
 *   links = {
 *     "edit-form" = "/examples/mailjet_subscription/manage/{mailjet_subscription_form}",
 *     "delete-form" = "/examples/mailjet_subscription/manage/{mailjet_subscription_form}/delete"
 *   }
 * )
 */
class SubscriptionForm extends ConfigEntityBase
{
  /**
   * @return string
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * @return string
   */
  public function getDescription(): string
  {
    return $this->description;
  }

  /**
   * @return string
   */
  public function getSumbitLabel(): string
  {
    return $this->sumbit_label;
  }

  /**
   * @return string
   */
  public function getDestinationPage(): string
  {
    return $this->destination_page;
  }

  /**
   * @return string
   */
  public function getConfirmationMessage(): string
  {
    return $this->confirmation_message;
  }

  /**
   * @return string
   */
  public function getErrorToken(): string
  {
    return $this->error_token;
  }

  /**
   * @return string
   */
  public function getConfirmationEmailText(): string
  {
    return $this->confirmation_email_text;
  }

  /**
   * @return string
   */
  public function getEmailTextButton(): string
  {
    return $this->email_text_button;
  }

  /**
   * @return string
   */
  public function getEmailTextDescription(): string
  {
    return $this->email_text_description;
  }

  /**
   * @return string
   */
  public function getEmailTextThankYou(): string
  {
    return $this->email_text_thank_you;
  }

  /**
   * @return string
   */
  public function getEmailOwner(): string
  {
    return $this->email_owner;
  }

  /**
   * @return string
   */
  public function getSubscribeError(): string
  {
    return $this->subscribe_error;
  }

  /**
   * @return string
   */
  public function getContactExist(): string
  {
    return $this->contact_exist;
  }

  /**
   * @return string
   */
  public function getSuccessMessageSubsribe(): string
  {
    return $this->success_message_subsribe;
  }

  /**
   * @return array
   */
  public function getLists(): array
  {
    return $this->lists;
  }

  /**
   * @return array
   */
  public function getFieldsMailjet(): array
  {
    return $this->fields_mailjet;
  }

  /**
   * @return array
   */
  public function getCssField(): array
  {
    return $this->css_field;
  }

  /**
   * @return string
   */
  public function getJsField(): string
  {
    return $this->js_field;
  }

  /**
   * @return string
   */
  public function getEmailFooterText(): string
  {
    return $this->email_footer_text;
  }

  /**
   * @return string
   */
  public function getErrorDataTypes(): string
  {
    return $this->error_data_types;
  }

  /**
   * @return string
   */
  public function getSortFields(): string
  {
    return $this->sort_fields;
  }
  /**
   * The Signup ID.
   *
   * @var int
   */
    public $id;

  /**
   * The Signup Form Machine Name.
   *
   * @var string
   */
    public $name;

  /**
   * The Signup Form Description.
   *
   * @var string
   */
    public $description;

  /**
   * The Signup Form Label of Sumbit button.
   *
   * @var string
   */
    public $sumbit_label;

  /**
   * The Signup Form Destination Page
   *
   * @var string
   */
    public $destination_page;

  /**
   * The Signup Form Confirmation Message
   *
   * @var string
   */
    public $confirmation_message;

  /**
   * The Signup Form Error token
   *
   * @var string
   */
    public $error_token;


  /**
   * The Signup Form Confirmation Rmail Text
   *
   * @var string
   */
    public $confirmation_email_text;


  /**
   * The Signup Form Email Text Button
   *
   * @var string
   */
    public $email_text_button;


  /** The Signup Form Email Text Description
   *
   * @var string
   */
    public $email_text_description;

  /**
   * The Signup Form Email Thank You Message
   *
   * @var string
   */
    public $email_text_thank_you;

  /**
   * The Signup Form Email Owner
   *
   * @var string
   */
    public $email_owner;

  /**
   * The Signup Form Subscribe Error
   *
   * @var string
   */
    public $subscribe_error;

  /**
   * The Signup Form Contact Exist Message
   *
   * @var string
   */
    public $contact_exist;

  /**
   * The Signup Form Success Message Subscribe
   *
   * @var string
   */
    public $success_message_subsribe;

  /**
   * The Signup Form lists
   *
   * @var array
   */
    public $lists;

  /**
   * The Signup Form Conctact propeties
   *
   * @var array
   */
    public $fields_mailjet;

  /**
   * The Signup Form CSS FIELD
   *
   * @var array
   */
    public $css_field;

  /**
   * The Signup Form Js Field
   *
   * @var string
   */
    public $js_field;

  /**
   * The Signup Form Email Footer Text
   *
   * @var string
   */
    public $email_footer_text;

  /**
   * The Signup Form Error Data Type Message
   *
   * @var string
   */
    public $error_data_types;

  /**
   * The Signup Form Sort fields - String
   *
   * @var string
   */
    public $sort_fields;

  /**
   * @return int
   */
  public function getId(): int
  {
    return $this->id;
  }
}
