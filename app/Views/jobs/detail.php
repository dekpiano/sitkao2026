<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($job['job_title']) ?> | SKJ Job Board</title>
    <link href="https://fonts.googleapis.com/css2?family=K2D:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style> body { font-family: 'K2D', sans-serif; } </style>
    <script src="<?= base_url('assets/js/floating-bubbles.js') ?>" defer></script>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen">

    <!-- Navbar -->
    <header class="bg-white border-b border-slate-200/80 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="<?= base_url('jobs') ?>" class="inline-flex items-center gap-2 text-xs sm:text-sm font-bold text-slate-600 hover:text-pink-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    กลับไปหน้ารวมประกาศงาน
                </a>
                <a href="<?= base_url('jobs/create') ?>" class="text-xs font-bold text-pink-600 hover:text-pink-700 bg-pink-50 px-3.5 py-1.5 rounded-xl transition">
                    + ลงประกาศงานใหม่
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 py-8 sm:py-12">

        <div class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/80 shadow-xs mb-8">
            
            <!-- Top Header -->
            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 pb-6 mb-6">
                <div>
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold mb-2 <?= $job['job_type'] === 'Full-time' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-blue-50 text-blue-700 border border-blue-200' ?>">
                        <?= esc($job['job_type']) ?>
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 leading-tight mb-2">
                        <?= esc($job['job_title']) ?>
                    </h1>
                    <div class="flex flex-wrap items-center gap-4 text-xs sm:text-sm text-slate-500 font-medium">
                        <span class="text-slate-800 font-bold flex items-center gap-1.5">
                            🏢 <?= esc($job['job_company']) ?>
                        </span>
                        <?php if (!empty($job['job_location'])): ?>
                            <span>📍 <?= esc($job['job_location']) ?></span>
                        <?php endif; ?>
                        <span>🕒 ประกาศเมื่อ <?= date('d M Y', strtotime($job['job_created_at'] ?? 'now')) ?></span>
                    </div>
                </div>

                <div class="bg-pink-50 p-4 rounded-2xl border border-pink-100 text-right">
                    <span class="text-[10px] font-bold uppercase text-slate-400 block">เงินเดือน / ค่าตอบแทน</span>
                    <span class="text-base sm:text-lg font-black text-pink-600"><?= esc($job['job_salary'] ?: 'ตามตกลง / โครงสร้าง') ?></span>
                </div>
            </div>

            <!-- Job Description -->
            <div class="space-y-6">
                <div>
                    <h2 class="text-base font-bold text-slate-900 mb-2 flex items-center gap-2">
                        <span class="w-2 h-4 bg-pink-600 rounded-full"></span>
                        รายละเอียดและหน้าที่ความรับผิดชอบ
                    </h2>
                    <div class="text-xs sm:text-sm text-slate-700 leading-relaxed whitespace-pre-line bg-slate-50/50 p-4 rounded-2xl border border-slate-100">
                        <?= esc($job['job_description']) ?>
                    </div>
                </div>

                <?php if (!empty($job['job_qualifications'])): ?>
                <div>
                    <h2 class="text-base font-bold text-slate-900 mb-2 flex items-center gap-2">
                        <span class="w-2 h-4 bg-blue-600 rounded-full"></span>
                        คุณสมบัติผู้สมัคร
                    </h2>
                    <div class="text-xs sm:text-sm text-slate-700 leading-relaxed whitespace-pre-line bg-slate-50/50 p-4 rounded-2xl border border-slate-100">
                        <?= esc($job['job_qualifications']) ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Contact & Apply Box -->
                <div class="rounded-2xl bg-gradient-to-br from-slate-900 to-slate-800 p-6 text-white mt-8">
                    <h3 class="text-base font-bold mb-3 flex items-center gap-2 text-pink-400">
                        📨 สนใจสมัครงาน / ช่องทางการติดต่อ
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs sm:text-sm">
                        <div>
                            <span class="text-slate-400 block text-[11px]">ผู้ติดต่อ / แผนก:</span>
                            <span class="font-bold"><?= esc($job['job_contact']) ?></span>
                        </div>
                        <?php if (!empty($job['job_contact_email'])): ?>
                        <div>
                            <span class="text-slate-400 block text-[11px]">อีเมลส่ง Resume:</span>
                            <a href="mailto:<?= esc($job['job_contact_email']) ?>" class="font-bold text-pink-300 hover:underline"><?= esc($job['job_contact_email']) ?></a>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($job['job_contact_phone'])): ?>
                        <div>
                            <span class="text-slate-400 block text-[11px]">เบอร์โทรศัพท์:</span>
                            <a href="tel:<?= esc($job['job_contact_phone']) ?>" class="font-bold text-emerald-300"><?= esc($job['job_contact_phone']) ?></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>

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
