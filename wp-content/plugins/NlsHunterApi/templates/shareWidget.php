<div class="share-widget flex space-between" style="display: none;">
    <a class="share-item copy" data-share-url="<?= $url ?>" href="#_">
        <img src="<?= $shareImagePath . 'link.png' ?>" alt="Mail Icon" />
    </a>
    <a target="_blank" 
    class="share-item mail" 
    href="mailto:<?= $mailTo ?: '' ?>?subject=<?= __('I have found a job for you', 'NlsHunterApi') ?>&body=<?= __('I have found a job for you', 'NlsHunterApi') . urlencode("\n\r" . $url . "\n\r") ?>">
        <img src="<?= $shareImagePath . 'mail.png' ?>" alt="Mail Icon" />
    </a>
    <a target="_blank" class="share-item " href="https://api.whatsapp.com/send?text=<?= urlencode($url) . '  ' . __('I have found a job for you', 'NlsHunterApi') ?>">
        <img src="<?= $shareImagePath . 'whatsapp.png' ?>" alt="Whatsapp Icon" />
    </a>
    <a target="_blank" class="share-item linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode($url) ?>">
        <img src="<?= $shareImagePath . 'linkedin.png' ?>" alt="Linked In Icon" />
    </a>
    <a target="_blank" class="share-item facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($url) ?>">
        <img src="<?= $shareImagePath . 'facebook.png' ?>" alt="Facebook Icon" />
    </a>
</div>