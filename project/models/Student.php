<?php

namespace Project\Models;

use \Core\Model;

class Student extends Model
{
    public function getAll()
    {
        return $this->findMany("SELECT * FROM `students`");
    }

    public function getByGroupId($group_id)
    {
        return $this->findMany("SELECT * FROM `students` WHERE `id_group`=" . $group_id);
    }

    public function getById($id)
    {
        return $this->findOne("SELECT * FROM `students` WHERE `id`=$id");
    }

    public function add($student)
    {
        $this->query("INSERT INTO `students` VALUES (" .
            $student['id'] . ",'" .
            $student['fio'] . "','" .
            $student['surname'] . "','" .
            $student['name'] . "','" .
            $student['patronymic'] . "','" .
            $student['birthdate'] . "'," .
            $student['id_group'] . ",'" .
            $student['form'] . "','" .
            $student['order'] . "');");
    }

    public function updateOne($id, $new)
    {
        $this->query("UPDATE `students` SET
                    `id`=" . $new['id'] . ",
                    `fio`='" . $new['fio'] . "',
                    `surname`='" . $new['surname'] . "',
                    `name`='" . $new['name'] . "',
                    `patronymic`='" . $new['patronymic'] . "',
                    `birthdate`='" . $new['birthdate'] . "',
                    `id_group`=" . $new['id_group'] . ",
                    `form`='" . $new['form'] . "',
                    `order`='" . $new['order'] . "'
                WHERE `id`=" . $id);

    }

    public function deleteById($id)
    {
        $this->query("DELETE FROM `students` WHERE `id`=" . $id);
    }

    public function deleteByGroupId($id_group)
    {
        $this->query("DELETE FROM `students` WHERE `id_group`=" . $id_group);
    }

    public function deleteAll()
    {
        $this->query("DELETE FROM students");
    }
}