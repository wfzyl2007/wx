<?php
class Action_Sample extends Sm_Base_PageAction {
    public function executeIt() {
        //这个方法将被调用
        $this->assign('word', $this->m_request['wd']);
        $this->setDisplayPage('sample');
        try {
            $this->displayPage($this->m_tplName);
        } catch (Exception $e) {
            Bd_Log::addNotice('errmsg', 'template error');
        }
    }
}
