<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลโปรไฟล์ & แบบสำรวจ | SKJ Alumni</title>
    <link href="https://fonts.googleapis.com/css2?family=K2D:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'K2D', sans-serif; }
        .swal2-popup { font-family: 'K2D', sans-serif !important; border-radius: 1.25rem !important; }
        
        .animated-bg {
            position: fixed;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
            background-color: #f8fafc;
            background-image: 
                linear-gradient(to right, rgba(0, 0, 0, 0.02) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.02) 1px, transparent 1px);
            background-size: 32px 32px;
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0.3;
            animation: floatBlob 24s infinite alternate cubic-bezier(0.4, 0, 0.2, 1);
        }

        .blob-1 {
            top: 5%;
            left: 10%;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, #f472b6 0%, transparent 70%);
        }

        .blob-2 {
            bottom: 10%;
            right: 10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, #60a5fa 0%, transparent 70%);
            animation-duration: 28s;
        }

        @keyframes floatBlob {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(60px, 40px) scale(1.1); }
            100% { transform: translate(-40px, 60px) scale(0.95); }
        }
    </style>
    <script src="<?= base_url('assets/js/floating-bubbles.js') ?>" defer></script>
</head>
<body class="bg-slate-50 min-h-screen text-slate-800 antialiased relative">

    <!-- Ambient Background -->
    <div class="animated-bg">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

    <!-- Header / Navbar -->
    <header class="sticky top-0 z-50 w-full border-b bg-white/90 backdrop-blur-md border-slate-200">
        <div class="mx-auto flex h-16 max-w-5xl items-center justify-between px-4 sm:px-6">
            <a href="<?= base_url('/') ?>" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-blue-500 rounded-lg flex items-center justify-center text-white font-bold text-lg shadow-sm">SKJ</div>
                <div>
                    <span class="block text-base font-bold text-slate-900 leading-tight">ทำเนียบรุ่นศิษย์เก่า SKJ</span>
                    <span class="block text-[10px] text-slate-500">สวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์</span>
                </div>
            </a>
            
            <div class="flex items-center gap-2">
                <a href="<?= base_url('alumni/profile/' . $alumni['alm_id']) ?>" class="inline-flex h-9 items-center justify-center rounded-full bg-slate-100 px-4 text-xs sm:text-sm font-medium text-slate-700 hover:bg-slate-200 transition">
                    👤 ดูโปรไฟล์สาธารณะ
                </a>
                <a href="<?= base_url('logout') ?>" onclick="confirmLogout(event, '<?= base_url('logout') ?>')" class="inline-flex h-9 items-center justify-center rounded-full bg-red-50 text-red-600 px-3.5 text-xs sm:text-sm font-medium hover:bg-red-100 transition">
                    ออกจากระบบ
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-8 sm:py-12 relative z-10">
        
        <!-- Breadcrumb & Title -->
        <div class="mb-8">
            <div class="flex items-center gap-2 text-xs sm:text-sm text-slate-500 mb-3">
                <a href="<?= base_url('/') ?>" class="hover:text-pink-600">หน้าหลัก</a>
                <span>/</span>
                <a href="<?= base_url('alumni/profile/' . $alumni['alm_id']) ?>" class="hover:text-pink-600">โปรไฟล์</a>
                <span>/</span>
                <span class="text-slate-900 font-bold">แก้ไขข้อมูลโปรไฟล์</span>
            </div>
            
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                        <span class="p-2 rounded-2xl bg-gradient-to-br from-pink-500 to-blue-600 text-white shadow-md shadow-pink-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </span>
                        แก้ไขข้อมูลโปรไฟล์ & แบบสำรวจ
                    </h1>
                    <p class="text-slate-500 text-sm mt-1">อัปเดตข้อมูลส่วนตัว ภาวะการมีงานทำ และประสบการณ์ทำงานเพื่อความต่อเนื่องของฐานข้อมูล</p>
                </div>

                <span class="self-start sm:self-auto inline-flex items-center px-3.5 py-1.5 rounded-full text-xs font-bold bg-pink-50 text-pink-700 border border-pink-200">
                    รุ่น: <?= esc($alumni['alm_batch'] ?? 'ไม่ระบุ') ?> (ปี <?= esc($alumni['alm_grad_year'] ?? '-') ?>)
                </span>
            </div>
        </div>

        <!-- Form Card -->
        <form id="editProfileForm" action="<?= base_url('alumni/update-profile') ?>" method="POST" enctype="multipart/form-data" class="space-y-8">
            <?= csrf_field() ?>

            <!-- Section 1: Personal & Avatar -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm relative overflow-hidden">
                <div class="border-b border-slate-100 pb-4 mb-6 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-xl bg-pink-100 text-pink-600 flex items-center justify-center font-bold text-sm">1</span>
                    <h2 class="text-lg font-bold text-slate-900">ข้อมูลส่วนตัว & รูปโปรไฟล์</h2>
                </div>

                <!-- Avatar Preview & Upload -->
                <div class="flex flex-col sm:flex-row items-center gap-6 mb-8 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="relative">
                        <img id="avatarPreview" src="<?= esc($alumni['alm_image'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($alumni['alm_name']) . '&background=random&color=fff&size=150') ?>" alt="Avatar" class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl object-cover border-4 border-white shadow-md">
                    </div>
                    <div class="flex-1 space-y-3 text-center sm:text-left">
                        <label class="block text-sm font-bold text-slate-700">เปลี่ยนรูปโปรไฟล์</label>
                        <div class="flex flex-col sm:flex-row gap-2">
                            <input type="file" name="avatar_file" id="avatarFileInput" accept="image/*" class="text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-pink-50 file:text-pink-600 hover:file:bg-pink-100 file:cursor-pointer">
                        </div>
                        <p class="text-[11px] text-slate-400">รองรับไฟล์ JPG, PNG, WebP ขนาดไม่เกิน 4MB</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-12 gap-4 mb-4">
                    <div class="sm:col-span-3">
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">คำนำหน้า</label>
                        <select name="prefix" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm text-slate-900 bg-white">
                            <option value="" <?= empty($alumni['alm_prefix']) ? 'selected' : '' ?>>-- เลือก --</option>
                            <option value="นาย" <?= ($alumni['alm_prefix'] ?? '') === 'นาย' ? 'selected' : '' ?>>นาย</option>
                            <option value="นางสาว" <?= ($alumni['alm_prefix'] ?? '') === 'นางสาว' ? 'selected' : '' ?>>นางสาว</option>
                            <option value="นาง" <?= ($alumni['alm_prefix'] ?? '') === 'นาง' ? 'selected' : '' ?>>นาง</option>
                            <option value="ดร." <?= ($alumni['alm_prefix'] ?? '') === 'ดร.' ? 'selected' : '' ?>>ดร.</option>
                            <option value="ว่าที่ ร.ต." <?= ($alumni['alm_prefix'] ?? '') === 'ว่าที่ ร.ต.' ? 'selected' : '' ?>>ว่าที่ ร.ต.</option>
                            <option value="พระภิกษุ" <?= ($alumni['alm_prefix'] ?? '') === 'พระภิกษุ' ? 'selected' : '' ?>>พระภิกษุ</option>
                            <option value="อื่นๆ" <?= (!empty($alumni['alm_prefix']) && !in_array($alumni['alm_prefix'], ['นาย', 'นางสาว', 'นาง', 'ดร.', 'ว่าที่ ร.ต.', 'พระภิกษุ'])) ? 'selected' : '' ?>>อื่นๆ</option>
                        </select>
                    </div>

                    <div class="sm:col-span-4">
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">ชื่อจริง <span class="text-red-500">*</span></label>
                        <input type="text" name="first_name" value="<?= esc($alumni['alm_first_name'] ?? (explode(' ', $alumni['alm_name'] ?? '')[0] ?? '')) ?>" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm text-slate-900">
                    </div>

                    <div class="sm:col-span-5">
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">นามสกุล <span class="text-red-500">*</span></label>
                        <input type="text" name="last_name" value="<?= esc($alumni['alm_last_name'] ?? (isset(explode(' ', $alumni['alm_name'] ?? '')[1]) ? implode(' ', array_slice(explode(' ', $alumni['alm_name'] ?? ''), 1)) : '')) ?>" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm text-slate-900">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="block text-xs font-bold text-slate-700 uppercase">ชื่อผู้ใช้งาน (Username) / อีเมล</label>
                            <label class="inline-flex items-center gap-1.5 cursor-pointer">
                                <input type="hidden" name="privacy_email" value="0">
                                <input type="checkbox" name="privacy_email" value="1" <?= (!isset($alumni['alm_privacy_email']) || $alumni['alm_privacy_email'] == 1 || $alumni['alm_privacy_email'] === 'public') ? 'checked' : '' ?> class="rounded text-pink-600 focus:ring-pink-500 w-4 h-4 border-slate-300">
                                <span class="text-[11px] font-medium text-slate-500 select-none">🌐 แสดงสาธารณะ</span>
                            </label>
                        </div>
                        <input type="text" value="<?= esc(!empty($alumni['alm_username']) ? $alumni['alm_username'] : ($alumni['alm_email'] ?? '')) ?>" disabled class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-sm text-slate-500 cursor-not-allowed font-medium">
                        <p class="text-[11px] text-slate-400 mt-1">ใช้เป็นชื่อบัญชีหลักสำหรับเข้าสู่ระบบ (ไม่สามารถแก้ไขได้)</p>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="block text-xs font-bold text-slate-700 uppercase">เบอร์โทรศัพท์</label>
                            <label class="inline-flex items-center gap-1.5 cursor-pointer">
                                <input type="hidden" name="privacy_phone" value="0">
                                <input type="checkbox" name="privacy_phone" value="1" <?= (!isset($alumni['alm_privacy_phone']) || $alumni['alm_privacy_phone'] == 1 || $alumni['alm_privacy_phone'] === 'public') ? 'checked' : '' ?> class="rounded text-pink-600 focus:ring-pink-500 w-4 h-4 border-slate-300">
                                <span class="text-[11px] font-medium text-slate-500 select-none">🌐 แสดงสาธารณะ</span>
                            </label>
                        </div>
                        <input type="tel" name="phone" value="<?= esc($alumni['alm_phone'] ?? '') ?>" placeholder="08xxxxxxxx" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm text-slate-900">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">ช่องทางติดต่ออื่นๆ (Line ID, Facebook)</label>
                        <input type="text" name="contact_other" value="<?= esc($alumni['alm_contact_other'] ?? '') ?>" placeholder="Line: @xxx, FB: ชื่อเฟซ" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm text-slate-900">
                    </div>

                    <div class="sm:col-span-2">
                        <div class="flex items-center justify-between mb-1">
                            <label class="block text-xs font-bold text-slate-700 uppercase">ที่อยู่ปัจจุบันที่สามารถติดต่อได้</label>
                            <label class="inline-flex items-center gap-1.5 cursor-pointer">
                                <input type="hidden" name="privacy_address" value="0">
                                <input type="checkbox" name="privacy_address" value="1" <?= (isset($alumni['alm_privacy_address']) && ($alumni['alm_privacy_address'] == 1 || $alumni['alm_privacy_address'] === 'public')) ? 'checked' : '' ?> class="rounded text-pink-600 focus:ring-pink-500 w-4 h-4 border-slate-300">
                                <span class="text-[11px] font-medium text-slate-500 select-none">🌐 แสดงสาธารณะ</span>
                            </label>
                        </div>
                        <textarea name="current_address" rows="2" placeholder="บ้านเลขที่ หมู่ ซอย ถนน ตำบล อำเภอ จังหวัด รหัสไปรษณีย์" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm text-slate-900"><?= esc($alumni['alm_current_address'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Section 2: Education & Career (PAO Nakhon Sawan Highlight) -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm relative overflow-hidden">
                <div class="border-b border-slate-100 pb-4 mb-6 flex items-center justify-between flex-wrap gap-2">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm">2</span>
                        <h2 class="text-lg font-bold text-slate-900">การศึกษา & ประสบการณ์ทำงาน</h2>
                    </div>
                    <span class="text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200 px-3 py-1 rounded-full flex items-center gap-1.5">
                        ⭐ ข้อมูลมีผลต่อการพิจารณาตำแหน่ง อบจ.
                    </span>
                </div>

                <!-- PAO Nakhon Sawan Info Callout -->
                <div class="mb-6 p-4 rounded-2xl bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200/80 text-xs sm:text-sm text-blue-900 leading-relaxed flex items-start gap-3">
                    <span class="text-xl shrink-0">🏛️</span>
                    <div>
                        <strong class="font-bold text-blue-950 block mb-0.5">ประกาศความร่วมมือ สังกัด อบจ.นครสวรรค์:</strong>
                        <span>ข้อมูล <strong>ระดับการศึกษา สาขาวิชาที่จบ และประสบการณ์ทำงาน</strong> มีผลอย่างยิ่งต่อการพิจารณารับสมัครงานหรือสรรหาบุคลากรในกรณีที่มีตำแหน่งงานว่างในสังกัด อบจ.นครสวรรค์</span>
                    </div>
                </div>

                <div class="space-y-5">
                    <!-- School, School Grad Level, Batch & Grad Year -->
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">สถาบัน / โรงเรียนที่จบ <span class="text-red-500">*</span></label>
                                <?php $currSchool = $alumni['alm_school'] ?? 'โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์'; ?>
                                <select name="school" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-xs sm:text-sm text-slate-900 bg-white">
                                    <option value="โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์" <?= (strpos($currSchool, 'สวนกุหลาบ') !== false) ? 'selected' : '' ?>>🌸 สวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์ (สกจ.)</option>
                                    <option value="โรงเรียนจิรประวัติวิทยาคม" <?= (strpos($currSchool, 'จิรประวัติวิทยาคม') !== false) ? 'selected' : '' ?>>🏫 จิรประวัติวิทยาคม (จ.ว.)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">ระดับชั้นที่จบจากโรงเรียน <span class="text-red-500">*</span></label>
                                <?php $currSchoolLvl = $alumni['alm_school_grad_level'] ?? 'มัธยมศึกษาปีที่ 6'; ?>
                                <select name="school_grad_level" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-xs sm:text-sm text-slate-900 bg-white">
                                    <option value="มัธยมศึกษาปีที่ 3" <?= (strpos($currSchoolLvl, '3') !== false) ? 'selected' : '' ?>>มัธยมศึกษาปีที่ 3 (ม.3)</option>
                                    <option value="มัธยมศึกษาปีที่ 6" <?= (strpos($currSchoolLvl, '6') !== false || empty($currSchoolLvl)) ? 'selected' : '' ?>>มัธยมศึกษาปีที่ 6 (ม.6)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">รุ่นที่จบ (เช่น รุ่นที่ 15)</label>
                                <input type="text" name="batch" value="<?= esc($alumni['alm_batch'] ?? '') ?>" placeholder="เช่น รุ่นที่ 15" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm text-slate-900 bg-white">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">ปีการศึกษาที่จบ (พ.ศ.)</label>
                                <input type="text" name="grad_year" value="<?= esc($alumni['alm_grad_year'] ?? '') ?>" placeholder="เช่น 2565" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm text-slate-900 bg-white">
                            </div>
                        </div>
                    </div>

                    <!-- Current Status -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-2">สถานะปัจจุบัน <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <?php $currStatus = $alumni['alm_current_status'] ?? 'ทำงานแล้ว'; ?>
                            <label class="flex items-center gap-3 p-3.5 rounded-2xl border border-slate-200 cursor-pointer hover:border-pink-400 has-[:checked]:border-pink-500 has-[:checked]:bg-pink-50/50 transition">
                                <input type="radio" name="current_status" value="ทำงานแล้ว" <?= $currStatus == 'ทำงานแล้ว' ? 'checked' : '' ?> onchange="toggleStatusSections()" class="text-pink-600 focus:ring-pink-500">
                                <div>
                                    <div class="text-sm font-bold text-slate-800">💼 ทำงานแล้ว</div>
                                    <div class="text-[11px] text-slate-400">มีงานทำ / ธุรกิจส่วนตัว</div>
                                </div>
                            </label>

                            <label class="flex items-center gap-3 p-3.5 rounded-2xl border border-slate-200 cursor-pointer hover:border-blue-400 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50/50 transition">
                                <input type="radio" name="current_status" value="กำลังศึกษาต่อ" <?= $currStatus == 'กำลังศึกษาต่อ' ? 'checked' : '' ?> onchange="toggleStatusSections()" class="text-blue-600 focus:ring-blue-500">
                                <div>
                                    <div class="text-sm font-bold text-slate-800">🎓 กำลังศึกษาต่อ</div>
                                    <div class="text-[11px] text-slate-400">ป.ตรี / โท / เอก / ปวส.</div>
                                </div>
                            </label>

                            <label class="flex items-center gap-3 p-3.5 rounded-2xl border border-slate-200 cursor-pointer hover:border-amber-400 has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50/50 transition">
                                <input type="radio" name="current_status" value="ว่างงาน" <?= $currStatus == 'ว่างงาน' ? 'checked' : '' ?> onchange="toggleStatusSections()" class="text-amber-600 focus:ring-amber-500">
                                <div>
                                    <div class="text-sm font-bold text-slate-800">⏳ ว่างงาน</div>
                                    <div class="text-[11px] text-slate-400">กำลังมองหางาน</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Job title or Study Place -->
                    <div id="section_working" class="<?= $currStatus == 'ทำงานแล้ว' ? '' : 'hidden' ?>">
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">ตำแหน่งงาน / อาชีพปัจจุบัน / สถานที่ทำงาน</label>
                        <input type="text" name="job_title" value="<?= esc($alumni['alm_job_title'] ?? '') ?>" placeholder="เช่น นักวิชาการคอมพิวเตอร์ อบจ.นครสวรรค์, ธุรกิจส่วนตัว" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm text-slate-900">
                    </div>

                    <div id="section_study" class="<?= $currStatus == 'กำลังศึกษาต่อ' ? '' : 'hidden' ?>">
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">สถานศึกษา / คณะ ที่กำลังศึกษาต่อ</label>
                        <input type="text" name="study_place" value="<?= esc($alumni['alm_study_place'] ?? '') ?>" placeholder="เช่น มหาวิทยาลัยราชภัฏนครสวรรค์ คณะวิทยาการจัดการ" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm text-slate-900">
                    </div>

                    <!-- Highest Degree & Major -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">ระดับการศึกษาสูงสุดที่สำเร็จในปัจจุบัน</label>
                            <?php $gradLvl = $alumni['alm_grad_level'] ?? 'ปริญญาตรี'; ?>
                            <select name="grad_level" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm text-slate-900 bg-white">
                                <option value="มัธยมศึกษาตอนต้น (ม.3)" <?= ($gradLvl == 'มัธยมศึกษาตอนต้น (ม.3)' || $gradLvl == 'มัธยมศึกษาปีที่ 3') ? 'selected' : '' ?>>มัธยมศึกษาตอนต้น (ม.3)</option>
                                <option value="มัธยมศึกษาตอนปลาย (ม.6)" <?= ($gradLvl == 'มัธยมศึกษาตอนปลาย (ม.6)' || $gradLvl == 'มัธยมศึกษาปีที่ 6') ? 'selected' : '' ?>>มัธยมศึกษาตอนปลาย (ม.6)</option>
                                <option value="ประกาศนียบัตรวิชาชีพ (ปวช.)" <?= $gradLvl == 'ประกาศนียบัตรวิชาชีพ (ปวช.)' ? 'selected' : '' ?>>ประกาศนียบัตรวิชาชีพ (ปวช.)</option>
                                <option value="ประกาศนียบัตรวิชาชีพชั้นสูง (ปวส.) / อนุปริญญา" <?= (strpos($gradLvl, 'ปวส') !== false || strpos($gradLvl, 'อนุปริญญา') !== false) ? 'selected' : '' ?>>ประกาศนียบัตรวิชาชีพชั้นสูง (ปวส.) / อนุปริญญา</option>
                                <option value="ปริญญาตรี" <?= $gradLvl == 'ปริญญาตรี' ? 'selected' : '' ?>>ปริญญาตรี</option>
                                <option value="ปริญญาโท" <?= $gradLvl == 'ปริญญาโท' ? 'selected' : '' ?>>ปริญญาโท</option>
                                <option value="ปริญญาเอก" <?= $gradLvl == 'ปริญญาเอก' ? 'selected' : '' ?>>ปริญญาเอก</option>
                                <option value="อื่นๆ" <?= $gradLvl == 'อื่นๆ' ? 'selected' : '' ?>>อื่นๆ (โปรดระบุ)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1 flex items-center justify-between">
                                <span>สาขาวิชาที่จบการศึกษา</span>
                                <span class="text-[10px] text-pink-600 font-normal">⭐ มีผลพิจารณาตำแหน่ง</span>
                            </label>
                            <input type="text" name="grad_major" value="<?= esc($alumni['alm_grad_major'] ?? '') ?>" placeholder="เช่น วิทยาการคอมพิวเตอร์, รัฐประศาสนศาสตร์, นิติศาสตร์" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm text-slate-900">
                        </div>
                    </div>

                    <!-- Work Experience -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1 flex items-center justify-between">
                            <span>ประสบการณ์ทำงาน / ทักษะความเชี่ยวชาญ</span>
                            <span class="text-[10px] text-pink-600 font-normal">⭐ มีผลพิจารณาตำแหน่ง</span>
                        </label>
                        <textarea name="work_experience" rows="3" placeholder="ระบุประวัติการทำงาน ทักษะ หรือความเชี่ยวชาญเฉพาะด้าน (เช่น ด้านสารสนเทศ งานธุรการ ช่างไฟฟ้า บัญชี เป็นต้น)" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm text-slate-900"><?= esc($alumni['alm_work_experience'] ?? '') ?></textarea>
                    </div>

                    <!-- Bio -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">แนะนำตัว / ข้อความสั้นๆ ถึงเพื่อนๆ (Bio)</label>
                        <textarea name="bio" rows="2" placeholder="ข้อความแนะนำตัวสั้นๆ ที่จะแสดงในหน้าโปรไฟล์สาธารณะ" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm text-slate-900"><?= esc($alumni['alm_bio'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Section 3: Feedback & Support Needs -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm relative overflow-hidden">
                <div class="border-b border-slate-100 pb-4 mb-6 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center font-bold text-sm">3</span>
                    <h2 class="text-lg font-bold text-slate-900">ความต้องการการสนับสนุน & ข้อเสนอแนะ</h2>
                </div>

                <?php 
                    $schoolSupports = !empty($alumni['alm_school_support_needs']) ? explode(', ', $alumni['alm_school_support_needs']) : [];
                ?>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-3">ความช่วยเหลือที่ต้องการจากโรงเรียน / อบจ.นครสวรรค์</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                            <?php
                            $supportOptions = [
                                'แจ้งข่าวสารการรับสมัครงาน / ตำแหน่งว่างสังกัด อบจ.นครสวรรค์',
                                'การจัดอบรมพัฒนาทักษะวิชาชีพ / Upskill-Reskill',
                                'การจัดตั้งเครือข่ายธุรกิจศิษย์เก่า (Business Matching)',
                                'การแนะแนวศึกษาต่อระดับอุดมศึกษา',
                                'การจัดกิจกรรมคืนสู่เหย้า / กิจกรรมสานสัมพันธ์รุ่น'
                            ];
                            foreach($supportOptions as $opt):
                                $checked = in_array($opt, $schoolSupports) ? 'checked' : '';
                            ?>
                            <label class="flex items-start gap-2.5 p-3 rounded-xl border border-slate-100 bg-slate-50/50 hover:bg-slate-50 cursor-pointer text-xs sm:text-sm text-slate-700">
                                <input type="checkbox" name="school_support_needs[]" value="<?= esc($opt) ?>" <?= $checked ?> class="mt-0.5 rounded text-pink-600 focus:ring-pink-500">
                                <span><?= esc($opt) ?></span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="pt-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">ข้อเสนอแนะในการพัฒนาโรงเรียนหรือเครือข่ายศิษย์เก่า</label>
                        <textarea name="suggestions" rows="2" placeholder="ข้อคิดเห็นหรือข้อเสนอแนะเพิ่มเติม..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm text-slate-900"><?= esc($alumni['alm_suggestions'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Section 4: Change Password (Optional) -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm relative overflow-hidden">
                <div class="border-b border-slate-100 pb-4 mb-6 flex items-center justify-between flex-wrap gap-2">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-sm">4</span>
                        <h2 class="text-lg font-bold text-slate-900">เปลี่ยนรหัสผ่าน (หากไม่ต้องการเปลี่ยน ให้เว้นว่างไว้)</h2>
                    </div>
                    <span class="text-xs text-slate-400">เว้นว่างไว้หากใช้รหัสผ่านเดิม</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">รหัสผ่านใหม่</label>
                        <input type="password" name="new_password" id="newPasswordInput" placeholder="เว้นว่างไว้หากไม่เปลี่ยน" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm text-slate-900">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">ยืนยันรหัสผ่านใหม่</label>
                        <input type="password" name="passconf" id="passconfInput" placeholder="ยืนยันรหัสผ่านใหม่" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm text-slate-900">
                    </div>
                </div>
                <div id="passwordMismatchWarning" class="hidden mt-3 text-xs font-bold text-red-600 bg-red-50 p-2.5 rounded-xl border border-red-200">
                    ⚠️ รหัสผ่านใหม่และการยืนยันรหัสผ่านไม่ตรงกัน
                </div>
            </div>

            <!-- Section 4: Privacy & PDPA Settings -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm">
                <div class="border-b border-slate-100 pb-4 mb-6 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center font-bold text-sm">4</span>
                        <h2 class="text-lg font-bold text-slate-900">ตั้งค่าความเป็นส่วนตัวของข้อมูล (Privacy Settings)</h2>
                    </div>
                    <span class="text-xs font-bold text-purple-700 bg-purple-50 px-3 py-1 rounded-full border border-purple-200">
                        🛡️ PDPA
                    </span>
                </div>

                <div class="space-y-3">
                    <label class="flex items-center justify-between p-4 rounded-2xl border border-slate-200 hover:border-pink-300 transition cursor-pointer bg-slate-50/50">
                        <div>
                            <span class="text-xs sm:text-sm font-bold text-slate-900 block">แสดงเบอร์โทรศัพท์ในทำเนียบสาธารณะ</span>
                            <span class="text-[11px] sm:text-xs text-slate-500">หากปิด บุคคลภายนอกจะไม่เห็นเบอร์โทรศัพท์ของคุณในหน้าทำเนียบ</span>
                        </div>
                        <input type="checkbox" name="privacy_phone" value="1" <?= ($alumni['alm_privacy_phone'] ?? 1) == 1 ? 'checked' : '' ?> class="w-5 h-5 rounded-lg accent-pink-600 cursor-pointer">
                    </label>

                    <label class="flex items-center justify-between p-4 rounded-2xl border border-slate-200 hover:border-pink-300 transition cursor-pointer bg-slate-50/50">
                        <div>
                            <span class="text-xs sm:text-sm font-bold text-slate-900 block">แสดงอีเมลติดต่อในทำเนียบสาธารณะ</span>
                            <span class="text-[11px] sm:text-xs text-slate-500">หากปิด จะซ่อนอีเมลของคุณจากการแสดงผลหน้าทำเนียบศิษย์เก่า</span>
                        </div>
                        <input type="checkbox" name="privacy_email" value="1" <?= ($alumni['alm_privacy_email'] ?? 1) == 1 ? 'checked' : '' ?> class="w-5 h-5 rounded-lg accent-pink-600 cursor-pointer">
                    </label>

                    <label class="flex items-center justify-between p-4 rounded-2xl border border-slate-200 hover:border-pink-300 transition cursor-pointer bg-slate-50/50">
                        <div>
                            <span class="text-xs sm:text-sm font-bold text-slate-900 block">แสดงที่อยู่ปัจจุบันในทำเนียบสาธารณะ</span>
                            <span class="text-[11px] sm:text-xs text-slate-500">แนะนำให้ปิดไว้เพื่อความปลอดภัยของข้อมูลส่วนบุคคล</span>
                        </div>
                        <input type="checkbox" name="privacy_address" value="1" <?= ($alumni['alm_privacy_address'] ?? 0) == 1 ? 'checked' : '' ?> class="w-5 h-5 rounded-lg accent-pink-600 cursor-pointer">
                    </label>
                </div>
            </div>

            <!-- Desktop Action Buttons & Mobile Floating Sticky Bar -->
            <div class="hidden sm:flex flex-row items-center justify-between gap-4 pt-4">
                <a href="<?= base_url('alumni/profile/' . $alumni['alm_id']) ?>" class="px-6 py-3 rounded-2xl border border-slate-200 text-slate-600 hover:bg-slate-100 font-bold text-sm text-center transition">
                    ← ยกเลิกและกลับหน้าโปรไฟล์
                </a>
                
                <button type="submit" id="saveButton" class="px-8 py-3.5 rounded-2xl bg-gradient-to-r from-pink-600 to-blue-600 text-white font-bold text-base shadow-lg shadow-pink-500/25 hover:opacity-95 hover:shadow-xl transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span>บันทึกการแก้ไขโปรไฟล์</span>
                </button>
            </div>

            <!-- Mobile Sticky Bottom Action Dock -->
            <div class="sm:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-xl border-t border-slate-200 p-3 shadow-2xl flex items-center gap-2">
                <a href="<?= base_url('alumni/profile/' . $alumni['alm_id']) ?>" class="w-12 h-12 rounded-2xl border border-slate-200 flex items-center justify-center text-slate-600 text-lg shrink-0">
                    ✕
                </a>
                <button type="submit" class="flex-1 h-12 rounded-2xl bg-gradient-to-r from-pink-600 to-blue-600 text-white font-bold text-sm shadow-md shadow-pink-500/30 flex items-center justify-center gap-2 cursor-pointer active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span>บันทึกการแก้ไข</span>
                </button>
            </div>
        </form>

    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 pt-12 pb-24 sm:pb-8 border-t border-slate-800 mt-20">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-xl font-bold text-white mb-2">SKJ Alumni Network</h2>
            <p class="text-slate-400 mb-4 text-xs">ระบบสำรวจภาวะการมีงานทำและทำเนียบศิษย์เก่า สวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์</p>
            
            <!-- Admin Portal Entry Button -->
            <div class="mb-6 flex items-center justify-center">
                <a href="<?= base_url('admin') ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-800/90 hover:bg-slate-700 text-slate-300 hover:text-white text-xs font-semibold border border-slate-700 hover:border-pink-500/60 transition-all shadow-sm group">
                    <svg class="w-4 h-4 text-pink-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <span>ระบบจัดการผู้ดูแลระบบ (Admin Portal)</span>
                </a>
            </div>

            <div class="border-t border-slate-800 pt-6 flex justify-center">
                <p class="text-slate-500 text-xs">© 2026 SKJ Alumni. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Status sections toggle
        function toggleStatusSections() {
            const selected = document.querySelector('input[name="current_status"]:checked')?.value;
            const secWorking = document.getElementById('section_working');
            const secStudy = document.getElementById('section_study');

            if (selected === 'ทำงานแล้ว') {
                secWorking?.classList.remove('hidden');
                secStudy?.classList.add('hidden');
            } else if (selected === 'กำลังศึกษาต่อ') {
                secWorking?.classList.add('hidden');
                secStudy?.classList.remove('hidden');
            } else {
                secWorking?.classList.add('hidden');
                secStudy?.classList.add('hidden');
            }
        }

        // Avatar preview on file select
        document.getElementById('avatarFileInput')?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('avatarPreview').src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Password matching check
        const newPass = document.getElementById('newPasswordInput');
        const passConf = document.getElementById('passconfInput');
        const mismatchWarn = document.getElementById('passwordMismatchWarning');

        function checkPassMatch() {
            if (newPass.value.length > 0 && passConf.value.length > 0) {
                if (newPass.value !== passConf.value) {
                    mismatchWarn.classList.remove('hidden');
                } else {
                    mismatchWarn.classList.add('hidden');
                }
            } else {
                mismatchWarn.classList.add('hidden');
            }
        }

        newPass?.addEventListener('input', checkPassMatch);
        passConf?.addEventListener('input', checkPassMatch);

        // SweetAlert2 Alerts for Session Flash Messages
        <?php if(session()->getFlashdata('success_msg')): ?>
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ!',
                text: <?= json_encode(session()->getFlashdata('success_msg')) ?>,
                confirmButtonColor: '#db2777',
                confirmButtonText: 'ตกลง'
            });
        <?php endif; ?>

        <?php if(session()->getFlashdata('error_msg')): ?>
            Swal.fire({
                icon: 'error',
                title: 'ข้อผิดพลาด!',
                text: <?= json_encode(session()->getFlashdata('error_msg')) ?>,
                confirmButtonColor: '#db2777',
                confirmButtonText: 'ตกลง'
            });
        <?php endif; ?>

        // Form Submit Confirmation
        document.getElementById('editProfileForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;

            if (newPass.value.length > 0 && newPass.value !== passConf.value) {
                Swal.fire({
                    icon: 'warning',
                    title: 'รหัสผ่านไม่ตรงกัน',
                    text: 'กรุณาตรวจสอบการยืนยันรหัสผ่านใหม่ให้ถูกต้องตรงกัน',
                    confirmButtonColor: '#db2777'
                });
                return;
            }

            Swal.fire({
                title: 'ยืนยันการบันทึกข้อมูล?',
                text: 'คุณต้องการบันทึกการเปลี่ยนแปลงข้อมูลโปรไฟล์และแบบสำรวจหรือไม่',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#db2777',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'บันทึกข้อมูล',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'กำลังบันทึกข้อมูล...',
                        text: 'กรุณารอสักครู่',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    form.submit();
                }
            });
        });

        function confirmLogout(e, url) {
            e.preventDefault();
            Swal.fire({
                title: 'ยืนยันการออกจากระบบ?',
                text: 'คุณต้องการออกจากระบบ SKJ Alumni หรือไม่',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#db2777',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'ออกจากระบบ',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>
</body>
</html>
