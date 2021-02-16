<div class="nls-apply-for-jobs modal bg-white shadowed-box rounded" style="display: none;">
    <div class="modal-content">
        <div class="modal-body send">
            <form name="nls-apply-for-jobs">
                <input type="hidden" name="jobIds" class="jobids-hidden-field">
                <input type="hidden" name="sid" class="sid-hidden-field" value="<?= $supplierId ?>">

                <!--  NAME -->
                <div class="nls-apply-field">
                    <label for="firstName"><?= __('First Name', 'NlsHunterApi') ?></label>
                    <input 
                        type="text" 
                        name="firstName" 
                        validator="required"
                        class="" 
                        aria-invalid="false" 
                        aria-required="true">
                    <div class="help-block"></div>
                </div>       

                <!--  NAME -->
                <div class="nls-apply-field">
                    <label for="lastName"><?= __('Last Name', 'NlsHunterApi') ?></label>
                    <input 
                        type="text" 
                        name="lastName" 
                        validator="required"
                        class="" 
                        aria-invalid="false" 
                        aria-required="true">
                    <div class="help-block"></div>
                </div>       

                <!--  ID -->
                <div class="nls-apply-field">
                    <label for="federalId"><?= __('ID', 'NlsHunterApi') ?></label>
                    <input 
                        type="text" 
                        name="federalId" 
                        validator="required ISRID"
                        class="ltr" 
                        aria-invalid="false" 
                        aria-required="true">
                    <div class="help-block"></div>
                </div>   
                
                <!--  EMAIL -->
                <div class="nls-apply-field">
                    <label for="email"><?= __('email', 'NlsHunterApi') ?></label>
                    <input 
                        type="email" 
                        name="email" 
                        validator="required email"
                        class="ltr" 
                        aria-invalid="false" 
                        aria-required="true">
                    <div class="help-block"></div>
                </div>       
                
                <!--  CELL PHONE -->
                <div class="nls-apply-field">
                    <label for="cell"><?= __('Cell', 'NlsHunterApi') ?></label>
                    <input 
                        type="tel" 
                        name="cell" 
                        class="ltr" 
                        validator="required phone"
                        aria-invalid="false" 
                        aria-required="true">
                    <div class="help-block"></div>
                </div>   
                
                <!--  HAS WORKED -->
                <div class="nls-apply-field">
                    <label><?= __('Worked before', 'NlsHunterApi') ?></label>
                    <div class="options-wrapper">
                        <div class="radio-option">
                            <input id="workedBeforeYes" type="radio" name="workedBefore" value="yes" validator="radioRequired">
                            <label for="workedBeforeYes"><?= __('Yes', 'NlsHunterApi') ?></label>
                        </div>
                        <div class="radio-option">
                            <input id="workedBeforeNo" type="radio" name="workedBefore" value="no">
                            <label for="workedBeforeNo"><?= __('No', 'NlsHunterApi') ?></label>
                        </div>
                    </div>
                    <div class="help-block"></div>
                </div>                    
                
                <!--  RELATIVE -->
                <div class="nls-apply-field">
                    <label>
                        <?= __('Relatives in the company?', 'NlsHunterApi') ?>
                        <span class="tooltip badge-outlined color-warning" title="<?= __('Relatives in the company help text', 'NlsHunterApi') ?>">?</span>
                    </label>
                    <div class="options-wrapper" validator="required">
                        <div class="radio-option">
                            <input id="relativeYes" type="radio" name="relative" value="yes" validator="radioRequired">
                            <label for="relativeYes"><?= __('Yes', 'NlsHunterApi') ?></label>
                        </div>
                        <div class="radio-option">
                            <input id="relativeNo" type="radio" name="relative" value="no">
                            <label for="relativeNo"><?= __('No', 'NlsHunterApi') ?></label>
                        </div>
                    </div>
                    <div class="help-block"></div>
                </div>      

                <!--  RELATIVE NAME -->
                <div class="nls-apply-field relative-show">
                    <label for="relativeName"><?= __('Relative Name', 'NlsHunterApi') ?></label>
                    <input 
                    type="text" 
                    name="relativeName" 
                    class=""                  
                    validator="required"
                    aria-invalid="false" 
                    aria-required="true">
                    <div class="help-block"></div>
                </div>       

                <!--  RELATION -->
                <div class="nls-apply-field relative-show">
                    <label for="relation"><?= __('Relation', 'NlsHunterApi') ?></label>
                    <input 
                    type="text" 
                    name="relation" 
                    class=""                  
                    validator="required"
                    aria-invalid="false" 
                    aria-required="true">
                    <div class="help-block"></div>
                </div>       

                <!--  HAVE REQUIRED CERTIFICATES -->
                <div class="nls-apply-field">
                    <label><?= __('Required Certificates', 'NlsHunterApi') ?></label>
                    <div class="options-wrapper">
                        <div class="radio-option">
                            <input 
                                id="requiredCertificatesYes" 
                                type="radio" 
                                name="requiredCertificates" 
                                value="yes" 
                                msg="היה ואין ברשותך את התעודות שנדרשו, לא נוכל לשקול את מועמדותך לתפקיד"
                                validator="radioYesOnly">
                            <label for="requiredCertificatesYes"><?= __('Yes', 'NlsHunterApi') ?></label>
                        </div>
                        <div class="radio-option">
                            <input id="requiredCertificatesNo" type="radio" name="requiredCertificates" value="no">
                            <label for="requiredCertificatesNo"><?= __('No', 'NlsHunterApi') ?></label>
                        </div>
                    </div>
                    <div class="help-block"></div>
                </div>                    

                <!--  REFERER -->
                <?php if (isset($referers)) : ?>
                    <div class="nls-apply-field options select">
                        <label for="referer"><?= __('How did you get to us', 'NlsHunterApi') ?></label>
                        <?= NlsHelper::htmlSelect("referer", "nls-search referer", false, $referers) ?>
                        <div class="nls-validation"></div>
                    </div>

                    <!--  REFERER NAME -->
                    <div class="nls-apply-field referer-show-freind" style="display: none;">
                        <label for="refererName"><?= __('Referer Name', 'NlsHunterApi') ?></label>
                        <input 
                        type="text" 
                        name="refererName" 
                        class=""                  
                        validator="required"
                        aria-invalid="false" 
                        aria-required="true">
                        <div class="help-block"></div>
                    </div>       

                <?php endif; ?>

                <!--  FILE NAME -->
                <div class="nls-apply-field browse">
                    <input type="file" name="cvFile" accept=".doc,.docx,.rtf,.txt,.pdf" class="file-hidden-field" style="display: none;">
                    <label for="cvFile"><?= __('Append CV File', 'NlsHunterApi') ?></label>
                    <div class="flex">
                        <button type="button" class="cvFile" field-id="cvFile"><?= __('Browse File', 'NlsHunterApi') ?></button>
                        <input 
                            type="text" 
                            name="cvFileName" 
                            readonly="readonly"
                            class="ltr" 
                            validator="required fileSize"
                            aria-invalid="false" 
                            aria-required="true">
                    </div>
                    <div class="help-block"></div>
                </div>   
                
                <!--  OTHER FILES -->
                <div class="nls-apply-field browse">
                    <input type="file" name="otherFile" class="file-hidden-field" style="display: none;" >
                    <label for="otherFile"><?= __('Other Files', 'NlsHunterApi') ?></label>
                    <div class="flex">
                        <button type="button" class="otherFile" field-id="otherFile"><?= __('Browse File', 'NlsHunterApi') ?></button>
                        <input 
                            type="text" 
                            name="otherFileName" 
                            readonly="readonly"
                            validator="fileSize"
                            class="ltr" 
                            aria-invalid="false" 
                            aria-required="false">
                    </div>
                    <div class="help-block"></div>
                </div>   
                
            </form>
        </div>
        <div class="modal-footer send text-center">
            <button type="button" class="apply-cv huji-btn color-white bg-primary rounded"><?= __('Submit CV', 'NlsHunterApi') ?></button>
            <div class="help-block">
                
            </div>
        </div>
    </div>
</div>