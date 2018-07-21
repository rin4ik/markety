<div class="toolbar d-flex justify-content-between">
  <aside class="form-row">
    <div class="col-auto input-group input-group-sm">
      <select class="custom-select">
        <option value="0" disabled selected>Действие</option>
        <option value="1">Редактировать</option>
        <option value="2">Удалить</option>
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
          <input type="checkbox" id="001">
        </th>
        <th>ID</th>
        <th>Название производителя</th>
        <th>Количество прилагаемых товаров</th>
        <th  class="text-right">Действие</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          <input type="checkbox" id="001">
        </td>
        <td>1</td>
        <td>Apple</td>
        <td>5</td>
        <td  class="text-right">
          <button class="btn btn-sm btn-blue" type="button">Редактировать</button>
          <button class="btn btn-sm btn-danger" type="button">Удалить</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>