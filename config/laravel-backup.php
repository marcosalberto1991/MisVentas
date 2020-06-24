<?php

return [

    'backup' => [

        /*
         * The name of this application. You can use this name to monitor
         * the backups.
         */
        'name' => env('APP_URL_BACKUP'),

        'source' => [

            'files' => [

                /*
                 * The list of directories that should be part of the backup. You can
                 * specify individual files as well.
                 */
                'include' => [
                    base_path(),
                ],

                /*
                 * These directories will be excluded from the backup.
                 * You can specify individual files as well.
                 */
                'exclude' => [
                    base_path('vendor'),
                    base_path('node_modules'),
                    storage_path(),
                ],

                /*
                 * Determines if symlinks should be followed.
                 */
                'followLinks' => false,
            ],

            /*
             * The names of the connections to the databases that should be part of the backup.
             * Currently only MySQL- and PostgreSQL-databases are supported.
             */
            'databases' => [
                'mysql',
            ],
        ],

        'destination' => [

            /*
             * The disk names on which the backups will be stored.
             */
            'disks' => [
                'backups',
            ],
        ],
    ],

    'cleanup' => [
        /*
         * The strategy that will be used to cleanup old backups.
         * The youngest backup will never be deleted.
         */
        'strategy' => \Spatie\Backup\Tasks\Cleanup\Strategies\DefaultStrategy::class,

        'defaultStrategy' => [

            /*
             * The amount of days that all backups must be kept.
             La cantidad de días que se deben mantener todas las copias de seguridad.
             */
            'keepAllBackupsForDays' => 7,

            /*
             * La cantidad de días que se deben mantener todas las copias de seguridad diarias
.
             */
            'keepDailyBackupsForDays' => 16,

            /*
             * The amount of weeks of which one weekly backup must be kept.
             La cantidad de semanas de las cuales una copia de seguridad semanal debe mantenerse

             */
            'keepWeeklyBackupsForWeeks' => 8,

            /*
             * The amount of months of which one monthly backup must be kept.
             La cantidad de meses de los cuales una copia de seguridad mensual debe mantenerse

             */
            'keepMonthlyBackupsForMonths' => 4,

            /*
             * The amount of years of which one yearly backup must be kept.
             La cantidad de meses de los cuales una copia de seguridad mensual debe ser mantenida
             */
            'keepYearlyBackupsForYears' => 2,

            /*
             * After cleaning up the backups remove the oldest backup until
             * this amount of megabytes has been reached.
             */
            'deleteOldestBackupsWhenUsingMoreMegabytesThan' => 5000
        ]
    ],


    /*
     *  In this array you can specify which backups should be monitored.
     *  If a backup does not meet the specified requirements the
     *  UnHealthyBackupWasFound-event will be fired.
     */
    'monitorBackups' => [
        [
            'name' => env('APP_URL_BACKUP'),
            'disks' => ['backups'],
            'newestBackupsShouldNotBeOlderThanDays' => 1,
            'storageUsedMayNotBeHigherThanMegabytes' => 5000,
        ],

        /*
        [
            'name' => 'name of the second app',
            'disks' => ['local', 's3'],
            'newestBackupsShouldNotBeOlderThanDays' => 1,
            'storageUsedMayNotBeHigherThanMegabytes' => 5000,
        ],
        */
    ],

    'notifications' => [

        /*
         * This class will be used to send all notifications.
         */
        'handler' => Spatie\Backup\Notifications\Notifier::class,

        /*
         * Here you can specify the ways you want to be notified when certain
         * events take place. Possible values are "log", "mail", "slack", 
         * "pushover", and "telegram".
         *
         * Slack requires the installation of the maknz/slack package.
         * Telegram requires the installation of the irazasyed/telegram-bot-sdk package.
         */
        'events' => [
            'whenBackupWasSuccessful'     => ['log'],
            'whenCleanupWasSuccessful'    => ['log'],
            'whenHealthyBackupWasFound'   => ['log'],
            'whenBackupHasFailed'         => ['log', 'mail'],
            'whenCleanupHasFailed'        => ['log', 'mail'],
            'whenUnhealthyBackupWasFound' => ['log', 'mail'],
        ],

        /*
         * Here you can specify how emails should be sent.
         */
        'mail' => [
            'from' => 'your@email.com',
            'to'   => 'once.marcos.alberto@gmail.com',
        ],

        /*
         * Here you can specify how messages should be sent to Slack.
         */
        'slack' => [
            'channel'  => '#backups',
            'username' => 'Backup bot',
            'icon'     => ':robot:',
        ],

        /*
         * Here you can specify how messages should be sent to Pushover.
         */
        'pushover' => [
            'token'  => env('PUSHOVER_APP_TOKEN'),
            'user'   => env('PUSHOVER_USER_KEY'),
            'sounds' => [
                'success' => env('PUSHOVER_SOUND_SUCCESS', 'pushover'),
                'error'   => env('PUSHOVER_SOUND_ERROR', 'siren'),
            ],
        ],
        
        /*
         * Here you can specify how messages should be sent to Telegram Bot API.
         */
        'telegram' => [
            'bot_token' => env('TELEGRAM_BOT_TOKEN'),
            'chat_id'   => env('TELEGRAM_CHAT_ID'),
            'async_requests' => env('TELEGRAM_ASYNC_REQUESTS', false),
            'disable_web_page_preview' => env('TELEGRAM_DISABLE_WEB_PAGE_PREVIEW', true),
        ],
    ]
];
