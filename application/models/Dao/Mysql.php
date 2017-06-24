<?php
class Model_Dao_Mysql {
    public function connect2() {
        $link = @mysql_connect(Common_Mysql::DB_HOST, Common_Mysql::DB_USER, Common_Mysql::DB_PWD) or die ('Link to mysql error '.mysql_errno().':'.mysql_error());
        mysql_set_charset(Common_Mysql::DB_CHARSET);
        mysql_select_db(Common_Mysql::DB_NAME);
        return $link;
    }
    public function close($link=null) {
        return mysql_close($link);
    }
    public function insert($array, $table) {
        $keys = join(',' , array_keys($array));
        $values = "'".join("','", array_values($array))."'";
        $sql = "INSERT {$table}({$keys}) VALUES ({$values})";
        $res = mysql_query($sql);
        if ($res) {
            return mysql_insert_id();
        } else {
            return false;
        }
    }
    public function update($array, $table, $where=null) {
        $sets = "";
        foreach ($array as $key => $val) {
            $sets .= $key."='".$val."',";
        }
        $sets = rtrim($sets, ',');
        $where = $where == null ? '' : 'WHERE '.$where;
        $sql = "UPDATE {$table} SET {$sets} {$where}";
        $res = mysql_query($sql);
        if ($res) {
            return mysql_affected_rows();
        } else {
            return false;
        }
    }
    public function fetchOne($sql, $result_type=MYSQL_ASSOC) {
        $result = mysql_query($sql);
        if ($result && mysql_num_rows($result) > 0) {
            return mysql_fetch_array($result, $result_type);
        } else {
            return false;
        }
    }
    function fetchAll($sql, $result_type=MYSQL_ASSOC) {
        $result = mysql_query($sql);
        if ($result && mysql_num_rows($result) > 0) {
            while ($row = mysql_fetch_array($result, $result_type)) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return false;
        }
    }
}
