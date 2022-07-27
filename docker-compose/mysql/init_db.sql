CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `zones_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `countries` (`id`, `code`, `name`, `created_at`, `updated_at`, `zones_id`) VALUES
(1, 'es', 'España', NULL, NULL, 1),
(2, 'fr', 'Francia', NULL, NULL, 1),
(3, 'gb', 'Reino Unido', NULL, NULL, 1);


CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `langs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `iso_code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `langs` (`id`, `iso_code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'es', 'Español', NULL, NULL),
(2, 'fr', 'Francés', NULL, NULL),
(3, 'en', 'Inglés', NULL, NULL);

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nif` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access` tinyint(1) NOT NULL DEFAULT '0',
  `lang_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `user_types_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `nif`, `telephone`, `username`, `password`, `access`, `lang_id`, `country_id`, `user_types_id`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'admin@hacce.com', NULL, '5555555', 'admin@hacce.com', '$2y$10$YdqpbSh4Si0ciAFQrG27Me/vQFNAjOP4nfACGhKr344Qv4uIiOKJu', 1, 1, 2, 1, NULL, '2022-03-25 11:57:53', '2022-06-30 16:17:07', NULL);

CREATE TABLE `user_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_types` (`id`, `slug`, `name`, `class`) VALUES
(1, 'admin', 'Administrador', NULL);

CREATE TABLE `zones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `zones` (`id`, `code`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'eu', 'Europa', NULL, NULL, NULL);

ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countries_zones_id_foreign` (`zones_id`);

ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

ALTER TABLE `langs`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_user_types_id_foreign` (`user_types_id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `country_id` (`country_id`);

ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `zones`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `langs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `user_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `zones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `countries`
  ADD CONSTRAINT `countries_zones_id_foreign` FOREIGN KEY (`zones_id`) REFERENCES `zones` (`id`) ON DELETE CASCADE;

ALTER TABLE `users`
  ADD CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_user_types_id_foreign` FOREIGN KEY (`user_types_id`) REFERENCES `user_types` (`id`) ON DELETE CASCADE;
COMMIT;