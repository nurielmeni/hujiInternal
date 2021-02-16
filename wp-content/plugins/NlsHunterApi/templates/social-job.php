<div class="social-share flex center">
    <ul class="flex center">
        <li class="bordered rounded">
            <a aria-label="copy" class="share-item copy" data-share-url="<?= $url ?>" href="#_">
                <img src="<?= $shareImagePath . 'link.png' ?>" alt="link Icon"  width="24" height="24"/>
            </a>
        </li>
        <li class="bordered rounded">
            <a  target="_blank" aria-label="mail" href="mailto:<?= $mailTo ?: '' ?>?subject=<?= __('I have found a job for you', 'NlsHunterApi') ?>&body=<?= __('I have found a job for you', 'NlsHunterApi') . urlencode("\n\r" . $url . "\n\r") ?>">
                <img src="<?= $shareImagePath . 'mail.png' ?>" alt="Mail Icon"  width="24" height="24"/>
            </a>
        </li>
        <li class="bordered rounded">
            <a target="_blank" aria-label="whatsapp"  href="https://api.whatsapp.com/send?text=<?= urlencode($url) . '  ' . __('I have found a job for you', 'NlsHunterApi') ?>">
                <img src="<?= $shareImagePath . 'whatsapp.svg' ?>" width="24" height="24" />
            </a>
        </li>
        <li class="bordered rounded">
            <a target="_blank" aria-label="linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode($url) ?>">
                <img src="<?= $shareImagePath . 'linkedin.svg' ?>" width="24" height="24" />
            </a>
        </li>
        <li class="bordered rounded">
            <a target="_blank" aria-label="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($url) ?>">
                <img src="<?= $shareImagePath . 'facebook.svg' ?>" width="24" height="24" />
            </a>
        </li>
    </ul>
</div>
