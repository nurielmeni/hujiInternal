<?php 
    include_once ABSPATH . 'wp-content/plugins/NlsHunterApi/renderFunction.php';
    $shareImagePath = wp_upload_dir()['baseurl'] . '/share/';
?>
<div class="banner job-details bg-primary color-white flex column center align-center">
    <h1 class="text-center"><?= $job['jobTitle'] ?></h1>
    <p class="flex align-center text-center">
        <label><?= __('Last application date', 'NlsHunterApi') ?></label>
        <?= empty($job['lastApplyDate']) ? '(לא הוגדר)' : $job['lastApplyDate'] ?>
    </p>
</div>

<div class="actions flex space-between content">
    <button class="huji-btn outlined rounded icon-right">
        <a href="<?= $referer ?>"><?= __('Back to search results', 'NlsHunterApi') ?></a>
    </button>
</div>

<div class="main-content content bg-light-gray">

    <div class="container bg-white color-primary shadowed-box">
        
        <?= render('content-job', [
            'jobDetails' => $jobDetails,
            'job' => $job
        ]) ?>


        <div class="disclaimer bg-warning color-primary">
            <section class="content">
                <ul>
                    <li><?= __('Very long text first line', 'NlsHunterApi') ?></li>
                    <li><?= __('Very long text secound line', 'NlsHunterApi') ?></li>
                </ul>
                <p><?= __('Very long text arab text', 'NlsHunterApi') ?></p>
            </section>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function() {
        jQuery('input[name="jobIds"]').val("<?= $job['jobCode'] ?>");
    });
</script>