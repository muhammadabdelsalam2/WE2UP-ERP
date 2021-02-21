drop database if exists erp;
create database erp;
use erp;
CREATE TABLE `system` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `system` (`id`, `key`, `value`) VALUES
(1, 'db_version', '3.6.5'),
(2, 'default_business_active_status', '1'),
(3, 'woocommerce_version', '2.5'),
(4, 'essentials_version', '2.2'),
(5, 'productcatalogue_version', '0.5'),
(6, 'project_version', '1.6'),
(7, 'repair_version', '0.8'),
(8, 'superadmin_version', '2.0'),
(9, 'app_currency_id', '2'),
(10, 'invoice_business_name', 'OR version'),
(11, 'invoice_business_landmark', 'Landmark'),
(12, 'invoice_business_zip', 'Zip'),
(13, 'invoice_business_state', 'State'),
(14, 'invoice_business_city', 'City'),
(15, 'invoice_business_country', 'Country'),
(16, 'email', 'superadmin@example.com'),
(17, 'package_expiry_alert_days', '5'),
(18, 'enable_business_based_username', '0'),
(19, 'superadmin_register_tc', NULL),
(20, 'welcome_email_subject', NULL),
(21, 'welcome_email_body', NULL),
(22, 'additional_js', NULL),
(23, 'additional_css', NULL),
(24, 'superadmin_enable_register_tc', '0'),
(25, 'allow_email_settings_to_businesses', '0'),
(26, 'enable_new_business_registration_notification', '1'),
(27, 'enable_new_subscription_notification', '1'),
(28, 'enable_welcome_email', '1'),
(29, 'manufacturing_version', '2.0');
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `system`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;
CREATE TABLE `repair_guarantee` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `location_id` int(10) UNSIGNED DEFAULT NULL,
  `contact_id` int(10) UNSIGNED NOT NULL,
  `job_sheet_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_type` enum('carry_in','pick_up','on_site') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pick_up_on_site_addr` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variation_id` int(10) UNSIGNED DEFAULT NULL,
  `transaction_id` int(10) UNSIGNED DEFAULT NULL,
  `supplier_id` int(10) UNSIGNED DEFAULT NULL,
  `checklist` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `security_pwd` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `security_pattern` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` int(11) NOT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `product_configuration` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `defects` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_condition` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_staff` int(10) UNSIGNED DEFAULT NULL,
  `comment_by_ss` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'comment made by technician',
  `estimated_cost` decimal(22,4) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
ALTER TABLE `repair_guarantee`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `repair_guarantee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;
