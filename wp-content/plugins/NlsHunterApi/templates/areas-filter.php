<form action="/">
    <select name="select" id="select">
        <option value="0"><?= __('Select', 'NlsHunterApi') ?></option>
        <?php foreach ($areas as $key => $value) : ?>
            <option value="<?= $key ?>"><?= $value ?></option>
        <?php endforeach; ?>
    </select>
    <button type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
</form>
