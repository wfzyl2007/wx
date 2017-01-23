<?php
class Common_BasePage extends Ap_Action_Abstract {
    public $m_smarty;
    public $m_tplName;
    /**
     * @brief execute
     **/
    public function execute() {
        try {
            $this->m_smarty = Bd_TplFactory::getInstance();
            $this->executeIt();
        } catch (Exception $e) {
            $strMsg = sprintf('[%s:%d] %s', $e->getFile(), $e->getLine(), $e->getMessage());
            Bd_log::warning($strMsg, $e->getCode());
        }
    }
    /**
     * @brief setDisplayPage
     **/
    public function setDisplayPage($strTplName) {
        $arrTplConf = Bd_Conf::getConf('/app/'.Bd_AppEnv::getCurrApp().'/'.Bd_AppEnv::getCurrApp().'/TPLCONF');
        $this->m_tplName = $arrTplConf[$strTplName]['name'];
    }
    /**
     * @brief assign
     **/
    public function assign($var, $value) {
        $this->m_smarty->assign($var, $value);
    }
    /**
     * @brief displayPage
     **/
    public function displayPage($strTpl=null) {
        if (empty($strTpl)) {
            $strTpl = $this->m_tplName;
            if (empty($strTpl)) {
                Bd_log::warning('no tpl');
                return false;
            }
        }
        $this->m_smarty->display($strTpl);
    }
    /**
     * @brief 子类重载这个方法
     **/
    protected function executeIt() {
    }
}
