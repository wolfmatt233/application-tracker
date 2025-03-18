<?php

namespace Api\Pages;

class CreateForm extends MainView
{
    public function display($status)
    {
        parent::$pageTitle = 'Add Application';
        parent::$curLinkCreate = 'current-link';
        parent::header();
        ?>

        <form class="form" action="http://localhost:5000/applications" method="POST">
            <h3>Add Application</h3>

            <label for="company_name">Company Name</label>
            <input type="text" name="company_name">

            <label for="job_title">Job Title</label>
            <input type="text" name="job_title">

            <label for="job_description">Job Description</label>
            <textarea name="job_description" rows="6"></textarea>

            <label for="apply_date">Application Date</label>
            <input type="date" name="apply_date">

            <label for="last_contact_date">Last Contact Date</label>
            <input type="date" name="last_contact_date">

            <label for="status">Status</label>
            <select name="status">
                <option value="1" selected="selected">Select</option>
                <?php foreach ($status as $idx => $st) { ?>
                    <option value="<?= $st->id ?> "><?= $st->level ?></option>
                <?php } ?>
            </select>

            <label for="location">Location</label>
            <input type="text" name="location">

            <label for="platform">Platform</label>
            <input type="text" name="platform">

            <label for="notes">Notes</label>
            <textarea name="notes" rows="6"></textarea>

            <input type="submit" value="Submit">
        </form>

        <?php
        parent::footer();
    }
}