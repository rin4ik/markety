<div class="toolbar d-flex justify-content-between">
  <aside class="form-row">
    <div class="col-auto input-group input-group-sm">
      <select class="custom-select">
        <option value="0" disabled selected>Действие</option>
        <option value="1">Переместить в работающие</option>
        <option value="2">Переместить в не работающие</option>
        <option value="4">Заблокировать</option>
        <option value="5">Удалить</option>
      </select>
      <div class="input-group-append">
        <button class="btn btn-dark" type="button">></button>
      </div>
    </div>
  </aside>
  <aside class="form-row">
    <div class="col-auto input-group input-group-sm">
      <input class="form-control" type="text" placeholder="Поиск">
      <div class="input-group-append">
        <button class="btn btn-dark" type="button">></button>
      </div>
    </div>
    <div class="col-auto">
      <button class="btn btn-sm btn-blue" type="button" data-toggle="modal" data-target="#newUser">Добавить</button>
    </div>
  </aside>
</div>
<div class="page-body">
  <table class="table table-striped table-hover table-sm">
    <thead>
      <tr>
        <th class="col-auto">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="001">
            <label class="custom-control-label" for="001"></label>
          </div>
        </th>
        <th class="col-1">№</th>
        <th class="col-7">ФИО</th>
        <th class="col-2">Группа</th>
        <th class="col-2">Статус</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="002">
            <label class="custom-control-label" for="002"></label>
          </div>
        </td>
        <td>015</td>
        <td>Холматов Жалолиддин Рахматжон угли</td>
        <td>Менежер по заказамы</td>
        <td>Работает</td>
      </tr>
    </tbody>
  </table>
</div>

ФИО
Пол
Дата рождения
Адрес проживание

Телефон
Доп. тел
Email
IP

Заработная плата
Дата принятие на работу
Дата уволнения

Статус



<div class="modal" id="newUser" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form class="modal-content" method="post">
      <div class="modal-header">
        <h5 class="modal-title">Новый сотрудник</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label class="form-label" for="name">ФИО</label>
              <input class="form-control" type="text" id="name" name="name">
            </div>
            <div class="form-group form-row">
              <div class="col">
                <label class="form-label" for="sex">Пол</label>
                <select class="custom-select" name="sex" id="sex">
                  <option value="0" selected disabled>Не выбран</option>
                  <option value="1">Мужской</option>
                  <option value="2">Женский</option>
                </select>
              </div>
              <div class="col">
                <label class="form-label" for="birthday">День рождения</label>
                <input class="form-control" type="date" id="birthday">
              </div>
            </div>
            <div class="form-group form-row">
              <div class="col">
                <label class="form-label" for="phone">Телефон</label>
                <input class="form-control" type="text" id="phone" name="phone">
              </div>
              <div class="col">
                <label class="form-label" for="email">Email</label>
                <input class="form-control" type="email" id="email" name="email">
              </div>
            </div>
            <div>
              <label class="form-label" for="adress">Адрес проживания</label>
              <textarea class="form-control" name="adress" id="adress"></textarea>
            </div>
          </div>
          <div class="col">
            <div class="form-group form-row">
              <div class="col">
                <label class="form-label" for="email">Дата принятия</label>
                <input class="form-control" type="date" id="email" name="email">
              </div>
              <div class="col">
                <label class="form-label" for="phone2">Дата увольнения</label>
                <input class="form-control" type="date" id="phone" name="phone2">
              </div>
            </div>
            
            <div class="form-group form-row">
              <div class="col">
                <label class="form-label" for="email">Группа</label>
                <select class="custom-select" name="sex" id="sex">
                  <option value="0" selected disabled>Не выбран</option>
                  <option value="1">test</option>
                  <option value="2">test</option>
                </select>
              </div>
              <div class="col">
                <label class="form-label" for="phone2">Test</label>
                <input class="form-control" type="text" id="phone" name="phone2">
              </div>
            </div>
            <div class="form-group form-row">
              <div class="col">
                <label class="form-label" for="email">IP</label>
                <input class="form-control" type="text" id="phone" name="phone2">
              </div>
              <div class="col">
                <label class="form-label" for="phone2">Пароль</label>
                <input class="form-control" type="text" id="phone" name="phone2">
              </div>
            </div>
            <div>
              <label class="form-label" for="adress">Примичение</label>
              <textarea class="form-control" name="adress" id="adress"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Закрыть</button>
        <button type="sumbit" class="btn btn-blue">Добавить</button>
      </div>
    </form>
  </div>
</div>