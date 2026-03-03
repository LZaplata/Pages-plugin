<?php if ($this->previewMode): ?>

    <div class="form-control">
        <?= $value ?>
    </div>

<?php else: ?>

    <div class="form-range-group">
        <input
            type="range"
            name="<?= $name ?>-selector"
            value="<?= $value ?? $default ?>"
            id="<?= $id ?>-selector"
            class="form-range"
            min="<?= $min ?>"
            max="<?= $max ?>"
            step="<?= $step ?>">

        <input
            type="number"
            name="<?= $name ?>"
            value="<?= $value ?? $default ?>"
            id="<?= $id ?>"
            class="form-control"
            min="<?= $min ?>"
            max="<?= $max ?>"
            step="<?= $step ?>">

        <?php if ($unit): ?>
            <span class="form-range-unit">
                <?= $unit ?>
            </span>
        <?php endif ?>
    </div>

<?php endif ?>
