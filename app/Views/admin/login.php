<!DOCTYPE html>
<html lang="th" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบผู้ดูแลระบบ (Admin) - SKJ Alumni Network</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=K2D:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Google Identity Services -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['K2D', 'Outfit', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#fdf2f8',
                            100: '#fce7f3',
                            500: '#ec4899',
                            600: '#db2777',
                            700: '#be185d',
                            900: '#831843',
                        }
                    },
                    animation: {
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'blob': 'blob 8s infinite',
                    },
                    keyframes: {
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -40px) scale(1.08)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.92)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass-card {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }
        .google-btn-glow {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .google-btn-glow:hover {
            box-shadow: 0 0 35px rgba(236, 72, 153, 0.35);
            transform: translateY(-2px);
        }
    </style>
    <script src="<?= base_url('assets/js/floating-bubbles.js') ?>" defer></script>
</head>
<body class="h-full bg-slate-950 text-slate-100 font-sans flex flex-col justify-between overflow-x-hidden relative selection:bg-pink-500 selection:text-white">

    <!-- Ambient Glowing Background Elements -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-pink-600/20 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute top-1/2 -right-32 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-32 left-1/3 w-96 h-96 bg-rose-600/20 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#1e293b_1px,transparent_1px)] [background-size:24px_24px] opacity-30"></div>
    </div>

    <!-- Navigation Header -->
    <header class="relative z-10 p-6 flex justify-between items-center max-w-7xl mx-auto w-full">
        <a href="<?= base_url('/') ?>" class="inline-flex items-center gap-3 group">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-pink-600 to-rose-500 p-0.5 shadow-lg shadow-pink-500/30 group-hover:scale-105 transition-transform duration-300">
                <div class="w-full h-full bg-slate-900 rounded-[14px] flex items-center justify-center">
                    <span class="text-pink-400 font-black text-sm">SKJ</span>
                </div>
            </div>
            <div>
                <span class="text-lg font-bold text-white tracking-wide block leading-none">SKJ ALUMNI</span>
                <span class="text-[10px] text-pink-400 font-medium tracking-wider">ADMIN BACKOFFICE</span>
            </div>
        </a>

        <a href="<?= base_url('/') ?>" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-white transition px-4 py-2 rounded-xl bg-slate-900/60 border border-slate-800 hover:border-slate-700">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>กลับสู่หน้าหลัก</span>
        </a>
    </header>

    <!-- Main Content Container -->
    <main class="relative z-10 flex-grow flex items-center justify-center px-4 py-12">
        <div class="max-w-md w-full">
            
            <!-- Login Card -->
            <div class="glass-card rounded-3xl p-8 sm:p-10 shadow-2xl relative overflow-hidden text-center">
                <!-- Top Accent Line -->
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-pink-500 via-rose-500 to-indigo-500"></div>

                <!-- Admin Shield Icon -->
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-pink-500/20 to-indigo-500/20 border border-pink-500/30 text-pink-400 mb-4 shadow-inner">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-pink-500/10 border border-pink-500/20 text-pink-400 text-xs font-semibold mb-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-pink-500 animate-pulse"></span>
                    Admin Backoffice Portal
                </div>
                
                <h1 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">เข้าสู่ระบบผู้ดูแลระบบ</h1>
                <p class="text-xs sm:text-sm text-slate-400 mt-1 mb-8">ยินดีต้อนรับผู้บริหารและเจ้าหน้าที่โรงเรียน สกจ.</p>

                <!-- Single Google Sign-In Button Container -->
                <div class="space-y-6">
                    
                    <?php if (!empty($googleClientId)): ?>
                    <!-- Google Identity Services Hidden/Wrapper Element -->
                    <div id="g_id_onload"
                         data-client_id="<?= esc($googleClientId) ?>"
                         data-callback="handleGoogleCredentialResponse"
                         data-auto_prompt="false"
                         data-context="signin"
                         data-ux_mode="popup">
                    </div>
                    <?php endif; ?>

                    <!-- Single Prominent Google Login Button -->
                    <button type="button" 
                            id="googleLoginBtn"
                            onclick="triggerGoogleLogin()"
                            class="google-btn-glow w-full flex items-center justify-center gap-3.5 px-6 py-4 rounded-2xl bg-white text-slate-900 font-bold text-sm sm:text-base hover:bg-slate-50 transition-all duration-300 shadow-xl border border-white/20 active:scale-[0.98] cursor-pointer">
                        <!-- Google Color Logo SVG -->
                        <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                            <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/>
                            <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 10.03 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                            <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                        </svg>
                        <span>เข้าสู่ระบบด้วย Google Account</span>
                    </button>

                    <!-- Security & Info Badge -->
                    <div class="pt-4 border-t border-slate-800/80 flex items-center justify-center gap-2 text-[11px] text-slate-500">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span>เฉพาะบัญชี Google ที่ได้รับสิทธิ์ Admin เท่านั้น</span>
                    </div>

                </div>

            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="relative z-10 py-6 text-center text-xs text-slate-600">
        <p>© 2026 โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์ | องค์การบริหารส่วนจังหวัดนครสวรรค์</p>
    </footer>

    <!-- JavaScript Logic -->
    <script>
        // Check flash message from session
        <?php if(session()->getFlashdata('msg')): ?>
            Swal.fire({
                icon: 'warning',
                title: 'กรุณาเข้าสู่ระบบ',
                text: '<?= addslashes((string)session()->getFlashdata('msg')) ?>',
                confirmButtonColor: '#db2777',
                confirmButtonText: 'ตกลง',
                background: '#0f172a',
                color: '#fff',
                customClass: {
                    popup: 'rounded-3xl border border-slate-800'
                }
            });
        <?php endif; ?>

        // Handle Google Identity Services Credential Response
        function handleGoogleCredentialResponse(response) {
            if (!response.credential) {
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: 'ไม่สามารถรับข้อมูลยืนยันตัวตนจาก Google ได้',
                    confirmButtonColor: '#db2777',
                    background: '#0f172a',
                    color: '#fff'
                });
                return;
            }

            Swal.fire({
                title: 'กำลังตรวจสอบสิทธิ์ Admin...',
                text: 'กำลังเชื่อมต่อ Google Security Service',
                allowOutsideClick: false,
                background: '#0f172a',
                color: '#fff',
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Send Google Credential to Backend
            fetch('<?= base_url('admin/google-login') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({
                    credential: response.credential
                })
            })
            .then(res => res.json())
            .then(handleLoginResponse)
            .catch(handleLoginError);
        }

        const hasGoogleClientId = <?= !empty($googleClientId) ? 'true' : 'false' ?>;

        // Trigger Google Login
        function triggerGoogleLogin() {
            if (hasGoogleClientId && typeof google !== 'undefined' && google.accounts && google.accounts.id) {
                try {
                    google.accounts.id.prompt((notification) => {
                        if (notification.isNotDisplayed() || notification.isSkippedMoment()) {
                            promptGoogleEmailModal();
                        }
                    });
                } catch(e) {
                    promptGoogleEmailModal();
                }
            } else {
                promptGoogleEmailModal();
            }
        }

        // Fallback email prompt dialog for custom Google account verification
        function promptGoogleEmailModal() {
            Swal.fire({
                title: 'Google Account Sign-In',
                html: `
                    <div class="text-left space-y-3 pt-2">
                        <p class="text-xs text-slate-400">กรุณาระบุอีเมล Google ของผู้ดูแลระบบที่ได้รับสิทธิ์</p>
                        <input type="email" id="swalGoogleEmail" class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:outline-none focus:border-pink-500" placeholder="name@skj.ac.th">
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'เข้าสู่ระบบด้วย Google',
                cancelButtonText: 'ยกเลิก',
                confirmButtonColor: '#db2777',
                cancelButtonColor: '#334155',
                background: '#0f172a',
                color: '#fff',
                customClass: {
                    popup: 'rounded-3xl border border-slate-800'
                },
                preConfirm: () => {
                    const email = document.getElementById('swalGoogleEmail').value.trim();
                    if (!email) {
                        Swal.showValidationMessage('กรุณาระบุอีเมล Google');
                        return false;
                    }
                    return email;
                }
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    verifyAdminGoogleEmail(result.value);
                }
            });
        }

        function verifyAdminGoogleEmail(email) {
            Swal.fire({
                title: 'กำลังตรวจสอบสิทธิ์ Admin...',
                text: `กำลังยืนยันตัวตนบัญชี ${email}`,
                allowOutsideClick: false,
                background: '#0f172a',
                color: '#fff',
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch('<?= base_url('admin/google-login') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({
                    email: email
                })
            })
            .then(res => res.json())
            .then(handleLoginResponse)
            .catch(handleLoginError);
        }

        function handleLoginResponse(data) {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'ยืนยันสิทธิ์สำเร็จ',
                    text: data.message,
                    timer: 1400,
                    showConfirmButton: false,
                    background: '#0f172a',
                    color: '#fff'
                }).then(() => {
                    window.location.href = data.redirect || '<?= base_url('admin') ?>';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'ไม่มีสิทธิ์เข้าถึง',
                    text: data.message,
                    confirmButtonColor: '#db2777',
                    background: '#0f172a',
                    color: '#fff'
                });
            }
        }

        function handleLoginError() {
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: 'ไม่สามารถติดต่อเซิร์ฟเวอร์ได้ กรุณาลองใหม่อีกครั้ง',
                confirmButtonColor: '#db2777',
                background: '#0f172a',
                color: '#fff'
            });
        }
    </script>
</body>
</html>
