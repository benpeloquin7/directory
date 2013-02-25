<?php
App::uses('Model', 'Model');

class BouncerModel extends Model {
    public $useDbConfig = 'mgspsf';
    
    public function checkTheList() {
        return true;
    }
}