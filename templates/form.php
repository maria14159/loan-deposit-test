<?php
/**
 * @var $name
 * @var $fields
 */


?>

<form class="form m-4" method="post" action="/send">
    <?php
    foreach ($fields as $field) {
        if ($field['block'] == 2)
            break;
        $template = $field['template'];
        $label = $field['label'];
        $args = $field['args'];

        require "$template.php";
    }
    ?>
    <div class="form-group mr-4 ml-4">
        <div class="nav nav-pills d-inline-flex" id="v-pills-tab" role="tablist">
            <button class="nav-link col-form-label active" data-bs-toggle="pill"
                    data-bs-target="#pills-loan-legal" type="button" role="tab"
                    aria-selected="true">Кредит
            </button>
            <button class="nav-link col-form-label" data-bs-toggle="pill"
                    data-bs-target="#pills-deposit-legal" type="button" role="tab"
                    aria-selected="false">Вклад
            </button>
        </div>
        <div class="tab-content mt-3" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="pills-loan-legal" role="tabpanel">
                <?php
                foreach ($fields as $field) {
                    if ($field['block'] == 1)
                        continue;
                    elseif ($field['block'] == 3)
                        break;

                    $template = $field['template'];
                    $label = $field['label'];
                    $args = $field['args'];

                    require "$template.php";
                }
                ?>
            </div>

            <div class="tab-pane fade" id="pills-deposit-legal" role="tabpanel">
                <?php
                foreach ($fields as $field) {
                    if ($field['block'] == 1 or $field['block'] == 2)
                        continue;

                    $template = $field['template'];
                    $label = $field['label'];
                    $args = $field['args'];

                    require "$template.php";
                }
                ?>
            </div>
        </div>
    </div>

    <div class="form-group ">
        <input type="submit" value="Отправить" name="submit" class="btn btn-primary"/>
    </div>
</form>