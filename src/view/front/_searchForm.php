<?php
/**
 * @var string $sort
 * @var string $sortOrder
 */
?>
<form class="form-inline" method="get">
    <div class="form-group mb-2">
        <label for="staticEmail2" class="">Сортировать по&nbsp;</label>
        <select id="staticEmail2" name="sort" class="form-control form-control-sm">
            <option value="id" <?php if ($sort == 'id') {
                echo "selected=\"selected\"";
            } ?>>Дате создания
            </option>
            <option value="username" <?php if ($sort == 'username') {
                echo "selected=\"selected\"";
            } ?>>Имени пользователя
            </option>
            <option value="email" <?php if ($sort == 'email') {
                echo "selected=\"selected\"";
            } ?>>E-mail
            </option>
            <option value="done" <?php if ($sort == 'done') {
                echo "selected=\"selected\"";
            } ?>>Статусу
            </option>
        </select>
        <select id="staticEmail2" name="sortOrder" class="form-control form-control-sm">
            <option value="ASC" <?php if ($sortOrder == 'ASC') {
                echo "selected=\"selected\"";
            } ?>>по возрастанию
            </option>
            <option value="DESC" <?php if ($sortOrder == 'DESC') {
                echo "selected=\"selected\"";
            } ?>>по убыванию
            </option>
        </select>
    </div>
    &nbsp;<button type="submit" class="btn btn-primary mb-2">Применить</button>
</form>