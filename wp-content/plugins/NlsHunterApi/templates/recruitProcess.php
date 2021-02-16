
<div class="recruit-process-item flex bg-white" post-id="<?= $recruitProcessItem->ID ?>">
    <img src="<?= $image ?>" alt="Recruit Process <?= $recruitProcessItem->title ?>">
    <div class="description flex column center">
        <h1 class="color-primary"><?= $recruitProcessItem->post_title ?></h1>
        <p class="color-primary"><?= get_the_content(null, false, $recruitProcessItem) ?></p>
    </div>
</div>
