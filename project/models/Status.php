<?php

namespace Project\Models;

use Core\Model;

class Status extends Model
{
    public function getById($id)
    {
        return $this->findOne("SELECT * FROM statuses WHERE id=$id");
    }

    public function getAll()
    {
        return $this->findMany("SELECT * FROM statuses");
    }
}