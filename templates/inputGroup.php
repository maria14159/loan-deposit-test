<?php
/**
 * @var $args
 * @var $label
 */

?>

    <label class="col-sm-10 col-form-label">
        <?= $label ?>
    </label>
    <div class="input-group col-sm-10 mr-auto ml-auto mb-4">
    <?php if (!empty($args)){
        foreach ($args as $input)
        {
            echo '<input ';
            foreach ($input as $key => $value) {
                echo $key .'="'. $value. '" ';
            }
            echo '>';
        }

    }else echo '' ?>
</div>

<?php
