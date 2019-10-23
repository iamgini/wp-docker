<?php

namespace MailOptin\Core;

use Carbon\Carbon;

class Cron
{
    public function __construct()
    {
        add_action('init', [$this, 'create_recurring_schedule']);
    }

    public function create_recurring_schedule()
    {
        if (!wp_next_scheduled('mo_hourly_recurring_job')) {
            // we are adding 10 mins to give room for timestamp/hourly checking to be correct.
            $tz = Carbon::now(0)->endOfHour()->addMinute(10)->timestamp;

            wp_schedule_event($tz, 'hourly', 'mo_hourly_recurring_job');
        }
    }

    /**
     * Singleton.
     *
     * @return Cron
     */
    public static function get_instance()
    {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }
}