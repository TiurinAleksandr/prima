<?php

namespace Project\Models;
use \Core\Model;

class Group extends Model
{
    public function getById($id)
    {
        return $this->findOne("SELECT * FROM groups WHERE id=$id");
    }

    public function getAll()
    {
        return $this->findMany("SELECT * FROM `groups`");
    }

    public function add($group)
    {
        $this->query("INSERT INTO `groups` VALUES (".
            $group['id'] . ",'" .
            $group['number'] . "','" .
            $group['spec'] . "','" .
            $group['date_start'] . "','" .
            $group['date_finish'] . "'," .
            $group['course'] . ",'" .
            $group['last_update'] . "');"
        );
    }

    public function updateOne($id, $new)
    {
        $this->query("UPDATE `groups` SET
                    `id`=" . $new['id'] . ",
                    `number`='" . $new['number'] . "',
                    `spec`='" . $new['spec'] . "',
                    `date_start`='" . $new['date_start'] . "',
                    `date_finish`='" . $new['date_finish'] . "',
                    `course`=" . $new['id'] . ",
                    `last_update`='" . $new['last_update'] . "'
                WHERE `id`=" . $id);
    }

    public function deleteById($id)
    {
        $this->query("DELETE FROM `groups` WHERE `id`=" . $id);
    }

    public function deleteAll()
    {
        $this->query("DELETE FROM groups");
    }
}
