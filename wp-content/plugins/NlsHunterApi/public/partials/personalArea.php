<?php 
    include_once ABSPATH . 'wp-content/plugins/NlsHunterApi/renderFunction.php';
?>
<div class="main-content">
    <div class="container">
        <?= render('page-header', [
            'title' => __('Personal area', 'NlsHunterApi')
        ]) ?>
        <div class="box-personal">
            
            <?php foreach($personalItems as $personalItem) : ?>
                <?= render('personal-item', [
                    'personalItem' => $personalItem,
                ]) ?>
            <?php endforeach; ?>
            
        </div>
    </div>
</div>

