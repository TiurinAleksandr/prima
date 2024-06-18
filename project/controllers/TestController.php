<?php

namespace Project\Controllers;

require 'vendor/autoload.php';

use Core\Controller;
use DiDom\Document;
use Project\Models\Group;
use Core\RemoteData;

class TestController extends Controller
{
    public function groups() {
        $groups = new Group();
        $this->title = 'GroupList';
        return $this->render('test/test', [
           'groups'=>$groups->getAll(),
        ]);
    }
    public function students() {
        $remote = new RemoteData;
        $html = $remote->getRemoteData(REMOTE_URL . '/pupils?id='.'5713'.'&page=6');
        $document = new Document($html, false, 'windows-1251');
        $order_number = $document->first('table')->find('tr')[1]->find('td')[5]->text();
        $order_date = $document->first('table')->find('tr')[1]->find('td')[4]->text();
        $order = '№ '.$order_number.' от '.$order_date;

        echo($order);
    }
}