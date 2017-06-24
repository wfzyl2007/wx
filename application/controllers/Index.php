<?php
class Controller_Index extends Yaf_Controller_Abstract {
    //Action会转换小写
    public $actions = array(
        'chatapi' => 'actions/api/Chatapi.php',
        'queue' => 'actions/Queue.php',
        'view' => 'actions/View.php',
    );
    public function indexAction() {
        //默认Action
        echo "hello world";
    }
}
?>
