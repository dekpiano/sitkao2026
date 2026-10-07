-- รันคำสั่งนี้ใน phpMyAdmin เพื่อเพิ่มคอลัมน์ ประสบการณ์ทำงาน และ ที่อยู่ปัจจุบัน
ALTER TABLE `alumni`
ADD `work_experience` VARCHAR(255) NULL AFTER `grad_major`,
ADD `current_address` TEXT NULL AFTER `contact_other`;
