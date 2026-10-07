-- รันคำสั่งนี้ใน phpMyAdmin เพื่อเพิ่มคอลัมน์สำหรับแบบสำรวจ อบจ. นครสวรรค์

ALTER TABLE `alumni`
ADD `grad_level` VARCHAR(50) NULL AFTER `batch`,
ADD `grad_level_other` VARCHAR(100) NULL AFTER `grad_level`,
ADD `grad_major` VARCHAR(150) NULL AFTER `grad_level_other`,
ADD `contact_other` VARCHAR(150) NULL AFTER `phone`,
ADD `current_status` VARCHAR(100) NULL AFTER `bio`,
ADD `study_place` VARCHAR(255) NULL AFTER `current_status`,
ADD `unemployed_reasons` TEXT NULL AFTER `study_place`,
ADD `unemployed_reasons_other` VARCHAR(255) NULL AFTER `unemployed_reasons`,
ADD `job_hunt_obstacles` TEXT NULL AFTER `unemployed_reasons_other`,
ADD `school_support_needs` TEXT NULL AFTER `job_hunt_obstacles`,
ADD `suggestions` TEXT NULL AFTER `school_support_needs`;
