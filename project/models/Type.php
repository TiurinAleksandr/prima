<?php

namespace Project\Models;

use Core\Model;

class Type extends Model
{
    public function getById($id)
    {
        return $this->findOne("SELECT * FROM types WHERE id=$id");
    }

    public function getAll()
    {
        return $this->findMany("SELECT * FROM types");
    }
}