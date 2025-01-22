<?php if ($this->previewMode): ?>

    <div class="form-control">
        <?= $value ?>
    </div>

<?php else: ?>

    <div class="form-container">

        <?php foreach ($options as $key => $option): ?>

            <div class="form-check <?php if ($key == $value): ?>checked<?php endif; ?>">
                <input
                    type="radio"
                    name="<?= $name ?>"
                    value="<?= $key ?>"
                    id="<?= $key ?>"
                    class="form-check-input"
                    <?php if ($key == $value): ?>checked<?php endif; ?>>

                <label for="<?= $key ?>" class="form-check-label">
                    <div class="img">
                        <img src="<?= asset($this->getAssetPath("images/$key.svg")) ?>" alt="<?= $key ?>">
                    </div>

                    <div class="name">
                        <?= $option ?>
                    </div>
                </label>
            </div>

        <?php endforeach; ?>

    </div>

<?php endif ?>
