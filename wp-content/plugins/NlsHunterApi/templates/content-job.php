<div class="job-header bg-warning flex space-between">
    <div class="info-part flex column">
        <span class="label text-bold"><?= __('Jod Code', 'NlsHunterApi') ?></span>
        <span class="value">  <?= $jobDetails['JobCode'] ?></span>
    </div>
    <div class="info-part flex column">
        <span class="label text-bold"><?= __('Employment Type', 'NlsHunterApi') ?></span>
        <span class="value">  <?= $jobDetails['EmploymentType'] ?></span>
    </div>
    <div class="info-part flex column">
        <span class="label text-bold"><?= __('Region Text', 'NlsHunterApi') ?></span>
        <span class="value">  <?= $job['regionText'] ?></span>
    </div>
</div>
<div class="content-job">
    <div class="box-job first">
        <h2 class="text-bold"><?= __('Jod Description', 'NlsHunterApi') ?></h2>
        <?= $jobDetails['Description'] ?>
    </div>
    <div class="box-job">
        <h2 class="text-bold"><?= __('Job Requirements', 'NlsHunterApi') ?></h2>
        <?= $jobDetails['Requirements'] ?>
    </div>
    <div class="box-job">
        <h2 class="text-bold"><?= __('Job Skills', 'NlsHunterApi') ?></h2>
        <?= $jobDetails['Skills'] ?>
    </div>
</div>
