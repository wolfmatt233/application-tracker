<?php

namespace Api\Pages;

class MainView
{

    public static $pageTitle = '';
    public static $curLinkHome = '';
    public static $curLinkCreate = '';
    public static $showEdit = '';
    public static $editId = '';

    public static function header()
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="/css/styles.css">
            <link rel="stylesheet" href="/css/header.css">
            <link rel="stylesheet" href="/css/index-list.css">
            <link rel="stylesheet" href="/css/forms.css">
            <link rel="stylesheet" href="/css/view-page.css">
            <link rel="shortcut icon" href="#" type="image/x-icon">
            <title><?= self::$pageTitle ?></title>
        </head>

        <body>

            <div class="app-wrapper">
                <div class="header-wrapper">
                    <div class="header-content">Application & Job Tracker</div>
                </div>
                <div class="nav-wrapper">
                    <nav>
                        <a href="/applications" class="<?= self::$curLinkHome ?>">Home</a>
                        <a href="/applications/create" class="<?= self::$curLinkCreate ?>">Add Application</a>
                        <a href="/applications/<?= self::$editId ?>/edit" class="hide-edit <?= self::$showEdit ?>">
                            Edit Application
                        </a>
                    </nav>
                </div>

                <div class="content-wrapper">
                    <?php
    }

    public static function footer()
    {
        ?>
                </div>
            </div>

            <script src="/js/app.js"></script>
        </body>

        </html>
        <?php
    }
}