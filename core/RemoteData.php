<?php

namespace Core;

use DiDom\Document;
use Project\Models\Group;

class RemoteData
{
    private function parse($url, $data=[]) {
        $cookie_file = $_SERVER['DOCUMENT_ROOT'] . '/project/webroot/avers_cookie.txt';
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_FOLLOWLOCATION=>1,
            CURLOPT_RETURNTRANSFER=>1,
            CURLOPT_POST=>1,
            CURLOPT_POSTFIELDS=>http_build_query($data),
            CURLOPT_COOKIEFILE=>$cookie_file,
            CURLOPT_COOKIEJAR=>$cookie_file,
        ]);
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }

    public function getRemoteData($url) {
        $auth_data = [
            'username'=>REMOTE_USER,
            'userpass'=>REMOTE_PASS
        ];
        $this->parse(REMOTE_URL_LOGIN, $auth_data);
        return $this->parse($url);
    }

    public function getGroups() {
        $html = $this->getRemoteData(REMOTE_URL . '/pgroup');
        $document = new Document($html, false, 'windows-1251');
        $ul = $document->first('.leftMenuListWide')->find('li');
        $groups = [];
        foreach ($ul as $li) {
            $a3 = $li->lastChild();
            $a3_id = explode('=', $a3->attr('href'))[1];
            $a3_text = str_replace("\xc2\xa0", '', $a3->text());
            $arr = explode(',', $a3_text);
            $group = [
                'id'=>(int)$a3_id,
                'number'=>substr($arr[0], 2),
                'course'=>(int)substr($arr[0], 0, 1),
                'spec'=>'--специальность--',
                'date_start'=>'дата_начала',
                'date_finish'=>'дата_окончания',
                'last_update'=>date('d.m.Y H:i', time())
            ];
            $groups[] = $group;
        }
        return $groups;
    }

    public function getStudentsByIdGroup($id_group) {
        $html = $this->getRemoteData(REMOTE_URL . '/pgroup?pgroup=' . $id_group . '&page=2');
        $document = new Document($html, false, 'windows-1251');
        $table = $document->first('table.size1');
        $rows = $table->find('tr');
        unset($rows[0]);
        $students = [];

        foreach ($rows as $row) {
            $cells = $row->find('td');
            $td = explode('id=', $cells[1]->innerHtml())[1];
            $td = explode('>', str_replace('"', '', $td));
            $student = [
                'id'=>(int)$td[0],
                'fio'=>substr($td[1], 0, -3),
                'id_group'=>$id_group,
            ];
            $students[] = $student;
        }

        for ($i=0; $i<count($students); $i++) {
            $html = $this->getRemoteData(REMOTE_URL . '/pupils?id='.$students[$i]['id'].'&page=1');
            $document = new Document($html, false, 'windows-1251');

            $students[$i]['surname'] = $document->first('input[name=qPupils-F_NAME]')->attr('value');
            $students[$i]['name'] = $document->first('input[name=qPupils-I_NAME]')->attr('value');
            $students[$i]['patronymic'] = $document->first('input[name=qPupils-O_NAME]')->attr('value');
            $students[$i]['birthdate'] = $document->first('input[name=qPupil_D_BIRTH]')->attr('value');
            $students[$i]['form'] = $document->first('input[name=RO_qCurClass]')->attr('value');

            $html = $this->getRemoteData(REMOTE_URL . '/pupils?id='.$students[$i]['id'].'&page=6');
            $document = new Document($html, false, 'windows-1251');
            $order_number = $document->first('table')->find('tr')[1]->find('td')[5]->text();
            $order_date = $document->first('table')->find('tr')[1]->find('td')[4]->text();
            $students[$i]['order'] = '№ '.$order_number.' от '.$order_date;
        }
        return $students;
    }
}
