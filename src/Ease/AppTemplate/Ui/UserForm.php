<?php

/**
 * Ease AppTemplate  - User form
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2020 Vitex Software
 */

namespace Ease\AppTemplate\Ui;

class UserForm extends \Ease\TWB4\Form {

    /**
     * User holder
     *
     * @var \Ease\User
     */
    public $user = null;

    public function __construct($user) {
        $userID = $user->getMyKey();
        $this->user = $user;
        parent::__construct('user' . $userID);

        $this->addInput(new \Ease\Html\InputTag('firstname',
                        $user->getDataValue('firstname')), _('Firstname'));
        $this->addInput(new \Ease\Html\InputTag('lastname',
                        $user->getDataValue('lastname')), _('Lastname'));
        $this->addInput(new \Ease\Html\InputTag('email',
                        $user->getDataValue('email')), _('Email'));
        $this->addInput(new \Ease\Html\InputTag('login',
                        $user->getDataValue('login')), _('Username'));

        $this->addItem(new \Ease\Html\InputHiddenTag('class', get_class($user)));
//        $this->addItem(new \Ease\Html\InputHiddenTag('enquiry_id', $user->getDataValue('enquiry_id')));

        $this->addItem(new \Ease\Html\Div(new EaseTWSubmitButton(_('Save'),
                                'success'), ['style' => 'text-align: right']));

        if (!is_null($userID)) {
            $this->addItem(new \Ease\Html\InputHiddenTag($user->keyColumn,
                            $userID));
        }
    }

}
