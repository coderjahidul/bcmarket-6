<?php
// partner-history.php

function partner_history_page_content() {
    ?>
    <div class="wrap">
        <h2>Partner History</h2>
        <table class="widefat striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Total Income</th>
                    <th>Total Withdraw</th>
                    <th>Roles</th>
                    <th>Wallet Balance</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query and display user information
                $user_query = new WP_User_Query(array(
                    'role' => 'partner',
                    'orderby' => 'login',
                    'order' => 'ASC',
                ));
                
                if (!empty($user_query->get_results())) {
                    foreach ($user_query->get_results() as $user) {
                        $username = $user->user_login;
                        $user_id = $user->ID;
                        $name = $user->display_name;
                        $email = $user->user_email;
                        $roles = implode(', ', $user->roles);
                        $wallet_balance = woo_wallet()->wallet->get_wallet_balance($user_id);
                        echo '<tr>';
                        echo '<td>' . esc_html($username) . '</td>';
                        echo '<td>' . esc_html($name) . '</td>';
                        echo '<td>' . esc_html($email) . '</td>';
                        echo '<td>' . esc_html($roles) . '</td>';
                        echo '<td>' . $wallet_balance . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">No users found</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
}

