<div class="nls-search-wrapper <?= isset($searchFormClass) ? $searchFormClass : '' ?>">
    <div class="container content">
        <form name="nls-search" class="nls-search rounded" method="get" action="<?= $searchResultsUrl ?>">
            <div class="nls-field areas select">
                <?= NlsHelper::htmlSelect("areas[]", "nls-search areas", true, $areas, __('Area', 'NlsHunterApi')) ?>
                <div class="nls-validation"></div>
            </div>
            <div class="nls-field job-types select">
                <?= NlsHelper::htmlSelect("jobTypes[]", "nls-search jobTypes", true, $jobTypes, __('Experty', 'NlsHunterApi')) ?>
                <div class="nls-validation"></div>
            </div>
            <div class="nls-field professional-fields select">
                <?= NlsHelper::htmlSelect("professionalFields[]", "nls-search professionalFields", true, $professionalFields, __('Main Professional Field', 'NlsHunterApi')) ?>
                <div class="nls-validation"></div>
            </div>
            <div class="nls-field submit">
                <input type="submit" class="huji-btn bg-primary color-white rounded no-border search icon search-white" value="<?= __('Search', 'NlsHunterApi') ?>">
            </div>
        </form>
    </div>
</div>
