<?php

namespace Core;

class Model
{
    private static $link;

    public function __construct()
    {
        if (!self::$link) {
            self::$link = mysqli_connect(LOCAL_DB_HOST, LOCAL_DB_USER, LOCAL_DB_PASS, LOCAL_DB_NAME);
            mysqli_query(self::$link, "SET NAMES 'utf8'");
        }
    }

    protected function findOne($query)
    {
        $result = mysqli_query(self::$link, $query) or die(mysqli_error(self::$link));
        return mysqli_fetch_assoc($result);
    }

    protected function findMany($query)
    {
        $result = mysqli_query(self::$link, $query) or die(mysqli_error(self::$link));
        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;
        return $data;
    }

    protected function query($query) {
        mysqli_query(self::$link, $query) or die(mysqli_error(self::$link));
    }
}
