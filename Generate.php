<?php
/**
 * 生成数据库结构
 * @author leo
 *
 */
class Generate extends PDO
{

    public function __construct($dsn, $username, $passwd, $options = null)
    {
        parent::__construct($dsn, $username, $passwd, $options);
        $this->query("set names utf8");
    }

    public function getTableList($dbname)
    {
        $this->query("use {$dbname}");
        $result = $this->query("SHOW TABLE STATUS")->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getTableField($dbname, $tablename)
    {
        $result = $this->query("SHOW FULL FIELDS FROM {$dbname}.{$tablename}")->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getDbInfo($dbname)
    {
        $tables = $this->getTableList($dbname);
        foreach ($tables as &$table) {
            $table['Fields'] = $this->getTableField($dbname, $table['Name']);
        }
        return $tables;
    }
}