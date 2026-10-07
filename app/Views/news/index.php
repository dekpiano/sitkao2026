<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข่าวสาร & กิจกรรมศิษย์เก่า | SKJ Alumni News & Events</title>
    <link href="https://fonts.googleapis.com/css2?family=K2D:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style> body { font-family: 'K2D', sans-serif; } </style>
    <script src="<?= base_url('assets/js/floating-bubbles.js') ?>" defer></script>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col">

    <!-- Top Navbar -->
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
                    <a href="<?= base_url('jobs') ?>" class="px-3.5 py-2 text-sm font-semibold text-slate-600 hover:text-pink-600 rounded-xl hover:bg-pink-50/50 transition">ตำแหน่งงานว่าง</a>
                    <a href="<?= base_url('news') ?>" class="px-3.5 py-2 text-sm font-bold text-pink-600 rounded-xl bg-pink-50 transition">ข่าวสาร & กิจกรรม</a>
                    <?php if (session()->get('role') === 'admin'): ?>
                        <a href="<?= base_url('admin/dashboard') ?>" class="px-3.5 py-2 text-sm font-bold text-purple-600 rounded-xl bg-purple-50 hover:bg-purple-100 transition">★ ระบบผู้ดูแล</a>
                    <?php endif; ?>
                </nav>

                <div class="flex items-center gap-3">
                    <?php if (session()->get('isLoggedIn')): ?>
                        <a href="<?= base_url('alumni/my-profile') ?>" class="p-2 rounded-xl text-slate-600 hover:bg-slate-100 transition" title="โปรไฟล์ของฉัน">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </a>
                    <?php else: ?>
                        <a href="<?= base_url('login') ?>" class="text-xs sm:text-sm font-bold text-slate-700 hover:text-pink-600 px-3 py-2 rounded-xl transition">เข้าสู่ระบบ</a>
                        <a href="<?= base_url('register') ?>" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-gradient-to-r from-pink-600 to-rose-500 text-white text-xs sm:text-sm font-bold shadow-md shadow-pink-500/20 transition">ลงทะเบียน</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 w-full">

        <!-- Page Header & Banner -->
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-8">
            <div>
                <span class="inline-block px-3 py-1 rounded-full bg-pink-50 text-pink-700 text-xs font-bold mb-2">
                    📰 Alumni News & Activities
                </span>
                <h1 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">ข่าวสาร ประชาสัมพันธ์ & กิจกรรม</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">เกาะติดข่าวสารงานคืนสู่เหย้า, ความภาคภูมิใจศิษย์เก่าดีเด่น, และโครงการสนับสนุนจาก อบจ.นครสวรรค์</p>
            </div>

            <!-- Categories Tabs -->
            <div class="flex items-center gap-2 overflow-x-auto pb-2">
                <a href="<?= base_url('news') ?>" class="px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition <?= empty($category) ? 'bg-slate-900 text-white shadow-xs' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' ?>">
                    ทั้งหมด
                </a>
                <a href="<?= base_url('news?category=' . urlencode('กิจกรรมศิษย์เก่า')) ?>" class="px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition <?= ($category ?? '') === 'กิจกรรมศิษย์เก่า' ? 'bg-pink-600 text-white shadow-xs' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' ?>">
                    🎉 กิจกรรมศิษย์เก่า
                </a>
                <a href="<?= base_url('news?category=' . urlencode('ศิษย์เก่าดีเด่น')) ?>" class="px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition <?= ($category ?? '') === 'ศิษย์เก่าดีเด่น' ? 'bg-amber-600 text-white shadow-xs' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' ?>">
                    🏆 ศิษย์เก่าดีเด่น
                </a>
                <a href="<?= base_url('news?category=' . urlencode('ข่าวทั่วไป')) ?>" class="px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition <?= ($category ?? '') === 'ข่าวทั่วไป' ? 'bg-blue-600 text-white shadow-xs' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' ?>">
                    📢 ข่าวทั่วไป & อบจ.
                </a>
            </div>
        </div>

        <!-- Featured News Hero (If on page 1 and no category filter) -->
        <?php if ($featured && empty($category) && empty($search)): ?>
        <div class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-sm mb-10 group grid grid-cols-1 lg:grid-cols-12 hover:border-pink-300 transition-all">
            <div class="lg:col-span-7 h-64 sm:h-80 lg:h-full relative overflow-hidden bg-slate-900">
                <img src="<?= esc($featured['news_image'] ?: 'https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=800&auto=format&fit=crop') ?>" alt="<?= esc($featured['news_title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90">
                <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-bold bg-pink-600 text-white shadow-md">
                    ⭐ ข่าวเด่นแนะนำ
                </span>
            </div>
            <div class="lg:col-span-5 p-6 sm:p-10 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 text-xs text-slate-400 mb-3">
                        <span class="font-bold text-pink-600 bg-pink-50 px-2.5 py-1 rounded-lg border border-pink-100"><?= esc($featured['news_category']) ?></span>
                        <span><?= date('d M Y', strtotime($featured['news_date'] ?: ($featured['news_created_at'] ?? 'now'))) ?></span>
                    </div>
                    <a href="<?= base_url('news/' . $featured['news_id']) ?>" class="text-xl sm:text-2xl font-black text-slate-900 group-hover:text-pink-600 transition-colors line-clamp-3 mb-3 leading-snug">
                        <?= esc($featured['news_title']) ?>
                    </a>
                    <p class="text-xs sm:text-sm text-slate-600 line-clamp-3 leading-relaxed">
                        <?= esc($featured['news_content']) ?>
                    </p>
                </div>
                <div class="pt-6 border-t border-slate-100 mt-6 flex items-center justify-between">
                    <span class="text-xs text-slate-400">👁 <?= number_format($featured['news_views'] ?? 0) ?> ครั้ง</span>
                    <a href="<?= base_url('news/' . $featured['news_id']) ?>" class="inline-flex items-center gap-1 text-xs font-bold text-pink-600 hover:text-pink-700">
                        อ่านข่าวทั้งหมด →
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- News Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($newsList as $news): ?>
            <div class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-xs hover:shadow-md hover:border-pink-200 transition-all flex flex-col justify-between group">
                <div>
                    <div class="h-48 overflow-hidden bg-slate-100 relative">
                        <img src="<?= esc($news['news_image'] ?: 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?q=80&w=600&auto=format&fit=crop') ?>" alt="<?= esc($news['news_title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-slate-900/80 text-white backdrop-blur-xs">
                            <?= esc($news['news_category']) ?>
                        </span>
                    </div>
                    <div class="p-6">
                        <div class="text-[11px] text-slate-400 font-mono mb-2">
                            <?= date('d M Y', strtotime($news['news_date'] ?: ($news['news_created_at'] ?? 'now'))) ?>
                        </div>
                        <a href="<?= base_url('news/' . $news['news_id']) ?>" class="text-base font-bold text-slate-900 group-hover:text-pink-600 transition-colors line-clamp-2 mb-2 leading-snug block">
                            <?= esc($news['news_title']) ?>
                        </a>
                        <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed">
                            <?= esc($news['news_content']) ?>
                        </p>
                    </div>
                </div>

                <div class="px-6 pb-6 pt-3 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-[11px] text-slate-400">👁 <?= number_format($news['news_views'] ?? 0) ?> views</span>
                    <a href="<?= base_url('news/' . $news['news_id']) ?>" class="text-xs font-bold text-slate-700 group-hover:text-pink-600 inline-flex items-center gap-1">
                        อ่านต่อ <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200/80 py-6 text-xs text-slate-500">
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
