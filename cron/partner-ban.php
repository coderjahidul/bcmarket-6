<?php 
    // cron job to ban users partner unbaned by automatically
    $current_datetimes = current_time('mysql'); // Get the current datetime in MySQL format
    $current_datetime = date('Y-m-d H:i', strtotime($current_datetimes));

    // Get the 'account_status_datetime' meta value for the user
    $account_status_datetimes = get_user_meta($user->ID, 'account_status_datetime', true);
    $account_status_datetime = str_replace('T', ' ', $account_status_datetimes);

    $ban_timestamp = strtotime($account_status_datetime);
    $current_timestamp = strtotime($current_datetime);

    // Compare 'account_status_datetime' with the current datetime
    if ($ban_timestamp <= $current_timestamp) {
        // Update 'account_status' to an empty string
        update_user_meta($user->ID, 'account_status', '');
        update_user_meta($user->ID, 'account_status_datetime', '');
    }
?>