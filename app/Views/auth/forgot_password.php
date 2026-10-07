<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลืมรหัสผ่าน | SKJ Alumni Network</title>
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
            background-color: #0b0f19;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 36px 36px;
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.6;
            animation: float 20s infinite alternate cubic-bezier(0.4, 0, 0.2, 1);
        }

        .blob-1 {
            top: -10%;
            left: -10%;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(236, 72, 153, 0.85) 0%, transparent 70%);
            animation-duration: 18s;
        }

        .blob-2 {
            bottom: -10%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.85) 0%, transparent 70%);
            animation-duration: 22s;
        }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(60px, 40px) scale(1.15); }
            100% { transform: translate(-40px, 80px) scale(0.9); }
        }

        .tab-btn.active {
            background-color: #ffffff;
            color: #0f172a;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
        }
    </style>
    <script src="<?= base_url('assets/js/floating-bubbles.js') ?>" defer></script>
</head>
<body class="min-h-screen flex flex-col justify-center py-10 px-4 sm:px-6 lg:px-8 text-slate-800 antialiased relative">
    
    <!-- Animated background -->
    <div class="animated-bg">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md relative z-10">
        <!-- Logo & Header -->
        <div class="flex justify-center mb-3">
            <a href="<?= base_url('/') ?>" class="w-12 h-12 bg-gradient-to-br from-pink-500 to-blue-500 rounded-2xl flex items-center justify-center text-white font-black text-xl shadow-lg shadow-pink-500/30 hover:scale-105 transition-transform">
                SKJ
            </a>
        </div>
        <h2 class="text-center text-2xl sm:text-3xl font-black tracking-tight text-white">
            กู้คืนและตั้งรหัสผ่านใหม่
        </h2>
        <p class="mt-1.5 text-center text-xs sm:text-sm text-slate-400">
            ระบบทำเนียบศิษย์เก่า สวนกุหลาบฯ จิรประวัติ & จิรประวัติวิทยาคม
        </p>
    </div>

    <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-lg relative z-10">
        <div class="bg-white/95 backdrop-blur-xl py-7 px-5 sm:py-8 sm:px-8 shadow-2xl rounded-3xl border border-white/40">
            
            <!-- Dual-Method Switcher Tabs -->
            <div class="bg-slate-100 p-1.5 rounded-2xl flex items-center mb-6 text-xs sm:text-sm font-bold text-slate-500">
                <button type="button" id="tabEmailBtn" onclick="switchResetTab('email')" class="tab-btn active flex-1 py-2.5 px-3 rounded-xl transition flex items-center justify-center gap-1.5 cursor-pointer">
                    <span>✉️</span>
                    <span>กู้คืนด้วยอีเมล</span>
                </button>
                <button type="button" id="tabInfoBtn" onclick="switchResetTab('info')" class="tab-btn flex-1 py-2.5 px-3 rounded-xl transition flex items-center justify-center gap-1.5 cursor-pointer">
                    <span>🛡️</span>
                    <span>ข้อมูลศิษย์เก่า (ไม่มีอีเมล)</span>
                </button>
            </div>

            <!-- ========================================== -->
            <!-- TAB 1: EMAIL RESET FORM                    -->
            <!-- ========================================== -->
            <div id="tabEmailContent" class="space-y-4">
                <div class="text-center mb-4">
                    <div class="w-11 h-11 mx-auto mb-2 rounded-2xl bg-pink-50 text-pink-600 flex items-center justify-center text-xl shadow-xs">
                        ✉️
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-slate-900">ยืนยันอีเมลของคุณ</h3>
                    <p class="text-xs text-slate-500 mt-0.5">
                        กรุณากรอกอีเมลที่ลงทะเบียนไว้ ระบบจะส่งลิงก์สำหรับตั้งรหัสผ่านใหม่ไปยังกล่องจดหมายของคุณ
                    </p>
                </div>

                <div id="requestFormContainer">
                    <form id="forgotEmailForm" class="space-y-4" onsubmit="handleSendResetEmail(event)">
                        <div>
                            <label for="email" class="block text-xs sm:text-sm font-semibold text-slate-700 mb-1.5">
                                อีเมลที่ใช้ลงทะเบียน <span class="text-pink-600">*</span>
                            </label>
                            <input id="email" name="email" type="email" required 
                                   class="block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 shadow-sm focus:border-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-500/20 text-sm bg-slate-50 focus:bg-white transition" 
                                   placeholder="เช่น yourname@gmail.com">
                        </div>

                        <div class="pt-2">
                            <button type="submit" id="btnSendEmail" class="flex w-full justify-center items-center gap-2 rounded-xl bg-gradient-to-r from-pink-600 via-pink-500 to-blue-600 py-3 px-4 text-sm font-bold text-white shadow-lg shadow-pink-500/25 hover:opacity-95 hover:shadow-pink-500/40 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition active:scale-[0.98] cursor-pointer">
                                <span>ส่งลิงก์ยืนยันไปยังอีเมล</span>
                                <span>✉️</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Email Sent Success State (Hidden by default) -->
                <div id="emailSentContainer" class="hidden text-center py-2">
                    <div class="w-14 h-14 mx-auto mb-2 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center text-2xl shadow-sm">
                        📬
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 mb-1">ส่งอีเมลเรียบร้อยแล้ว!</h3>
                    <p class="text-xs sm:text-sm text-slate-600 mb-4 leading-relaxed">
                        ระบบได้ส่งลิงก์ตั้งรหัสผ่านใหม่ไปยัง<br>
                        <span id="sentTargetEmail" class="font-bold text-pink-600 bg-pink-50 px-2 py-0.5 rounded-md"></span>
                    </p>

                    <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-200/80 text-left text-xs text-slate-600 space-y-1.5 mb-4">
                        <div class="font-bold text-slate-800 flex items-center gap-1.5">
                            <span>💡</span>
                            <span>คำแนะนำ:</span>
                        </div>
                        <ul class="list-disc list-inside space-y-1 text-slate-500 pl-1 text-[11px]">
                            <li>กรุณาเปิดอีเมลและคลิกปุ่ม <strong>"ตั้งรหัสผ่านใหม่"</strong></li>
                            <li>หากไม่พบใน Inbox โปรดตรวจดูในโฟลเดอร์ <strong>Junk / Spam (ขยะ)</strong></li>
                            <li>ลิงก์ยืนยันมีอายุการใช้งาน 30 นาที</li>
                        </ul>
                    </div>

                    <div class="space-y-2">
                        <a href="<?= base_url('login') ?>" class="block w-full text-center py-2.5 px-4 rounded-xl bg-slate-900 text-white font-bold text-xs sm:text-sm hover:bg-slate-800 transition shadow-sm">
                            กลับไปหน้าเข้าสู่ระบบ
                        </a>
                        
                        <button type="button" onclick="document.getElementById('emailSentContainer').classList.add('hidden'); document.getElementById('requestFormContainer').classList.remove('hidden');" class="text-xs font-semibold text-slate-500 hover:text-pink-600 transition cursor-pointer">
                            ส่งอีเมลอีกครั้ง
                        </button>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- TAB 2: PROFILE VERIFICATION FORM (NO EMAIL) -->
            <!-- ========================================== -->
            <div id="tabInfoContent" class="hidden space-y-4">
                <div class="text-center mb-4">
                    <div class="w-11 h-11 mx-auto mb-2 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl shadow-xs">
                        🛡️
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-slate-900">ยืนยันข้อมูลศิษย์เก่า</h3>
                    <p class="text-xs text-slate-500 mt-0.5">
                        สำหรับผู้ที่ไม่ได้กรอกอีเมลไว้ กรอกข้อมูลตอนลงทะเบียนเพื่อยืนยันตัวตนและตั้งรหัสผ่านใหม่ได้ทันที
                    </p>
                </div>

                <form id="forgotInfoForm" class="space-y-3.5" onsubmit="handleVerifyAlumniInfo(event)">
                    <div>
                        <label for="v_identifier" class="block text-xs sm:text-sm font-semibold text-slate-700 mb-1">
                            ชื่อผู้ใช้งาน (Username) หรือ เบอร์โทรศัพท์ <span class="text-pink-600">*</span>
                        </label>
                        <input id="v_identifier" name="identifier" type="text" required 
                               class="block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 shadow-sm focus:border-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-500/20 text-sm bg-slate-50 focus:bg-white transition" 
                               placeholder="เช่น somchai2520 หรือ 0812345678">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label for="v_first_name" class="block text-xs sm:text-sm font-semibold text-slate-700 mb-1">
                                ชื่อจริง <span class="text-pink-600">*</span>
                            </label>
                            <input id="v_first_name" name="first_name" type="text" required 
                                   class="block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 shadow-sm focus:border-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-500/20 text-sm bg-slate-50 focus:bg-white transition" 
                                   placeholder="เช่น สมชาย">
                        </div>
                        <div>
                            <label for="v_last_name" class="block text-xs sm:text-sm font-semibold text-slate-700 mb-1">
                                นามสกุล <span class="text-pink-600">*</span>
                            </label>
                            <input id="v_last_name" name="last_name" type="text" required 
                                   class="block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 shadow-sm focus:border-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-500/20 text-sm bg-slate-50 focus:bg-white transition" 
                                   placeholder="เช่น ใจดี">
                        </div>
                    </div>

                    <div>
                        <label for="v_grad_year" class="block text-xs sm:text-sm font-semibold text-slate-700 mb-1">
                            ปี พ.ศ. ที่จบการศึกษา <span class="text-slate-400 font-normal text-xs">(เช่น 2553)</span>
                        </label>
                        <input id="v_grad_year" name="grad_year" type="text" 
                               class="block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 shadow-sm focus:border-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-500/20 text-sm bg-slate-50 focus:bg-white transition" 
                               placeholder="เช่น 2553 หรือ 2560">
                    </div>

                    <div class="pt-2">
                        <button type="submit" id="btnVerifyInfo" class="flex w-full justify-center items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 py-3 px-4 text-sm font-bold text-white shadow-lg shadow-blue-500/25 hover:opacity-95 hover:shadow-blue-500/40 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition active:scale-[0.98] cursor-pointer">
                            <span>ตรวจสอบข้อมูล & ตั้งรหัสผ่านใหม่</span>
                            <span>🛡️</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Help Callout (Admin Contact) -->
            <div class="mt-6 p-3.5 bg-slate-50 rounded-2xl border border-slate-200/70 text-xs text-slate-500 flex items-start gap-2.5">
                <span class="text-base shrink-0">💬</span>
                <div>
                    <strong class="text-slate-700 block font-semibold">จำข้อมูลการลงทะเบียนไม่ได้?</strong>
                    <span>สามารถติดต่อผู้ดูแลระบบเพื่อขอรีเซ็ตรหัสผ่านได้ที่ห้องวิชาการ/งานศิษย์เก่าโรงเรียน</span>
                </div>
            </div>

            <!-- Bottom Links -->
            <div class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                <a href="<?= base_url('login') ?>" class="font-bold text-pink-600 hover:text-pink-700 underline decoration-pink-300">
                    ← กลับไปหน้าเข้าสู่ระบบ
                </a>
                <a href="<?= base_url('/') ?>" class="font-medium text-slate-400 hover:text-slate-600 transition">
                    หน้าหลักทำเนียบ
                </a>
            </div>
        </div>
    </div>

    <script>
        function switchResetTab(tab) {
            const emailTabBtn = document.getElementById('tabEmailBtn');
            const infoTabBtn = document.getElementById('tabInfoBtn');
            const emailContent = document.getElementById('tabEmailContent');
            const infoContent = document.getElementById('tabInfoContent');

            if (tab === 'email') {
                emailTabBtn.classList.add('active');
                infoTabBtn.classList.remove('active');
                emailContent.classList.remove('hidden');
                infoContent.classList.add('hidden');
            } else {
                infoTabBtn.classList.add('active');
                emailTabBtn.classList.remove('active');
                infoContent.classList.remove('hidden');
                emailContent.classList.add('hidden');
            }
        }

        // 1. Handle Email-Based Reset
        async function handleSendResetEmail(e) {
            e.preventDefault();
            const btn = document.getElementById('btnSendEmail');
            const email = document.getElementById('email').value.trim();

            if (!email) {
                Swal.fire({
                    icon: 'warning',
                    title: 'กรุณากรอกอีเมล',
                    text: 'กรุณาระบุอีเมลที่ท่านเคยลงทะเบียนไว้ในระบบ',
                    confirmButtonColor: '#db2777'
                });
                return;
            }

            btn.disabled = true;
            btn.innerHTML = `
                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>กำลังส่งอีเมล...</span>
            `;

            try {
                const formData = new FormData();
                formData.append('email', email);

                const res = await fetch('<?= base_url('forgot-password/verify') ?>', {
                    method: 'POST',
                    body: formData
                });
                const data = await res.json();

                if (data.success) {
                    document.getElementById('sentTargetEmail').textContent = data.masked_email || email;
                    document.getElementById('requestFormContainer').classList.add('hidden');
                    document.getElementById('emailSentContainer').classList.remove('hidden');

                    Swal.fire({
                        icon: 'success',
                        title: 'ส่งอีเมลเรียบร้อยแล้ว',
                        text: data.message,
                        confirmButtonColor: '#059669',
                        confirmButtonText: 'ตกลง'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ไม่สามารถดำเนินการได้',
                        text: data.message || 'ไม่พบบัญชีผู้ใช้งานหรืออีเมลนี้ในระบบ',
                        confirmButtonColor: '#db2777',
                        confirmButtonText: 'ลองใหม่อีกครั้ง'
                    });
                }
            } catch (err) {
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้ กรุณาลองใหม่ในภายหลัง',
                    confirmButtonColor: '#db2777'
                });
            } finally {
                btn.disabled = false;
                btn.innerHTML = `<span>ส่งลิงก์ยืนยันไปยังอีเมล</span><span>✉️</span>`;
            }
        }

        // 2. Handle Profile Info-Based Verification (No Email)
        async function handleVerifyAlumniInfo(e) {
            e.preventDefault();
            const btn = document.getElementById('btnVerifyInfo');
            const identifier = document.getElementById('v_identifier').value.trim();
            const firstName = document.getElementById('v_first_name').value.trim();
            const lastName = document.getElementById('v_last_name').value.trim();
            const gradYear = document.getElementById('v_grad_year').value.trim();

            if (!identifier || !firstName || !lastName) {
                Swal.fire({
                    icon: 'warning',
                    title: 'กรุณากรอกข้อมูลให้ครบ',
                    text: 'กรุณากรอกชื่อผู้ใช้/เบอร์โทร, ชื่อจริง และนามสกุล เพื่อยืนยันตัวตน',
                    confirmButtonColor: '#2563eb'
                });
                return;
            }

            btn.disabled = true;
            btn.innerHTML = `
                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>กำลังตรวจสอบข้อมูล...</span>
            `;

            try {
                const formData = new FormData();
                formData.append('identifier', identifier);
                formData.append('first_name', firstName);
                formData.append('last_name', lastName);
                formData.append('grad_year', gradYear);

                const res = await fetch('<?= base_url('forgot-password/verify-info') ?>', {
                    method: 'POST',
                    body: formData
                });
                const data = await res.json();

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'ยืนยันตัวตนสำเร็จ!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = data.redirect;
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ไม่พบข้อมูลที่ตรงกัน',
                        text: data.message || 'ข้อมูลไม่ตรงกับในระบบ โปรดตรวจสอบอีกครั้ง',
                        confirmButtonColor: '#2563eb',
                        confirmButtonText: 'ลองใหม่อีกครั้ง'
                    });
                }
            } catch (err) {
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้ กรุณาลองใหม่ในภายหลัง',
                    confirmButtonColor: '#2563eb'
                });
            } finally {
                btn.disabled = false;
                btn.innerHTML = `<span>ตรวจสอบข้อมูล & ตั้งรหัสผ่านใหม่</span><span>🛡️</span>`;
            }
        }

        <?php if(session()->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'แจ้งเตือน',
                text: '<?= addslashes((string)session()->getFlashdata('error')) ?>',
                confirmButtonColor: '#db2777'
            });
        <?php endif; ?>
    </script>
</body>
</html>
