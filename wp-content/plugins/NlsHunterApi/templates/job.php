<div class="job-wrap flex column space-between rounded">
    <div class="top-wrap flex color-black bg-light-gray">
        <div class="sr-select flex column space-between">
            <label class="job-title text-bold" for="<?= $job['jobCode'] ?>">
                <input type="checkbox" id="<?= $job['jobCode'] ?>" name="<?= $job['jobCode'] ?>" jobcode="<?= $job['jobCode'] ?>">
                <?= $job['jobTitle'] ?>
            </label>
            <p class="kampus"><?= $job['regionText'] ?></p>
        </div>
        <div class="last-date push-left flex column">
            <?= empty($job['lastApplyDate']) ? '(לא הוגדר)' : $job['lastApplyDate'] ?>
            <label><?= __('Last application date', 'NlsHunterApi') ?></label>
        </div>
    </div>

    <div class="main-wrap flex space-between">
        <div class="right flex column space-between color-primary">
            <div class="description">
                <div class="sr-job-details"><?= $job['description'] ?></div>
            </div>

            <div class="more text-bold">                        
                <a href="<?= add_query_arg(['jobcode' => $job['jobCode']], $jobDetailsPageUrl) ?>" class="sr-name"><?= __('Read more', 'NlsHunterApi') ?></a>
            </div>
        </div>

        <div class="footer flex column space-between">
            <button jobcode="<?= $job['jobCode'] ?>" class="huji-btn btn-md bg-primary color-white rounded submit-cv"><?= __('Submit CV', 'NlsHunterApi') ?></button>
            <button class="huji-btn outlined rounded color-black share" job-title="<?= $job['jobTitle'] ?>"><?= __('Share Job', 'NlsHunterApi') ?></button>
            <?= render('shareWidget', [
                'shareImagePath' => $shareImagePath,
                'jobTitle' => $job['jobTitle'],
                'jobDescription' => $job['description'],
                'mailTo' => get_option(NlsHunterApi_Admin::NLS_SOCIAL_MAIL_TO),
                'url' => $jobDetailsPageUrl . '?jobcode=' . $job['jobCode']
            ]) ?>
        </div>
    </div>

</div>
