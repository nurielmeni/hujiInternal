<div class="nls-social">
    <?php if (strlen($nlsSocialMailTo) && $nlsSocialMailTo !== "not-set") : ?>
        <a class="social mailto" target="_blank" href="mailto:<?= $nlsSocialMailTo ?>"></a>
    <?php endif; ?>
    <?php if (strlen($nlsSocialWeb) && $nlsSocialWeb !== "not-set") : ?>
        <a class="social internet" target="_blank" href="<?= $nlsSocialWeb ?>"></a>
    <?php endif; ?>
    <?php if (strlen($nlsSocialInsta) && $nlsSocialInsta !== "not-set") : ?>
        <a class="social instagram" target="_blank" href="<?= $nlsSocialInsta ?>"></a>
    <?php endif; ?>
    <?php if (strlen($nlsSocialIn) && $nlsSocialIn !== "not-set") : ?>
        <a class="social linkedin" target="_blank" href="<?= $nlsSocialIn ?>"></a>
    <?php endif; ?>
    <?php if (strlen($nlsSocialFace) && $nlsSocialFace !== "not-set") : ?>
        <a class="social facebook" target="_blank" href="<?= $nlsSocialFace ?>"></a>
    <?php endif; ?>
</div>
