<?php
/**
 * @var $args
 * @var $label
 */

?>

<div class="form-group">
    <label for="capitalization" class="col-sm-10 col-form-label">
        <?= $label ?>
        <select class="form-control mt-2 text-center" id="capitalization" name = "capitalization" required>
            <?php if (!empty($args)) {
                foreach ($args as $option) {
                    echo '<option value= "' . $option['name'] . '"';
                    if ($option['selected'] == 'true')
                        echo ' selected';

                    echo '>' . $option['name'] . '</option>';
                }

            } else echo '' ?>
        </select>
    </label>


</div>