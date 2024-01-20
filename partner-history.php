<?php
// partner-history.php

function partner_history_page_content() {
    ?>
    <div class="wrap">
        <h2>Partner History</h2>

        <!-- Search Form -->
        <form method="post">
            <p class="search-box">
                <label class="screen-reader-text" for="user-search-input">Search Pratner:</label>
                <input type="search" id="user-search-input" name="user_search" value="<?php echo isset($_POST['user_search']) ? esc_attr($_POST['user_search']) : ''; ?>">
                <input type="submit" id="search-submit" class="button" value="Search Pratner">
            </p>
        </form>

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
                $search_term = isset($_POST['user_search']) ? sanitize_text_field($_POST['user_search']) : '';
                $user_query = new WP_User_Query(array(
                    'role' => 'partner',
                    'orderby' => 'login',
                    'order' => 'ASC',
                    'search' => '*' . $search_term . '*',
                ));

                if (!empty($user_query->get_results())) {
                    
                    foreach ($user_query->get_results() as $user) {
                        $user_id = $user->ID;
                        $username = $user->user_login;
                        $name = $user->display_name;
                        $email = $user->user_email;
                        $roles = implode(', ', $user->roles);
                        $wallet_balance = woo_wallet()->wallet->get_wallet_balance($user_id);
                    
                        // Assuming that the following functions are correctly defined
                        $total_income = wc_price(get_pending_total_by_user_id($user_id));
                    
                        // Calculate total value for each user based on the 'payment' post type
                        $total_withdraw = 0; // Initialize total value

                        $payment_query = new WP_Query(array(
                            'post_type' => 'payment',
                            'posts_per_page' => -1,
                            'author' => $user_id,
                        ));

                        while ($payment_query->have_posts()) : $payment_query->the_post();
                            // Adjust the following logic based on your 'payment' post type structure
                            $order_ids = get_post_meta(get_the_ID(), 'order_ids', true);

                            // Assuming that get_payment_request_total and deduct_payment_by_payment_id return numeric values
                            $total_withdraw += get_payment_request_total($order_ids, $user_id) - deduct_payment_by_payment_id($user_id);
                        endwhile;

                        wp_reset_postdata();

                        echo '<tr>';
                        echo '<td>' . esc_html($username) . '</td>';
                        echo '<td>' . $total_income . '</td>';
                        echo '<td>' . wc_price($total_withdraw) . '</td>';
                        echo '<td>' . esc_html($roles) . '</td>';
                        echo '<td>' . $wallet_balance . '</td>';
                        echo '</tr>';
                    }
                    

                    
                } else {
                    echo '<tr><td colspan="5">No users found</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
}

