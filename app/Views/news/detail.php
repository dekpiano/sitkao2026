<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($news['news_title']) ?> | SKJ News</title>
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
                <a href="<?= base_url('news') ?>" class="inline-flex items-center gap-2 text-xs sm:text-sm font-bold text-slate-600 hover:text-pink-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    กลับไปหน้ารวมข่าวสาร & กิจกรรม
                </a>
                <a href="<?= base_url() ?>" class="text-xs font-bold text-slate-500 hover:text-pink-600">
                    หน้าหลักศิษย์เก่า
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 py-8 sm:py-12">

        <article class="bg-white rounded-3xl p-6 sm:p-12 border border-slate-200/80 shadow-xs mb-12">
            
            <div class="mb-6">
                <div class="flex items-center gap-3 text-xs text-slate-400 mb-3">
                    <span class="font-bold text-pink-600 bg-pink-50 px-3 py-1 rounded-lg border border-pink-100"><?= esc($news['news_category']) ?></span>
                    <span>วันที่เผยแพร่: <?= date('d M Y', strtotime($news['news_date'] ?: ($news['news_created_at'] ?? 'now'))) ?></span>
                    <span>• เข้าชม <?= number_format($news['news_views'] ?? 0) ?> ครั้ง</span>
                </div>
                <h1 class="text-2xl sm:text-4xl font-black text-slate-900 leading-tight">
                    <?= esc($news['news_title']) ?>
                </h1>
            </div>

            <?php if (!empty($news['news_image'])): ?>
            <div class="rounded-3xl overflow-hidden mb-8 bg-slate-100 shadow-xs">
                <img src="<?= esc($news['news_image']) ?>" alt="<?= esc($news['news_title']) ?>" class="w-full h-auto max-h-[480px] object-cover">
            </div>
            <?php endif; ?>

            <div class="prose prose-slate max-w-none text-sm sm:text-base text-slate-700 leading-relaxed whitespace-pre-line">
                <?= esc($news['news_content']) ?>
            </div>

            <div class="mt-12 pt-6 border-t border-slate-100 flex items-center justify-between">
                <a href="<?= base_url('news') ?>" class="inline-flex items-center gap-2 text-xs sm:text-sm font-bold text-pink-600 hover:underline">
                    ← กลับสู่หน้าข่าวสารทั้งหมด
                </a>
                <div class="text-xs text-slate-400">
                    โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์
                </div>
            </div>

        </article>

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
