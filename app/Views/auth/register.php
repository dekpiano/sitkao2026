<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงทะเบียนและแบบสำรวจศิษย์เก่า | SKJ Alumni</title>
    <link href="https://fonts.googleapis.com/css2?family=K2D:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'K2D', sans-serif;
        }

        .swal2-popup {
            font-family: 'K2D', sans-serif !important;
            border-radius: 1.25rem !important;
        }

        /* Flat checkbox & radio styles */
        input[type="radio"],
        input[type="checkbox"] {
            accent-color: #db2777;
            /* pink-600 */
        }

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
            opacity: 0.35;
            animation: floatBlob 24s infinite alternate cubic-bezier(0.4, 0, 0.2, 1);
        }

        .blob-1 {
            top: 5%;
            left: 5%;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, #f472b6 0%, transparent 70%);
        }

        .blob-2 {
            bottom: 10%;
            right: 5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, #60a5fa 0%, transparent 70%);
            animation-duration: 28s;
        }

        .blob-3 {
            top: 45%;
            right: 20%;
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, #c084fc 0%, transparent 70%);
            animation-duration: 20s;
        }

        @keyframes floatBlob {
            0% {
                transform: translate(0, 0) scale(1);
            }

            50% {
                transform: translate(70px, 50px) scale(1.1);
            }

            100% {
                transform: translate(-50px, 70px) scale(0.95);
            }
        }

        /* Step Transition */
        .step-panel {
            display: none;
            opacity: 0;
            transform: translateY(12px);
            transition: opacity 0.35s ease-out, transform 0.35s ease-out;
        }

        .step-panel.active {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }
    </style>
    <script src="<?= base_url('assets/js/floating-bubbles.js') ?>" defer></script>
</head>

<body class="min-h-screen text-slate-800 antialiased py-6 sm:py-12 relative">

    <!-- Animated Ambient Background -->
    <div class="animated-bg">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>

    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 relative z-10 px-4">

        <!-- Header -->
        <div class="mb-6 sm:mb-8 text-center">
            <div class="inline-flex items-center gap-2 mb-2">
                <span
                    class="w-8 h-8 rounded-lg bg-gradient-to-br from-pink-500 to-blue-500 flex items-center justify-center text-white font-bold text-sm shadow-sm">SKJ</span>
                <span class="text-xs sm:text-sm font-bold text-slate-700">จิรประวัติวิทยาคม (จ.ว.) & สวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์ (สกจ.)</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-2">แบบสำรวจและลงทะเบียนศิษย์เก่า
            </h1>
            <div
                class="inline-block bg-pink-50 border border-pink-100 text-pink-700 text-xs px-3 py-1 rounded-full font-medium">
                ข้อมูลเพื่อการสนับสนุนและประสานงาน อบจ.นครสวรรค์
            </div>
        </div>

        <!-- Multi-Step Progress Header -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-4 sm:p-6 mb-6">

            <!-- Progress Bar -->
            <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden mb-6">
                <div id="progressBar"
                    class="h-full bg-gradient-to-r from-pink-500 via-purple-500 to-blue-500 transition-all duration-500 ease-out"
                    style="width: 25%;"></div>
            </div>

            <!-- Stepper Indicators -->
            <div class="grid grid-cols-4 gap-2 text-center">

                <!-- Step 1 Indicator -->
                <div class="step-indicator group flex flex-col items-center" id="indicator-1">
                    <div
                        class="step-circle w-8 h-8 sm:w-9 sm:h-9 rounded-full flex items-center justify-center text-xs sm:text-sm font-bold bg-pink-600 text-white shadow-md shadow-pink-500/25 transition-all">
                        1
                    </div>
                    <span
                        class="step-text text-[11px] sm:text-xs font-bold text-pink-600 mt-2 line-clamp-1">บัญชี & ข้อมูลส่วนตัว</span>
                </div>

                <!-- Step 2 Indicator -->
                <div class="step-indicator group flex flex-col items-center" id="indicator-2">
                    <div
                        class="step-circle w-8 h-8 sm:w-9 sm:h-9 rounded-full flex items-center justify-center text-xs sm:text-sm font-bold bg-slate-100 text-slate-400 transition-all">
                        2
                    </div>
                    <span
                        class="step-text text-[11px] sm:text-xs font-medium text-slate-400 mt-2 line-clamp-1">ข้อมูลโรงเรียน</span>
                </div>

                <!-- Step 3 Indicator -->
                <div class="step-indicator group flex flex-col items-center" id="indicator-3">
                    <div
                        class="step-circle w-8 h-8 sm:w-9 sm:h-9 rounded-full flex items-center justify-center text-xs sm:text-sm font-bold bg-slate-100 text-slate-400 transition-all">
                        3
                    </div>
                    <span
                        class="step-text text-[11px] sm:text-xs font-medium text-slate-400 mt-2 line-clamp-1">ปัจจุบัน & การทำงาน</span>
                </div>

                <!-- Step 4 Indicator -->
                <div class="step-indicator group flex flex-col items-center" id="indicator-4">
                    <div
                        class="step-circle w-8 h-8 sm:w-9 sm:h-9 rounded-full flex items-center justify-center text-xs sm:text-sm font-bold bg-slate-100 text-slate-400 transition-all">
                        4
                    </div>
                    <span
                        class="step-text text-[11px] sm:text-xs font-medium text-slate-400 mt-2 line-clamp-1">ความต้องการ</span>
                </div>

            </div>
        </div>

        <!-- Form Container -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">

            <?php if (isset($validation)): ?>
                <div class="bg-red-50 text-red-700 p-4 sm:p-5 border-b border-red-100 text-sm">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>

            <form id="multiStepForm" action="<?= base_url('register/submit') ?>" method="POST" class="p-5 sm:p-8">

                <!-- ============================================== -->
                <!-- STEP 1: ข้อมูลบัญชีผู้ใช้ & ข้อมูลติดต่อส่วนตัว -->
                <!-- ============================================== -->
                <div class="step-panel active" id="step-1">
                    <div class="flex items-center mb-6 pb-3 border-b border-slate-100">
                        <div class="w-2 h-6 bg-pink-600 rounded-full mr-3"></div>
                        <div>
                            <h2 class="text-lg sm:text-xl font-bold text-slate-900">ขั้นตอนที่ 1: บัญชีผู้ใช้งาน &
                                ข้อมูลส่วนตัว</h2>
                            <p class="text-xs text-slate-500">กรอกอีเมลเพื่อใช้เข้าสู่ระบบและข้อมูลการติดต่อของคุณ</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Username Field -->
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                                    ชื่อผู้ใช้งาน (Username) <span class="text-red-500">*</span>
                                    <span class="text-[11px] font-normal text-slate-400 block sm:inline">(สำหรับเข้าสู่ระบบ)</span>
                                </label>
                                <input name="username" id="username" type="text" required minlength="3" maxlength="50"
                                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 outline-none transition bg-slate-50 focus:bg-white text-sm sm:text-base font-medium"
                                    placeholder="เช่น somchai2520 หรือเบอร์โทร" value="<?= old('username') ?>">
                                <p class="text-[11px] text-slate-400 mt-1">ใช้ภาษาอังกฤษ ตัวเลข หรือเบอร์โทร (อย่างน้อย 3 ตัว)</p>
                            </div>

                            <!-- Email Field (Optional) -->
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                                    อีเมลติดต่อ <span class="text-xs font-normal text-slate-400">(ไม่บังคับ / มีหรือไม่มีก็ได้)</span>
                                </label>
                                <input name="email" id="email" type="email"
                                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 outline-none transition bg-slate-50 focus:bg-white text-sm sm:text-base"
                                    placeholder="เช่น yourname@gmail.com" value="<?= old('email') ?>">
                                <p class="text-[11px] text-slate-400 mt-1">สำหรับรับข่าวสารและกู้รหัสผ่านทางอีเมล</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Password Field -->
                            <div>
                                <label
                                    class="block text-sm font-semibold text-slate-700 mb-1.5 flex items-center justify-between">
                                    <span>รหัสผ่าน <span class="text-red-500">*</span></span>
                                    <span id="strengthLabel"
                                        class="text-[11px] font-bold text-slate-400">ยังไม่ระบุ</span>
                                </label>
                                <div class="relative">
                                    <input name="password" id="password" type="password" required minlength="8"
                                        class="w-full rounded-xl border border-slate-300 pl-4 pr-11 py-3 text-slate-900 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 outline-none transition bg-slate-50 focus:bg-white text-sm sm:text-base font-mono"
                                        placeholder="อย่างน้อย 8 ตัวอักษร">
                                    <button type="button" onclick="togglePasswordVisibility('password', 'eyeIcon1')"
                                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                        <svg id="eyeIcon1" class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Password Strength Progress Bars -->
                                <div class="grid grid-cols-4 gap-1.5 mt-2">
                                    <div id="bar-1" class="h-1.5 rounded-full bg-slate-200 transition-all duration-300">
                                    </div>
                                    <div id="bar-2" class="h-1.5 rounded-full bg-slate-200 transition-all duration-300">
                                    </div>
                                    <div id="bar-3" class="h-1.5 rounded-full bg-slate-200 transition-all duration-300">
                                    </div>
                                    <div id="bar-4" class="h-1.5 rounded-full bg-slate-200 transition-all duration-300">
                                    </div>
                                </div>

                                <!-- Password Criteria Checklist -->
                                <div
                                    class="mt-2.5 space-y-1 text-[11px] text-slate-500 bg-slate-50 p-2.5 rounded-xl border border-slate-200/80">
                                    <div id="rule-length" class="flex items-center gap-1.5 transition-colors">
                                        <span
                                            class="rule-icon w-3.5 h-3.5 rounded-full bg-slate-200 flex items-center justify-center text-[9px] text-slate-500 font-bold">•</span>
                                        <span>ความยาวอย่างน้อย 8 ตัวอักษร</span>
                                    </div>
                                    <div id="rule-upper" class="flex items-center gap-1.5 transition-colors">
                                        <span
                                            class="rule-icon w-3.5 h-3.5 rounded-full bg-slate-200 flex items-center justify-center text-[9px] text-slate-500 font-bold">•</span>
                                        <span>มีตัวอักษรพิมพ์ใหญ่ (A-Z)</span>
                                    </div>
                                    <div id="rule-lower" class="flex items-center gap-1.5 transition-colors">
                                        <span
                                            class="rule-icon w-3.5 h-3.5 rounded-full bg-slate-200 flex items-center justify-center text-[9px] text-slate-500 font-bold">•</span>
                                        <span>มีตัวอักษรพิมพ์เล็ก (a-z)</span>
                                    </div>
                                    <div id="rule-number" class="flex items-center gap-1.5 transition-colors">
                                        <span
                                            class="rule-icon w-3.5 h-3.5 rounded-full bg-slate-200 flex items-center justify-center text-[9px] text-slate-500 font-bold">•</span>
                                        <span>มีตัวเลขอย่างน้อย 1 ตัว (0-9)</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Confirm Password Field -->
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">ยืนยันรหัสผ่าน <span
                                        class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input name="passconf" id="passconf" type="password" required minlength="8"
                                        class="w-full rounded-xl border border-slate-300 pl-4 pr-11 py-3 text-slate-900 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 outline-none transition bg-slate-50 focus:bg-white text-sm sm:text-base font-mono"
                                        placeholder="พิมพ์รหัสผ่านเดิมอีกครั้ง">
                                    <button type="button" onclick="togglePasswordVisibility('passconf', 'eyeIcon2')"
                                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                        <svg id="eyeIcon2" class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Real-time Instant Match Feedback Message -->
                                <div id="matchFeedback" class="mt-2.5 hidden">
                                    <div id="matchSuccess"
                                        class="hidden p-2.5 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-xs font-semibold flex items-center gap-2">
                                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>รหัสผ่านตรงกันสมบูรณ์ ✓</span>
                                    </div>
                                    <div id="matchError"
                                        class="hidden p-2.5 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl text-xs font-semibold flex items-center gap-2 animate-pulse">
                                        <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" />
                                            <line x1="15" y1="9" x2="9" y2="15" />
                                            <line x1="9" y1="9" x2="15" y2="15" />
                                        </svg>
                                        <span>รหัสผ่านไม่ตรงกัน กรุณาตรวจสอบ ✗</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="border-slate-100 my-2">

                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-3 sm:gap-4">
                            <!-- คำนำหน้าชื่อ -->
                            <div class="sm:col-span-3">
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">คำนำหน้า <span
                                        class="text-red-500">*</span></label>
                                <div class="relative">
                                    <select name="prefix" id="prefix" required
                                        class="w-full rounded-xl border border-slate-300 px-3.5 py-3 text-slate-900 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 outline-none transition bg-slate-50 focus:bg-white text-sm sm:text-base appearance-none cursor-pointer">
                                        <option value="" disabled <?= old('prefix') ? '' : 'selected' ?>>-- เลือก --
                                        </option>
                                        <option value="นาย" <?= old('prefix') === 'นาย' ? 'selected' : '' ?>>นาย</option>
                                        <option value="นางสาว" <?= old('prefix') === 'นางสาว' ? 'selected' : '' ?>>นางสาว
                                        </option>
                                        <option value="นาง" <?= old('prefix') === 'นาง' ? 'selected' : '' ?>>นาง</option>
                                        <option value="ดร." <?= old('prefix') === 'ดร.' ? 'selected' : '' ?>>ดร.</option>
                                        <option value="ว่าที่ ร.ต." <?= old('prefix') === 'ว่าที่ ร.ต.' ? 'selected' : '' ?>>ว่าที่ ร.ต.</option>
                                        <option value="พระภิกษุ" <?= old('prefix') === 'พระภิกษุ' ? 'selected' : '' ?>>
                                            พระภิกษุ</option>
                                        <option value="อื่นๆ" <?= (old('prefix') && !in_array(old('prefix'), ['นาย', 'นางสาว', 'นาง', 'ดร.', 'ว่าที่ ร.ต.', 'พระภิกษุ'])) ? 'selected' : '' ?>>
                                            อื่นๆ (ระบุ)</option>
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <input type="text" name="prefix_other" id="prefix_other" placeholder="ระบุคำนำหน้า"
                                    class="<?= (old('prefix') === 'อื่นๆ' || (old('prefix_other') && !in_array(old('prefix'), ['นาย', 'นางสาว', 'นาง', 'ดร.', 'ว่าที่ ร.ต.', 'พระภิกษุ']))) ? '' : 'hidden' ?> mt-2 w-full rounded-xl border border-slate-300 px-3 py-2 text-slate-900 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 outline-none transition bg-white text-xs sm:text-sm"
                                    value="<?= old('prefix_other') ?>">
                            </div>

                            <!-- ชื่อจริง -->
                            <div class="sm:col-span-4">
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">ชื่อจริง <span
                                        class="text-red-500">*</span></label>
                                <input name="first_name" id="first_name" type="text" required
                                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 outline-none transition bg-slate-50 focus:bg-white text-sm sm:text-base"
                                    placeholder="เช่น สมชาย" value="<?= old('first_name') ?>">
                            </div>

                            <!-- นามสกุล -->
                            <div class="sm:col-span-5">
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">นามสกุล <span
                                        class="text-red-500">*</span></label>
                                <input name="last_name" id="last_name" type="text" required
                                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 outline-none transition bg-slate-50 focus:bg-white text-sm sm:text-base"
                                    placeholder="เช่น ใจดี" value="<?= old('last_name') ?>">
                            </div>
                        </div>

                        <!-- เบอร์โทรศัพท์ & ช่องทางติดต่ออื่น -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">เบอร์โทรศัพท์ติดต่อ</label>
                                <input name="phone" id="phone" type="tel"
                                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 outline-none transition bg-slate-50 focus:bg-white text-sm sm:text-base"
                                    placeholder="เช่น 0812345678" value="<?= old('phone') ?>">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">ช่องทางติดต่ออื่น (Line ID / Facebook / etc.)</label>
                                <input name="contact_other" id="contact_other" type="text"
                                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 outline-none transition bg-slate-50 focus:bg-white text-sm sm:text-base"
                                    placeholder="เช่น Line: somchai_skj, FB: Somchai Jaidee" value="<?= old('contact_other') ?>">
                            </div>
                        </div>

                        <!-- ที่อยู่ปัจจุบัน -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">ที่อยู่ปัจจุบัน</label>
                            <textarea name="current_address" id="current_address" rows="2"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 outline-none transition bg-slate-50 focus:bg-white text-sm sm:text-base"
                                placeholder="เช่น บ้านเลขที่ ถนน ตำบล อำเภอ จังหวัด"><?= old('current_address') ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- ============================================== -->
                <!-- STEP 2: ประวัติศิษย์เก่า (ตอนอยู่โรงเรียน จ.ว. / สกจ.) -->
                <!-- ============================================== -->
                <div class="step-panel" id="step-2">
                    <div class="flex items-center mb-6 pb-3 border-b border-slate-100">
                        <div class="w-2 h-6 bg-pink-600 rounded-full mr-3"></div>
                        <div>
                            <h2 class="text-lg sm:text-xl font-bold text-slate-900">ขั้นตอนที่ 2: ประวัติศิษย์เก่า (ตอนอยู่โรงเรียน)</h2>
                            <p class="text-xs text-slate-500">ข้อมูลสถาบัน ระดับชั้นที่สำเร็จการศึกษาจากโรงเรียน และรุ่นที่จบ (จ.ว. / สกจ.)</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <!-- ข้อมูลการศึกษาเดิมจากโรงเรียน (SKJ / จ.ว.)  -->
                        <div class="p-5 sm:p-6 rounded-2xl bg-white border border-slate-200/90 space-y-5 shadow-xs">
                            <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                                <span class="w-7 h-7 rounded-lg bg-pink-100 text-pink-600 flex items-center justify-center font-bold text-xs shadow-xs">🏫</span>
                                <div>
                                    <h3 class="text-sm sm:text-base font-bold text-slate-900">สถาบันและระดับชั้นที่สำเร็จการศึกษาจากโรงเรียน</h3>
                                    <p class="text-[11px] text-slate-500">ระบุโรงเรียน ระดับชั้น ม.3 หรือ ม.6 และปีการศึกษาที่จบ</p>
                                </div>
                            </div>

                            <!-- School Selection (จ.ว. / สกจ.) -->
                            <div>
                                <label class="block text-sm font-bold text-slate-800 mb-2">
                                    โรงเรียน / สถาบันที่สำเร็จการศึกษา <span class="text-red-500">*</span>
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <?php 
                                        $selectedSchool = old('school', 'โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์');
                                    ?>
                                    <!-- Option 1: สกจ. -->
                                    <label class="school-card relative flex items-start p-4 border-2 rounded-2xl cursor-pointer transition-all duration-200 <?= ($selectedSchool === 'โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์') ? 'border-pink-500 bg-pink-50/40 shadow-sm' : 'border-slate-200 bg-white hover:border-slate-300' ?>">
                                        <input type="radio" name="school" value="โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์" 
                                               class="w-4 h-4 mt-1 text-pink-600 focus:ring-pink-500 border-slate-300 mr-3 shrink-0" 
                                               <?= ($selectedSchool === 'โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์') ? 'checked' : '' ?>
                                               onchange="updateSchoolCardSelection()">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="px-2 py-0.5 rounded-md bg-gradient-to-r from-pink-500 to-blue-500 text-white text-[11px] font-black shadow-xs">สกจ.</span>
                                                <span class="text-xs font-bold text-pink-700">ยุคปัจจุบัน</span>
                                            </div>
                                            <h4 class="text-sm font-bold text-slate-900 leading-snug">โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์</h4>
                                            <p class="text-[11px] text-slate-500 mt-0.5">ศิษย์เก่าสวนกุหลาบฯ จิรประวัติ</p>
                                        </div>
                                    </label>

                                    <!-- Option 2: จ.ว. -->
                                    <label class="school-card relative flex items-start p-4 border-2 rounded-2xl cursor-pointer transition-all duration-200 <?= ($selectedSchool === 'โรงเรียนจิรประวัติวิทยาคม') ? 'border-blue-500 bg-blue-50/40 shadow-sm' : 'border-slate-200 bg-white hover:border-slate-300' ?>">
                                        <input type="radio" name="school" value="โรงเรียนจิรประวัติวิทยาคม" 
                                               class="w-4 h-4 mt-1 text-blue-600 focus:ring-blue-500 border-slate-300 mr-3 shrink-0" 
                                               <?= ($selectedSchool === 'โรงเรียนจิรประวัติวิทยาคม') ? 'checked' : '' ?>
                                               onchange="updateSchoolCardSelection()">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="px-2 py-0.5 rounded-md bg-gradient-to-r from-blue-700 to-indigo-700 text-white text-[11px] font-black shadow-xs">จ.ว.</span>
                                                <span class="text-xs font-bold text-blue-700">สถาบันเดิม</span>
                                            </div>
                                            <h4 class="text-sm font-bold text-slate-900 leading-snug">โรงเรียนจิรประวัติวิทยาคม</h4>
                                            <p class="text-[11px] text-slate-500 mt-0.5">ศิษย์เก่าจิรประวัติวิทยาคม</p>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- ระดับชั้นที่สำเร็จการศึกษาจากโรงเรียน (ม.3 หรือ ม.6) -->
                            <div>
                                <label class="block text-sm font-bold text-slate-800 mb-1">
                                    ระดับชั้นที่สำเร็จการศึกษาจากโรงเรียน <span class="text-red-500">*</span>
                                    <span class="text-[11px] font-normal text-slate-500 block sm:inline">(เลือกระดับชั้นที่ท่านจบการศึกษาจากโรงเรียน จ.ว. หรือ สกจ.)</span>
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-2">
                                    <?php 
                                        $selectedSchoolLevel = old('school_grad_level', 'มัธยมศึกษาปีที่ 6');
                                    ?>
                                    <label class="school-level-card relative flex items-start p-3.5 border-2 rounded-2xl cursor-pointer transition-all duration-200 <?= ($selectedSchoolLevel === 'มัธยมศึกษาปีที่ 3') ? 'border-pink-500 bg-pink-50/50 shadow-xs ring-1 ring-pink-500/20' : 'border-slate-200 bg-white hover:border-slate-300' ?>">
                                        <input type="radio" name="school_grad_level" value="มัธยมศึกษาปีที่ 3" 
                                               class="w-4 h-4 mt-1 text-pink-600 focus:ring-pink-500 border-slate-300 mr-3 shrink-0" 
                                               <?= ($selectedSchoolLevel === 'มัธยมศึกษาปีที่ 3') ? 'checked' : '' ?>
                                               required onchange="updateSchoolLevelSelection()">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-0.5">
                                                <span class="text-sm font-bold text-slate-900">มัธยมศึกษาปีที่ 3 (ม.3)</span>
                                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-700">ม.ต้น</span>
                                            </div>
                                            <p class="text-[11px] text-slate-500">สำเร็จการศึกษาระดับชั้นมัธยมศึกษาตอนต้น</p>
                                        </div>
                                    </label>

                                    <label class="school-level-card relative flex items-start p-3.5 border-2 rounded-2xl cursor-pointer transition-all duration-200 <?= ($selectedSchoolLevel === 'มัธยมศึกษาปีที่ 6') ? 'border-pink-500 bg-pink-50/50 shadow-xs ring-1 ring-pink-500/20' : 'border-slate-200 bg-white hover:border-slate-300' ?>">
                                        <input type="radio" name="school_grad_level" value="มัธยมศึกษาปีที่ 6" 
                                               class="w-4 h-4 mt-1 text-pink-600 focus:ring-pink-500 border-slate-300 mr-3 shrink-0" 
                                               <?= ($selectedSchoolLevel === 'มัธยมศึกษาปีที่ 6') ? 'checked' : '' ?>
                                               required onchange="updateSchoolLevelSelection()">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-0.5">
                                                <span class="text-sm font-bold text-slate-900">มัธยมศึกษาปีที่ 6 (ม.6)</span>
                                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-pink-100 text-pink-700">ม.ปลาย</span>
                                            </div>
                                            <p class="text-[11px] text-slate-500">สำเร็จการศึกษาระดับชั้นมัธยมศึกษาตอนปลาย</p>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- รุ่นที่จบ & ปีการศึกษาที่จบ -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1.5" id="batchLabel">รุ่นที่จบ (จ.ว. / สกจ.) </label>
                                    <input name="batch" id="batch" type="text"
                                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 outline-none transition bg-white text-sm sm:text-base"
                                        placeholder="เช่น รุ่นที่ 15 หรือ จ.ว. รุ่นที่ 10" value="<?= old('batch') ?>">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">ปีการศึกษาที่จบ (พ.ศ.) <span class="text-red-500">*</span></label>
                                    <input name="grad_year" id="grad_year" type="text" required
                                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 outline-none transition bg-white text-sm sm:text-base"
                                        placeholder="เช่น 2565 หรือ 2548" value="<?= old('grad_year') ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================== -->
                <!-- STEP 3: สถานภาพปัจจุบัน & การศึกษา / การทำงาน (Smart Status-Driven Form) -->
                <!-- ============================================== -->
                <div class="step-panel" id="step-3">
                    <div class="flex items-center mb-6 pb-3 border-b border-slate-100">
                        <div class="w-2 h-6 bg-pink-600 rounded-full mr-3"></div>
                        <div>
                            <h2 class="text-lg sm:text-xl font-bold text-slate-900">ขั้นตอนที่ 3: สถานภาพปัจจุบัน & การศึกษา / การทำงาน</h2>
                            <p class="text-xs text-slate-500">เลือกสถานภาพปัจจุบันของท่าน เพื่อตอบข้อมูลวุฒิการศึกษาและการทำงานที่ตรงกับท่านที่สุด</p>
                        </div>
                    </div>

                    <!-- Hidden Synced Fields for Backend Submission -->
                    <input type="hidden" name="current_status" id="final_current_status" value="<?= old('current_status') ?>">
                    <input type="hidden" name="grad_level" id="final_grad_level" value="<?= old('grad_level') ?>">
                    <input type="hidden" name="grad_level_other" id="final_grad_level_other" value="<?= old('grad_level_other') ?>">
                    <input type="hidden" name="grad_major" id="final_grad_major" value="<?= old('grad_major') ?>">
                    <input type="hidden" name="study_place" id="final_study_place" value="<?= old('study_place') ?>">
                    <input type="hidden" name="job_title" id="final_job_title" value="<?= old('job_title') ?>">
                    <input type="hidden" name="work_experience" id="final_work_experience" value="<?= old('work_experience') ?>">

                    <div class="space-y-6">
                        <!-- 3.1 เลือกสถานภาพปัจจุบัน (Current Status Cards) -->
                        <div class="p-5 sm:p-6 rounded-2xl bg-white border border-slate-200/90 space-y-4 shadow-xs">
                            <div class="flex items-center justify-between gap-2 pb-3 border-b border-slate-100">
                                <div class="flex items-center gap-2.5">
                                    <span class="w-7 h-7 rounded-lg bg-pink-100 text-pink-600 flex items-center justify-center font-bold text-xs shadow-xs">3.1</span>
                                    <div>
                                        <h3 class="text-sm sm:text-base font-bold text-slate-900">ปัจจุบันท่านอยู่ในสถานภาพใด? <span class="text-red-500">*</span></h3>
                                        <p class="text-[11px] text-slate-500">โปรดเลือก 1 ข้อ เพื่อตอบคำถามขั้นตอนถัดไปให้ตรงกับสถานะของท่าน</p>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" id="status_choice_container">
                                <!-- Card: ทำงานแล้ว -->
                                <label class="status-choice-card flex items-start p-4 border rounded-2xl cursor-pointer hover:border-pink-400 hover:bg-pink-50/20 transition group border-slate-200 bg-white shadow-xs" onclick="onStatusCardClick('ทำงานแล้ว')">
                                    <input type="radio" name="ui_current_status" value="ทำงานแล้ว" class="mt-1 w-4 h-4 mr-3 text-pink-600 focus:ring-pink-500" <?= old('current_status') === 'ทำงานแล้ว' ? 'checked' : '' ?>>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-1.5 mb-1">
                                            <span class="text-lg">💼</span>
                                            <span class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-pink-600">ทำงานแล้ว</span>
                                        </div>
                                        <p class="text-slate-500 text-xs leading-relaxed">ประกอบอาชีพ / มีงานประจำ / ธุรกิจส่วนตัว / อาชีพอิสระ</p>
                                    </div>
                                </label>

                                <!-- Card: กำลังศึกษาต่อ -->
                                <label class="status-choice-card flex items-start p-4 border rounded-2xl cursor-pointer hover:border-pink-400 hover:bg-pink-50/20 transition group border-slate-200 bg-white shadow-xs" onclick="onStatusCardClick('กำลังศึกษาต่อ')">
                                    <input type="radio" name="ui_current_status" value="กำลังศึกษาต่อ" class="mt-1 w-4 h-4 mr-3 text-pink-600 focus:ring-pink-500" <?= old('current_status') === 'กำลังศึกษาต่อ' ? 'checked' : '' ?>>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-1.5 mb-1">
                                            <span class="text-lg">🎓</span>
                                            <span class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-pink-600">กำลังศึกษาต่อ</span>
                                        </div>
                                        <p class="text-slate-500 text-xs leading-relaxed">ศึกษาต่อระดับ ปวช., ปวส., ปริญญาตรี หรือ ปริญญาโท-เอก</p>
                                    </div>
                                </label>

                                <!-- Card: กำลังศึกษาต่อและทำงานไปด้วย -->
                                <label class="status-choice-card flex items-start p-4 border rounded-2xl cursor-pointer hover:border-pink-400 hover:bg-pink-50/20 transition group border-slate-200 bg-white shadow-xs" onclick="onStatusCardClick('กำลังศึกษาต่อและทำงานไปด้วย')">
                                    <input type="radio" name="ui_current_status" value="กำลังศึกษาต่อและทำงานไปด้วย" class="mt-1 w-4 h-4 mr-3 text-pink-600 focus:ring-pink-500" <?= old('current_status') === 'กำลังศึกษาต่อและทำงานไปด้วย' ? 'checked' : '' ?>>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-1.5 mb-1">
                                            <span class="text-lg">💼🎓</span>
                                            <span class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-pink-600">กำลังศึกษาต่อ & ทำงานไปด้วย</span>
                                        </div>
                                        <p class="text-slate-500 text-xs leading-relaxed">เรียนภาคค่ำ/เสาร์-อาทิตย์ หรือ ทำงานพาร์ตไทม์ควบคู่การเรียน</p>
                                    </div>
                                </label>

                                <!-- Card: ว่างงาน -->
                                <label class="status-choice-card flex items-start p-4 border rounded-2xl cursor-pointer hover:border-pink-400 hover:bg-pink-50/20 transition group border-slate-200 bg-white shadow-xs" onclick="onStatusCardClick('ว่างงาน')">
                                    <input type="radio" name="ui_current_status" value="ว่างงาน" class="mt-1 w-4 h-4 mr-3 text-pink-600 focus:ring-pink-500" <?= old('current_status') === 'ว่างงาน' ? 'checked' : '' ?>>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-1.5 mb-1">
                                            <span class="text-lg">⏳</span>
                                            <span class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-pink-600">ว่างงาน / กำลังหางาน</span>
                                        </div>
                                        <p class="text-slate-500 text-xs leading-relaxed">ยังไม่ได้ศึกษาต่อและอยู่ระหว่างหางาน หรือรอเปิดภาคเรียน</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- 3.2 Dynamic Panels Container -->

                        <!-- Notice when no status is selected -->
                        <div id="panel_empty_notice" class="p-8 rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/50 text-center text-slate-400">
                            <span class="text-3xl block mb-2">👆</span>
                            <p class="text-sm font-semibold text-slate-600">กรุณาเลือกสถานภาพปัจจุบันของท่านในข้อ 3.1 ด้านบน</p>
                            <p class="text-xs text-slate-400 mt-1">ระบบจะแสดงแบบสอบถามการศึกษาและการทำงานที่เกี่ยวข้องกับท่านโดยอัตโนมัติ</p>
                        </div>

                        <!-- ============================================== -->
                        <!-- PANEL 1: กรณี "ทำงานแล้ว" -->
                        <!-- ============================================== -->
                        <div id="panel_status_working" class="hidden space-y-6">
                            <!-- PAO Nakhon Sawan Banner -->
                            <div class="rounded-2xl bg-gradient-to-r from-amber-500/10 via-pink-500/10 to-blue-500/10 border-2 border-amber-300/80 p-4 sm:p-5 shadow-sm">
                                <div class="flex items-start gap-3.5">
                                    <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-md shadow-amber-500/30">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 flex-wrap mb-1">
                                            <span class="text-xs font-black tracking-wider uppercase bg-amber-500 text-white px-2.5 py-0.5 rounded-full shadow-xs">
                                                📌 ข้อมูลสำคัญเพื่อการสนับสนุนตำแหน่งงาน อบจ.นครสวรรค์
                                            </span>
                                            <span class="text-xs font-bold text-amber-900">มีผลต่อการพิจารณาตำแหน่งงานว่าง</span>
                                        </div>
                                        <p class="text-xs sm:text-sm text-slate-800 leading-relaxed font-medium">
                                            ข้อมูล <strong class="text-pink-700 underline decoration-pink-300">"ระดับการศึกษาสูงสุด"</strong>, <strong class="text-pink-700 underline decoration-pink-300">"สาขาวิชาที่จบ"</strong> และ <strong class="text-blue-700 underline decoration-blue-300">"ประสบการณ์ทำงาน"</strong> ของท่าน จะถูกใช้เป็นฐานข้อมูลหลักในการพิจารณาคัดเลือกบรรจุหรือรับเข้าทำงานในสังกัด องค์การบริหารส่วนจังหวัดนครสวรรค์
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-5 sm:p-6 rounded-2xl bg-white border border-slate-200/90 space-y-5 shadow-xs">
                                <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                                    <span class="w-7 h-7 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs shadow-xs">3.2</span>
                                    <div>
                                        <h3 class="text-sm sm:text-base font-bold text-slate-900">ระดับการศึกษาสูงสุด & ข้อมูลการทำงานปัจจุบัน</h3>
                                        <p class="text-[11px] text-slate-500">สำหรับผู้ที่มีงานทำ หรือประกอบธุรกิจส่วนตัว</p>
                                    </div>
                                </div>

                                <!-- วุฒิการศึกษาสูงสุดที่สำเร็จ -->
                                <div>
                                    <label class="block text-sm font-bold text-slate-800 mb-1 flex items-center justify-between flex-wrap gap-1">
                                        <span>ระดับการศึกษาสูงสุดที่ท่านสำเร็จการศึกษา <span class="text-red-500">*</span></span>
                                        <span class="text-xs font-normal text-slate-400">(วุฒิสูงสุดที่ได้รับ)</span>
                                    </label>
                                    <p class="text-[11px] text-slate-500 mb-2.5">เลือกวุฒิการศึกษาสูงสุดที่ท่านได้รับ</p>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                        <?php 
                                            $levels = ['มัธยมศึกษาตอนต้น (ม.3)', 'มัธยมศึกษาตอนปลาย (ม.6)', 'ประกาศนียบัตรวิชาชีพ (ปวช.)', 'ประกาศนียบัตรวิชาชีพชั้นสูง (ปวส.) / อนุปริญญา', 'ปริญญาตรี', 'ปริญญาโท', 'ปริญญาเอก', 'อื่นๆ'];
                                            foreach($levels as $lvl):
                                        ?>
                                        <label class="flex items-center p-3 border rounded-xl cursor-pointer hover:bg-pink-50/40 transition border-slate-200 bg-white">
                                            <input type="radio" name="work_grad_level" value="<?= $lvl ?>" class="w-4 h-4 mr-3 text-pink-600" onchange="syncStep3Values()">
                                            <span class="text-sm font-medium text-slate-800"><?= $lvl ?></span>
                                        </label>
                                        <?php endforeach; ?>
                                    </div>
                                    <input type="text" id="work_grad_level_other" placeholder="โปรดระบุระดับการศึกษา เช่น ประกาศนียบัตรบัณฑิต..." class="mt-2.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 outline-none text-sm hidden" oninput="syncStep3Values()">
                                </div>

                                <!-- คณะ / สาขาวิชาที่จบ -->
                                <div class="p-4 rounded-2xl bg-amber-50/40 border border-amber-200">
                                    <label class="block text-sm font-bold text-slate-800 mb-1 flex items-center justify-between flex-wrap gap-1">
                                        <span class="flex items-center gap-1.5">
                                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                            <span>แผนการเรียน / คณะ / สาขาวิชาที่จบ <span class="text-red-500">*</span></span>
                                        </span>
                                        <span class="bg-amber-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-md shadow-xs">
                                            ⭐ สำคัญ: สนับสนุนตำแหน่ง อบจ.
                                        </span>
                                    </label>
                                    <p class="text-[11px] text-slate-500 mb-2">ระบุสาขาวิชาหรือวิชาเอก เช่น นิติศาสตร์, สาธารณสุขศาสตร์, วิทยาการคอมพิวเตอร์, ช่างไฟฟ้า, บัญชี</p>
                                    <input type="text" id="work_major" class="w-full rounded-xl border border-amber-300 px-4 py-3 text-slate-900 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/30 outline-none transition bg-white text-sm sm:text-base font-medium" placeholder="เช่น บริหารธุรกิจ สาขาการจัดการ หรือ ปวส. ช่างยนต์" oninput="syncStep3Values()">
                                </div>

                                <!-- อาชีพ / ตำแหน่งงานปัจจุบัน -->
                                <div class="p-4 rounded-2xl bg-pink-50/40 border border-pink-200">
                                    <label class="block text-sm font-bold text-slate-800 mb-1">
                                        อาชีพ / ตำแหน่งงานปัจจุบัน / สถานที่ทำงาน <span class="text-red-500">*</span>
                                    </label>
                                    <p class="text-[11px] text-slate-500 mb-2">ระบุตำแหน่งงานและบริษัท/หน่วยงานที่ท่านสังกัด</p>
                                    <input type="text" id="work_job_title" class="w-full rounded-xl border border-pink-300 px-4 py-3 text-slate-900 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/30 outline-none transition bg-white text-sm sm:text-base font-medium" placeholder="เช่น วิศวกรโยธา บ.ไทยคอนกรีต หรือ เจ้าของร้านอาหาร" oninput="syncStep3Values()">
                                </div>

                                <!-- ประสบการณ์ทำงาน -->
                                <div class="p-4 rounded-2xl bg-blue-50/40 border border-blue-200">
                                    <label class="block text-sm font-bold text-slate-800 mb-1 flex items-center justify-between flex-wrap gap-1">
                                        <span class="flex items-center gap-1.5">
                                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                            <span>ประสบการณ์ทำงาน / ทักษะความเชี่ยวชาญเฉพาะด้าน</span>
                                        </span>
                                        <span class="bg-blue-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-md shadow-xs">
                                            ⭐ สำคัญ: สนับสนุนตำแหน่ง อบจ.
                                        </span>
                                    </label>
                                    <p class="text-[11px] text-slate-500 mb-2">ระบุจำนวนปี สายงานที่เคยทำ หรือใบประกอบวิชาชีพ เช่น ประสบการณ์ฝ่ายธุรการ 3 ปี, มีใบ กว., ใบประกอบวิชาชีพครู</p>
                                    <input type="text" id="work_experience_input" class="w-full rounded-xl border border-blue-300 px-4 py-3 text-slate-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 outline-none transition bg-white text-sm sm:text-base font-medium" placeholder="เช่น 3 ปี งานธุรการและสารบรรณ หรือ เชี่ยวชาญระบบจัดซื้อพัสดุ" oninput="syncStep3Values()">
                                </div>
                            </div>
                        </div>

                        <!-- ============================================== -->
                        <!-- PANEL 2: กรณี "กำลังศึกษาต่อ" -->
                        <!-- ============================================== -->
                        <div id="panel_status_studying" class="hidden space-y-6">
                            <div class="p-5 sm:p-6 rounded-2xl bg-white border border-slate-200/90 space-y-5 shadow-xs">
                                <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                                    <span class="w-7 h-7 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs shadow-xs">3.2</span>
                                    <div>
                                        <h3 class="text-sm sm:text-base font-bold text-slate-900">ข้อมูลการศึกษาต่อปัจจุบัน</h3>
                                        <p class="text-[11px] text-slate-500">สำหรับศิษย์เก่าที่กำลังศึกษาอยู่ในปัจจุบัน</p>
                                    </div>
                                </div>

                                <!-- ระดับการศึกษาที่กำลังศึกษา -->
                                <div>
                                    <label class="block text-sm font-bold text-slate-800 mb-1">
                                        ระดับการศึกษาที่กำลังศึกษาอยู่ในปัจจุบัน <span class="text-red-500">*</span>
                                    </label>
                                    <p class="text-[11px] text-slate-500 mb-2.5">เลือกระดับการศึกษาที่ท่านกำลังศึกษาอยู่</p>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                        <?php 
                                            $studyLevels = ['ประกาศนียบัตรวิชาชีพ (ปวช.)', 'ประกาศนียบัตรวิชาชีพชั้นสูง (ปวส.) / อนุปริญญา', 'ปริญญาตรี', 'ปริญญาโท', 'ปริญญาเอก', 'อื่นๆ'];
                                            foreach($studyLevels as $slvl):
                                        ?>
                                        <label class="flex items-center p-3 border rounded-xl cursor-pointer hover:bg-blue-50/40 transition border-slate-200 bg-white">
                                            <input type="radio" name="study_grad_level" value="<?= $slvl ?>" class="w-4 h-4 mr-3 text-blue-600" onchange="syncStep3Values()">
                                            <span class="text-sm font-medium text-slate-800"><?= $slvl ?></span>
                                        </label>
                                        <?php endforeach; ?>
                                    </div>
                                    <input type="text" id="study_grad_level_other" placeholder="โปรดระบุระดับการศึกษา เช่น หลักสูตรประกาศนียบัตรเฉพาะทาง..." class="mt-2.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 outline-none text-sm hidden" oninput="syncStep3Values()">
                                </div>

                                <!-- สถาบันการศึกษา / มหาวิทยาลัย -->
                                <div>
                                    <label class="block text-sm font-bold text-slate-800 mb-1.5">
                                        สถาบันการศึกษา / มหาวิทยาลัย ที่กำลังศึกษา <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="study_institute" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition bg-white text-sm sm:text-base" placeholder="เช่น มหาวิทยาลัยเชียงใหม่, มหาวิทยาลัยนเรศวร, วิทยาลัยอาชีวศึกษานครสวรรค์" oninput="syncStep3Values()">
                                </div>

                                <!-- คณะ / สาขาวิชา -->
                                <div>
                                    <label class="block text-sm font-bold text-slate-800 mb-1.5">
                                        คณะ / สาขาวิชา / แผนกวิชา <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="study_major" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition bg-white text-sm sm:text-base" placeholder="เช่น คณะวิศวกรรมศาสตร์ สาขาวิศวกรรมโยธา หรือ สาขาการบัญชี" oninput="syncStep3Values()">
                                </div>
                            </div>
                        </div>

                        <!-- ============================================== -->
                        <!-- PANEL 3: กรณี "กำลังศึกษาต่อและทำงานไปด้วย" -->
                        <!-- ============================================== -->
                        <div id="panel_status_both" class="hidden space-y-6">
                            <div class="p-5 sm:p-6 rounded-2xl bg-white border border-slate-200/90 space-y-5 shadow-xs">
                                <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                                    <span class="w-7 h-7 rounded-lg bg-pink-100 text-pink-600 flex items-center justify-center font-bold text-xs shadow-xs">3.2</span>
                                    <div>
                                        <h3 class="text-sm sm:text-base font-bold text-slate-900">ข้อมูลการศึกษาต่อ & การทำงานควบคู่กัน</h3>
                                        <p class="text-[11px] text-slate-500">สำหรับศิษย์เก่าที่กำลังศึกษาและทำงานหารายได้ไปพร้อมกัน</p>
                                    </div>
                                </div>

                                <!-- ระดับการศึกษาที่กำลังศึกษา -->
                                <div>
                                    <label class="block text-sm font-bold text-slate-800 mb-1">
                                        ระดับการศึกษาที่กำลังศึกษา <span class="text-red-500">*</span>
                                    </label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                        <?php foreach($studyLevels as $blvl): ?>
                                        <label class="flex items-center p-3 border rounded-xl cursor-pointer hover:bg-pink-50/40 transition border-slate-200 bg-white">
                                            <input type="radio" name="both_grad_level" value="<?= $blvl ?>" class="w-4 h-4 mr-3 text-pink-600" onchange="syncStep3Values()">
                                            <span class="text-sm font-medium text-slate-800"><?= $blvl ?></span>
                                        </label>
                                        <?php endforeach; ?>
                                    </div>
                                    <input type="text" id="both_grad_level_other" placeholder="โปรดระบุระดับการศึกษา..." class="mt-2.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 outline-none text-sm hidden" oninput="syncStep3Values()">
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-bold text-slate-800 mb-1.5">
                                            สถาบันการศึกษา / มหาวิทยาลัย <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="both_institute" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 outline-none text-sm" placeholder="เช่น มหาวิทยาลัยราชภัฏนครสวรรค์" oninput="syncStep3Values()">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-800 mb-1.5">
                                            คณะ / สาขาวิชา <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="both_major" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 outline-none text-sm" placeholder="เช่น คณะมนุษยศาสตร์และสังคมศาสตร์" oninput="syncStep3Values()">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-3 border-t border-slate-100">
                                    <div>
                                        <label class="block text-sm font-bold text-slate-800 mb-1.5">
                                            ลักษณะงาน / ตำแหน่งงานที่ทำ <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="both_job_title" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 outline-none text-sm" placeholder="เช่น พนักงานพาร์ตไทม์, กราฟิกดีไซน์ฟรีแลนซ์" oninput="syncStep3Values()">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-800 mb-1.5">
                                            ประสบการณ์ทำงาน / ทักษะ
                                        </label>
                                        <input type="text" id="both_experience" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none text-sm" placeholder="เช่น มีทักษะด้านงานบริการ หรือ ทักษะตัดต่อวิดีโอ" oninput="syncStep3Values()">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ============================================== -->
                        <!-- PANEL 4: กรณี "ว่างงาน / กำลังหางาน" -->
                        <!-- ============================================== -->
                        <div id="panel_status_unemployed" class="hidden space-y-6">
                            <!-- PAO Opportunity Notice -->
                            <div class="rounded-2xl bg-gradient-to-r from-blue-500/10 via-pink-500/10 to-amber-500/10 border-2 border-blue-300/80 p-4 sm:p-5 shadow-sm">
                                <div class="flex items-start gap-3.5">
                                    <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-blue-500/30">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <span class="text-xs font-black tracking-wider uppercase bg-blue-600 text-white px-2.5 py-0.5 rounded-full shadow-xs">
                                            🎯 อบจ.นครสวรรค์ ยินดีสนับสนุนตำแหน่งงาน
                                        </span>
                                        <p class="text-xs sm:text-sm text-slate-800 leading-relaxed font-medium mt-1">
                                            องค์การบริหารส่วนจังหวัดนครสวรรค์ และเครือข่ายสถานประกอบการ มีตำแหน่งงานเปิดรับสมัครเป็นระยะ ข้อมูลวุฒิการศึกษาและสาขาวิชาของท่านจะถูกนำไป <span class="font-bold text-blue-900 bg-blue-100/80 px-1 py-0.5 rounded">จับคู่โอกาสการจ้างงาน (Job Matching)</span> เพื่อติดต่อแจ้งข่าวสารตำแหน่งงานว่างครับ
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-5 sm:p-6 rounded-2xl bg-white border border-slate-200/90 space-y-5 shadow-xs">
                                <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                                    <span class="w-7 h-7 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center font-bold text-xs shadow-xs">3.2</span>
                                    <div>
                                        <h3 class="text-sm sm:text-base font-bold text-slate-900">ระดับการศึกษา & ความต้องการงาน</h3>
                                        <p class="text-[11px] text-slate-500">สำหรับผู้ที่อยู่ระหว่างมองหางาน หรือรอเปิดภาคเรียน</p>
                                    </div>
                                </div>

                                <!-- วุฒิการศึกษาสูงสุดที่จบ -->
                                <div>
                                    <label class="block text-sm font-bold text-slate-800 mb-1">
                                        ระดับการศึกษาสูงสุดที่ท่านจบการศึกษาในปัจจุบัน <span class="text-red-500">*</span>
                                    </label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                        <?php foreach($levels as $ulvl): ?>
                                        <label class="flex items-center p-3 border rounded-xl cursor-pointer hover:bg-slate-50 transition border-slate-200 bg-white">
                                            <input type="radio" name="unemp_grad_level" value="<?= $ulvl ?>" class="w-4 h-4 mr-3 text-pink-600" onchange="syncStep3Values()">
                                            <span class="text-sm font-medium text-slate-800"><?= $ulvl ?></span>
                                        </label>
                                        <?php endforeach; ?>
                                    </div>
                                    <input type="text" id="unemp_grad_level_other" placeholder="โปรดระบุระดับการศึกษา..." class="mt-2.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 outline-none text-sm hidden" oninput="syncStep3Values()">
                                </div>

                                <!-- คณะ / สาขาวิชาที่จบ -->
                                <div>
                                    <label class="block text-sm font-bold text-slate-800 mb-1.5">
                                        แผนการเรียน / คณะ / สาขาวิชาที่จบ <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="unemp_major" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 outline-none text-sm sm:text-base" placeholder="เช่น วิทยาการคอมพิวเตอร์, บัญชี, ม.6 แผนวิทย์-คณิต" oninput="syncStep3Values()">
                                </div>

                                <!-- ทักษะ หรือ สายงานที่ต้องการทำ -->
                                <div>
                                    <label class="block text-sm font-bold text-slate-800 mb-1.5">
                                        ทักษะความสามารถ หรือ สายงานที่ท่านต้องการสมัครทำ
                                    </label>
                                    <input type="text" id="unemp_experience" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none text-sm sm:text-base" placeholder="เช่น งานธุรการ, พนักงานขาย, กราฟิก, มีใบขับขี่" oninput="syncStep3Values()">
                                </div>

                                <hr class="border-slate-100">

                                <!-- สาเหตุที่ยังไม่ได้ศึกษาต่อหรือยังไม่มีงานทำ -->
                                <div>
                                    <label class="block text-sm font-bold text-slate-900 mb-2.5">
                                        สาเหตุหลักที่ยังไม่ได้ศึกษาต่อหรือยังไม่มีงานทำ <span class="text-slate-500 text-xs font-normal">(เลือกได้มากกว่า 1 ข้อ)</span>
                                    </label>
                                    <div class="grid grid-cols-1 gap-2.5">
                                        <label class="flex items-start text-xs sm:text-sm"><input type="checkbox" name="unemployed_reasons[]" value="อยู่ระหว่างรอฟังผลสอบเข้าศึกษาต่อ / รอเปิดเทอม" class="mt-0.5 w-4 h-4 mr-2.5 rounded"> <span>อยู่ระหว่างรอฟังผลสอบเข้าศึกษาต่อ / รอเปิดเทอม</span></label>
                                        <label class="flex items-start text-xs sm:text-sm"><input type="checkbox" name="unemployed_reasons[]" value="อยู่ระหว่างสมัครงานและรอเรียกสัมภาษณ์" class="mt-0.5 w-4 h-4 mr-2.5 rounded"> <span>อยู่ระหว่างสมัครงานและรอเรียกสัมภาษณ์</span></label>
                                        <label class="flex items-start text-xs sm:text-sm"><input type="checkbox" name="unemployed_reasons[]" value="ประสบปัญหาภาระค่าใช้จ่าย / ขาดแคลนทุนทรัพย์" class="mt-0.5 w-4 h-4 mr-2.5 rounded"> <span>ประสบปัญหาภาระค่าใช้จ่าย / ขาดแคลนทุนทรัพย์</span></label>
                                        <label class="flex items-start text-xs sm:text-sm"><input type="checkbox" name="unemployed_reasons[]" value="จำเป็นต้องดูแลครอบครัว / ช่วยงานบ้าน" class="mt-0.5 w-4 h-4 mr-2.5 rounded"> <span>จำเป็นต้องดูแลครอบครัว / ช่วยงานบ้าน</span></label>
                                        <label class="flex items-start text-xs sm:text-sm"><input type="checkbox" name="unemployed_reasons[]" value="ขาดข้อมูลข่าวสารเกี่ยวกับการรับสมัครงานหรือสถานศึกษา" class="mt-0.5 w-4 h-4 mr-2.5 rounded"> <span>ขาดข้อมูลข่าวสารเกี่ยวกับการรับสมัครงานหรือสถานศึกษา</span></label>
                                        <label class="flex items-start text-xs sm:text-sm"><input type="checkbox" name="unemployed_reasons[]" value="ยังไม่แน่ใจในความต้องการของตนเอง (กำลังค้นหาตัวเอง)" class="mt-0.5 w-4 h-4 mr-2.5 rounded"> <span>ยังไม่แน่ใจในความต้องการของตนเอง (กำลังค้นหาตัวเอง)</span></label>
                                        <label class="flex items-start text-xs sm:text-sm"><input type="checkbox" name="unemployed_reasons[]" value="มีปัญหาด้านสุขภาพ" class="mt-0.5 w-4 h-4 mr-2.5 rounded"> <span>มีปัญหาด้านสุขภาพ</span></label>
                                        <label class="flex items-center text-xs sm:text-sm"><input type="checkbox" name="unemployed_reasons[]" value="อื่นๆ" class="w-4 h-4 mr-2.5 rounded" id="unemployed_other_cb"> <span>อื่นๆ</span></label>
                                        <input type="text" name="unemployed_reasons_other" id="unemployed_other_text" placeholder="โปรดระบุสาเหตุ..." class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2 text-slate-900 outline-none hidden bg-white text-xs sm:text-sm">
                                    </div>
                                </div>

                                <hr class="border-slate-100">

                                <!-- อุปสรรคสำคัญในการหางาน -->
                                <div>
                                    <label class="block text-sm font-bold text-slate-900 mb-2.5">
                                        อุปสรรคสำคัญในการหางาน <span class="text-slate-500 text-xs font-normal">(เลือกได้มากกว่า 1 ข้อ)</span>
                                    </label>
                                    <div class="grid grid-cols-1 gap-2.5">
                                        <label class="flex items-start text-xs sm:text-sm"><input type="checkbox" name="job_hunt_obstacles[]" value="ขาดประสบการณ์ทำงาน" class="mt-0.5 w-4 h-4 mr-2.5 rounded"> <span>ขาดประสบการณ์ทำงาน (สถานประกอบการต้องการคนมีประสบการณ์)</span></label>
                                        <label class="flex items-start text-xs sm:text-sm"><input type="checkbox" name="job_hunt_obstacles[]" value="วุฒิการศึกษา/สาขาที่จบ ไม่ตรงกับตลาดงาน" class="mt-0.5 w-4 h-4 mr-2.5 rounded"> <span>วุฒิการศึกษา/สาขาที่จบ ไม่ตรงกับความต้องการของตลาดงานในพื้นที่</span></label>
                                        <label class="flex items-start text-xs sm:text-sm"><input type="checkbox" name="job_hunt_obstacles[]" value="ทักษะที่มีไม่เพียงพอ" class="mt-0.5 w-4 h-4 mr-2.5 rounded"> <span>ทักษะที่มีไม่เพียงพอ (เช่น ภาษาอังกฤษ, คอมพิวเตอร์, ทักษะวิชาชีพ)</span></label>
                                        <label class="flex items-start text-xs sm:text-sm"><input type="checkbox" name="job_hunt_obstacles[]" value="ค่าตอบแทน/เงินเดือน ต่ำกว่าความคาดหวัง" class="mt-0.5 w-4 h-4 mr-2.5 rounded"> <span>ค่าตอบแทน/เงินเดือน ต่ำกว่าความคาดหวัง</span></label>
                                        <label class="flex items-start text-xs sm:text-sm"><input type="checkbox" name="job_hunt_obstacles[]" value="การเดินทางลำบาก / งานอยู่นอกพื้นที่" class="mt-0.5 w-4 h-4 mr-2.5 rounded"> <span>การเดินทางลำบาก / งานอยู่นอกพื้นที่</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================== -->
                <!-- STEP 4: ความต้องการ & ข้อเสนอแนะ & ยืนยัน -->
                <!-- ============================================== -->
                <div class="step-panel" id="step-4">
                    <div class="flex items-center mb-6 pb-3 border-b border-slate-100">
                        <div class="w-2 h-6 bg-pink-600 rounded-full mr-3"></div>
                        <div>
                            <h2 class="text-lg sm:text-xl font-bold text-slate-900">ขั้นตอนที่ 4: ความต้องการ &
                                ข้อเสนอแนะ</h2>
                            <p class="text-xs text-slate-500">สิ่งที่ต้องการให้โรงเรียนและ อบจ. ช่วยเหลือ
                                พร้อมแนะนำตัวสั้นๆ</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-3">ท่านต้องการให้โรงเรียนและ
                                อบจ.นครสวรรค์ สนับสนุนในเรื่องใดมากที่สุด? <span
                                    class="text-pink-600 text-xs font-normal">(เลือกได้สูงสุด 2 ข้อ)</span></label>
                            <div class="grid grid-cols-1 gap-2.5">
                                <label
                                    class="flex items-start p-3 border border-amber-200 bg-amber-50/30 rounded-xl cursor-pointer hover:bg-amber-50/60 transition">
                                    <input type="checkbox" name="school_support_needs[]"
                                        value="ประสานงานแจ้งข่าวสารการรับสมัครงานสังกัด อบจ.นครสวรรค์"
                                        class="mt-0.5 w-4 h-4 mr-3 support-cb">
                                    <span class="text-xs sm:text-sm font-medium text-slate-800">📌
                                        ประสานงานแจ้งข่าวสารการรับสมัครงาน / ตำแหน่งงานว่างในสังกัด อบจ.นครสวรรค์
                                        และหน่วยงานในพื้นที่</span>
                                </label>
                                <label
                                    class="flex items-start p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-pink-50/40 transition">
                                    <input type="checkbox" name="school_support_needs[]"
                                        value="แนะนำแนวทางการศึกษาต่อ / ทุนการศึกษา"
                                        class="mt-0.5 w-4 h-4 mr-3 support-cb">
                                    <span class="text-xs sm:text-sm text-slate-700">แนะนำแนวทางการศึกษาต่อ /
                                        ทุนการศึกษา</span>
                                </label>
                                <label
                                    class="flex items-start p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-pink-50/40 transition">
                                    <input type="checkbox" name="school_support_needs[]"
                                        value="จัดอบรมเพิ่มทักษะสั้นๆ ฟรี" class="mt-0.5 w-4 h-4 mr-3 support-cb">
                                    <span class="text-xs sm:text-sm text-slate-700">จัดอบรมเพิ่มทักษะสั้นๆ ฟรี (เช่น
                                        ภาษาต่างประเทศ, ดิจิทัล, งานฝีมือ/อาชีพเสริม)</span>
                                </label>
                                <label
                                    class="flex items-start p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-pink-50/40 transition">
                                    <input type="checkbox" name="school_support_needs[]"
                                        value="อบรมเทคนิคการเตรียมตัวสมัครงาน" class="mt-0.5 w-4 h-4 mr-3 support-cb">
                                    <span class="text-xs sm:text-sm text-slate-700">อบรมเทคนิคการเตรียมตัวสมัครงาน
                                        (เขียน Resume, เทคนิคสัมภาษณ์งาน)</span>
                                </label>
                                <label
                                    class="flex items-start p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-pink-50/40 transition">
                                    <input type="checkbox" name="school_support_needs[]"
                                        value="ให้คำปรึกษาด้านการจัดการความเครียด / สุขภาพจิต"
                                        class="mt-0.5 w-4 h-4 mr-3 support-cb">
                                    <span class="text-xs sm:text-sm text-slate-700">ให้คำปรึกษาด้านการจัดการความเครียด /
                                        สุขภาพจิต</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">ประวัติย่อ /
                                ข้อความแนะนำตัวถึงเพื่อนๆ และน้องๆ (จะแสดงในโปรไฟล์)</label>
                            <textarea name="bio" rows="2"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 outline-none transition bg-slate-50 focus:bg-white text-sm sm:text-base resize-none"
                                placeholder="เช่น ยินดีให้คำปรึกษารุ่นน้องสายงานคอมพิวเตอร์ครับ..."></textarea>
                        </div>

                        <div>
                            <label
                                class="block text-sm font-semibold text-slate-700 mb-1.5">ข้อเสนอแนะเพิ่มเติมถึงโรงเรียนและ
                                อบจ.นครสวรรค์</label>
                            <textarea name="suggestions" rows="2"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 outline-none transition bg-slate-50 focus:bg-white text-sm sm:text-base resize-none"
                                placeholder="ข้อเสนอแนะของคุณ..."></textarea>
                        </div>

                        <!-- Feature Benefits Banner -->
                        <div class="rounded-2xl bg-gradient-to-r from-pink-50 via-purple-50 to-blue-50 border border-pink-200/80 p-4 sm:p-5 shadow-xs">
                            <div class="flex items-start gap-3.5">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-pink-600 to-blue-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-pink-500/20">
                                    <span class="text-xl">✨</span>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-xs sm:text-sm font-bold text-slate-900 mb-1">หลังลงทะเบียนเสร็จสิ้น ท่านสามารถเข้าสู่ระบบเพื่อใช้งาน:</h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-slate-700 mt-2 font-medium">
                                        <div class="flex items-center gap-2">
                                            <span class="text-pink-600 font-bold">✓</span>
                                            <span><strong>แก้ไขข้อมูล & โปรไฟล์:</strong> อัปเดตงานและวุฒิได้ตลอด</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-blue-600 font-bold">✓</span>
                                            <span><strong>ฝากงาน / ประกาศรับสมัคร:</strong> โพสต์งานช่วยเหลือรุ่นน้อง</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-emerald-600 font-bold">✓</span>
                                            <span><strong>ค้นหาทำเนียบรุ่น:</strong> เชื่อมต่อเพื่อนศิษย์เก่า จ.ว. / สกจ.</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-amber-600 font-bold">✓</span>
                                            <span><strong>รับโอกาสงาน อบจ.:</strong> ข้อมูลถูกส่งเข้า Job Matching</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================== -->
                <!-- ACTION BUTTONS: PREVIOUS / NEXT / SUBMIT -->
                <!-- ============================================== -->
                <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-between gap-3">

                    <button type="button" id="prevBtn"
                        class="hidden inline-flex items-center justify-center rounded-xl bg-slate-100 hover:bg-slate-200 px-5 py-3 text-sm font-bold text-slate-700 transition">
                        ← ย้อนกลับ
                    </button>

                    <div class="ml-auto flex items-center gap-3">
                        <button type="button" id="nextBtn"
                            class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-pink-600 via-pink-500 to-blue-600 hover:opacity-95 px-7 py-3 text-sm font-bold text-white shadow-lg shadow-pink-500/25 transition active:scale-95">
                            <span>ถัดไป</span>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                        <button type="submit" id="submitBtn"
                            class="hidden inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-pink-600 to-blue-600 hover:opacity-95 px-8 py-3 text-sm font-bold text-white shadow-lg shadow-pink-500/30 transition active:scale-95">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            ยืนยันและส่งแบบสำรวจ
                        </button>
                    </div>

                </div>

            </form>
        </div>

        <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500 px-2">
            <div>
                มีบัญชีศิษย์เก่าอยู่แล้ว? <a href="<?= base_url('login') ?>"
                    class="font-bold text-pink-600 hover:underline">เข้าสู่ระบบที่นี่</a>
            </div>

            <!-- Auto-save Draft Status & Reset -->
            <div class="flex items-center gap-3">
                <span id="draftSavedIndicator"
                    class="inline-flex items-center gap-1.5 text-emerald-700 bg-emerald-50 border border-emerald-200/80 px-2.5 py-1 rounded-full font-medium text-[11px] shadow-xs">
                    <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>บันทึกความคืบหน้าอัตโนมัติ</span>
                </span>
                <button type="button" onclick="clearFormDraft(true)"
                    class="text-slate-400 hover:text-rose-600 hover:underline transition text-[11px]">
                    ล้างข้อมูลร่าง
                </button>
            </div>
        </div>

    </div>

    <!-- Multi-step Form & Interaction Logic -->
    <script>
        let currentStep = 1;
        const totalSteps = 4;
        const DRAFT_STORAGE_KEY = 'skj_alumni_reg_draft_state_v2';

        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const submitBtn = document.getElementById('submitBtn');
        const progressBar = document.getElementById('progressBar');

        function updateStepView() {
            // Show/hide step panels
            document.querySelectorAll('.step-panel').forEach((panel, idx) => {
                if (idx + 1 === currentStep) {
                    panel.classList.add('active');
                } else {
                    panel.classList.remove('active');
                }
            });

            // Update Stepper indicators & progress bar
            const percent = (currentStep / totalSteps) * 100;
            progressBar.style.width = percent + '%';

            for (let i = 1; i <= totalSteps; i++) {
                const indicator = document.getElementById(`indicator-${i}`);
                const circle = indicator.querySelector('.step-circle');
                const text = indicator.querySelector('.step-text');

                if (i < currentStep) {
                    // Completed step
                    circle.className = 'step-circle w-8 h-8 sm:w-9 sm:h-9 rounded-full flex items-center justify-center text-xs sm:text-sm font-bold bg-green-500 text-white shadow-sm';
                    circle.innerHTML = '✓';
                    text.className = 'step-text text-[11px] sm:text-xs font-bold text-green-600 mt-2 line-clamp-1';
                } else if (i === currentStep) {
                    // Current step
                    circle.className = 'step-circle w-8 h-8 sm:w-9 sm:h-9 rounded-full flex items-center justify-center text-xs sm:text-sm font-bold bg-pink-600 text-white shadow-md shadow-pink-500/30';
                    circle.innerHTML = i;
                    text.className = 'step-text text-[11px] sm:text-xs font-bold text-pink-600 mt-2 line-clamp-1';
                } else {
                    // Future step
                    circle.className = 'step-circle w-8 h-8 sm:w-9 sm:h-9 rounded-full flex items-center justify-center text-xs sm:text-sm font-bold bg-slate-100 text-slate-400';
                    circle.innerHTML = i;
                    text.className = 'step-text text-[11px] sm:text-xs font-medium text-slate-400 mt-2 line-clamp-1';
                }
            }

            // Button controls
            if (currentStep === 1) {
                prevBtn.classList.add('hidden');
                prevBtn.style.display = 'none';
            } else {
                prevBtn.classList.remove('hidden');
                prevBtn.style.display = 'inline-flex';
            }

            if (currentStep === totalSteps) {
                nextBtn.classList.add('hidden');
                nextBtn.style.display = 'none';
                submitBtn.classList.remove('hidden');
                submitBtn.style.display = 'inline-flex';
            } else {
                nextBtn.classList.remove('hidden');
                nextBtn.style.display = 'inline-flex';
                submitBtn.classList.add('hidden');
                submitBtn.style.display = 'none';
            }

            // Scroll up to form on step change
            window.scrollTo({ top: 120, behavior: 'smooth' });

            // Auto-save step change
            saveFormDraft();
        }

        // ==========================================
        // AUTO-SAVE & RESTORE DRAFT MECHANISM
        // ==========================================
        function saveFormDraft() {
            try {
                const form = document.getElementById('multiStepForm');
                if (!form) return;

                const formData = {
                    currentStep: currentStep,
                    fields: {},
                    radios: {},
                    checkboxes: {}
                };

                // Normal inputs & textarea
                const textInputs = form.querySelectorAll('input:not([type="radio"]):not([type="checkbox"]), textarea, select');
                textInputs.forEach(el => {
                    if (el.name) {
                        formData.fields[el.name] = el.value;
                    }
                });

                // Radios
                const radios = form.querySelectorAll('input[type="radio"]');
                radios.forEach(r => {
                    if (r.name && r.checked) {
                        formData.radios[r.name] = r.value;
                    }
                });

                // Checkboxes
                const checkboxes = form.querySelectorAll('input[type="checkbox"]');
                checkboxes.forEach(cb => {
                    if (cb.name) {
                        if (!formData.checkboxes[cb.name]) {
                            formData.checkboxes[cb.name] = [];
                        }
                        if (cb.checked) {
                            formData.checkboxes[cb.name].push(cb.value);
                        }
                    }
                });

                localStorage.setItem(DRAFT_STORAGE_KEY, JSON.stringify(formData));
            } catch (err) {
                console.warn('Draft auto-save warning:', err);
            }
        }

        function restoreFormDraft() {
            try {
                const raw = localStorage.getItem(DRAFT_STORAGE_KEY);
                if (!raw) return false;
                const data = JSON.parse(raw);
                if (!data) return false;

                const form = document.getElementById('multiStepForm');
                if (!form) return false;

                let restoredCount = 0;

                // Restore text fields
                if (data.fields) {
                    Object.keys(data.fields).forEach(name => {
                        const el = form.querySelector(`input[name="${name}"]:not([type="radio"]):not([type="checkbox"]), textarea[name="${name}"], select[name="${name}"]`);
                        if (el && data.fields[name]) {
                            el.value = data.fields[name];
                            restoredCount++;
                        }
                    });
                }

                // Restore radios
                if (data.radios) {
                    Object.keys(data.radios).forEach(name => {
                        const val = data.radios[name];
                        const r = form.querySelector(`input[type="radio"][name="${name}"][value="${val}"]`);
                        if (r) {
                            r.checked = true;
                            r.dispatchEvent(new Event('change', { bubbles: true }));
                            restoredCount++;
                        }
                    });
                    if (data.radios['ui_current_status']) {
                        onStatusCardClick(data.radios['ui_current_status']);
                    } else if (data.fields && data.fields['current_status']) {
                        onStatusCardClick(data.fields['current_status']);
                    }
                    if (typeof syncStep3Values === 'function') {
                        syncStep3Values();
                    }
                }

                // Restore checkboxes
                if (data.checkboxes) {
                    Object.keys(data.checkboxes).forEach(name => {
                        const vals = data.checkboxes[name] || [];
                        const cbs = form.querySelectorAll(`input[type="checkbox"][name="${name}"]`);
                        cbs.forEach(cb => {
                            if (vals.includes(cb.value)) {
                                cb.checked = true;
                                cb.dispatchEvent(new Event('change', { bubbles: true }));
                                restoredCount++;
                            }
                        });
                    });
                }

                // Restore step
                if (data.currentStep && data.currentStep >= 1 && data.currentStep <= totalSteps) {
                    currentStep = data.currentStep;
                }

                // Trigger password validations if filled
                if (document.getElementById('password') && document.getElementById('password').value) {
                    checkPasswordRules(document.getElementById('password').value);
                }
                if (document.getElementById('passconf') && document.getElementById('passconf').value) {
                    checkPasswordMatch();
                }

                if (restoredCount > 0) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3500,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'กู้คืนข้อมูลที่กรอกค้างไว้ให้เรียบร้อยแล้ว'
                    });
                    return true;
                }
            } catch (err) {
                console.warn('Draft restore warning:', err);
            }
            return false;
        }

        function clearFormDraft(showConfirm = true) {
            if (showConfirm) {
                Swal.fire({
                    title: 'ล้างข้อมูลที่กรอกค้างไว้?',
                    text: 'ข้อมูลทั้งหมดที่คุณเคยกรอกไว้จะถูกล้างออกเพื่อเริ่มต้นใหม่',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#db2777',
                    cancelButtonColor: '#94a3b8',
                    confirmButtonText: 'ใช่, ล้างข้อมูล',
                    cancelButtonText: 'ยกเลิก',
                    customClass: {
                        popup: 'rounded-2xl',
                        confirmButton: 'rounded-xl px-5 py-2.5 font-bold',
                        cancelButton: 'rounded-xl px-5 py-2.5 font-bold'
                    }
                }).then((res) => {
                    if (res.isConfirmed) {
                        localStorage.removeItem(DRAFT_STORAGE_KEY);
                        document.getElementById('multiStepForm').reset();
                        currentStep = 1;
                        updateStepView();
                        window.location.reload();
                    }
                });
            } else {
                localStorage.removeItem(DRAFT_STORAGE_KEY);
            }
        }

        // Toggle Password Visibility (Show/Hide)
        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (!input || !icon) return;

            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>`;
                icon.classList.add('text-pink-600');
            } else {
                input.type = 'password';
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
                icon.classList.remove('text-pink-600');
            }
        }

        // Real-Time Password Validation & Strength Meter
        const passwordInput = document.getElementById('password');
        const passconfInput = document.getElementById('passconf');
        const strengthLabel = document.getElementById('strengthLabel');
        const matchFeedback = document.getElementById('matchFeedback');
        const matchSuccess = document.getElementById('matchSuccess');
        const matchError = document.getElementById('matchError');

        function updateRuleItem(elementId, isValid) {
            const el = document.getElementById(elementId);
            if (!el) return;
            const icon = el.querySelector('.rule-icon');
            if (isValid) {
                el.className = 'flex items-center gap-1.5 transition-colors text-emerald-600 font-medium';
                icon.className = 'rule-icon w-3.5 h-3.5 rounded-full bg-emerald-100 flex items-center justify-center text-[10px] text-emerald-600 font-bold';
                icon.innerHTML = '✓';
            } else {
                el.className = 'flex items-center gap-1.5 transition-colors text-slate-500';
                icon.className = 'rule-icon w-3.5 h-3.5 rounded-full bg-slate-200 flex items-center justify-center text-[9px] text-slate-500 font-bold';
                icon.innerHTML = '•';
            }
        }

        function checkPasswordRules(pwd) {
            const hasLength = pwd.length >= 8;
            const hasUpper = /[A-Z]/.test(pwd);
            const hasLower = /[a-z]/.test(pwd);
            const hasNumber = /[0-9]/.test(pwd);

            updateRuleItem('rule-length', hasLength);
            updateRuleItem('rule-upper', hasUpper);
            updateRuleItem('rule-lower', hasLower);
            updateRuleItem('rule-number', hasNumber);

            let score = 0;
            if (hasLength) score++;
            if (hasUpper) score++;
            if (hasLower) score++;
            if (hasNumber) score++;

            const bars = [document.getElementById('bar-1'), document.getElementById('bar-2'), document.getElementById('bar-3'), document.getElementById('bar-4')];
            bars.forEach(b => b.className = 'h-1.5 rounded-full bg-slate-200 transition-all duration-300');

            if (pwd.length === 0) {
                strengthLabel.textContent = 'ยังไม่ระบุ';
                strengthLabel.className = 'text-[11px] font-bold text-slate-400';
            } else if (score <= 1) {
                strengthLabel.textContent = 'ระดับ: ง่ายเกินไป (อ่อน)';
                strengthLabel.className = 'text-[11px] font-bold text-rose-500';
                bars[0].className = 'h-1.5 rounded-full bg-rose-500 transition-all duration-300';
            } else if (score === 2) {
                strengthLabel.textContent = 'ระดับ: ปานกลาง';
                strengthLabel.className = 'text-[11px] font-bold text-amber-500';
                bars[0].className = 'h-1.5 rounded-full bg-amber-500 transition-all duration-300';
                bars[1].className = 'h-1.5 rounded-full bg-amber-500 transition-all duration-300';
            } else if (score === 3) {
                strengthLabel.textContent = 'ระดับ: แข็งแรง';
                strengthLabel.className = 'text-[11px] font-bold text-blue-500';
                bars[0].className = 'h-1.5 rounded-full bg-blue-500 transition-all duration-300';
                bars[1].className = 'h-1.5 rounded-full bg-blue-500 transition-all duration-300';
                bars[2].className = 'h-1.5 rounded-full bg-blue-500 transition-all duration-300';
            } else {
                strengthLabel.textContent = 'ระดับ: ปลอดภัยมาก ✓';
                strengthLabel.className = 'text-[11px] font-bold text-emerald-600';
                bars.forEach(b => b.className = 'h-1.5 rounded-full bg-emerald-500 transition-all duration-300');
            }

            return { hasLength, hasUpper, hasLower, hasNumber, score };
        }

        function checkPasswordMatch() {
            const p1 = passwordInput.value;
            const p2 = passconfInput.value;

            if (p2.length === 0) {
                matchFeedback.classList.add('hidden');
                matchSuccess.classList.add('hidden');
                matchError.classList.add('hidden');
                passconfInput.classList.remove('border-rose-400', 'bg-rose-50/20', 'border-emerald-400', 'bg-emerald-50/20');
                passconfInput.classList.add('border-slate-300');
                return;
            }

            matchFeedback.classList.remove('hidden');
            if (p1 === p2) {
                // Matching
                matchSuccess.classList.remove('hidden');
                matchError.classList.add('hidden');
                passconfInput.classList.remove('border-rose-400', 'bg-rose-50/20', 'border-slate-300');
                passconfInput.classList.add('border-emerald-400', 'bg-emerald-50/20');
            } else {
                // Not Matching
                matchSuccess.classList.add('hidden');
                matchError.classList.remove('hidden');
                passconfInput.classList.remove('border-emerald-400', 'bg-emerald-50/20', 'border-slate-300');
                passconfInput.classList.add('border-rose-400', 'bg-rose-50/20');
            }
        }

        if (passwordInput && passconfInput) {
            passwordInput.addEventListener('input', function () {
                checkPasswordRules(this.value);
                if (passconfInput.value.length > 0) {
                    checkPasswordMatch();
                }
            });

            passconfInput.addEventListener('input', checkPasswordMatch);
        }

        // ==========================================
        // SMART SCROLL, FOCUS & HIGHLIGHT HELPER
        // ==========================================
        function focusAndHighlightElement(targetEl) {
            if (!targetEl) return;

            // 1. If target is inside another step panel, switch to that step first
            const stepPanel = targetEl.closest('.step-panel');
            if (stepPanel && stepPanel.id) {
                const stepNum = parseInt(stepPanel.id.replace('step-', ''), 10);
                if (stepNum && stepNum !== currentStep) {
                    currentStep = stepNum;
                    updateStepView();
                }
            }

            // 2. Identify focus element and visual highlight container
            let focusEl = targetEl;
            let highlightEl = targetEl;

            if (targetEl.type === 'radio' || targetEl.type === 'checkbox') {
                const parentLabel = targetEl.closest('label');
                if (parentLabel) {
                    highlightEl = parentLabel;
                }
            } else if (!['INPUT', 'SELECT', 'TEXTAREA', 'BUTTON'].includes(targetEl.tagName)) {
                const nestedInput = targetEl.querySelector('input:not([type="hidden"]), select, textarea');
                if (nestedInput) {
                    focusEl = nestedInput;
                    const nestedLabel = nestedInput.closest('label');
                    if (nestedLabel) highlightEl = nestedLabel;
                } else {
                    targetEl.setAttribute('tabindex', '-1');
                }
            }

            // 3. Smooth scroll and focus after modal animation finishes
            setTimeout(() => {
                highlightEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                
                try {
                    focusEl.focus({ preventScroll: true });
                    if (focusEl.select && typeof focusEl.select === 'function' && focusEl.type !== 'radio' && focusEl.type !== 'checkbox') {
                        focusEl.select();
                    }
                } catch (e) {
                    console.warn('Focus error:', e);
                }

                // 4. Distinct pulse ring animation to draw user's eyes
                highlightEl.classList.add('ring-4', 'ring-pink-500/60', 'border-pink-500', 'bg-pink-50/40', 'transition-all', 'duration-300');
                
                let cleared = false;
                const clearHighlight = () => {
                    if (cleared) return;
                    cleared = true;
                    highlightEl.classList.remove('ring-4', 'ring-pink-500/60', 'border-pink-500', 'bg-pink-50/40');
                    highlightEl.removeEventListener('input', clearHighlight);
                    highlightEl.removeEventListener('change', clearHighlight);
                    highlightEl.removeEventListener('click', clearHighlight);
                };

                highlightEl.addEventListener('input', clearHighlight);
                highlightEl.addEventListener('change', clearHighlight);
                highlightEl.addEventListener('click', clearHighlight);

                setTimeout(clearHighlight, 4000);
            }, 150);
        }

        function notifyWarning(title, text, targetEl = null) {
            let hasHandledFocus = false;
            const handleFocus = () => {
                if (!hasHandledFocus && targetEl) {
                    hasHandledFocus = true;
                    focusAndHighlightElement(targetEl);
                }
            };

            Swal.fire({
                icon: 'warning',
                title: title,
                text: text,
                confirmButtonColor: '#db2777',
                confirmButtonText: 'รับทราบ',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl px-6 py-2.5 font-bold shadow-md'
                },
                didClose: handleFocus
            }).then(() => {
                handleFocus();
            });
        }

        function validateCurrentStep() {
            const currentPanel = document.getElementById(`step-${currentStep}`);
            const inputs = currentPanel.querySelectorAll('input, select, textarea');

            for (let input of inputs) {
                // Email format check (if provided, whether required or optional)
                if (input.type === 'email' && input.value.trim() !== '') {
                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailPattern.test(input.value.trim())) {
                        notifyWarning('รูปแบบอีเมลไม่ถูกต้อง', 'กรุณากรอกอีเมลในรูปแบบที่ถูกต้อง เช่น yourname@example.com (หรือเว้นว่างไว้หากไม่มีอีเมล)', input);
                        return false;
                    }
                }

                // If input is required and currently visible/active
                if (input.required && !input.closest('.hidden')) {
                    if (input.type === 'radio') {
                        const radioGroup = currentPanel.querySelectorAll(`input[name="${input.name}"]`);
                        const isChecked = Array.from(radioGroup).some(r => r.checked);
                        if (!isChecked) {
                            const firstRadio = radioGroup[0] || input;
                            if (input.name === 'school_grad_level') {
                                notifyWarning('กรุณาระบุระดับชั้นที่จบจากโรงเรียน', 'กรุณาเลือกระดับชั้นที่สำเร็จการศึกษาจากโรงเรียน (ม.3 หรือ ม.6)', firstRadio);
                            } else if (input.name === 'school') {
                                notifyWarning('กรุณาเลือกโรงเรียน/สังกัด', 'กรุณาเลือกโรงเรียนที่สำเร็จการศึกษา (สวนกุหลาบฯ จิรประวัติ หรือ จิรประวัติวิทยาคม)', firstRadio);
                            } else if (input.name === 'grad_level') {
                                notifyWarning('กรุณาระบุระดับการศึกษาสูงสุด', 'กรุณาเลือกระดับการศึกษาสูงสุดที่สำเร็จในปัจจุบัน', firstRadio);
                            } else if (input.name === 'current_status') {
                                notifyWarning('กรุณาเลือกสถานภาพปัจจุบัน', 'โปรดเลือกสถานภาพปัจจุบันของท่าน (ทำงานแล้ว / กำลังศึกษาต่อ / ฯลฯ)', firstRadio);
                            } else {
                                notifyWarning('กรุณาระบุข้อมูล', 'กรุณาเลือกตัวเลือกที่กำหนดให้ครบถ้วนก่อนไปขั้นตอนถัดไป', firstRadio);
                            }
                            return false;
                        }
                    } else if (input.name === 'username' && input.value.trim().length < 3) {
                        notifyWarning('ชื่อผู้ใช้งานสั้นเกินไป', 'ชื่อผู้ใช้งาน (Username) ต้องมีความยาวอย่างน้อย 3 ตัวอักษร', input);
                        return false;
                    } else if (input.value.trim() === '') {
                        let fieldTitle = '';
                        const label = input.closest('div')?.querySelector('label');
                        if (label) {
                            fieldTitle = label.innerText.replace('*', '').trim().split('\n')[0];
                        }
                        const msg = fieldTitle ? `โปรดระบุ "${fieldTitle}" ให้ครบถ้วน` : 'โปรดระบุข้อมูลในช่องที่มีเครื่องหมาย * ให้ครบถ้วน';
                        notifyWarning('กรุณากรอกข้อมูลให้ครบถ้วน', msg, input);
                        return false;
                    }
                }
            }

            // Check modern password rules on step 1
            if (currentStep === 1) {
                const p1 = passwordInput.value;
                const p2 = passconfInput.value;
                const rules = checkPasswordRules(p1);

                if (!rules.hasLength) {
                    notifyWarning('รหัสผ่านสั้นเกินไป', 'รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร', passwordInput);
                    return false;
                }
                if (!rules.hasUpper || !rules.hasLower || !rules.hasNumber) {
                    notifyWarning('รหัสผ่านไม่ตรงตามเงื่อนไขความปลอดภัย', 'รหัสผ่านต้องประกอบด้วยตัวพิมพ์ใหญ่ (A-Z), ตัวพิมพ์เล็ก (a-z) และตัวเลข (0-9) อย่างน้อยอย่างละ 1 ตัว', passwordInput);
                    return false;
                }
                if (p1 !== p2) {
                    notifyWarning('รหัสผ่านไม่ตรงกัน', 'รหัสผ่านและการยืนยันรหัสผ่านไม่ตรงกัน กรุณาตรวจสอบอีกครั้ง', passconfInput);
                    return false;
                }
            }

            // Step 3 smart status-tailored validation
            if (currentStep === 3) {
                syncStep3Values();
                const currentStatus = document.getElementById('final_current_status').value;
                if (!currentStatus) {
                    const firstStatusChoice = document.querySelector('input[name="ui_current_status"]') || document.getElementById('status_choice_container');
                    notifyWarning('กรุณาเลือกสถานภาพปัจจุบัน', 'โปรดเลือกสถานภาพปัจจุบันของท่านในข้อ 3.1 ก่อนดำเนินต่อ', firstStatusChoice);
                    return false;
                }

                if (currentStatus === 'ทำงานแล้ว') {
                    const checkedGrad = document.querySelector('input[name="work_grad_level"]:checked');
                    if (!checkedGrad) {
                        const firstWorkGrad = document.querySelector('input[name="work_grad_level"]');
                        notifyWarning('กรุณาระบุระดับการศึกษาสูงสุด', 'โปรดเลือกระดับการศึกษาสูงสุดที่สำเร็จการศึกษา', firstWorkGrad);
                        return false;
                    }
                    if (checkedGrad.value === 'อื่นๆ' && !document.getElementById('work_grad_level_other').value.trim()) {
                        notifyWarning('กรุณาระบุระดับการศึกษา', 'โปรดระบุระดับการศึกษาของท่านในช่องอื่นๆ', document.getElementById('work_grad_level_other'));
                        return false;
                    }
                    if (!document.getElementById('work_major').value.trim()) {
                        notifyWarning('กรุณาระบุสาขาวิชาที่จบ', 'โปรดระบุแผนการเรียน / คณะ / สาขาวิชาที่ท่านสำเร็จการศึกษา', document.getElementById('work_major'));
                        return false;
                    }
                    if (!document.getElementById('work_job_title').value.trim()) {
                        notifyWarning('กรุณาระบุตำแหน่งงาน / อาชีพ', 'โปรดระบุอาชีพหรือตำแหน่งงานปัจจุบันของท่าน', document.getElementById('work_job_title'));
                        return false;
                    }
                } else if (currentStatus === 'กำลังศึกษาต่อ') {
                    const checkedGrad = document.querySelector('input[name="study_grad_level"]:checked');
                    if (!checkedGrad) {
                        const firstStudyGrad = document.querySelector('input[name="study_grad_level"]');
                        notifyWarning('กรุณาระบุระดับการศึกษา', 'โปรดเลือกระดับการศึกษาที่ท่านกำลังศึกษาอยู่ในปัจจุบัน', firstStudyGrad);
                        return false;
                    }
                    if (checkedGrad.value === 'อื่นๆ' && !document.getElementById('study_grad_level_other').value.trim()) {
                        notifyWarning('กรุณาระบุระดับการศึกษา', 'โปรดระบุระดับการศึกษาของท่านในช่องอื่นๆ', document.getElementById('study_grad_level_other'));
                        return false;
                    }
                    if (!document.getElementById('study_institute').value.trim()) {
                        notifyWarning('กรุณาระบุสถาบันการศึกษา', 'โปรดระบุสถาบันการศึกษาหรือมหาวิทยาลัยที่ท่านกำลังศึกษาอยู่', document.getElementById('study_institute'));
                        return false;
                    }
                    if (!document.getElementById('study_major').value.trim()) {
                        notifyWarning('กรุณาระบุสาขาวิชา', 'โปรดระบุคณะ / สาขาวิชา หรือ แผนกวิชาที่กำลังศึกษา', document.getElementById('study_major'));
                        return false;
                    }
                } else if (currentStatus === 'กำลังศึกษาต่อและทำงานไปด้วย') {
                    const checkedGrad = document.querySelector('input[name="both_grad_level"]:checked');
                    if (!checkedGrad) {
                        const firstBothGrad = document.querySelector('input[name="both_grad_level"]');
                        notifyWarning('กรุณาระบุระดับการศึกษา', 'โปรดเลือกระดับการศึกษาที่ท่านกำลังศึกษาอยู่', firstBothGrad);
                        return false;
                    }
                    if (!document.getElementById('both_institute').value.trim()) {
                        notifyWarning('กรุณาระบุสถาบันการศึกษา', 'โปรดระบุสถาบันการศึกษาที่ท่านกำลังศึกษาอยู่', document.getElementById('both_institute'));
                        return false;
                    }
                    if (!document.getElementById('both_major').value.trim()) {
                        notifyWarning('กรุณาระบุสาขาวิชา', 'โปรดระบุคณะหรือสาขาวิชาที่กำลังศึกษา', document.getElementById('both_major'));
                        return false;
                    }
                    if (!document.getElementById('both_job_title').value.trim()) {
                        notifyWarning('กรุณาระบุตำแหน่งงาน / ลักษณะงาน', 'โปรดระบุงานที่ทำควบคู่การเรียน', document.getElementById('both_job_title'));
                        return false;
                    }
                } else if (currentStatus === 'ว่างงาน') {
                    const checkedGrad = document.querySelector('input[name="unemp_grad_level"]:checked');
                    if (!checkedGrad) {
                        const firstUnempGrad = document.querySelector('input[name="unemp_grad_level"]');
                        notifyWarning('กรุณาระบุระดับการศึกษาสูงสุด', 'โปรดเลือกระดับการศึกษาสูงสุดที่สำเร็จการศึกษา', firstUnempGrad);
                        return false;
                    }
                    if (!document.getElementById('unemp_major').value.trim()) {
                        notifyWarning('กรุณาระบุสาขาวิชาที่จบ', 'โปรดระบุแผนการเรียนหรือสาขาวิชาที่สำเร็จการศึกษา เพื่อประโยชน์ในการจับคู่งาน อบจ.', document.getElementById('unemp_major'));
                        return false;
                    }
                }
                syncStep3Values();
            }

            return true;
        }

        nextBtn.addEventListener('click', function () {
            if (validateCurrentStep()) {
                if (currentStep < totalSteps) {
                    currentStep++;
                    updateStepView();
                }
            }
        });

        prevBtn.addEventListener('click', function () {
            if (currentStep > 1) {
                currentStep--;
                updateStepView();
            }
        });

        // Form Submit Validation & SweetAlert Confirmation on Last Step
        document.getElementById('multiStepForm').addEventListener('submit', function (e) {
            e.preventDefault();

            if (!validateCurrentStep()) {
                return;
            }

            Swal.fire({
                title: 'ยืนยันการลงทะเบียน?',
                html: `
                    <div class="text-left text-xs sm:text-sm text-slate-600 space-y-3 leading-relaxed mt-1">
                        <p class="font-medium text-slate-800">โปรดตรวจสอบความถูกต้อง คุณต้องการบันทึกข้อมูลและส่งแบบสำรวจศิษย์เก่าใช่หรือไม่</p>
                        <div class="p-3 bg-pink-50/70 rounded-2xl border border-pink-100 text-slate-700 space-y-1.5">
                            <span class="font-bold text-pink-700 block text-xs">🎉 เมื่อลงทะเบียนสำเร็จ ท่านสามารถเข้าสู่ระบบเพื่อ:</span>
                            <div class="space-y-1 text-[11px] sm:text-xs">
                                <div class="flex items-center gap-1.5"><span>✏️</span> <span><strong>แก้ไขข้อมูล & โปรไฟล์:</strong> อัปเดตงานและวุฒิได้ตลอด</span></div>
                                <div class="flex items-center gap-1.5"><span>💼</span> <span><strong>ฝากงาน / ประกาศรับสมัคร:</strong> โพสต์งานช่วยเหลือรุ่นน้อง</span></div>
                                <div class="flex items-center gap-1.5"><span>👥</span> <span><strong>ค้นหาทำเนียบศิษย์เก่า:</strong> เชื่อมต่อเพื่อนร่วมรุ่น จ.ว. / สกจ.</span></div>
                                <div class="flex items-center gap-1.5"><span>🏛️</span> <span><strong>รับโอกาสงานจาก อบจ.:</strong> ข้อมูลถูกส่งเข้าฐานข้อมูล Job Matching</span></div>
                            </div>
                        </div>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#db2777',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'ยืนยันและส่งข้อมูล',
                cancelButtonText: 'กลับไปตรวจสอบ',
                customClass: {
                    popup: 'rounded-3xl max-w-lg',
                    confirmButton: 'rounded-xl px-6 py-2.5 font-bold shadow-md',
                    cancelButton: 'rounded-xl px-6 py-2.5 font-bold'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'กำลังบันทึกข้อมูล...',
                        text: 'กรุณารอสักครู่ ระบบกำลังจัดเก็บข้อมูลของคุณ',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    // Clear draft before submitting form
                    clearFormDraft(false);
                    document.getElementById('multiStepForm').submit();
                }
            });
        });

        // Attach Real-time Auto-Save Listeners to form
        const alumniForm = document.getElementById('multiStepForm');
        if (alumniForm) {
            alumniForm.addEventListener('input', saveFormDraft);
            alumniForm.addEventListener('change', saveFormDraft);
        }

        // Step 3 state initializer
        function initStep3State() {
            <?php if (old('current_status')): ?>
                onStatusCardClick('<?= old('current_status') ?>');
            <?php endif; ?>
        }

        // Initialize and Restore Draft on Page Load
        document.addEventListener('DOMContentLoaded', function () {
            restoreFormDraft();
            initStep3State();
            updateStepView();
        });

        // Immediate call in case DOMContentLoaded has already fired
        restoreFormDraft();
        initStep3State();
        updateStepView();

        // Prefix other toggle
        const prefixSelect = document.getElementById('prefix');
        const prefixOther = document.getElementById('prefix_other');
        if (prefixSelect && prefixOther) {
            prefixSelect.addEventListener('change', function () {
                if (this.value === 'อื่นๆ') {
                    prefixOther.classList.remove('hidden');
                    prefixOther.required = true;
                    prefixOther.focus();
                } else {
                    prefixOther.classList.add('hidden');
                    prefixOther.required = false;
                    prefixOther.value = '';
                }
            });
        }

        // ==========================================
        // STEP 3: SMART STATUS CARD SELECTION & SYNC
        // ==========================================
        function onStatusCardClick(status) {
            if (!status) return;

            // Set radio checked
            const radio = document.querySelector(`input[name="ui_current_status"][value="${status}"]`);
            if (radio) {
                radio.checked = true;
            }

            // Visual card styling
            document.querySelectorAll('.status-choice-card').forEach(card => {
                card.classList.remove('border-pink-500', 'ring-2', 'ring-pink-500/20', 'bg-pink-50/30');
                card.classList.add('border-slate-200', 'bg-white');
            });
            if (radio) {
                const parentCard = radio.closest('.status-choice-card');
                if (parentCard) {
                    parentCard.classList.remove('border-slate-200', 'bg-white');
                    parentCard.classList.add('border-pink-500', 'ring-2', 'ring-pink-500/20', 'bg-pink-50/30');
                }
            }

            // Toggle panels
            const notice = document.getElementById('panel_empty_notice');
            const panelWorking = document.getElementById('panel_status_working');
            const panelStudying = document.getElementById('panel_status_studying');
            const panelBoth = document.getElementById('panel_status_both');
            const panelUnemployed = document.getElementById('panel_status_unemployed');

            if (notice) notice.classList.add('hidden');
            if (panelWorking) panelWorking.classList.add('hidden');
            if (panelStudying) panelStudying.classList.add('hidden');
            if (panelBoth) panelBoth.classList.add('hidden');
            if (panelUnemployed) panelUnemployed.classList.add('hidden');

            if (status === 'ทำงานแล้ว') {
                if (panelWorking) panelWorking.classList.remove('hidden');
            } else if (status === 'กำลังศึกษาต่อ') {
                if (panelStudying) panelStudying.classList.remove('hidden');
            } else if (status === 'กำลังศึกษาต่อและทำงานไปด้วย') {
                if (panelBoth) panelBoth.classList.remove('hidden');
            } else if (status === 'ว่างงาน') {
                if (panelUnemployed) panelUnemployed.classList.remove('hidden');
            }

            const finalStatusEl = document.getElementById('final_current_status');
            if (finalStatusEl) {
                finalStatusEl.value = status;
            }
            syncStep3Values();
            saveFormDraft();
        }

        function syncStep3Values() {
            const finalStatusEl = document.getElementById('final_current_status');
            const status = finalStatusEl ? finalStatusEl.value : '';
            const finalGradLevel = document.getElementById('final_grad_level');
            const finalGradOther = document.getElementById('final_grad_level_other');
            const finalMajor = document.getElementById('final_grad_major');
            const finalPlace = document.getElementById('final_study_place');
            const finalJob = document.getElementById('final_job_title');
            const finalExp = document.getElementById('final_work_experience');

            if (!finalGradLevel) return;

            if (status === 'ทำงานแล้ว') {
                const checkedLvl = document.querySelector('input[name="work_grad_level"]:checked');
                finalGradLevel.value = checkedLvl ? checkedLvl.value : '';
                const otherEl = document.getElementById('work_grad_level_other');
                finalGradOther.value = (finalGradLevel.value === 'อื่นๆ' && otherEl) ? otherEl.value : '';
                if (otherEl) otherEl.classList.toggle('hidden', finalGradLevel.value !== 'อื่นๆ');

                finalMajor.value = document.getElementById('work_major')?.value || '';
                finalJob.value = document.getElementById('work_job_title')?.value || '';
                finalExp.value = document.getElementById('work_experience_input')?.value || '';
                finalPlace.value = '';
            } else if (status === 'กำลังศึกษาต่อ') {
                const checkedLvl = document.querySelector('input[name="study_grad_level"]:checked');
                finalGradLevel.value = checkedLvl ? checkedLvl.value : '';
                const otherEl = document.getElementById('study_grad_level_other');
                finalGradOther.value = (finalGradLevel.value === 'อื่นๆ' && otherEl) ? otherEl.value : '';
                if (otherEl) otherEl.classList.toggle('hidden', finalGradLevel.value !== 'อื่นๆ');

                finalPlace.value = document.getElementById('study_institute')?.value || '';
                finalMajor.value = document.getElementById('study_major')?.value || '';
                finalJob.value = 'นักศึกษา';
                finalExp.value = '';
            } else if (status === 'กำลังศึกษาต่อและทำงานไปด้วย') {
                const checkedLvl = document.querySelector('input[name="both_grad_level"]:checked');
                finalGradLevel.value = checkedLvl ? checkedLvl.value : '';
                const otherEl = document.getElementById('both_grad_level_other');
                finalGradOther.value = (finalGradLevel.value === 'อื่นๆ' && otherEl) ? otherEl.value : '';
                if (otherEl) otherEl.classList.toggle('hidden', finalGradLevel.value !== 'อื่นๆ');

                finalPlace.value = document.getElementById('both_institute')?.value || '';
                finalMajor.value = document.getElementById('both_major')?.value || '';
                finalJob.value = document.getElementById('both_job_title')?.value || '';
                finalExp.value = document.getElementById('both_experience')?.value || '';
            } else if (status === 'ว่างงาน') {
                const checkedLvl = document.querySelector('input[name="unemp_grad_level"]:checked');
                finalGradLevel.value = checkedLvl ? checkedLvl.value : '';
                const otherEl = document.getElementById('unemp_grad_level_other');
                finalGradOther.value = (finalGradLevel.value === 'อื่นๆ' && otherEl) ? otherEl.value : '';
                if (otherEl) otherEl.classList.toggle('hidden', finalGradLevel.value !== 'อื่นๆ');

                finalMajor.value = document.getElementById('unemp_major')?.value || '';
                finalExp.value = document.getElementById('unemp_experience')?.value || '';
                finalJob.value = 'กำลังมองหางาน';
                finalPlace.value = '';
            }
        }

        // Unemployed other toggle
        const unempCb = document.getElementById('unemployed_other_cb');
        const unempText = document.getElementById('unemployed_other_text');
        if (unempCb && unempText) {
            unempCb.addEventListener('change', function () {
                if (this.checked) {
                    unempText.classList.remove('hidden');
                    unempText.required = true;
                    unempText.focus();
                } else {
                    unempText.classList.add('hidden');
                    unempText.required = false;
                }
            });
        }

        // Limit Checkbox selection to 2 for support needs
        const supportCheckboxes = document.querySelectorAll('.support-cb');
        supportCheckboxes.forEach(cb => {
            cb.addEventListener('change', function () {
                const checkedCount = document.querySelectorAll('.support-cb:checked').length;
                if (checkedCount > 2) {
                    this.checked = false;
                    Swal.fire({
                        icon: 'info',
                        title: 'เลือกได้สูงสุด 2 ข้อ',
                        text: 'สามารถเลือกสิ่งที่ต้องการให้ รร. หรือ อบจ. ช่วยเหลือได้สูงสุด 2 ข้อครับ',
                        confirmButtonColor: '#db2777',
                        confirmButtonText: 'เข้าใจแล้ว',
                        customClass: {
                            popup: 'rounded-2xl',
                            confirmButton: 'rounded-xl px-5 py-2 font-bold'
                        }
                    });
                }
            });
        });

        // Flash message or server-side validation notice via SweetAlert2
        <?php if (isset($validation)): ?>
            <?php 
                $errors = $validation->getErrors();
                $firstField = !empty($errors) ? array_key_first($errors) : null;
            ?>
            Swal.fire({
                icon: 'error',
                title: 'กรุณาตรวจสอบข้อมูล',
                html: '<div class="text-left text-sm text-slate-700 leading-relaxed"><?= addslashes($validation->listErrors()) ?></div>',
                confirmButtonColor: '#db2777',
                confirmButtonText: 'กลับไปแก้ไข',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl px-6 py-2.5 font-bold'
                },
                didClose: () => {
                    <?php if ($firstField): ?>
                        const errField = document.querySelector('[name="<?= $firstField ?>"], #<?= $firstField ?>');
                        if (errField) {
                            focusAndHighlightElement(errField);
                        }
                    <?php endif; ?>
                }
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: '<?= addslashes((string) session()->getFlashdata('error')) ?>',
                confirmButtonColor: '#db2777',
                confirmButtonText: 'ตกลง',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl px-6 py-2.5 font-bold'
                }
            });
        <?php endif; ?>
    
        function updateSchoolCardSelection() {
            const selectedRadio = document.querySelector('input[name="school"]:checked');
            if (!selectedRadio) return;
            const isSKJ = (selectedRadio.value.indexOf('สวนกุหลาบ') !== -1);
            
            document.querySelectorAll('.school-card').forEach(card => {
                const radio = card.querySelector('input[type="radio"]');
                if (radio && radio.checked) {
                    if (isSKJ) {
                        card.className = 'school-card relative flex items-start p-4 border-2 rounded-2xl cursor-pointer transition-all duration-200 border-pink-500 bg-pink-50/40 shadow-sm';
                    } else {
                        card.className = 'school-card relative flex items-start p-4 border-2 rounded-2xl cursor-pointer transition-all duration-200 border-blue-500 bg-blue-50/40 shadow-sm';
                    }
                } else {
                    card.className = 'school-card relative flex items-start p-4 border-2 rounded-2xl cursor-pointer transition-all duration-200 border-slate-200 bg-white hover:border-slate-300';
                }
            });

            const batchInput = document.getElementById('batch');
            if (batchInput) {
                if (isSKJ) {
                    batchInput.placeholder = 'เช่น รุ่นที่ 15 หรือ ม.6 รุ่น 15';
                } else {
                    batchInput.placeholder = 'เช่น จ.ว. รุ่นที่ 10 หรือ รุ่นที่ 10';
                }
            }
        }

        function updateSchoolLevelSelection() {
            document.querySelectorAll('.school-level-card').forEach(card => {
                const radio = card.querySelector('input[type="radio"]');
                if (radio && radio.checked) {
                    card.className = 'school-level-card relative flex items-start p-3.5 border-2 rounded-2xl cursor-pointer transition-all duration-200 border-pink-500 bg-pink-50/50 shadow-xs ring-1 ring-pink-500/20';
                } else {
                    card.className = 'school-level-card relative flex items-start p-3.5 border-2 rounded-2xl cursor-pointer transition-all duration-200 border-slate-200 bg-white hover:border-slate-300';
                }
            });
        }

        function updateHighestLevelSelection() {
            document.querySelectorAll('.highest-level-card').forEach(card => {
                const radio = card.querySelector('input[type="radio"]');
                if (radio && radio.checked) {
                    card.className = 'highest-level-card flex items-center p-3 border rounded-xl cursor-pointer hover:bg-pink-50/40 transition border-pink-500 bg-pink-50/40 ring-1 ring-pink-500/20';
                } else {
                    card.className = 'highest-level-card flex items-center p-3 border rounded-xl cursor-pointer hover:bg-pink-50/40 transition border-slate-200 bg-white';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateSchoolCardSelection();
            updateSchoolLevelSelection();
            updateHighestLevelSelection();
        });
    </script>
</body>

</html>