<?php 
    include_once ABSPATH . 'wp-content/plugins/NlsHunterApi/renderFunction.php';
    $shareImagePath = '/wp-content/uploads/share/';
?>

<div class="nls-search-results-module content"> 
    <div class="flex space-between v-center actions">
        <a  class="huji-btn btn-md rounded color-white bg-info hover-success" href="<?= $searchPageUrl ?>">
            <?= __('Back', 'NlsHunterApi') ?>
        </a>
    </div>

    <div class="top-title nls-box-shadow">
        <div class="flex space-between align-center bg-primary color-white">
            <span class="title"><?= sprintf(__('Found %s jobs', 'NlsHunterApi'), count($jobs)) ?></span>
            <div class="submit">
                <button class="huji-btn submit-cv border rounded bg-info  hover-success color-white submit-selected" disabled="disabled">
                    <span><?= __('Submit CV several jobs', 'NlsHunterApi') ?></span>
                </button>
            </div>
        </div>
    </div>
          

<!-- JOBS RENDERING -->
    <section id="search-result-jobs" class="flex column">
        <!-- Place holder for form -->
        <div class="job-wrap"></div>

        <?php if ($jobs && is_array($jobs)) : ?>
            <?php foreach ($jobs as $job) : ?>
                <?= render('job', [
                    'job' => $job,
                    'jobDetailsPageUrl' => $jobDetailsPageUrl,
                    'shareImagePath' => $shareImagePath,
                ]) ?>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="description">
                <?= __('No results for the search criteria', 'NlsHunterApi') ?>
            </div>
        <?php endif; ?>

    </section>
<!-- End of JOBS RENDERING -->
</div>
<script>
    // Used to set the url for the Job details page
    var jobDetailsPageUrl = "<?= $jobDetailsPageUrl ?>";
    
    // Used to set the selected options from the submited search form
    var setSelectedSumoOptions = <?= isset($search) ? json_encode($search) : '[]' ?>;

    // Used to set the search page url for the 'New Search Button'
    var searchPageUrl = "<?= isset($serachPageUrl) ? $serachPageUrl : null ?>";
</script>
