<?php

namespace Api\Pages;

class IndexList extends MainView
{

    public function display($applications, $params)
    {
        parent::$curLinkHome = 'current-link';
        parent::$pageTitle = 'Applications';
        parent::header();

        // Search
        $query = '';
        $filter = "checked='on'";

        // Filtering
        $status1 = "checked='on'";
        $status2 = "checked='on'";
        $status3 = "checked='on'";
        $status4 = "";

        // Sorting
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

        if (count($params) > 0) {
            for ($i = 1; $i <= 4; $i++) {
                if (array_key_exists("filter-$i", $params)) {
                    ${"status$i"} = "checked='on'";
                } else {
                    ${"status$i"} = "";
                }
            }
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

        <form action="http://<?= parent::$host ?>/applications" id="searchForm">
            <div class="sort-filter">
                <select name="date_sort" id="sortList">
                    <option value="apply_date_desc" disabled>Sort By</option>
                    <option value="apply_date_desc" <?= $applyDesc ?>>Apply Date (Desc)</option>
                    <option value="apply_date_asc" <?= $applyAsc ?>>Apply Date (Asc)</option>
                    <option value="last_contact_date_desc" <?= $lastDesc ?>>Last Contacted (Desc)</option>
                    <option value="last_contact_date_asc" <?= $lastAsc ?>>Last Contacted (Asc)</option>
                </select>

                <div id="filterBox" class="filter-closed">
                    <p>Filter</p>
                    <div class="filter-dropdown">
                        <label>
                            Applied <input type="checkbox" name="filter-1" <?= $status1 ?>>
                        </label>
                        <label>
                            Communicating <input type="checkbox" name="filter-2" <?= $status2 ?>>
                        </label>
                        <label>
                            Interviewing <input type="checkbox" name="filter-3" <?= $status3 ?>>
                        </label>
                        <label>
                            Rejected <input type="checkbox" name="filter-4" <?= $status4 ?>>
                        </label>
                    </div>
                </div>
            </div>

            <div class="search-box">
                <input type="text" name="q" value="<?= $query ?>">
                <button type="submit">Search</button>
            </div>
        </form>

        <div class="list-table">
            <div class="header-row">
                <p>Company</p>
                <p>Job Title</p>
                <p>Applied</p>
                <p>Last Contacted</p>
                <p>Status</p>
            </div>

            <?php foreach ($applications as $idx => $app) {
                $odd = $idx % 2 !== 0 ? 'odd-row' : 'list-row';



                $status = $app->status->level;
                ?>

                <a href="http://<?= parent::$host ?>/applications/<?= $app->id ?>" class="<?= $odd ?>">
                    <p><?= $app->company_name ?></p>
                    <p><?= $app->job_title ?></p>
                    <p><?= $app->apply_date ?></p>
                    <p><?= $app->last_contact_date ?></p>
                    <p class="status-<?= $app->status_id ?>"><?= $status ?></p>
                </a>
                <?php
            } ?>
        </div>
        <?php

        parent::footer();
    }
}