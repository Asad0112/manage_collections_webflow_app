<?php
error_reporting(1);
ini_set('display_errors', true);

require_once('config/app.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title><?= APP_NAME; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-3">
        <p>List of Projects associated with the Site IDs: <strong> <?= $siteIdDetails; ?></strong></p>
        <table class="table table-bordered mt-2">
            <thead>
                <tr>
                    <th>Site Name</th>
                    <th>Project Name</th>
                    <th>Project Slug</th>
                    <th>Project Summary</th>
                    <th>Project Client</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projectDetails as $project) { ?>
                    <tr>
                        <td><?= $project['project-details']; ?></td>
                        <td><?= $project['name']; ?></td>
                        <td><?= $project['slug']; ?></td>
                        <td><?= $project['project-summary']; ?></td>
                        <td><?= $project['client']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>