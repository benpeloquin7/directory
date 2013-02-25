<?php
App::uses('AppModel', 'Model');
/**
 * Vote Model
 *
 * @property Poll $Poll
 * @property User $User
 */
class Bouncer extends AppModel {
    public $useDbConfig = 'mgspsf';
}