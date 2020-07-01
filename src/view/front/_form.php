<?php
/**
 * @var \beejee\model\Task $model
 */
?>
<div class="form-group">
    <label for="inputEmail1">Email</label>
    <input type="email" required="required" name="email" value="<?php echo $model->email; ?>" class="form-control" id="inputEmail1" aria-describedby="emailHelp">
</div>
<div class="form-group">
    <label for="inputEmail1">Имя пользователя</label>
    <input type="text" required="required" name="username" value="<?php echo $model->username; ?>" class="form-control" id="inputEmail1" aria-describedby="emailHelp">
</div>
<div class="form-group">
    <label for="description">Описание</label>
    <textarea required="required" name="description" class="form-control" id="description" rows="3"><?php echo $model->description; ?></textarea>
</div>