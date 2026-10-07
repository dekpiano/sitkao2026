<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กระดานรับสมัครงาน & โอกาสสำหรับศิษย์เก่า | SKJ Alumni</title>
    <link href="https://fonts.googleapis.com/css2?family=K2D:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style> body { font-family: 'K2D', sans-serif; } </style>
    <script src="<?= base_url('assets/js/floating-bubbles.js') ?>" defer></script>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col">

    <!-- Navbar -->
    <header class="bg-white/95 backdrop-blur border-b border-slate-200/80 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                <a href="<?= base_url() ?>" class="flex items-center gap-3">
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl bg-gradient-to-tr from-pink-600 to-rose-400 flex items-center justify-center text-white font-bold text-lg shadow-md shadow-pink-500/20">
                        SKJ
                    </div>
                    <div>
                        <span class="text-base sm:text-lg font-bold text-slate-900 block leading-tight">ทำเนียบศิษย์เก่า</span>
                        <span class="text-xs text-slate-500 block">สวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์</span>
                    </div>
                </a>

                <nav class="hidden md:flex items-center gap-1">
                    <a href="<?= base_url() ?>" class="px-3.5 py-2 text-sm font-semibold text-slate-600 hover:text-pink-600 rounded-xl hover:bg-pink-50/50 transition">หน้าแรก</a>
                    <a href="<?= base_url('jobs') ?>" class="px-3.5 py-2 text-sm font-bold text-pink-600 rounded-xl bg-pink-50 transition">ตำแหน่งงานว่าง</a>
                    <a href="<?= base_url('news') ?>" class="px-3.5 py-2 text-sm font-semibold text-slate-600 hover:text-pink-600 rounded-xl hover:bg-pink-50/50 transition">ข่าวสาร & กิจกรรม</a>
                    <?php if (session()->get('role') === 'admin'): ?>
                        <a href="<?= base_url('admin/dashboard') ?>" class="px-3.5 py-2 text-sm font-bold text-purple-600 rounded-xl bg-purple-50 hover:bg-purple-100 transition">★ ระบบผู้ดูแล</a>
                    <?php endif; ?>
                </nav>

                <div class="flex items-center gap-3">
                    <a href="<?= base_url('jobs/create') ?>" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-gradient-to-r from-pink-600 to-rose-500 hover:from-pink-700 hover:to-rose-600 text-white text-xs sm:text-sm font-bold shadow-md shadow-pink-500/20 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        ลงประกาศงาน
                    </a>
                    <?php if (session()->get('isLoggedIn')): ?>
                        <a href="<?= base_url('alumni/my-profile') ?>" class="p-2 rounded-xl text-slate-600 hover:bg-slate-100 transition" title="โปรไฟล์ของฉัน">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </a>
                    <?php else: ?>
                        <a href="<?= base_url('login') ?>" class="text-xs sm:text-sm font-bold text-slate-700 hover:text-pink-600 px-3 py-2 rounded-xl transition">เข้าสู่ระบบ</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 w-full">

        <!-- Banner Header -->
        <div class="rounded-3xl bg-gradient-to-r from-slate-900 via-slate-800 to-pink-950 p-6 sm:p-10 text-white shadow-lg mb-8 relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 w-72 h-72 bg-pink-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="relative z-10 max-w-2xl">
                <span class="inline-block px-3 py-1 rounded-full bg-white/10 text-pink-300 text-xs font-bold mb-3 border border-white/10">
                    💼 SKJ Career Network & Job Opportunities
                </span>
                <h1 class="text-2xl sm:text-4xl font-black tracking-tight mb-2">กระดานรับสมัครงาน & ฝึกงาน</h1>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal">
                    ศูนย์รวมตำแหน่งงานว่างจากหน่วยงาน อบจ.นครสวรรค์, องค์กรพันธมิตร และธุรกิจของเครือข่ายศิษย์เก่า เพื่อเปิดโอกาสในการทำงานร่วมกัน
                </p>
            </div>
        </div>

        <!-- Filter & Search Controls -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/80 shadow-xs mb-8">
            <form action="<?= base_url('jobs') ?>" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                <div class="sm:col-span-6">
                    <input type="text" name="search" value="<?= esc($search ?? '') ?>" placeholder="ค้นหาตำแหน่งงาน, บริษัท, สถานที่ทำงาน..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-xs sm:text-sm outline-none">
                </div>
                <div class="sm:col-span-4">
                    <select name="type" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 text-xs sm:text-sm bg-white outline-none">
                        <option value="">-- รูปแบบงานทั้งหมด (Job Type) --</option>
                        <option value="Full-time" <?= ($type ?? '') === 'Full-time' ? 'selected' : '' ?>>งานประจำ (Full-time)</option>
                        <option value="Part-time" <?= ($type ?? '') === 'Part-time' ? 'selected' : '' ?>>งานพาร์ตไทม์ (Part-time)</option>
                        <option value="Internship" <?= ($type ?? '') === 'Internship' ? 'selected' : '' ?>>นักศึกษาฝึกงาน (Internship)</option>
                        <option value="Freelance" <?= ($type ?? '') === 'Freelance' ? 'selected' : '' ?>>ฟรีแลนซ์ / รับงานอิสระ</option>
                    </select>
                </div>
                <div class="sm:col-span-2 flex gap-2">
                    <button type="submit" class="flex-1 px-4 py-2.5 rounded-xl bg-pink-600 hover:bg-pink-700 text-white text-xs font-bold shadow-xs transition">
                        ค้นหา
                    </button>
                    <a href="<?= base_url('jobs') ?>" class="px-3 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold transition flex items-center justify-center">
                        ล้าง
                    </a>
                </div>
            </form>
        </div>

        <!-- Job Grid -->
        <?php if (empty($jobs)): ?>
            <div class="bg-white rounded-3xl p-12 text-center border border-slate-200/80 shadow-xs max-w-lg mx-auto">
                <div class="w-16 h-16 rounded-full bg-pink-50 text-pink-500 flex items-center justify-center mx-auto mb-4 text-2xl font-bold">
                    💼
                </div>
                <h3 class="text-base font-bold text-slate-800 mb-1">ยังไม่พบประกาศงานที่ตรงกับเงื่อนไข</h3>
                <p class="text-xs text-slate-400 mb-6">ลองเปลี่ยนคำค้นหา หรือร่วมเป็นผู้ลงประกาศงานคนแรก</p>
                <a href="<?= base_url('jobs/create') ?>" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-pink-600 text-white text-xs font-bold shadow-sm hover:bg-pink-700 transition">
                    ลงประกาศรับสมัครงาน
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($jobs as $job): ?>
                <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs hover:shadow-md hover:border-pink-200 transition-all flex flex-col justify-between group">
                    <div>
                        <!-- Type badge & Date -->
                        <div class="flex items-center justify-between gap-2 mb-3">
                            <span class="text-[11px] font-bold px-2.5 py-1 rounded-lg <?= $job['job_type'] === 'Full-time' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : ($job['job_type'] === 'Internship' ? 'bg-purple-50 text-purple-700 border border-purple-200' : 'bg-blue-50 text-blue-700 border border-blue-200') ?>">
                                <?= esc($job['job_type']) ?>
                            </span>
                            <span class="text-[11px] text-slate-400 font-mono">
                                <?= date('d M Y', strtotime($job['job_created_at'] ?? 'now')) ?>
                            </span>
                        </div>

                        <!-- Job Title -->
                        <h3 class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-pink-600 transition-colors line-clamp-2 mb-1.5">
                            <?= esc($job['job_title']) ?>
                        </h3>

                        <!-- Company & Location -->
                        <div class="space-y-1 mb-4 text-xs text-slate-500">
                            <div class="flex items-center gap-1.5 font-semibold text-slate-700">
                                <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                <span><?= esc($job['job_company']) ?></span>
                            </div>
                            <?php if (!empty($job['job_location'])): ?>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span><?= esc($job['job_location']) ?></span>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Description Snippet -->
                        <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed mb-4">
                            <?= esc($job['job_description']) ?>
                        </p>
                    </div>

                    <!-- Footer Details & Action -->
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 block">เงินเดือน / ค่าตอบแทน</span>
                            <span class="text-xs sm:text-sm font-bold text-pink-600"><?= esc($job['job_salary'] ?: 'ตามตกลง / โครงสร้าง') ?></span>
                        </div>
                        <a href="<?= base_url('jobs/' . $job['job_id']) ?>" class="inline-flex items-center gap-1 px-4 py-2 rounded-xl bg-slate-900 hover:bg-pink-600 text-white text-xs font-bold transition">
                            ดูรายละเอียด
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200/80 py-6 mt-12 text-xs text-slate-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p>© 2026 โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์ | องค์การบริหารส่วนจังหวัดนครสวรรค์</p>
            <a href="<?= base_url('admin') ?>" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium text-xs transition border border-slate-200">
                <svg class="w-3.5 h-3.5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <span>เข้าสู่ระบบ Admin</span>
            </a>
        </div>
    </footer>

</body>
</html>
