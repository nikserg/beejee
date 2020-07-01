<?php
/**
 * @var \beejee\model\Task[] $tasks
 * @var \voku\helper\Paginator $pager
 * @var bool $isAdmin
 */
?>
<div class="row">
    <div class="col">
        <h1>Список задач</h1>
    </div>
</div>
<div class="row">
    <div class="col">
        <a href="/front/create" class="btn btn-success">Создать задачу</a>
    </div>
</div>
<div class="row">
    <div class="col">
        <?php include "_searchForm.php"; ?>
    </div>
</div>
<?php
foreach ($tasks as $task) {
    ?>
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        Задача <?php echo $task->id; ?>
                        <?php if ($task->done) { ?><span class="badge badge-success">Выполнена</span><?php } ?>
                        <?php if ($task->edited) { ?><span class="badge badge-info">Отредактировано администратором</span><?php } ?>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlentities($task->email) ?></h6>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlentities($task->username) ?></h6>
                    <p class="card-text"><?php echo htmlentities($task->description); ?></p>
                    <?php if ($isAdmin) { ?>
                        <a href="/front/edit?id=<?php echo $task->id; ?>" class="card-link">Редактировать</a>
                    <?php } ?>
                </div>
            </div>
            <br/>
        </div>
    </div>

    <?php
}
?>
<div class="row">
    <div class="col">
        <?php echo $pager; ?>
    </div>
</div>