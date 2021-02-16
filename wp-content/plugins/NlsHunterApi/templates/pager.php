<!--				
                <div class="pagenavi">	
					<a href="#" class="next-steps"><</a>
					<a href="#">5</a>
					<a href="#">4</a>
					<a href="#">3</a>
					<a href="#">2</a>
					<a href="#" class="active">1</a>
					<a href="#" class="back-steps">></a>
				</div>
-->
<div class="nls-pager">
    <div class="pagenavi">

        <a href="<?= $model->getPagerUrl(0) ?>" <?= $model->getPagerData($jobs, $offset, false, 'next-steps') ?>><?= __('Prev', 'NlsHunterApi') ?></a>
        <a href="<?= $model->getPagerUrl(-1) ?>" <?= $model->getPagerData($jobs, $offset, true, 'back-steps') ?>><?= __('Next', 'NlsHunterApi') ?></a>

    </div>
    <div class="step-next pagenavis">	
        <a href="<?= $searchResultsUrl ?>" class="back-step">לכל המשרות ></a>
    </div>
</div>
