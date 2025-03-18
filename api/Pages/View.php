<?php

namespace Api\Pages;

class View extends MainView
{

    public function display($application)
    {
        parent::$showEdit = 'show-edit';
        parent::$pageTitle = $application->job_title;
        parent::$editId = $application->id;
        parent::header();
        ?>

        <div class="view-title">
            <h3><?= $application->company_name ?> | <?= $application->job_title ?></h3>
            <p>
                Applied: <?= $application->apply_date ?> |
                Last Contacted: <?= $application->last_contact_date ?> |
                Status: <?= $application->status->level ?>
            </p>
            <p>
                <?= $application->location ?> | <?= $application->platform ?>
            </p>
        </div>

        <div class="half-wrapper">
            <div class="text-wrapper">
                <h4>Job Description</h4>
                <p><?= nl2br(htmlspecialchars($application->job_description)) ?></p>
            </div>
            <div class="text-wrapper">
                <h4>Notes</h4>
                <p><?= nl2br(htmlspecialchars($application->notes)) ?></p>
            </div>
        </div>
        </div>
        <?php
        parent::footer();
    }
}