<?php 
// users-history.php
function users_history_page_content() {
    ?>
    <style>
        .history {
            padding-top: 20px;
        }
        .history .tablenav-pages a {
            text-decoration: none;
        }
        .history .tablenav-pages .current{
            background-color: #fff;
        }
        .history .tablenav-pages .page-numbers {
            padding: 5px 10px;
            border: solid 1px #ccc;
            border-radius: 5px;
        }
    </style>
    <div class="wrap">
        <h2><?php echo esc_html(get_admin_page_title()); ?></h2>

        <!-- Search Form -->
        <form method="post">
            <p class="search-box">
                <label class="screen-reader-text" for="user-search-input">Search Buyer:</label>
                <input type="search" id="user-search-input" name="user_search" value="<?php echo isset($_POST['user_search']) ? esc_attr($_POST['user_search']) : ''; ?>">
                <input type="submit" id="search-submit" class="button" value="Search Partner">
            </p>
        </form>

        <?php
        // Query and display user information
        $search_term = isset($_POST['user_search']) ? sanitize_text_field($_POST['user_search']) : '';
        $current_page = max(1, isset($_GET['paged']) ? absint($_GET['paged']) : 1);
        // Use get_query_var as a fallback
        $current_page = max(1, get_query_var('paged', $current_page));

        $users_per_page = 20; // Change this as needed
        $offset = ($current_page - 1) * $users_per_page;

        $user_query = new WP_User_Query(array(
            'orderby' => 'login',
            'order' => 'ASC',
            'search' => '*' . $search_term . '*',
            'number' => $users_per_page,
            'offset' => $offset,
        ));

        if (!empty($user_query->get_results())) {
            ?>
            <div class="tablenav top history">
                <?php
                // Top Pagination
                $total_users = $user_query->get_total();
                $total_pages = ceil($total_users / $users_per_page);

                $pagination_args_top = array(
                    'base' => add_query_arg('paged', '%#%'),
                    'format' => '',
                    'total' => $total_pages,
                    'current' => $current_page,
                    'prev_text' => 'Prev',
                    'next_text' => 'Next',
                );

                echo '<div class="tablenav-pages">' . paginate_links($pagination_args_top) . '</div>';
                ?>
            </div>

            <table class="wp-list-table widefat striped">
                <thead>
                    <tr>
                        <th><?php echo esc_html( 'User ID' );?></th>
                        <th><?php echo esc_html( 'Username');?></th>
                        <th><?php echo esc_html( 'Email' );?></th>
                        <th><?php echo esc_html( 'Roles' );?></th>
                        <th><?php echo esc_html( 'Last Login IP Address' );?></th>
                        <th><?php echo esc_html( 'Last Login Browser Name' );?></th>
                        <th><?php echo esc_html( 'Last Login Time' );?></th>
                        <th><?php echo esc_html( 'Last Login Location' );?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        
                        // Loop through users and display information
                        foreach ($user_query->get_results() as $user) {
                            $user_id = $user->ID;
                            $username = $user->user_login;
                            $name = $user->display_name;
                            $email = $user->user_email;
                            $roles = implode(', ', $user->roles);
                            // Get the last login IP address from user meta
                            $ip_address = get_user_meta($user_id, 'last_login_ip', true);
                            if($ip_address != NULL){
                                $last_login_ip = get_user_meta($user_id, 'last_login_ip', true);
                            }else{
                                $last_login_ip = "N/A";
                            }
                            // Get the last login browser from user meta
                            $browser_name = get_user_meta($user_id, 'last_login_browser', true);
                            if($browser_name != NULL){
                                $last_login_browser = $browser_name;
                            }else{
                                $last_login_browser = "N/A";
                            }

                            // Get last login time (assuming you have stored it in user meta)
                            $login_time = get_user_meta($user_id, 'last_login_time', true);
                            if($login_time != NULL){
                                $last_login_time = $login_time;
                            }else{
                                $last_login_time = "N/A";
                            }
                            // Get the last login location from user meta
                            $last_location = get_user_meta($user_id, 'last_login_location', true);
                            if($last_location != NULL){
                                $last_login_location = $last_location;
                            }else{
                                $last_login_location = "N/A";
                            }

                            echo '<tr>';
                            echo '<td>' . $user_id . '</td>';
                            echo '<td>' . esc_html($username) . '</td>';
                            echo '<td>' . $email . '</td>';
                            echo '<td>' . $roles . '</td>';
                            echo '<td>' . $last_login_ip . '</td>';
                            echo '<td>' . $last_login_browser . '</td>';
                            echo '<td>' . $last_login_time . '</td>';
                            echo '<td>' . $last_login_location . '</td>';
                            echo '</tr>';
                        }

                    ?>
                </tbody>
            </table>

            <div class="tablenav bottom history">
                <?php
                // Bottom Pagination
                $pagination_args_bottom = array(
                    'base' => add_query_arg('paged', '%#%'),
                    'format' => '',
                    'total' => $total_pages,
                    'current' => $current_page,
                    'prev_text' => 'Prev',
                    'next_text' => 'Next',
                );

                echo '<div class="tablenav-pages">' . paginate_links($pagination_args_bottom) . '</div>';
                ?>
            </div>
            <?php
        } else {
            echo '<p>No Partner found</p>';
        }
        ?>
    </div>
    <?php
}