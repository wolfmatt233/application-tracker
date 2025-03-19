<?php

namespace Api\Pages;

class IndexList extends MainView
{

    public function display($applications, $params)
    {
        parent::$curLinkHome = 'current-link';
        parent::$pageTitle = 'Applications';
        parent::header();

        $query = '';
        $filter = "checked='on'";
        $dateSort = '';
        $applyDesc = '';
        $applyAsc = '';
        $lastDesc = '';
        $lastAsc = '';

        if (count($params) > 0) {
            $query = isset($params['filter']) ? $params['q'] : '';
            $filter = isset($params['filter']) ? 'checked="' . $params['filter'] . '"' : '';
            $dateSort = $params['date_sort'];
        }

        switch ($dateSort) {
            case 'apply_date_desc':
                $applyDesc = 'selected';
                break;
            case 'apply_date_asc':
                $applyAsc = 'selected';
                break;
            case 'last_contact_date_desc':
                $lastDesc = 'selected';
                break;
            case 'last_contact_date_asc':
                $lastAsc = 'selected';
                break;
            default:
                $applyDesc = 'selected';
                break;
        }

        ?>

        <form action="http://localhost:5000/applications" id="searchForm">
            <div class="sort-filter">
                <select name="date_sort" id="sortList">
                    <option value="apply_date_desc" disabled>Sort By</option>
                    <option value="apply_date_desc" <?= $applyDesc ?>>Apply Date (Desc)</option>
                    <option value="apply_date_asc" <?= $applyAsc ?>>Apply Date (Asc)</option>
                    <option value="last_contact_date_desc" <?= $lastDesc ?>>Last Contacted (Desc)</option>
                    <option value="last_contact_date_asc" <?= $lastAsc ?>>Last Contacted (Asc)</option>
                </select>
                <div class="filter-closed">
                    <p>Filter</p>
                    <div class="filter-dropdown">
                        <p>
                            Applied <input type="checkbox" name="filter-1" value="1">
                        </p>
                        <p>
                            Communicating <input type="checkbox" name="filter-2" value="1">
                        </p>
                        <p>
                            Interviewing <input type="checkbox" name="filter-3" value="1">
                        </p>
                        <p>
                            Rejected <input type="checkbox" name="filter-4" value="1">
                        </p>
                    </div>
                </div>
                <div class="checkbox-filter">
                    <label for="filter">Remove rejected</label>
                    <input type="checkbox" name="filter" <?= $filter ?> id="filterList">
                </div>

            </div>

            <div class="search-box">
                <input type="text" name="q" value="<?= $query ?>">
                <button type="submit">Search</button>
            </div>
        </form>

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