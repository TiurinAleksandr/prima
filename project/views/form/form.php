<div class="wrapper">
    <div class="main">
        <div class="container-sm d-flex align-items-center">
            <div class="window bg-white rounded-3 shadow p-3 mx-auto my-5">
                <div class="row">
                    <div class="col-sm-12"><img src="/project/webroot/img/kitis-logo.png" alt="logo" class="mx-auto" style="width:150px"></div>
                    <div class="col-sm-12"><h1 class="fs-3 text-center my-3">Заказать обычную справку</h1></div>
                </div>
                <div class="row">
                    <div class="col">
                        <form action="/submit" method="post">
                            <div class="mb-2 field">
                                <label for="group" class="form-label">Группа*</label>
                                <select name="group" id="group" class="form-select" required>
                                    <option selected=""></option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="fio" class="form-label">ФИО*</label>
                                <select name="fio" id="fio" class="form-select" required>
                                    <option selected=""></option>

                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" aria-describedby="emailHelp" placeholder="Можете оставить email, чтобы получить уведомление">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="check" required>
                                <label class="form-check-label" for="check">Даю согласие на обработку персональных данных</label>
                            </div>

                            <!-- КНОПКА ДОБАВЛЕНИЯ ЗАЯВКИ В БД -->
                            <input type="submit" name="addOrder" value="Отправить" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- данные -->
<ul id="data_groups" class="d-none">
    <?php foreach ($group_list as $group): ?>
        <li>
            <p class="id"><?=$group['id']?></p>
            <p class="number"><?=$group['number']?></p>
        </li>
    <?php endforeach; ?>
</ul>
<ul id="data_students" class="d-none">
    <?php foreach ($student_list as $student): ?>
        <li>
            <p class="id"><?=$student['id']?></p>
            <p class="fio"><?=$student['fio']?></p>
            <p class="id_group"><?=$student['id_group']?></p>
        </li>
    <?php endforeach; ?>
</ul>



<script>
//    перевод данных о группах из php в объекты js
    const group_select = document.querySelector('#group');
    const group_list = document.querySelectorAll('#data_groups li');
    let groups = [];
    group_list.forEach((group_li) => groups.push(
        {
            id: group_li.querySelector('.id').textContent,
            number: group_li.querySelector('.number').textContent
        }
    ))
    console.log(groups)

//    перевод данных о студентах из php в объекты js
    const student_select = document.querySelector('#fio');
    const student_list = document.querySelectorAll('#data_students li');
    let students = [];
    student_list.forEach((student_li) => students.push(
        {
            id: student_li.querySelector('.id').textContent,
            fio: student_li.querySelector('.fio').textContent,
            id_group: student_li.querySelector('.id_group').textContent
        }
    ))
    console.log(students)

    // добавление options в select групп
    groups.forEach((group) => {
        let option = document.createElement("option")
        option.value = group.id
        option.text = group.number
        group_select.appendChild(option)
    })

    // при выборе группы добавление options в select студентов
    group_select.addEventListener('change', function() {
        student_select.options.length = 1;
        students.forEach((student) => {
            if (student.id_group === group_select.value) {
                let option = document.createElement("option")
                option.value = student.id
                option.text = student.fio
                student_select.appendChild(option)
            }
        })
    });

</script>

<style>

</style>
