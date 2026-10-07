-- รันคำสั่งนี้ใน phpMyAdmin ฐานข้อมูล sitkao2026

ALTER TABLE `alumni` 
ADD `username` VARCHAR(50) NULL DEFAULT NULL AFTER `id`,
ADD `password_hash` VARCHAR(255) NULL DEFAULT NULL AFTER `username`;

-- สร้างบัญชีแอดมินหรือทดสอบ (รหัสผ่านคือ 123456)
-- สำหรับศิษย์เก่าคนเดิม เราสามารถใช้วิธีอัปเดตข้อมูลหรือให้เขาสมัครใหม่ได้
UPDATE `alumni` SET `username` = 'somchai', `password_hash` = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' WHERE `id` = 1;
