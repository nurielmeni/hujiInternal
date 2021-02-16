<?php 
    include_once ABSPATH . 'wp-content/plugins/NlsHunterApi/renderFunction.php';
    $shareImagePath = wp_upload_dir()['baseurl'] . '/share/';
    $url = $jobDetailsPageUrl . '?jobcode=' . $job['jobCode'];
?>
<div class="bottom actions content container rounded bg-white color-primary shadowed-box">
    <div class="flex center">
        <button type="button" class="huji-btn rounded bg-primary color-white">
            <?= __('Apply for job', 'NlsHunterApi') ?>
        </button>
    </div>
    <p class="text-center color-primary"><?= __('Share the job', 'NlsHunterApi') ?></p>
    <?= render('social-job', [
        'url' => $url,
        'shareImagePath' => $shareImagePath,
        'mailTo' => null
    ]) ?>
</div>
