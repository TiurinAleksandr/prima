<?php

namespace Project\Controllers;

use Core\Controller;
use Core\RemoteData;
use Project\Models\Group;
use Project\Models\Student;

class FormController extends Controller
{
    public function show()
    {
        $group_list = new Group;
        $student_list = new Student;

        $this->title = 'Заказ справки';
        return $this->render('form/form',
            [
                'group_list'=>$group_list->getAll(),
                'student_list'=>$student_list->getAll()
            ]
        );
    }

    public function submit() {

    }
}
