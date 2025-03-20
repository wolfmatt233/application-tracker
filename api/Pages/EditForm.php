<?php

namespace Api\Pages;

class EditForm extends MainView
{
    public function display($id, $application, $status)
    {
        parent::$pageTitle = 'Edit Application';
        parent::$showEdit = 'show-edit current-link';
        parent::$editId = $id;
        parent::header();
        ?>

        <form class="form" action="http://<?= parent::$host ?>/applications/<?= $id ?>" method="POST">
            <input type="hidden" name="_method" value="PATCH">

            <h3>Edit Application</h3>

            <label for="company_name">Company Name</label>
            <input type="text" name="company_name" value="<?= $application->company_name ?>">

            <label for="job_title">Job Title</label>
            <input type="text" name="job_title" value="<?= $application->job_title ?>">

            <label for="job_description">Job Description</label>
            <textarea name="job_description" rows="6">
                    <?= $application->job_description ?>
                    </textarea>

            <label for="apply_date">Application Date</label>
            <input type="date" name="apply_date" value="<?= $application->apply_date ?>">

            <label for="last_contact_date">Last Contact Date</label>
            <input type="date" name="last_contact_date" value="<?= $application->last_contact_date ?>">

            <label for="status_id">Status</label>
            <select name="status_id">
                <?php foreach ($status as $idx => $st) {
                    if ($st->id === $application->status_id) { ?>
                        <option value="<?= $st->id ?>" selected="selected"><?= $st->level ?></option>
                        <?php
                    } else { ?>
                        <option value="<?= $st->id ?> "><?= $st->level ?></option>
                    <?php }
                } ?>
            </select>

            <label for="location">Location</label>
            <input type="text" name="location" value="<?= $application->location ?>">

            <label for="platform">Platform</label>
            <input type="text" name="platform" value="<?= $application->platform ?>">

            <label for="notes">Notes</label>
            <textarea name="notes" rows="6">
                <?= $application->notes ?>
            </textarea>

            <button type="submit" class="submit-btn">Submit</button>
        </form>

        <?php

        parent::footer();
    }
}