<?php
/**
 * @var \beejee\model\Task $model
 */
include "_form.php";
?>
<div class="form-group">
    <label>
        <input type="hidden" name="done" value="0" />
        <input type="checkbox" name="done" value="1" <?php if ($model->done) {
            echo "checked='checked'";
        } ?>> Задача выполнена
    </label>
</div>