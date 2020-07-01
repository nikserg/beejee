<?php
/**
 * @var Throwable $error
 */
?>
<div class="row">
    <div class="col">
        <h1>Ошибка <?php echo $error->getCode() ?></h1>
    </div>
</div>
<div class="row">
    <div class="col">
        <?php echo $error->getMessage(); ?>
    </div>
</div>
<div class="row">
    <div class="col">
        <a href="/">На главную</a>
    </div>
</div>