<?php

namespace Project\Controllers;

require 'vendor/autoload.php';

use Core\Controller;
use Core\RemoteData;
use Project\Models\Group;
use Project\Models\Student;

class DevController extends Controller
{
    public function show() {
        $groups = new Group;
        $this->title = 'Dev Page';
        return $this->render('dev/dev', [
            'groups'=>$groups->getAll()
        ]);
    }


    public function updateAllGroups() {
        $avers = new RemoteData;
        $model = new Group;
        $remote_groups = $avers->getGroups();
        $local_groups = $model->getAll();
        foreach ($local_groups as $l) {
            $flag = false;
            foreach ($remote_groups as $r) {
                if ($l['id'] == $r['id']) {
                    $flag = true;
                    $model->updateOne($l['id'], $r);
                }
            }
            if (!$flag) {
                $students = new Student;
                $students->deleteByGroupId($l['id']);
                $model->deleteById($l['id']);
            }
        }
        foreach ($remote_groups as $r) {
            $flag = false;
            foreach ($local_groups as $l) {
                if ($r['id'] == $l['id']) $flag = true;
            }
            if (!$flag) $model->add($r);
        }

        $updated_local_groups = $model->getAll();
        foreach ($updated_local_groups as $groups) {
            $model = new Student;
            $remote_students = $avers->getStudentsByIdGroup($groups['id']);
            $local_students = $model->getByGroupId($groups['id']);
            foreach ($local_students as $l) {
                $flag = false;
                foreach ($remote_students as $r) {
                    if ($l['id'] == $r['id']) {
                        $flag = true;
                        $model->updateOne($l['id'], $r);
                    }
                }
                if (!$flag) $model->deleteById($l['id']);
            }
            foreach ($remote_students as $r) {
                $flag = false;
                foreach ($local_students as $l) {
                    if ($r['id'] == $l['id']) $flag = true;
                }
                if (!$flag) $model->add($r);
            }
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function updateStudentsOfGroup($params) {
        $group_id = $params['id'];
        $avers = new RemoteData;
        $model = new Student;
        $remote_students = $avers->getStudentsByIdGroup($group_id);
        $local_students = $model->getByGroupId($group_id);
        foreach ($local_students as $l) {
            $flag = false;
            foreach ($remote_students as $r) {
                if ($l['id'] == $r['id']) {
                    $flag = true;
                    $model->updateOne($l['id'], $r);
                }
            }
            if (!$flag) $model->deleteById($l['id']);
        }
        foreach ($remote_students as $r) {
            $flag = false;
            foreach ($local_students as $l) {
                if ($r['id'] == $l['id']) $flag = true;
            }
            if (!$flag) $model->add($r);
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}