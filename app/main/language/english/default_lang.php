<?php defined('BASEPATH') OR exit('No direct script access allowed');

$lang = [
    'activity_self'                    => 'You',
    'activity_custom'                  => '{customer} <b>{action}</b> {context} <a href="{link}"><b>{item}</b></a>.',
    'activity_logged_in'               => '<a href="{link}">{customer}</a> <b>logged</b> in.',
    'activity_logged_out'              => '<a href="{link}">{customer}</a> <b>logged</b> out.',
    'activity_registered_account'      => '<a href="{link}">{customer}</a> <b>registered</b> an <b>account.</b>',
    'activity_updated_account'         => '<a href="{link}">{customer}</a> <b>updated</b> their <b>account details.</b>',
    'activity_changed_password'        => '<a href="{link}">{customer}</a> <b>changed</b> their <b>account password.</b>',
    'activity_created_order'           => '{customer} <b>created</b> a new order <a href="{link}"><b>#{order_id}.</b></a>',
    'activity_reserved_table'          => '{customer} made a new <b>reservation</b> <a href="{link}"><b>#{reservation_id}.</b></a>',
    'text_heading'                     => 'Contact',
    'button_go_back'                   => 'Add more items',
    'text_checkout'                    => 'Almost there, Please confirm your details and proceed to payment.',
    'text_payments'                    => 'Please choose your payment method.',
    'text_registered'                  => 'Already have an account? <a href="%s">Login Here</a>',
    'text_logout'                      => 'Welcome Back %s, Not You? <a href="%s">Logout</a>',
    'text_asap'                        => 'As soon as possible',
    'text_later'                       => 'Later',
    'text_step_one'                    => 'Step 1',
    'text_step_one_summary'            => 'Your Details',
    'text_step_two'                    => 'Step 2',
    'text_step_two_summary'            => 'Payment',
    'text_step_three'                  => 'Step 3',
    'text_step_three_summary'          => 'Confirmation',
    'text_location_closed'             => 'Sorry, but we\'re closed, come back during opening hours',
    'text_edit'                        => 'Edit',
    'text_close'                       => 'Close',
    'text_ip_warning'                  => '(Warning: Your IP Address has been logged for our fraud prevention measures.)',
    'text_date_format'                 => '%l %d',
    'text_greetings'                   => 'Hello %s,',
    'text_success_heading'             => 'Order Confirmation',
    'text_order_details'               => 'Order Details',
    'text_order_items'                 => 'What you\'ve ordered:',
    'text_delivery_address'            => 'Your Delivery Address',
    'text_your_local'                  => 'Your local restaurant',
    'text_thank_you'                   => 'We hope to see you again soon',
    'text_success_message'             => 'Your order  %s has been received and will be with you shortly. <br /><a href="%s">Click here</a> to view your order progress. <br />Thanks for shopping with us online!',
    'text_order_info'                  => 'This is a %s order. <br /><br /><b>Order Date:</b> %s <br /><b>%s Time:</b> %s <br /><b>Payment Method:</b> %s ',
    'text_order_total'                 => 'Order Total: <b>%s.</b>',
    'text_collection_order_type'       => 'This is a pick-up order',
    'text_no_payment'                  => 'No payment method selected',
    'label_customer_name'              => 'Customer Name',
    'label_first_name'                 => 'First Name',
    'label_last_name'                  => 'Last Name',
    'label_email'                      => 'Email Address:',
    'label_telephone'                  => 'Telephone:',
    'label_address'                    => 'Delivery Address',
    'label_address_id'                 => 'Address Id',
    'label_address_1'                  => 'Address 1',
    'label_address_2'                  => 'Address 2',
    'label_city'                       => 'City',
    'label_state'                      => 'State',
    'label_postcode'                   => 'Postcode',
    'label_country'                    => 'Country',
    'label_order_type'                 => 'Order Type',
    'label_delivery'                   => 'Delivery',
    'label_collection'                 => 'Pick-up',
    'label_order_time'                 => '%s Time',
    'label_choose_order_time'          => 'Choose %s Time',
    'label_order_asap_time'            => '%s ASAP Time',
    'label_order_time_type'            => '%s Time Type',
    'label_date'                       => 'Date',
    'label_hour'                       => 'Hour',
    'label_minute'                     => 'Minute',
    'label_payment_method'             => 'Payment Method',
    'label_terms'                      => 'By clicking I Agree, you agree to the <a href="%s" data-toggle="modal" data-target="#terms-modal">Terms and Conditions</a> set out by this site, including our Cookie Use.',
    'label_comment'                    => 'Comment',
    'label_ip'                         => 'IP Address',
    'button_agree_terms'               => 'I Agree',
    'error_delivery_unavailable'       => 'Delivery is unavailable at the selected restaurant!',
    'error_collection_unavailable'     => 'Pick-up is unavailable at the selected restaurant!',
    'error_covered_area'               => 'This restaurant currently does not deliver to your address',
    'error_delivery_less_current_time' => 'The %s Time can not be less than current time!',
    'error_no_delivery_time'           => 'The selected %s time is outside our opening/closing hours',
    'error_invalid_payment'            => 'The selected payment is invalid, please contact us',
    'alert_no_menu_to_order'           => '<p class="alert-danger">Please, add some menus before you checkout!</p>',
    'alert_no_selected_local'          => '<p class="alert-danger">Please select your local restaurant</p>',
    'alert_location_closed'            => '<p class="alert-danger">Sorry, you can\'t place an order now, we are currently closed,<br /> please come back later during our opening times.</p>',
    'alert_order_unavailable'          => '<p class="alert-danger">Niether delivery or pick-up is available at the selected restaurant.</p>',
    'alert_customer_not_logged'        => '<p class="alert-info">Almost there, Please login or register to complete checkout.</p>',
    'alert_delivery_area_changed'      => '<p class="alert-info">Your delivery area has changed, please confirm the delivery cost.</p>',
    'text_summary'                     => 'Feel free to send a message',
    'text_find_us'                     => 'Find Us On Map',
    'text_select_subject'              => 'select a subject',
    'text_contact_us'                  => 'Contact Us',
    'text_general_enquiry'             => 'General enquiry',
    'text_comment'                     => 'Comment',
    'text_technical_issues'            => 'Technical Issues',
    'label_subject'                    => 'Enquiry Subject:',
    'label_full_name'                  => 'Full Name:',
    'label_captcha'                    => 'Type the code shown',
    'button_send'                      => 'SEND',
    'error_captcha'                    => 'The letters you entered does not match the image.',
    'alert_contact_sent'               => '<p class="alert-success">Message Sent successfully, we will get back to you shortly!</p>',
    'site_title'                       => '%s - %s',
    'site_copyright'                   => '&copy; %s %s - ',
    'text_equals'                      => ' = ',
    'text_plus'                        => '+ ',
    'text_minutes'                     => 'minutes',
    'text_min'                         => 'min',
    'text_my_account'                  => 'My Account',
    'text_information'                 => 'Information',
    'text_follow_us'                   => 'Follow us on:',
    'menu_home'                        => 'Home',
    'menu_menu'                        => 'View Menu',
    'menu_reservation'                 => 'Reservation',
    'menu_login'                       => 'Login',
    'menu_logout'                      => 'Logout',
    'menu_register'                    => 'Register',
    'menu_my_account'                  => 'My Account',
    'menu_account'                     => 'Main',
    'menu_detail'                      => 'Edit Details',
    'menu_address'                     => 'Address Book',
    'menu_recent_order'                => 'Recent Orders',
    'menu_recent_reservation'          => 'Recent Reservations',
    'menu_locations'                   => 'Our Locations',
    'menu_contact'                     => 'Contact Us',
    'menu_admin'                       => 'Administrator',
    'alert_success'                    => '%s successfully.',
    'alert_error'                      => 'An error occurred, %s.',
    'alert_error_nothing'              => 'An error occurred, nothing %s.',
    'alert_error_try_again'            => 'An error occurred, please try again.',
    'alert_warning_confirm'            => 'This cannot be undone! Are you sure you want to do this?',
    'alert_no_search_query'            => '<p class="alert-danger">Please type in a postcode/address to check if we can deliver to you.</p>',
    'alert_info_outdated_browser'      => 'You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.',
];