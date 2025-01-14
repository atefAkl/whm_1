-- جدول الأدوار
CREATE TABLE IF NOT EXISTS `roles` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `guard_name` varchar(255) NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `roles_name_guard_name_unique` (`name`, `guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- جدول الصلاحيات
CREATE TABLE IF NOT EXISTS `permissions` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `guard_name` varchar(255) NOT NULL,
    `description` text DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `permissions_name_guard_name_unique` (`name`, `guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- جدول العلاقة بين الأدوار والصلاحيات
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
    `permission_id` bigint(20) UNSIGNED NOT NULL,
    `role_id` bigint(20) UNSIGNED NOT NULL,
    PRIMARY KEY (`permission_id`, `role_id`),
    KEY `role_has_permissions_role_id_foreign` (`role_id`),
    CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
    CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- جدول العلاقة بين المستخدمين والأدوار
CREATE TABLE IF NOT EXISTS `model_has_roles` (
    `role_id` bigint(20) UNSIGNED NOT NULL,
    `model_type` varchar(255) NOT NULL,
    `model_id` bigint(20) UNSIGNED NOT NULL,
    PRIMARY KEY (`role_id`, `model_id`, `model_type`),
    KEY `model_has_roles_model_id_model_type_index` (`model_id`, `model_type`),
    CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- جدول العلاقة بين المستخدمين والصلاحيات
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
    `permission_id` bigint(20) UNSIGNED NOT NULL,
    `model_type` varchar(255) NOT NULL,
    `model_id` bigint(20) UNSIGNED NOT NULL,
    PRIMARY KEY (`permission_id`, `model_id`, `model_type`),
    KEY `model_has_permissions_model_id_model_type_index` (`model_id`, `model_type`),
    CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- إدخال بعض الأدوار الأساسية
INSERT INTO `roles` (`name`, `guard_name`, `created_at`, `updated_at`) VALUES
('super-admin', 'admin', NOW(), NOW()),
('admin', 'admin', NOW(), NOW()),
('moderator', 'admin', NOW(), NOW());

-- إدخال بعض الصلاحيات الأساسية
INSERT INTO `permissions` (`name`, `guard_name`, `description`, `created_at`, `updated_at`) VALUES
('manage-admins', 'admin', 'إدارة المشرفين', NOW(), NOW()),
('manage-roles', 'admin', 'إدارة الأدوار', NOW(), NOW()),
('manage-permissions', 'admin', 'إدارة الصلاحيات', NOW(), NOW()),
('view-dashboard', 'admin', 'عرض لوحة التحكم', NOW(), NOW()),
('create-admin', 'admin', 'إنشاء مشرف جديد', NOW(), NOW()),
('edit-admin', 'admin', 'تعديل بيانات المشرف', NOW(), NOW()),
('delete-admin', 'admin', 'حذف مشرف', NOW(), NOW()),
('view-admin', 'admin', 'عرض بيانات المشرف', NOW(), NOW());

-- منح جميع الصلاحيات لدور super-admin
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
SELECT p.id, r.id
FROM `permissions` p
CROSS JOIN `roles` r
WHERE r.name = 'super-admin';
