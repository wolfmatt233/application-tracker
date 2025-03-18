<?php

namespace Api\Pages;

class IndexList extends MainView
{

    public function display($applications)
    {
        parent::$curLinkHome = 'current-link';
        parent::$pageTitle = 'Applications';
        parent::header();
        ?>

        <div class="table">
            <div class="row odd-row list-header">
                <p class="col">ID</p>
                <p class="col">Company</p>
                <p class="col">Job Title</p>
                <p class="col">Application Date</p>
                <p class="col">Last Contact Date</p>
                <p class="col">Status</p>
            </div>

            <?php foreach ($applications as $idx => $app) {
                $odd = '';

                if ($idx % 2 !== 0) {
                    $odd = 'odd-row';
                }

                $status = $app->status->level;
                ?>

                <a href="http://localhost:5000/applications/<?= $app->id ?>" class="row <?= $odd ?>">
                    <p class="col"><?= $app->id ?></p>
                    <p class="col"><?= $app->company_name ?></p>
                    <p class="col"><?= $app->job_title ?></p>
                    <p class="col"><?= $app->apply_date ?></p>
                    <p class="col"><?= $app->last_contact_date ?></p>
                    <p class="col status-<?= $app->status_id ?>"><?= $status ?></p>
                </a>
                <?php
            } ?>
        </div>
        <?php

        parent::footer();
    }
}