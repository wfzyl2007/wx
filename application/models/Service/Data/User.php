<?php
class Model_Service_Data_User {
    const DB_TABLE_NAME = 'user';
    private $_dao = null;
    public function __construct() {
        $this->_dao = new Model_Dao_Mysql();
    }
    public function checkUser($openid) {
        $link = $this->_dao->connect2();
        $sql = "SELECT * from ".self::DB_TABLE_NAME." where openid='$openid'";
        return $this->_dao->fetchOne($sql);
    }
    public function insertUser($openid, $name, $number, $place=1, $type=1, $inqueue=0, $day="") {
        $link = $this->_dao->connect2();
        $row = array(
            'openid' => $openid,
            'name' => $name,
            'number' => $number,
            'place' => $place,
            'type' => $type,
            'inqueue' => $inqueue,
            'day' => $day,
        );
        return $this->_dao->insert($row, self::DB_TABLE_NAME);
    }
    public function updateUser($openid, $name, $number, $place, $type, $inqueue, $day) {
        $link = $this->_dao->connect2();
        $row = array(
            'openid' => $openid,
            'name' => $name,
            'number' => $number,
            'place' => $place,
            'type' => $type,
            'inqueue' => $inqueue,
            'day' => $day,
        );
        return $this->_dao->update($row, self::DB_TABLE_NAME, "openid='$openid'");
    }
    public function quitUser($openid, $inqueue, $day) {
        $link = $this->_dao->connect2();
        $row = array(
            'openid' => $openid,
            'inqueue' => $inqueue,
            'day' => $day,
        );
        return $this->_dao->update($row, self::DB_TABLE_NAME, "openid='$openid'");
    }
    public function getQueueUser($type=null, $place=null) {
        $link = $this->_dao->connect2();
        $date = date("Ymd");
        $type = $type == null ? '' : " AND type='$type'";
        $place = $place == null ? '' : " AND place='$place'";
        $sql = "SELECT * from ".self::DB_TABLE_NAME." where day='$date'".$type.$place;
        $sql .= " ORDER BY inqueue";
        return $this->_dao->fetchAll($sql);
    }
}
