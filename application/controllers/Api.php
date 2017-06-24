<?php
class Controller_Api extends Yaf_Controller_Abstract {
    public $actions = array(
        'setmenu' => 'actions/api/SetMenu.php',
        'chatapi' => 'actions/api/Chatapi.php',
    );
}
