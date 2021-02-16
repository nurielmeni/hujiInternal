<div class="tab-job">
    <?php foreach($professionalFields as $id => $text) : ?>
        <a href="<?= $searchResultsUrl . '?' . $attribute . '[]=' . $id ?>"><?= $text ?></a>
    <?php endforeach; ?>
</div>
