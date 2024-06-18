<div class="wrapper py-5">
    <div class="window w-50 bg-white rounded-3 shadow p-3 mx-auto my-4 d-flex justify-content-between align-items-center">
        <small class="d-block">* обновить список существующих групп</small>
        <td><a href="/dev/updateAllGroups/" class="btn btn-primary p-1">Обновить</a></td>
    </div>

    <div class="window w-50 mx-auto my-2">
        <small>* обновить информацию о группах по отдельности</small><br>
        <small>** обновить списки студентов по группам</small>
    </div>
    <div class="window bg-white rounded-3 shadow p-3 mx-auto">
        <table>
            <thead>
                <tr class="fs-5 fw-600 my-3">
                    <td><p class="text-black-50">№</p></td>
                    <td><p>Группа</p></td>
                    <td><p>Студенты</p></td>
                    <td><p>Последнее обновление</p></td>
                </tr>
            </thead>
            <?php $n = 1; ?>
            <tboby>
                <?php foreach($groups as $group): ?>
                    <tr>
                        <td class="text-black-50"><?=$n++?></td>
                        <td><?=$group['number']?></td>
                        <td><a href="/dev/updateStudentsOfGroup/<?=$group['id']?>/" class="btn btn-outline-primary p-1 my-1">Обновить</a></td>
                        <td><?=$group['last_update']?></td>
                    </tr>
                <?php endforeach; ?>
            </tboby>
        </table>
    </div>
</div>

<style>
    td {
        padding: 0 15px;
    }
</style>
