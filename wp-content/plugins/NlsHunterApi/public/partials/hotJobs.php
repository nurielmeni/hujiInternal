<div class="nls-hot-jobs-module">
    <h1 class="title taas-title"><?= __('Hot Jobs', 'NlsHunterApi') ?></h1>
    <div class="hot-jobs-wrapper">
        <?php foreach ($hotjobs as $hotjob) : ?>
        <div class="hot-job">
            <div class="info" job-id="<?= $hotjob['jobId'] ?>">
                <div class="hot-job-name"><span class=""><?= $hotjob['jobTitle'] ?></span></div>
                <div class="more-details"  job-id="<?= $hotjob['jobId'] ?>"><span class=""><?= __('More Details', 'NlsHunterApi') ?><i>></i></span></div>
            </div>
            <div class="submit-cv nls-green" job-id="<?= $hotjob['jobId'] ?>"><?= __('Submit CV', 'NlsHunterApi') ?></div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<script>
    // Used to set the url for the Job details page
    var jobDetailsPageUrl = "<?= $jobDetailsPageUrl ?>";
</script>