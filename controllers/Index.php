<?php
/**
 * @name Main_Controller
 * @desc 主控制器,也是默认控制器
 * @author 张溢麟(zhangyilin@baidu.com)
 */

class Controller_Index extends Ap_Controller_Abstract {
    public $actions = array(
        'sample' => 'actions/page/Sample.php',
        'wx' => 'actions/page/Sample.php',
    );
}
