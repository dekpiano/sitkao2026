<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตั้งรหัสผ่านใหม่ | SKJ Alumni Network</title>
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
    </style>
    <script src="<?= base_url('assets/js/floating-bubbles.js') ?>" defer></script>
</head>
<body class="min-h-screen flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-8 text-slate-800 antialiased relative">
    
    <!-- Animated background -->
    <div class="animated-bg">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md relative z-10">
        <!-- Logo & Header -->
        <div class="flex justify-center mb-3">
            <a href="<?= base_url('/') ?>" class="w-12 h-12 bg-gradient-to-br from-pink-500 to-blue-500 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-pink-500/30 hover:scale-105 transition-transform">
                SKJ
            </a>
        </div>
        <h2 class="text-center text-2xl sm:text-3xl font-bold tracking-tight text-white">
            ตั้งรหัสผ่านใหม่
        </h2>
        <p class="mt-2 text-center text-xs sm:text-sm text-slate-400">
            ระบบทำเนียบศิษย์เก่าโรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ)
        </p>
    </div>

    <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-md relative z-10">
        <div class="bg-white/95 backdrop-blur-xl py-8 px-6 shadow-2xl rounded-3xl sm:px-10 border border-white/40">
            
            <div class="mb-5 text-center">
                <div class="w-12 h-12 mx-auto mb-2 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl shadow-inner">
                    🔐
                </div>
                <h3 class="text-lg font-bold text-slate-900">กำหนดรหัสผ่านใหม่</h3>
                
                <!-- Verified User Card -->
                <div class="mt-3 p-3.5 rounded-2xl bg-gradient-to-r from-pink-50 to-blue-50 border border-pink-100 text-left flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-pink-500 to-blue-600 text-white flex items-center justify-center font-bold text-sm shrink-0 shadow-sm">
                        👤
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="text-[11px] text-slate-500">บัญชีศิษย์เก่าของคุณ:</div>
                        <div class="text-sm font-bold text-slate-900 truncate">
                            <?= esc($user['alm_name'] ?? 'ศิษย์เก่า SKJ') ?>
                        </div>
                        <div class="text-xs text-pink-600 font-medium truncate">
                            <?= esc($user['alm_batch'] ?? '') ?> <?= !empty($user['alm_grad_year']) ? '(ปี ' . esc($user['alm_grad_year']) . ')' : '' ?>
                        </div>
                    </div>
                </div>
            </div>

            <form id="resetPasswordForm" class="space-y-4" onsubmit="handleResetPassword(event)">
                <input type="hidden" id="token" name="token" value="<?= esc($token) ?>">

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-xs sm:text-sm font-semibold text-slate-700">
                            รหัสผ่านใหม่ <span class="text-pink-600">*</span>
                        </label>
                        <button type="button" onclick="togglePasswordVisibility('password', 'toggleNewPassIcon')" class="text-xs text-slate-500 hover:text-pink-600 flex items-center gap-1 cursor-pointer">
                            <span id="toggleNewPassIcon">👁️</span>
                            <span class="text-[11px]">แสดง/ซ่อน</span>
                        </button>
                    </div>
                    <input id="password" name="password" type="password" required 
                           onkeyup="checkPasswordStrength(this.value)"
                           class="block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 shadow-sm focus:border-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-500/20 text-sm bg-slate-50 focus:bg-white transition" 
                           placeholder="อย่างน้อย 8 ตัวอักษร">
                </div>

                <!-- Password Rules Checklist -->
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-xs space-y-1">
                    <div class="font-semibold text-slate-600 text-[11px] mb-1">เงื่อนไขความปลอดภัย:</div>
                    <div id="rule-length" class="flex items-center gap-1.5 text-slate-400">
                        <span class="rule-icon text-xs">○</span>
                        <span>ยาวอย่างน้อย 8 ตัวอักษร</span>
                    </div>
                    <div id="rule-upper" class="flex items-center gap-1.5 text-slate-400">
                        <span class="rule-icon text-xs">○</span>
                        <span>มีตัวอักษรพิมพ์ใหญ่ (A-Z)</span>
                    </div>
                    <div id="rule-lower" class="flex items-center gap-1.5 text-slate-400">
                        <span class="rule-icon text-xs">○</span>
                        <span>มีตัวอักษรพิมพ์เล็ก (a-z)</span>
                    </div>
                    <div id="rule-number" class="flex items-center gap-1.5 text-slate-400">
                        <span class="rule-icon text-xs">○</span>
                        <span>มีตัวเลข (0-9)</span>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="passconf" class="block text-xs sm:text-sm font-semibold text-slate-700">
                            ยืนยันรหัสผ่านใหม่ <span class="text-pink-600">*</span>
                        </label>
                        <button type="button" onclick="togglePasswordVisibility('passconf', 'toggleConfPassIcon')" class="text-xs text-slate-500 hover:text-pink-600 flex items-center gap-1 cursor-pointer">
                            <span id="toggleConfPassIcon">👁️</span>
                            <span class="text-[11px]">แสดง/ซ่อน</span>
                        </button>
                    </div>
                    <input id="passconf" name="passconf" type="password" required 
                           class="block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 shadow-sm focus:border-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-500/20 text-sm bg-slate-50 focus:bg-white transition" 
                           placeholder="กรอกรหัสผ่านใหม่อีกครั้ง">
                </div>

                <div class="pt-2">
                    <button type="submit" id="btnSubmitReset" class="flex w-full justify-center items-center gap-2 rounded-xl bg-gradient-to-r from-emerald-600 via-teal-600 to-blue-600 py-3 px-4 text-sm font-bold text-white shadow-lg shadow-emerald-500/25 hover:opacity-95 hover:shadow-emerald-500/40 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition active:scale-[0.98] cursor-pointer">
                        <span>บันทึกรหัสผ่านใหม่</span>
                        <span>✓</span>
                    </button>
                </div>
            </form>

            <div class="mt-6 pt-6 border-t border-slate-100 flex flex-col gap-3 text-center text-sm">
                <a href="<?= base_url('login') ?>" class="text-xs font-bold text-pink-600 hover:text-pink-700 underline decoration-pink-300">
                    ← กลับไปหน้าเข้าสู่ระบบ
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = '🙈';
            } else {
                input.type = 'password';
                icon.textContent = '👁️';
            }
        }

        function checkPasswordStrength(password) {
            const updateRule = (id, isValid) => {
                const el = document.getElementById(id);
                if (!el) return;
                const icon = el.querySelector('.rule-icon');
                if (isValid) {
                    el.className = 'flex items-center gap-1.5 text-emerald-600 font-medium';
                    icon.textContent = '●';
                } else {
                    el.className = 'flex items-center gap-1.5 text-slate-400';
                    icon.textContent = '○';
                }
            };

            updateRule('rule-length', password.length >= 8);
            updateRule('rule-upper', /[A-Z]/.test(password));
            updateRule('rule-lower', /[a-z]/.test(password));
            updateRule('rule-number', /\d/.test(password));
        }

        async function handleResetPassword(e) {
            e.preventDefault();
            const btn = document.getElementById('btnSubmitReset');
            const token = document.getElementById('token').value.trim();
            const password = document.getElementById('password').value;
            const passconf = document.getElementById('passconf').value;

            if (!password || password.length < 8) {
                Swal.fire({
                    icon: 'warning',
                    title: 'รหัสผ่านสั้นเกินไป',
                    text: 'รหัสผ่านใหม่ต้องมีความยาวอย่างน้อย 8 ตัวอักษร',
                    confirmButtonColor: '#db2777'
                });
                return;
            }

            if (!/[A-Z]/.test(password) || !/[a-z]/.test(password) || !/\d/.test(password)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'รหัสผ่านไม่ตรงตามเงื่อนไข',
                    text: 'รหัสผ่านต้องประกอบด้วยตัวพิมพ์ใหญ่ (A-Z), ตัวพิมพ์เล็ก (a-z) และตัวเลข (0-9)',
                    confirmButtonColor: '#db2777'
                });
                return;
            }

            if (password !== passconf) {
                Swal.fire({
                    icon: 'warning',
                    title: 'รหัสผ่านไม่ตรงกัน',
                    text: 'การยืนยันรหัสผ่านใหม่ไม่ตรงกัน กรุณากรอกใหม่อีกครั้ง',
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
                <span>กำลังบันทึกรหัสผ่านใหม่...</span>
            `;

            try {
                const formData = new FormData();
                formData.append('token', token);
                formData.append('password', password);
                formData.append('passconf', passconf);

                const res = await fetch('<?= base_url('forgot-password/reset') ?>', {
                    method: 'POST',
                    body: formData
                });
                const data = await res.json();

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'เปลี่ยนรหัสผ่านสำเร็จ!',
                        text: data.message,
                        confirmButtonColor: '#059669',
                        confirmButtonText: 'เข้าสู่ระบบตอนนี้'
                    }).then(() => {
                        window.location.href = '<?= base_url('login') ?>';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ตั้งรหัสผ่านไม่สำเร็จ',
                        text: data.message || 'เกิดข้อผิดพลาดในการเปลี่ยนรหัสผ่าน',
                        confirmButtonColor: '#db2777'
                    });
                }
            } catch (err) {
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้ กรุณาลองใหม่อีกครั้ง',
                    confirmButtonColor: '#db2777'
                });
            } finally {
                btn.disabled = false;
                btn.innerHTML = `<span>บันทึกรหัสผ่านใหม่</span><span>✓</span>`;
            }
        }
    </script>
</body>
</html>
