<?php

namespace Api\Pages;

include 'header.php';
?>

<p>Application List</p>

<div class="list-row odd-row">
    <p>Id</p>
    <p>Company</p>
    <p>Job Title</p>
    <p>Application Date</p>
    <p>Last Contact Date</p>
    <p>Status</p>
</div>

<?php foreach ($applications as $idx => $app) {
    $odd = '';

    if ($idx + 1 % 2 === 0) {
        $odd = ' odd-row';
    }

    $statusColor = '';
    switch ($app->status) {
        case 'Applied':
            # code...
            break;
        case 'Communicating':
            # code...
            break;
        case 'Interviewing':
            # code...
            break;
        case 'Rejected':
            # code...
            break;
        default:
            # code...
            break;
    }
    ?>

    <a href="http://localhost:5000/applications/<?= $app->id ?>" class="list-row <?= $odd ?>">
        <p><?= $app->id ?></p>
        <p><?= $app->company_name ?></p>
        <p><?= $app->job_title ?></p>
        <p><?= $app->apply_date ?></p>
        <p><?= $app->last_contact_date ?></p>
        <p><?= $app->status->status ?></p>
    </a>
<?php }

include 'footer.php';