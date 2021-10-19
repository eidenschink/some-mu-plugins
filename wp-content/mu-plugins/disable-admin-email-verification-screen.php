<?php
/**
 * In setups with special login screens and different authentication
 * concepts the WordPress introduced Admin Email Verifications screen
 * might lead to problems.
 *
 * By turning off the check interval you never get asked.
 *
 * @see https://make.wordpress.org/core/2019/10/17/wordpress-5-3-admin-email-verification-screen/
 */

add_filter( 'admin_email_check_interval', '__return_false' );



