<section class="popup backdrop flex center align-center" style="display: none;">
    <div class="card-wrapper bg-white rounded shadowed-box">
        <div class="card-header bg-primary color-white">
            <span class="close color-white">x</span>
            <h4 class="text-bold text-center"><?= __('Submit additionsl documents', 'NlsHunterApi') ?></h4>
        </div>
        <div class="card-body">
            <form>
                <div class="nls-apply-field">
                    <label for="email"><?= __('Email', 'NlsHunterApi') ?></label>
                    <input type="email" name="email" validator="required email" class="ltr" aria-invalid="false" aria-required="true">
                    <div class="help-block"></div>
                </div>
                <div class="nls-apply-field">
                    <label for="cell"><?= __('Cell phone', 'NlsHunterApi') ?></label>
                    <input type="hidden" name="cell" class="ltr" validator="phone" aria-invalid="false" aria-required="false">
                    <div class="flex space-between">
                        <input type="tel" name="cellNumber" class="ltr" aria-invalid="false" aria-required="false">
                        <span class="text-center cell-devider">-</span>
                        <input type="text" name="cellPrepend" aria-invalid="false" aria-required="false">
                    </div>
                    <div class="help-block"></div>
                </div>
                <div class="nls-apply-field browse">
                    <input type="file" name="addFile" class="file-hidden-field" style="display: none;">
                    <label for="addFile"><?= __('Upload documents', 'NlsHunterApi') ?></label>
                    <div class="flex">
                        <button type="button" class="addFile" field-id="addFile">בחר/י קובץ</button>
                        <input type="text" name="addFileName" readonly="readonly" class="ltr" validator="required" aria-invalid="false" aria-required="true">
                    </div>
                    <div class="help-block"></div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <button type="button" class="send-document huji-btn color-white bg-primary rounded"><?= __('Send', 'NlsHunterApi') ?></button>
            <div class="help-block" style="display: none;"><?= __('One or more fields are invalid', 'NlsHunterApi') ?></div>
        </div>
    </div>
</section>