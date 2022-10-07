<?php
/**
 * @var $args
 * @var $label
 */

?>

<div class="form-group">
    <label class="col-sm-10 col-form-label">
        <?= $label ?>

            <input <?php if (!empty($args)){
                foreach ($args as $key => $value) {
                    echo $key .'="'. $value. '" ';
                }
            }else echo '' ?>>

    </label>

</div>