-- phpMyAdmin SQL Dump
-- Database: skjacth_sitkao

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";

-- --------------------------------------------------------
-- Table structure for table `tb_alumni`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `tb_alumni`;
CREATE TABLE `tb_alumni` (
  `alm_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'รหัสประจำตัวศิษย์เก่า (Primary Key)',
  `alm_username` varchar(50) DEFAULT NULL UNIQUE COMMENT 'ชื่อผู้ใช้งานสำหรับเข้าสู่ระบบ (Username)',
  `alm_password` varchar(255) DEFAULT NULL COMMENT 'รหัสผ่านแฮช (Password Hash)',
  `alm_role` varchar(20) NOT NULL DEFAULT 'alumni' COMMENT 'สิทธิ์ผู้ใช้งาน (alumni/admin)',
  `alm_prefix` varchar(50) DEFAULT NULL COMMENT 'คำนำหน้าชื่อ (นาย/นาง/นางสาว/อื่นๆ)',
  `alm_first_name` varchar(100) DEFAULT NULL COMMENT 'ชื่อจริง',
  `alm_last_name` varchar(100) DEFAULT NULL COMMENT 'นามสกุล',
  `alm_name` varchar(255) NOT NULL COMMENT 'ชื่อ-นามสกุลจริง',
  `alm_school` varchar(150) DEFAULT 'โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์' COMMENT 'โรงเรียนที่สำเร็จการศึกษา (จ.ว. / สกจ.)',
  `alm_school_grad_level` varchar(50) DEFAULT 'มัธยมศึกษาปีที่ 6 (ม.6)' COMMENT 'ระดับชั้นที่สำเร็จการศึกษาจากโรงเรียน (ม.3 หรือ ม.6)',
  `alm_batch` varchar(100) NOT NULL COMMENT 'รุ่นที่จบการศึกษา (เช่น รุ่นที่ 15)',
  `alm_grad_year` varchar(50) DEFAULT NULL COMMENT 'ปีการศึกษาที่จบ (เช่น 2565)',
  `alm_grad_level` varchar(100) DEFAULT NULL COMMENT 'ระดับการศึกษาสูงสุดที่สำเร็จในปัจจุบัน (ม.3, ม.6, ปวช., ปวส., ป.ตรี, ป.โท)',
  `alm_grad_level_other` varchar(255) DEFAULT NULL COMMENT 'ระดับชั้นอื่นๆ (กรณีระบุอื่นๆ)',
  `alm_grad_major` varchar(255) DEFAULT NULL COMMENT 'แผนการเรียน / สาขาวิชาที่จบ',
  `alm_work_experience` varchar(255) DEFAULT NULL COMMENT 'ประสบการณ์ทำงาน (จำนวนปี / ด้าน)',
  `alm_current_address` text DEFAULT NULL COMMENT 'ที่อยู่ปัจจุบัน',
  `alm_privacy_address` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'การเปิดเผยที่อยู่ (1=เปิด, 0=ซ่อน)',
  `alm_phone` varchar(50) DEFAULT NULL COMMENT 'เบอร์โทรศัพท์ที่ติดต่อได้',
  `alm_privacy_phone` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'การเปิดเผยเบอร์โทร (1=เปิด, 0=ซ่อน)',
  `alm_contact_other` varchar(255) DEFAULT NULL COMMENT 'ช่องทางติดต่ออื่นๆ (เช่น Line ID / Facebook)',
  `alm_email` varchar(255) DEFAULT NULL COMMENT 'อีเมลติดต่อ',
  `alm_privacy_email` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'การเปิดเผยอีเมล (1=เปิด, 0=ซ่อน)',
  `alm_current_status` varchar(100) DEFAULT NULL COMMENT 'สถานภาพปัจจุบัน (ทำงานแล้ว / กำลังศึกษาต่อ / ว่างงาน)',
  `alm_job_title` varchar(255) DEFAULT NULL COMMENT 'อาชีพ / ตำแหน่งงานปัจจุบัน',
  `alm_study_place` varchar(255) DEFAULT NULL COMMENT 'สถาบันการศึกษาและสาขาที่กำลังศึกษาต่อ',
  `alm_unemployed_reasons` text DEFAULT NULL COMMENT 'สาเหตุที่ยังไม่ได้ทำงาน/ว่างงาน (เลือกได้หลายข้อ)',
  `alm_unemployed_reasons_other` text DEFAULT NULL COMMENT 'สาเหตุว่างงานอื่นๆ (กรณีระบุอื่นๆ)',
  `alm_job_hunt_obstacles` text DEFAULT NULL COMMENT 'ปัญหาและอุปสรรคในการหางาน',
  `alm_school_support_needs` text DEFAULT NULL COMMENT 'สิ่งที่ต้องการให้โรงเรียนและ อบจ. ช่วยเหลือ',
  `alm_suggestions` text DEFAULT NULL COMMENT 'ข้อเสนอแนะเพิ่มเติม',
  `alm_pdpa_consent` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'การยินยอมตาม PDPA',
  `alm_bio` text DEFAULT NULL COMMENT 'ประวัติการทำงานและข้อความแนะนำตัว',
  `alm_image` varchar(255) DEFAULT NULL COMMENT 'รูปโปรไฟล์ศิษย์เก่า',
  `alm_reset_token` varchar(100) DEFAULT NULL COMMENT 'Token รีเซ็ตรหัสผ่าน',
  `alm_reset_expires` datetime DEFAULT NULL COMMENT 'วันหมดอายุ Token รีเซ็ตรหัสผ่าน',
  `alm_created_at` datetime DEFAULT NULL COMMENT 'วันที่บันทึกข้อมูล',
  `alm_updated_at` datetime DEFAULT NULL COMMENT 'วันที่แก้ไขข้อมูลล่าสุด',
  PRIMARY KEY (`alm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='ตารางจัดเก็บข้อมูลทำเนียบศิษย์เก่าและแบบสำรวจภาวะการมีงานทำ';

-- --------------------------------------------------------
-- Table structure for table `tb_jobs`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `tb_jobs`;
CREATE TABLE `tb_jobs` (
  `job_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `job_title` varchar(255) NOT NULL,
  `job_company` varchar(255) NOT NULL,
  `job_location` varchar(255) DEFAULT NULL,
  `job_type` varchar(50) NOT NULL DEFAULT 'Full-time',
  `job_salary` varchar(100) DEFAULT NULL,
  `job_description` text NOT NULL,
  `job_qualifications` text DEFAULT NULL,
  `job_contact` varchar(255) NOT NULL,
  `job_contact_email` varchar(255) DEFAULT NULL,
  `job_contact_phone` varchar(50) DEFAULT NULL,
  `job_author_id` int(11) UNSIGNED DEFAULT NULL,
  `job_status` varchar(20) NOT NULL DEFAULT 'open',
  `job_created_at` datetime DEFAULT NULL,
  `job_updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='ตารางจัดเก็บประกาศรับสมัครงานและฝึกงาน';

-- --------------------------------------------------------
-- Table structure for table `tb_news`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `tb_news`;
CREATE TABLE `tb_news` (
  `news_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `news_title` varchar(255) NOT NULL,
  `news_category` varchar(50) NOT NULL DEFAULT 'ข่าวทั่วไป',
  `news_content` text NOT NULL,
  `news_image` varchar(255) DEFAULT NULL,
  `news_date` date DEFAULT NULL,
  `news_author_id` int(11) UNSIGNED DEFAULT NULL,
  `news_views` int(11) NOT NULL DEFAULT 0,
  `news_created_at` datetime DEFAULT NULL,
  `news_updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='ตารางจัดเก็บข่าวสารและกิจกรรมศิษย์เก่า';

--
-- Dumping sample data
--

INSERT INTO `tb_alumni` (`alm_id`, `alm_name`, `alm_school`, `alm_prefix`, `alm_first_name`, `alm_last_name`, `alm_role`, `alm_batch`, `alm_grad_year`, `alm_job_title`, `alm_image`, `alm_email`, `alm_phone`, `alm_bio`, `alm_created_at`, `alm_updated_at`) VALUES
(1, 'นายสมชาย ใจดี', 'โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์', 'นาย', 'สมชาย', 'ใจดี', 'admin', 'รุ่นที่ 15', '2560', 'Software Engineer', 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=300&auto=format&fit=crop', 'somchai.j@example.com', '081-234-5678', 'ทำงานสายเทคโนโลยีและพัฒนาซอฟต์แวร์ ยินดีให้คำปรึกษารุ่นน้องครับ', NOW(), NOW()),
(2, 'นางสาววันดี รักดี', 'โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์', 'นางสาว', 'วันดี', 'รักดี', 'alumni', 'รุ่นที่ 18', '2563', 'Marketing Director', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=300&auto=format&fit=crop', 'wandee.r@example.com', '089-876-5432', 'เชี่ยวชาญด้านการตลาดดิจิทัลและการสร้างแบรนด์', NOW(), NOW()),
(3, 'นายอนุรักษ์ ปัญญา', 'โรงเรียนจิรประวัติวิทยาคม', 'นาย', 'อนุรักษ์', 'ปัญญา', 'alumni', 'รุ่นที่ 10', '2550', 'Data Scientist', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=300&auto=format&fit=crop', 'anurak.p@example.com', '082-345-6789', 'ศิษย์เก่าจิรประวัติวิทยาคม ทำงานวิเคราะห์ข้อมูลและ Machine Learning', NOW(), NOW()),
(4, 'นายกิตติพงษ์ สุขใจ', 'โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์', 'นาย', 'กิตติพงษ์', 'สุขใจ', 'alumni', 'รุ่นที่ 20', '2565', 'UX/UI Designer', 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=300&auto=format&fit=crop', 'kittipong.s@example.com', '086-555-4444', 'ออกแบบประสบการณ์ผู้ใช้งานดิจิทัลและผลิตภัณฑ์โมบายล์', NOW(), NOW()),
(5, 'นางสาวสุภาวดี ทรัพย์เจริญ', 'โรงเรียนจิรประวัติวิทยาคม', 'นางสาว', 'สุภาวดี', 'ทรัพย์เจริญ', 'alumni', 'รุ่นที่ 12', '2552', 'ข้าราชการครู ชำนาญการ', 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=300&auto=format&fit=crop', 'supawadee.s@example.com', '085-111-2233', 'ศิษย์เก่า จ.ว. ภาคภูมิใจในสถาบัน ยินดีให้คำแนะนำรุ่นน้องด้านการศึกษาต่อ', NOW(), NOW());

INSERT INTO `tb_jobs` (`job_title`, `job_company`, `job_location`, `job_type`, `job_salary`, `job_description`, `job_qualifications`, `job_contact`, `job_contact_email`, `job_contact_phone`, `job_status`, `job_created_at`, `job_updated_at`) VALUES 
('เจ้าหน้าที่เทคโนโลยีสารสนเทศ (IT Officer)', 'องค์การบริหารส่วนจังหวัดนครสวรรค์ (อบจ.นครสวรรค์)', 'อ.เมือง จ.นครสวรรค์', 'Full-time', '15,000 - 22,000 บาท', 'ดูแลรักษาระบบเครือข่าย ซ่อมบำรุงอุปกรณ์คอมพิวเตอร์ และพัฒนาระบบสารสนเทศของหน่วยงาน', 'วุฒิ ป.ตรี สาขาเทคโนโลยีสารสนเทศ วิทยาการคอมพิวเตอร์ หรือสาขาที่เกี่ยวข้อง มีความกระตือรือร้นและพร้อมเรียนรู้', 'กองการเจ้าหน้าที่ อบจ.นครสวรรค์', 'hr@nakhonsawanpao.go.th', '056-803-555', 'open', NOW(), NOW()),
('Graphic & Digital Content Creator', 'SKJ Media Studio (ธุรกิจศิษย์เก่า รุ่น 15)', 'จ.นครสวรรค์ / Hybrid Work', 'Full-time', '18,000 - 28,000 บาท', 'ออกแบบสื่อกราฟิก ตัดต่อวิดีโอสั้น TikTok/Reels และวางแผนคอนเทนต์ประชาสัมพันธ์ผลิตภัณฑ์', 'สามารถใช้ Adobe Photoshop, Illustrator, Premiere Pro ได้เป็นอย่างดี ยินดีรับนักศึกษาจบใหม่', 'คุณสมชาย ใจดี (ประธานศิษย์เก่า รุ่น 15)', 'somchai.j@example.com', '081-234-5678', 'open', NOW(), NOW()),
('นักศึกษาฝึกงาน ด้านการจัดการและเอกสารสำนักงาน', 'สำนักงานศิษย์เก่าสวนกุหลาบ (จิรประวัติ)', 'โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ)', 'Internship', 'มีเบี้ยเลี้ยงรายวัน', 'ช่วยงานประสานงานเอกสาร งานทะเบียนศิษย์เก่า และต้อนรับผู้มาติดต่อ', 'กำลังศึกษาอยู่ในระดับ ปวช./ปวส. หรือ ป.ตรี ทุกสาขาวิชา', 'ครูฝ่ายแนะแนวและศิษย์เก่าสัมพันธ์', 'contact@skj.ac.th', '056-000-000', 'open', NOW(), NOW());

INSERT INTO `tb_news` (`news_title`, `news_category`, `news_content`, `news_image`, `news_date`, `news_views`, `news_created_at`, `news_updated_at`) VALUES 
('ขอเชิญร่วมงานคืนสู่เหย้า "จิรประวัติสัมพันธ์ 2569" รำลึกความหลัง ณ ลานอเนกประสงค์', 'กิจกรรมศิษย์เก่า', 'สมาคมศิษย์เก่าโรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์ ร่วมกับ อบจ.นครสวรรค์ ขอเชิญชวนศิษย์เก่าทุกรุ่น ร่วมงานคืนสู่เหย้าประจำปี พบปะคุณครูอาจารย์ เพื่อนร่วมรุ่น พร้อมชมการแสดงดนตรีและกิจกรรมประมูลของที่ระลึกเพื่อการกุศล', 'https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=800&auto=format&fit=crop', '2026-11-20', 142, NOW(), NOW()),
('อบจ.นครสวรรค์ เปิดรับสมัครสอบบรรจุบุคลากรทางการศึกษาและเจ้าหน้าที่ ประจำปีงบประมาณ 2569', 'ข่าวทั่วไป', 'องค์การบริหารส่วนจังหวัดนครสวรรค์ ประกาศรับสมัครคัดเลือกบุคคลเพื่อบรรจุเป็นข้าราชการและพนักงานจ้างในสังกัด อบจ.นครสวรรค์ โดยศิษย์เก่าโรงเรียนในสังกัดที่กรอกข้อมูลในระบบทำเนียบศิษย์เก่าจะได้รับสิทธิพิเศษในการรับการแจ้งเตือนข่าวสารตำแหน่งงานว่างล่วงหน้า', 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=800&auto=format&fit=crop', '2026-10-15', 289, NOW(), NOW()),
('ขอแสดงความยินดีกับ นายอนุรักษ์ ปัญญา ศิษย์เก่ารุ่นที่ 16 ได้รับรางวัลนักนวัตกรรมดีเด่นระดับประเทศ', 'ศิษย์เก่าดีเด่น', 'โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์ ขอแสดงความยินดีและร่วมภาคภูมิใจกับ นายอนุรักษ์ ปัญญา ศิษย์เก่ารุ่น 16 (ปัจจุบัน Data Scientist) ที่ได้รับรางวัลนวัตกรรมปัญญาประดิษฐ์ระดับชาติ สร้างชื่อเสียงให้แก่สถาบัน', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=800&auto=format&fit=crop', '2026-09-28', 350, NOW(), NOW());

COMMIT;
