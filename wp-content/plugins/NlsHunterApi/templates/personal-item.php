<div class="item-personal">
    <a href="<?= $personalItem['url'] ?>">
        <div class="inner-personal">
            <span><?= $personalItem['value'] ?></span>
            <div class="bottom-per">
                <h3><?= $personalItem['title'] ?></h3>
                <?php if (key_exists('subtitle', $personalItem) && !empty($personalItem['subtitle'])) : ?>
                <p><?= $personalItem['subtitle'] ?></p>
                <?php endif; ?>
            </div>
        </div>
    </a>
</div>
