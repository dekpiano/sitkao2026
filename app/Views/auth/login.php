<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ | SKJ Alumni Network</title>
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
        <div class="flex justify-center mb-3">
            <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-blue-500 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-pink-500/30">SKJ</div>
        </div>
        <h2 class="text-center text-2xl sm:text-3xl font-bold tracking-tight text-white">เข้าสู่ระบบ</h2>
        <p class="mt-2 text-center text-sm text-slate-400">
            ระบบทำเนียบศิษย์เก่าโรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ)
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md relative z-10">
        <div class="bg-white/95 backdrop-blur-xl py-8 px-6 shadow-2xl rounded-3xl sm:px-10 border border-white/40">
            
            <form class="space-y-5" action="<?= base_url('login/submit') ?>" method="POST">
                <div>
                    <label for="username" class="block text-sm font-semibold text-slate-700 mb-1.5">ชื่อผู้ใช้งาน / อีเมล / เบอร์โทรศัพท์</label>
                    <input id="username" name="username" type="text" required value="<?= esc(old('username', session()->getFlashdata('registered_username') ?? '')) ?>" class="block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 shadow-sm focus:border-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-500/20 text-sm bg-slate-50 focus:bg-white transition font-medium" placeholder="เช่น somchai2520, อีเมล หรือเบอร์โทร">
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-sm font-semibold text-slate-700">รหัสผ่าน</label>
                        <a href="<?= base_url('forgot-password') ?>" class="text-xs font-semibold text-pink-600 hover:text-pink-700 hover:underline transition">
                            ลืมรหัสผ่าน?
                        </a>
                    </div>
                    <div class="relative">
                        <input id="password" name="password" type="password" required class="block w-full rounded-xl border border-slate-200 px-4 py-2.5 pr-11 text-slate-900 shadow-sm focus:border-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-500/20 text-sm bg-slate-50 focus:bg-white transition" placeholder="กรอกรหัสผ่านของคุณ">
                        <button type="button" onclick="const p = document.getElementById('password'); const btn = this.querySelector('span'); if(p.type === 'password'){ p.type='text'; btn.textContent='🙈'; }else{ p.type='password'; btn.textContent='👁️'; }" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1 cursor-pointer">
                            <span class="text-xs">👁️</span>
                        </button>
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-xl bg-gradient-to-r from-pink-600 via-pink-500 to-blue-600 py-3 px-4 text-sm font-bold text-white shadow-lg shadow-pink-500/25 hover:opacity-95 hover:shadow-pink-500/40 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition active:scale-[0.98] cursor-pointer">
                        เข้าสู่ระบบ
                    </button>
                </div>
            </form>

            <div class="mt-6 pt-6 border-t border-slate-100 flex flex-col gap-3 text-center text-sm">
                <span class="text-slate-500">ยังไม่มีบัญชีศิษย์เก่า? 
                    <a href="<?= base_url('register') ?>" class="font-bold text-pink-600 hover:text-pink-700 underline decoration-pink-300">ลงทะเบียนที่นี่</a>
                </span>
                <a href="<?= base_url('/') ?>" class="text-xs font-medium text-slate-400 hover:text-slate-600 transition">← กลับสู่หน้าหลัก</a>
            </div>
        </div>
    </div>

    <script>
        <?php if(session()->getFlashdata('registered_success')): ?>
            Swal.fire({
                icon: 'success',
                title: '🎉 ลงทะเบียนศิษย์เก่าสำเร็จ!',
                html: `
                    <div class="text-left text-xs sm:text-sm text-slate-700 space-y-3 leading-relaxed mt-2">
                        <div class="p-3.5 bg-gradient-to-r from-pink-50 via-purple-50 to-blue-50 rounded-2xl border border-pink-200">
                            <p class="font-bold text-slate-900 text-sm mb-0.5">ยินดีต้อนรับสู่เครือข่ายศิษย์เก่า ✨</p>
                            <p class="text-xs text-slate-600">
                                คุณ <strong><?= esc((string)session()->getFlashdata('registered_name')) ?></strong> 
                                สามารถเข้าสู่ระบบด้วยชื่อผู้ใช้ <strong><?= esc((string)session()->getFlashdata('registered_username')) ?></strong> หรืออีเมลของท่านได้ทันที
                            </p>
                        </div>

                        <div class="rounded-2xl border border-slate-200 p-3 sm:p-4 bg-slate-50/70 space-y-2.5">
                            <div class="text-[11px] font-bold text-pink-600 uppercase tracking-wider flex items-center gap-1.5">
                                <span>🌟</span> สิ่งที่ท่านสามารถทำได้เมื่อเข้าสู่ระบบ:
                            </div>

                            <div class="flex items-start gap-2.5 bg-white p-2.5 rounded-xl border border-slate-100 shadow-xs">
                                <span class="text-base shrink-0">✏️</span>
                                <div>
                                    <strong class="text-slate-900 font-semibold block text-xs">แก้ไขและอัปเดตข้อมูลส่วนตัว</strong>
                                    <span class="text-[11px] text-slate-500">ปรับปรุงวุฒิการศึกษา ตำแหน่งงาน สถานภาพ ช่องทางติดต่อ และเปลี่ยนรูปโปรไฟล์ได้ตลอดเวลา</span>
                                </div>
                            </div>

                            <div class="flex items-start gap-2.5 bg-white p-2.5 rounded-xl border border-slate-100 shadow-xs">
                                <span class="text-base shrink-0">💼</span>
                                <div>
                                    <strong class="text-slate-900 font-semibold block text-xs">ฝากงาน / ประกาศรับสมัครงาน (Job Board)</strong>
                                    <span class="text-[11px] text-slate-500">มีงานว่างในหน่วยงานหรือธุรกิจของท่าน? โพสต์รับสมัครงานในระบบเพื่อมอบโอกาสให้เพื่อนและรุ่นน้อง</span>
                                </div>
                            </div>

                            <div class="flex items-start gap-2.5 bg-white p-2.5 rounded-xl border border-slate-100 shadow-xs">
                                <span class="text-base shrink-0">👥</span>
                                <div>
                                    <strong class="text-slate-900 font-semibold block text-xs">ค้นหาเพื่อน & ทำเนียบรุ่นศิษย์เก่า</strong>
                                    <span class="text-[11px] text-slate-500">ค้นหาเพื่อนร่วมรุ่นตามปีที่จบ (ม.3 / ม.6) ทั้ง สกจ. และ จ.ว. เพื่อเชื่อมต่อเครือข่ายวิชาชีพ</span>
                                </div>
                            </div>

                            <div class="flex items-start gap-2.5 bg-white p-2.5 rounded-xl border border-slate-100 shadow-xs">
                                <span class="text-base shrink-0">🏛️</span>
                                <div>
                                    <strong class="text-slate-900 font-semibold block text-xs">รับโอกาสงานจาก อบจ.นครสวรรค์</strong>
                                    <span class="text-[11px] text-slate-500">ข้อมูลของท่านถูกนำไปใช้คัดเลือกจับคู่ตำแหน่งงานว่าง (Job Matching) สังกัด อบจ.</span>
                                </div>
                            </div>

                            <div class="flex items-start gap-2.5 bg-white p-2.5 rounded-xl border border-slate-100 shadow-xs">
                                <span class="text-base shrink-0">📢</span>
                                <div>
                                    <strong class="text-slate-900 font-semibold block text-xs">ติดตามข่าวสาร & กิจกรรมคืนสู่เหย้า</strong>
                                    <span class="text-[11px] text-slate-500">อัปเดตกิจกรรมโรงเรียน ข่าวสารสมาคมศิษย์เก่า และงานสังสรรค์คืนสู่เหย้า</span>
                                </div>
                            </div>
                        </div>
                    </div>
                `,
                confirmButtonColor: '#db2777',
                confirmButtonText: 'เข้าสู่ระบบเลย',
                customClass: {
                    popup: 'rounded-3xl max-w-lg',
                    confirmButton: 'rounded-xl px-7 py-2.5 font-bold shadow-md'
                },
                didClose: () => {
                    const pwd = document.getElementById('password');
                    if (pwd) pwd.focus();
                }
            });
        <?php elseif(session()->getFlashdata('msg')): ?>
            Swal.fire({
                icon: 'info',
                title: 'แจ้งเตือน',
                text: '<?= addslashes((string)session()->getFlashdata('msg')) ?>',
                confirmButtonColor: '#db2777',
                confirmButtonText: 'ตกลง',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl px-6 py-2.5 font-bold shadow-md'
                }
            });
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'เข้าสู่ระบบไม่สำเร็จ',
                text: '<?= addslashes((string)session()->getFlashdata('error')) ?>',
                confirmButtonColor: '#db2777',
                confirmButtonText: 'ลองใหม่อีกครั้ง',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl px-6 py-2.5 font-bold shadow-md'
                }
            });
        <?php endif; ?>

        <?php if(session()->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: '<?= addslashes((string)session()->getFlashdata('success')) ?>',
                confirmButtonColor: '#059669',
                confirmButtonText: 'เข้าสู่ระบบเลย',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl px-6 py-2.5 font-bold shadow-md'
                }
            });
        <?php endif; ?>
    </script>
</body>
</html>
