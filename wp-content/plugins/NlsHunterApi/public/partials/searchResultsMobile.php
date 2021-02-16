<div class="nls-search-results-module mobile">
    <h1 class="title taas-title"><?= __('Search Results', 'NlsHunterApi') ?></h1>
    
    <div id="nls-search-results-new-search"><?= __('New Search', 'NlsHunterApi') ?></div>
      
    <?php foreach ($jobs as $job) : ?>
    <div class="nls-job-mobile">
        <h3 class="sr-name"><a class="job-details" href="http://82.166.132.15/nlshunterapi/sample-page/%D7%A4%D7%A8%D7%98%D7%99-%D7%9E%D7%A9%D7%A8%D7%94/?jobId=<?= $job['jobId'] ?>"><?= $job['jobTitle'] ?></a></h3>
        <article class="nls-job-details"><?= $job['description'] ?></article>
        <p class="submit"><button job-id="<?= $job['jobId'] ?>" class="submit-cv nls-button nls-green"><?= __('Submit CV', 'NlsHunterApi') ?></button></p>
        <div class="actions">
            <div class="share">
                <span class="share"><?= __('Share Job', 'NlsHunterApi') ?></span>
                <a class="social-share" job-title="<?= $job['jobTitle'] ?>" job-id="<?= $job['jobId'] ?>" href="#social"></a>
            </div>
            <div class="submit">
                <input type="checkbox" job-id="<?= $job['jobId'] ?>">
                <span class="submit"><?= __('Submit Several Jobs', 'NlsHunterApi') ?></span>
            </div>
        </div>
    </div>   
    <?php endforeach; ?>
    
    <div class="nls-actions">
        <div class="pager mobile">
            <div <?= $this->getPagerData($jobs, $offset, false) ?>><?= __('Prev', 'NlsHunterApi') ?></div>
            <div <?= $this->getPagerData($jobs, $offset, true) ?>><?= __('Next', 'NlsHunterApi') ?></div>
        </div>
    </div> 
</div>
<script>
    // Used to set the url for the Job details page
    var jobDetailsPageUrl = "<?= $jobDetailsPageUrl ?>";
    
    // Used to set the selected options from the submited search form
    var setSelectedSumoOptions = <?= json_encode($search) ?>;

    // Used to set the search page url for the 'New Search Button'
    var searchPageUrl = "<?= $searchPageUrl ?>";
</script>
