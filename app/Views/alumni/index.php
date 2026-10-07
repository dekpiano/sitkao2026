<!DOCTYPE html>
<html lang="th" class="h-full scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>ทำเนียบรุ่นศิษย์เก่า SKJ | สวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์ & จิรประวัติวิทยาคม</title>
    <meta name="description"
        content="ระบบทำเนียบรุ่นศิษย์เก่าออนไลน์ โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์ (สกจ.) และ โรงเรียนจิรประวัติวิทยาคม (จ.ว.)">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=K2D:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url('assets/js/floating-bubbles.js') ?>" defer></script>

    <style>
        body {
            font-family: 'K2D', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            -webkit-tap-highlight-color: transparent;
        }

        /* Glassmorphism Classes */
        .glass-nav {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .glass-hero {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.92) 0%, rgba(248, 250, 252, 0.85) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        /* Subtle mesh background */
        .bg-mesh-soft {
            background-color: #f8fafc;
            background-image:
                radial-gradient(at 0% 0%, rgba(236, 72, 153, 0.08) 0px, transparent 45%),
                radial-gradient(at 100% 0%, rgba(59, 130, 246, 0.08) 0px, transparent 45%),
                radial-gradient(at 50% 100%, rgba(244, 114, 182, 0.05) 0px, transparent 45%);
        }

        /* Custom Scrollbar for chips */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Batch card transition */
        .batch-card {
            transition: transform 0.25s cubic-bezier(0.2, 0, 0, 1), box-shadow 0.25s cubic-bezier(0.2, 0, 0, 1);
        }

        .batch-card:hover {
            transform: translateY(-4px);
        }
    </style>
</head>

<body
    class="min-h-full bg-mesh-soft text-slate-800 antialiased flex flex-col selection:bg-pink-500 selection:text-white pb-20 sm:pb-0">

    <?php
    $isLoggedIn = session()->get('isLoggedIn');
    $userName = session()->get('name');
    $userEmail = session()->get('email');
    $userId = session()->get('id');
    $userRole = session()->get('role');
    $isAdmin = in_array($userRole, ['admin', 'super_admin']);
    ?>

    <!-- ============================================== -->
    <!-- TOP NAVBAR (Sticky, Clean & Responsive)        -->
    <!-- ============================================== -->
    <header
        class="sticky top-0 z-40 w-full border-b border-slate-200/70 glass-nav transition-all duration-200 shadow-xs">
        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

            <!-- Brand Logo -->
            <a href="<?= base_url('/') ?>" class="flex items-center gap-2.5 sm:gap-3 group">
                <div
                    class="w-10 h-10 rounded-xl bg-gradient-to-br from-pink-500 via-rose-500 to-blue-600 flex items-center justify-center text-white font-black text-lg shadow-md shadow-pink-500/20 group-hover:scale-105 transition-transform">
                    SKJ
                </div>
                <div class="min-w-0">
                    <span class="block text-sm sm:text-base font-extrabold text-slate-900 leading-tight tracking-tight">
                        ทำเนียบรุ่นศิษย์เก่า SKJ
                    </span>
                    <span class="block text-[10px] sm:text-[11px] text-slate-500 font-medium truncate">
                        สวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์
                    </span>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden md:flex items-center gap-1 bg-slate-100/80 p-1 rounded-full border border-slate-200/60">
                <a href="<?= base_url('/#batches') ?>"
                    class="px-4 py-1.5 text-xs sm:text-sm font-bold text-pink-600 bg-white rounded-full shadow-xs transition">
                    🏛️ ทำเนียบรุ่น
                </a>
                <a href="<?= base_url('jobs') ?>"
                    class="px-4 py-1.5 text-xs sm:text-sm font-medium text-slate-600 hover:text-pink-600 hover:bg-white/70 rounded-full transition">
                    💼 ตำแหน่งงานว่าง
                </a>
                <a href="<?= base_url('news') ?>"
                    class="px-4 py-1.5 text-xs sm:text-sm font-medium text-slate-600 hover:text-pink-600 hover:bg-white/70 rounded-full transition">
                    📰 ข่าวสาร & กิจกรรม
                </a>
                <?php if ($isAdmin): ?>
                    <a href="<?= base_url('admin/dashboard') ?>"
                        class="px-4 py-1.5 text-xs sm:text-sm font-bold text-purple-700 bg-purple-50 hover:bg-purple-100 rounded-full border border-purple-200 transition">
                        ★ จัดการระบบ (Admin)
                    </a>
                <?php endif; ?>
            </nav>

            <!-- Desktop Action Buttons -->
            <div class="hidden sm:flex items-center gap-2">
                <?php if ($isLoggedIn): ?>
                    <a href="<?= base_url('alumni/profile/' . $userId) ?>"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
                        <span>👤</span>
                        <span class="max-w-[120px] truncate"><?= esc($userName ?? 'โปรไฟล์') ?></span>
                    </a>
                    <a href="<?= base_url('logout') ?>" onclick="confirmLogout(event, '<?= base_url('logout') ?>')"
                        class="w-9 h-9 rounded-full flex items-center justify-center text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition"
                        title="ออกจากระบบ">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </a>
                <?php else: ?>
                    <a href="<?= base_url('login') ?>"
                        class="inline-flex h-9 items-center justify-center rounded-full px-4 text-xs sm:text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">
                        เข้าสู่ระบบ
                    </a>
                    <a href="<?= base_url('register') ?>"
                        class="inline-flex h-9 items-center justify-center rounded-full bg-gradient-to-r from-pink-600 via-pink-500 to-blue-600 px-5 text-xs sm:text-sm font-bold text-white shadow-md shadow-pink-500/20 hover:opacity-95 transition active:scale-95">
                        ลงทะเบียนศิษย์เก่า
                    </a>
                <?php endif; ?>
            </div>

            <!-- Mobile Drawer Button -->
            <div class="flex items-center gap-2 md:hidden">
                <?php if ($isLoggedIn): ?>
                    <a href="<?= base_url('alumni/profile/' . $userId) ?>"
                        class="w-8 h-8 rounded-full bg-pink-50 text-pink-600 border border-pink-200 flex items-center justify-center text-xs font-bold shadow-xs">
                        👤
                    </a>
                <?php else: ?>
                    <a href="<?= base_url('login') ?>"
                        class="h-8 px-3 rounded-full bg-slate-100 text-slate-700 text-xs font-bold flex items-center justify-center">
                        เข้าสู่ระบบ
                    </a>
                <?php endif; ?>

                <button type="button" onclick="toggleMobileDrawer()"
                    class="w-9 h-9 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center transition active:scale-90"
                    aria-label="เปิดเมนู">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

        </div>
    </header>

    <!-- ============================================== -->
    <!-- MOBILE SLIDE-OUT DRAWER                        -->
    <!-- ============================================== -->
    <div id="mobileDrawer" class="fixed inset-0 z-50 hidden md:hidden" role="dialog" aria-modal="true">
        <div id="drawerBackdrop"
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity duration-300 opacity-0"
            onclick="toggleMobileDrawer()"></div>

        <div id="drawerPanel"
            class="fixed inset-y-0 right-0 w-[82vw] max-w-xs bg-white shadow-2xl p-6 flex flex-col justify-between transform translate-x-full transition-transform duration-300 ease-out z-10 border-l border-slate-100">
            <div>
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-2">
                        <div
                            class="w-8 h-8 rounded-lg bg-gradient-to-br from-pink-500 to-blue-500 flex items-center justify-center text-white font-bold text-xs shadow-xs">
                            SKJ</div>
                        <span class="text-sm font-bold text-slate-900">เมนูหลัก</span>
                    </div>
                    <button type="button" onclick="toggleMobileDrawer()"
                        class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center hover:bg-slate-200">✕</button>
                </div>

                <?php if ($isLoggedIn): ?>
                    <div class="my-4 p-3.5 rounded-2xl bg-gradient-to-br from-pink-50 to-blue-50 border border-pink-100/80">
                        <div class="text-xs text-slate-400">เข้าสู่ระบบในชื่อ</div>
                        <div class="text-sm font-bold text-slate-900 truncate"><?= esc($userName) ?></div>
                        <div class="text-[11px] text-slate-500 truncate"><?= esc($userEmail) ?></div>
                    </div>
                <?php endif; ?>

                <nav class="space-y-1 mt-4 text-sm font-medium">
                    <a href="<?= base_url('/#batches') ?>" onclick="toggleMobileDrawer()"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-pink-600 bg-pink-50/70 font-bold">
                        <span>🏛️</span><span>ทำเนียบรุ่นศิษย์เก่า</span>
                    </a>
                    <a href="<?= base_url('jobs') ?>" onclick="toggleMobileDrawer()"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-700 hover:bg-slate-50">
                        <span>💼</span><span>ตำแหน่งงานว่าง & อบจ.</span>
                    </a>
                    <a href="<?= base_url('news') ?>" onclick="toggleMobileDrawer()"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-700 hover:bg-slate-50">
                        <span>📰</span><span>ข่าวสาร & กิจกรรม</span>
                    </a>
                    <?php if ($isAdmin): ?>
                        <a href="<?= base_url('admin/dashboard') ?>" onclick="toggleMobileDrawer()"
                            class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-purple-700 bg-purple-50 font-bold">
                            <span>★</span><span>จัดการระบบ (Admin)</span>
                        </a>
                    <?php endif; ?>

                    <hr class="my-3 border-slate-100">

                    <?php if ($isLoggedIn): ?>
                        <a href="<?= base_url('alumni/profile/' . $userId) ?>" onclick="toggleMobileDrawer()"
                            class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-700 hover:bg-slate-50">
                            <span>👤</span><span>โปรไฟล์ของฉัน</span>
                        </a>
                        <a href="<?= base_url('alumni/edit-profile') ?>" onclick="toggleMobileDrawer()"
                            class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-700 hover:bg-slate-50">
                            <span>✏️</span><span>แก้ไขข้อมูลโปรไฟล์</span>
                        </a>
                    <?php else: ?>
                        <a href="<?= base_url('register') ?>" onclick="toggleMobileDrawer()"
                            class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-white bg-gradient-to-r from-pink-600 to-blue-600 font-bold shadow-xs">
                            <span>📝</span><span>ลงทะเบียนศิษย์เก่า</span>
                        </a>
                        <a href="<?= base_url('login') ?>" onclick="toggleMobileDrawer()"
                            class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-700 hover:bg-slate-50">
                            <span>🔑</span><span>เข้าสู่ระบบ</span>
                        </a>
                    <?php endif; ?>
                </nav>
            </div>

            <?php if ($isLoggedIn): ?>
                <div class="pt-4 border-t border-slate-100">
                    <a href="<?= base_url('logout') ?>" onclick="confirmLogout(event, '<?= base_url('logout') ?>')"
                        class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl text-xs font-bold text-rose-600 bg-rose-50 hover:bg-rose-100 transition">
                        <span>🚪</span> ออกจากระบบ
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- HERO SECTION (Modern, Clean & Interactive)    -->
    <!-- ============================================== -->
    <main class="flex-1">

        <section class="relative pt-8 pb-12 sm:pt-14 sm:pb-20 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

                <div class="max-w-3xl mx-auto text-center space-y-4 sm:space-y-6">

                    <!-- Era Badge Tags -->
                    <div
                        class="inline-flex items-center gap-1.5 p-1 px-3 rounded-full bg-white/90 border border-slate-200/80 shadow-xs text-xs font-semibold backdrop-blur-md">
                        <span class="flex h-2 w-2 relative">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pink-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-pink-500"></span>
                        </span>
                        <span class="text-slate-700">เครือข่ายศิษย์เก่า 2 ยุคสถาบัน</span>
                        <span class="text-slate-300">|</span>
                        <span class="text-pink-600 font-bold">🌸 สกจ.</span>
                        <span class="text-blue-600 font-bold">🏫 จ.ว.</span>
                    </div>

                    <!-- Main Catchy Title -->
                    <div class="space-y-1 sm:space-y-2">
                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-tight">
                            <span
                                class="block text-slate-900 font-extrabold text-2xl sm:text-4xl lg:text-5xl mb-1">ทำเนียบรุ่นศิษย์เก่า</span>
                            <span
                                class="inline-block text-transparent bg-clip-text bg-gradient-to-r from-pink-600 via-rose-500 to-blue-600">
                                สกจ. & จ.ว. นครสวรรค์
                            </span>
                        </h1>
                    </div>

                    <!-- Clean Subtitle -->
                    <p class="text-xs sm:text-base text-slate-600 max-w-xl mx-auto font-normal leading-relaxed">
                        ศูนย์รวมข้อมูลทำเนียบรุ่น ค้นหาเพื่อนศิษย์เก่า <strong
                            class="text-pink-700 font-semibold">สกจ.</strong> & <strong
                            class="text-blue-700 font-semibold">จ.ว.</strong> ติดตามข่าวสารและโอกาสงาน อบจ.นครสวรรค์
                    </p>

                    <!-- Quick Stats Counter Strip -->
                    <div class="grid grid-cols-3 gap-2.5 sm:gap-4 max-w-xl mx-auto pt-2 pb-2">
                        <div class="glass-card p-3 sm:p-4 rounded-2xl border border-slate-200/70 shadow-xs text-center">
                            <div class="text-xl sm:text-3xl font-extrabold text-slate-900 leading-none mb-1">
                                <?= number_format($total_alumni ?? 0) ?>
                            </div>
                            <div class="text-[10px] sm:text-xs font-bold text-slate-500">🌟 สมาชิกทั้งหมด</div>
                        </div>
                        <div
                            class="glass-card p-3 sm:p-4 rounded-2xl border border-pink-200/70 shadow-xs text-center bg-pink-50/30">
                            <div class="text-xl sm:text-3xl font-extrabold text-pink-600 leading-none mb-1">
                                <?= number_format($skj_count ?? 0) ?>
                            </div>
                            <div class="text-[10px] sm:text-xs font-bold text-pink-700">🌸 สกจ. (ปัจจุบัน)</div>
                        </div>
                        <div
                            class="glass-card p-3 sm:p-4 rounded-2xl border border-blue-200/70 shadow-xs text-center bg-blue-50/30">
                            <div class="text-xl sm:text-3xl font-extrabold text-blue-600 leading-none mb-1">
                                <?= number_format($jw_count ?? 0) ?>
                            </div>
                            <div class="text-[10px] sm:text-xs font-bold text-blue-700">🏫 จ.ว. (สถาบันเดิม)</div>
                        </div>
                    </div>

                    <!-- Hero Call to Action Buttons -->
                    <div class="flex items-center justify-center gap-3 pt-1 flex-wrap">
                        <?php if (!$isLoggedIn): ?>
                            <a href="<?= base_url('register') ?>"
                                class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-gradient-to-r from-pink-600 via-pink-500 to-blue-600 text-white font-bold text-xs sm:text-sm shadow-lg shadow-pink-500/25 hover:opacity-95 hover:scale-105 active:scale-95 transition-all">
                                <span>📝</span>
                                <span>ลงทะเบียนศิษย์เก่าใหม่</span>
                            </a>
                            <a href="<?= base_url('/#batches') ?>"
                                class="inline-flex items-center gap-1.5 px-5 py-3 rounded-full bg-white text-slate-700 font-bold text-xs sm:text-sm border border-slate-200 hover:bg-slate-50 shadow-xs transition active:scale-95">
                                <span>🔍</span>
                                <span>สำรวจทำเนียบรุ่น</span>
                            </a>
                        <?php else: ?>
                            <a href="<?= base_url('alumni/edit-profile') ?>"
                                class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-gradient-to-r from-pink-600 via-pink-500 to-blue-600 text-white font-bold text-xs sm:text-sm shadow-lg shadow-pink-500/25 hover:opacity-95 hover:scale-105 active:scale-95 transition-all">
                                <span>✏️</span>
                                <span>แก้ไขข้อมูลโปรไฟล์ของฉัน</span>
                            </a>
                            <a href="<?= base_url('alumni/profile/' . $userId) ?>"
                                class="inline-flex items-center gap-1.5 px-5 py-3 rounded-full bg-white text-slate-700 font-bold text-xs sm:text-sm border border-slate-200 hover:bg-slate-50 shadow-xs transition active:scale-95">
                                <span>👤</span>
                                <span>ดูโปรไฟล์สาธารณะ</span>
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- ============================================== -->
                    <!-- LIVE REAL-TIME SEARCH & FILTER BAR             -->
                    <!-- ============================================== -->
                    <div class="mt-6 sm:mt-8 w-full max-w-2xl mx-auto text-left">

                        <!-- Search Box Input -->
                        <div class="relative group">
                            <div
                                class="absolute -inset-1 bg-gradient-to-r from-pink-500 via-purple-500 to-blue-500 rounded-2xl blur-md opacity-25 group-hover:opacity-40 transition duration-300">
                            </div>

                            <div
                                class="relative flex items-center bg-white rounded-2xl p-2 sm:p-2.5 shadow-xl border border-slate-200/80">
                                <div
                                    class="w-10 h-10 rounded-xl bg-gradient-to-br from-pink-500 to-blue-600 flex items-center justify-center text-white shrink-0 shadow-xs">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <path d="m21 21-4.3-4.3" stroke-width="2.5" stroke-linecap="round"></path>
                                    </svg>
                                </div>
                                <input type="text" id="searchBatchInput"
                                    placeholder="พิมพ์ค้นหา เช่น รุ่นที่ 15, ม.6 หรือ ปี พ.ศ. 2565..."
                                    class="flex-1 bg-transparent px-3 text-slate-900 placeholder:text-slate-400 focus:outline-none text-xs sm:text-base font-medium">

                                <button type="button" id="clearSearchBtn" onclick="clearSearch()"
                                    class="hidden p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition mr-1 cursor-pointer"
                                    title="ล้างคำค้นหา">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- School Filter Toggle Chips -->
                        <div
                            class="flex items-center gap-1.5 sm:gap-2 mt-3 overflow-x-auto pb-1 no-scrollbar text-xs font-semibold">
                            <span class="text-slate-400 text-[11px] shrink-0 mr-0.5">ตัวกรอง:</span>

                            <button type="button" onclick="filterBySchool('all')" data-filter="all"
                                class="school-filter-chip shrink-0 px-3.5 py-1.5 rounded-full bg-slate-900 text-white shadow-xs transition active:scale-95 cursor-pointer">
                                🌟 ทั้งหมด (<?= $total_alumni ?? 0 ?>)
                            </button>

                            <button type="button" onclick="filterBySchool('skj')" data-filter="skj"
                                class="school-filter-chip shrink-0 px-3.5 py-1.5 rounded-full bg-white text-slate-600 border border-slate-200 hover:border-pink-300 hover:text-pink-600 transition active:scale-95 cursor-pointer">
                                🌸 สกจ. สวนกุหลาบฯ (<?= $skj_count ?? 0 ?>)
                            </button>

                            <button type="button" onclick="filterBySchool('jw')" data-filter="jw"
                                class="school-filter-chip shrink-0 px-3.5 py-1.5 rounded-full bg-white text-slate-600 border border-slate-200 hover:border-blue-300 hover:text-blue-600 transition active:scale-95 cursor-pointer">
                                🏫 จ.ว. จิรประวัติฯ (<?= $jw_count ?? 0 ?>)
                            </button>
                        </div>

                    </div>

                </div>

            </div>
        </section>

        <!-- ============================================== -->
        <!-- QUICK FEATURE BENTO CARDS (Jobs & News)        -->
        <!-- ============================================== -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">

                <!-- Card 1: Job Opportunities with PAO Nakhon Sawan -->
                <div
                    class="glass-card rounded-3xl p-5 sm:p-6 border border-amber-200/80 shadow-xs relative overflow-hidden bg-gradient-to-br from-amber-50/40 via-white to-pink-50/20 group hover:shadow-md transition">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 rounded-2xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-md shadow-amber-500/20 text-xl group-hover:scale-105 transition-transform">
                            💼
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <span
                                    class="px-2.5 py-0.5 rounded-md bg-amber-500 text-white text-[10px] font-black uppercase tracking-wider">โอกาสงาน
                                    อบจ.</span>
                                <span class="text-xs font-bold text-amber-900">ฐานข้อมูลเพื่อการบรรจุงาน</span>
                            </div>
                            <h3 class="text-base sm:text-lg font-extrabold text-slate-900 leading-snug">
                                กระดานรับสมัครงาน & โอกาสทางอาชีพ
                            </h3>
                            <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                ร่วมสร้างอนาคตร่วมกับ อบจ.นครสวรรค์ และเครือข่ายศิษย์เก่า
                                มีตำแหน่งงานและโครงการรองรับต่อเนื่อง
                            </p>
                            <div class="mt-3.5">
                                <a href="<?= base_url('jobs') ?>"
                                    class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-700 hover:text-amber-800 hover:underline">
                                    <span>สำรวจตำแหน่งงานว่างทั้งหมด</span>
                                    <span>→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: News & Alumni Events -->
                <div
                    class="glass-card rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-xs relative overflow-hidden bg-gradient-to-br from-blue-50/30 via-white to-purple-50/20 group hover:shadow-md transition">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 rounded-2xl bg-gradient-to-br from-pink-500 to-blue-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-blue-500/20 text-xl group-hover:scale-105 transition-transform">
                            📰
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <span
                                    class="px-2.5 py-0.5 rounded-md bg-pink-600 text-white text-[10px] font-black uppercase tracking-wider">ข่าวสารล่าสุด</span>
                                <span class="text-xs font-bold text-slate-700">กิจกรรมโรงเรียน & ศิษย์เก่า</span>
                            </div>
                            <h3 class="text-base sm:text-lg font-extrabold text-slate-900 leading-snug">
                                ประชาสัมพันธ์กิจกรรม & งานคืนสู่เหย้า
                            </h3>
                            <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                ติดตามข่าวสารงานสมาคม การจัดงานเลี้ยงรุ่น และกิจกรรมสาธารณประโยชน์เพื่อรุ่นน้อง
                            </p>
                            <div class="mt-3.5">
                                <a href="<?= base_url('news') ?>"
                                    class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-700 hover:text-blue-800 hover:underline">
                                    <span>อ่านข่าวสารและกิจกรรมทั้งหมด</span>
                                    <span>→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ============================================== -->
        <!-- BATCH CARDS GRID SECTION                       -->
        <!-- ============================================== -->
        <section id="batches" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">

            <div
                class="flex flex-col sm:flex-row sm:items-end justify-between gap-3 mb-6 pb-4 border-b border-slate-200/80">
                <div>
                    <h2
                        class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                        <span
                            class="w-2.5 h-6 bg-gradient-to-b from-pink-500 to-blue-600 rounded-full inline-block"></span>
                        <span>ทำเนียบรุ่นศิษย์เก่าทั้งหมด</span>
                    </h2>
                    <p class="text-xs text-slate-500 mt-1">
                        คลิกเลือกรุ่นที่ต้องการเพื่อดูรายชื่อเพื่อนร่วมรุ่นและช่องทางติดต่อ
                    </p>
                </div>

                <div class="text-xs text-slate-500 font-medium">
                    แสดง <span id="batchCountBadge" class="font-bold text-pink-600"><?= count($batches ?? []) ?></span>
                    รุ่น
                </div>
            </div>

            <!-- Batch Grid Container -->
            <div id="batchGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
                <?php if (!empty($batches)): ?>
                    <?php foreach ($batches as $batch): ?>
                        <?php
                        $isJW = $batch['is_jw'] ?? false;
                        $schoolName = $batch['school'] ?? ($isJW ? 'โรงเรียนจิรประวัติวิทยาคม' : 'โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์');
                        $batchCategory = $isJW ? 'jw' : 'skj';
                        $gradYear = !empty($batch['grad_year']) ? 'พ.ศ. ' . $batch['grad_year'] : '';
                        $batchSlug = !empty($batch['slug']) ? $batch['slug'] : (!empty($batch['grad_year']) ? $batch['grad_year'] : $batch['batch_name']);
                        $rawBatchesList = !empty($batch['raw_batches']) ? implode(', ', $batch['raw_batches']) : '';
                        $searchKeywords = strtolower($batch['batch_name'] . ' ' . $schoolName . ' ' . $gradYear . ' ' . $rawBatchesList);
                        ?>

                        <div class="batch-card glass-card rounded-3xl p-5 border border-slate-200/80 shadow-xs flex flex-col justify-between hover:border-pink-300 transition-all"
                            data-school="<?= $batchCategory ?>"
                            data-name="<?= esc($searchKeywords) ?>">

                            <div>
                                <!-- Era Badges -->
                                <div class="flex items-center justify-between gap-2 mb-3">
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-black <?= $isJW ? 'bg-blue-100 text-blue-800 border border-blue-200' : 'bg-pink-100 text-pink-800 border border-pink-200' ?>">
                                        <span><?= $isJW ? '🏫 จ.ว.' : '🌸 สกจ.' ?></span>
                                    </span>

                                    <?php if (!empty($batch['grad_year'])): ?>
                                        <span class="text-[11px] font-bold text-pink-700 bg-pink-50 border border-pink-100 px-2.5 py-0.5 rounded-full">
                                            ปี <?= esc($gradYear) ?>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <!-- Batch Name -->
                                <h3 class="text-lg font-bold text-slate-900 tracking-tight leading-snug mb-1">
                                    <?= esc($batch['batch_name']) ?>
                                </h3>

                                <?php if (!empty($batch['raw_batches'])): ?>
                                    <p class="text-[11px] font-medium text-pink-600 line-clamp-1 mb-1" title="<?= esc($rawBatchesList) ?>">
                                        🏷️ <?= esc(implode(' • ', array_slice($batch['raw_batches'], 0, 3))) ?><?= count($batch['raw_batches']) > 3 ? '...' : '' ?>
                                    </p>
                                <?php endif; ?>

                                <p class="text-xs text-slate-500 line-clamp-1 mb-4">
                                    <?= esc($schoolName) ?>
                                </p>

                                <!-- Member Avatar Stack & Count -->
                                <div class="flex items-center justify-between pt-3 border-t border-slate-100 mb-4">
                                    <div class="flex -space-x-2 overflow-hidden">
                                        <?php if (!empty($batch['preview_images'])): ?>
                                            <?php foreach ($batch['preview_images'] as $img): ?>
                                                <img class="inline-block h-7 w-7 rounded-full ring-2 ring-white object-cover shadow-xs"
                                                    src="<?= esc($img) ?>" alt="Alumni">
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <div
                                                class="w-7 h-7 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center text-xs">
                                                👤</div>
                                        <?php endif; ?>
                                    </div>

                                    <span class="text-xs font-bold text-slate-700 bg-slate-100 px-2.5 py-0.5 rounded-full">
                                        <?= number_format($batch['total_count']) ?> ท่าน
                                    </span>
                                </div>
                            </div>

                            <!-- Single Tap Enter Button -->
                            <a href="<?= base_url('alumni/batch/' . urlencode($batchSlug)) ?>"
                                class="w-full inline-flex justify-center items-center gap-1.5 py-2.5 rounded-xl text-xs font-bold text-slate-700 bg-slate-50 hover:bg-gradient-to-r hover:from-pink-600 hover:to-blue-600 hover:text-white transition-all shadow-xs active:scale-95">
                                <span>เข้าสู่ห้องรุ่น</span>
                                <span>→</span>
                            </a>

                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-slate-200">
                        <p class="text-slate-500 text-sm">ยังไม่มีข้อมูลรุ่นศิษย์เก่าในระบบ</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Empty Search State -->
            <div id="noResultsState"
                class="hidden py-16 text-center bg-white rounded-3xl border border-dashed border-slate-300 mt-4">
                <div class="text-3xl mb-2">🔍</div>
                <h4 class="text-base font-bold text-slate-800">ไม่พบข้อมูลรุ่นที่ตรงกับคำค้นหา</h4>
                <p class="text-xs text-slate-500 mt-1">ลองเปลี่ยนคำค้นหา หรือคลิกดูรุ่นทั้งหมด</p>
                <button type="button" onclick="clearSearch()"
                    class="mt-4 px-4 py-2 rounded-full bg-slate-100 text-xs font-bold text-slate-700 hover:bg-slate-200 transition">
                    ล้างการค้นหา
                </button>
            </div>

        </section>

    </main>

    <!-- ============================================== -->
    <!-- MOBILE BOTTOM APP DOCK (For Smartphone UX)    -->
    <!-- ============================================== -->
    <nav
        class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-xl border-t border-slate-200/80 px-2 py-1.5 shadow-[0_-4px_25px_rgba(0,0,0,0.08)] flex justify-around items-center">
        <a href="<?= base_url('/') ?>"
            class="flex flex-col items-center justify-center py-1 px-3 text-pink-600 text-center">
            <span class="text-base">🏛️</span>
            <span class="text-[10px] font-bold mt-0.5">หน้าหลัก</span>
        </a>

        <button type="button" onclick="focusSearchInput()"
            class="flex flex-col items-center justify-center py-1 px-3 text-slate-500 hover:text-pink-600 text-center cursor-pointer">
            <span class="text-base">🔍</span>
            <span class="text-[10px] font-medium mt-0.5">ค้นหารุ่น</span>
        </button>

        <a href="<?= base_url('jobs') ?>"
            class="flex flex-col items-center justify-center py-1 px-3 text-slate-500 hover:text-pink-600 text-center">
            <span class="text-base">💼</span>
            <span class="text-[10px] font-medium mt-0.5">งาน อบจ.</span>
        </a>

        <?php if ($isLoggedIn): ?>
            <a href="<?= base_url('alumni/profile/' . $userId) ?>"
                class="flex flex-col items-center justify-center py-1 px-3 text-slate-500 hover:text-pink-600 text-center">
                <span class="text-base">👤</span>
                <span class="text-[10px] font-medium mt-0.5">โปรไฟล์</span>
            </a>
        <?php else: ?>
            <a href="<?= base_url('login') ?>"
                class="flex flex-col items-center justify-center py-1 px-3 text-slate-500 hover:text-pink-600 text-center">
                <span class="text-base">🔑</span>
                <span class="text-[10px] font-medium mt-0.5">เข้าสู่ระบบ</span>
            </a>
        <?php endif; ?>
    </nav>

    <!-- ============================================== -->
    <!-- FOOTER                                         -->
    <!-- ============================================== -->
    <footer class="bg-slate-900 text-slate-400 pt-12 pb-24 sm:pb-10 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">

            <div class="inline-flex items-center gap-2">
                <div
                    class="w-8 h-8 rounded-lg bg-gradient-to-br from-pink-500 to-blue-600 flex items-center justify-center text-white font-bold text-xs">
                    SKJ
                </div>
                <span class="text-base font-bold text-white">ทำเนียบรุ่นศิษย์เก่า SKJ</span>
            </div>

            <p class="text-xs max-w-md mx-auto leading-relaxed text-slate-400">
                โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์ & โรงเรียนจิรประวัติวิทยาคม <br>
                สนับสนุนโดย องค์การบริหารส่วนจังหวัดนครสวรรค์ (อบจ.นครสวรรค์)
            </p>

            <div class="flex items-center justify-center gap-4 text-xs">
                <a href="<?= base_url('jobs') ?>" class="hover:text-white transition">ตำแหน่งงานว่าง</a>
                <span>•</span>
                <a href="<?= base_url('news') ?>" class="hover:text-white transition">ข่าวสาร & กิจกรรม</a>
                <span>•</span>
                <a href="<?= base_url('admin') ?>" class="hover:text-pink-400 transition">เข้าสู่ระบบผู้ดูแล (Admin)</a>
            </div>

            <div class="border-t border-slate-800 pt-6 text-[11px] text-slate-500">
                © 2026 SKJ Alumni Network. All rights reserved.
            </div>

        </div>
    </footer>

    <!-- ============================================== -->
    <!-- INTERACTIVE JAVASCRIPT LOGIC                   -->
    <!-- ============================================== -->
    <script>
        let currentFilter = 'all';

        // Toggle mobile slide-out drawer
        function toggleMobileDrawer() {
            const drawer = document.getElementById('mobileDrawer');
            const backdrop = document.getElementById('drawerBackdrop');
            const panel = document.getElementById('drawerPanel');

            if (drawer.classList.contains('hidden')) {
                drawer.classList.remove('hidden');
                setTimeout(() => {
                    backdrop.classList.remove('opacity-0');
                    backdrop.classList.add('opacity-100');
                    panel.classList.remove('translate-x-full');
                    panel.classList.add('translate-x-0');
                }, 10);
            } else {
                backdrop.classList.remove('opacity-100');
                backdrop.classList.add('opacity-0');
                panel.classList.remove('translate-x-0');
                panel.classList.add('translate-x-full');
                setTimeout(() => {
                    drawer.classList.add('hidden');
                }, 300);
            }
        }

        // Focus search input from mobile dock
        function focusSearchInput() {
            const input = document.getElementById('searchBatchInput');
            if (input) {
                input.focus();
                input.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }

        // Live Real-Time Batch Filter
        function performSearch() {
            const query = (document.getElementById('searchBatchInput').value || '').trim().toLowerCase();
            const clearBtn = document.getElementById('clearSearchBtn');
            const cards = document.querySelectorAll('.batch-card');
            let visibleCount = 0;

            if (query.length > 0) {
                clearBtn.classList.remove('hidden');
            } else {
                clearBtn.classList.add('hidden');
            }

            cards.forEach(card => {
                const school = card.getAttribute('data-school');
                const cardName = card.getAttribute('data-name') || '';

                const matchesFilter = (currentFilter === 'all' || school === currentFilter);
                const matchesQuery = (query === '' || cardName.includes(query));

                if (matchesFilter && matchesQuery) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            // Update visible badge & empty state
            const badge = document.getElementById('batchCountBadge');
            if (badge) badge.textContent = visibleCount;

            const noResults = document.getElementById('noResultsState');
            if (noResults) {
                if (visibleCount === 0) {
                    noResults.classList.remove('hidden');
                } else {
                    noResults.classList.add('hidden');
                }
            }
        }

        // Filter by school category (all / skj / jw)
        function filterBySchool(category) {
            currentFilter = category;

            document.querySelectorAll('.school-filter-chip').forEach(btn => {
                const filter = btn.getAttribute('data-filter');
                if (filter === category) {
                    btn.className = 'school-filter-chip shrink-0 px-3.5 py-1.5 rounded-full bg-slate-900 text-white shadow-xs transition active:scale-95 cursor-pointer font-bold';
                } else {
                    btn.className = 'school-filter-chip shrink-0 px-3.5 py-1.5 rounded-full bg-white text-slate-600 border border-slate-200 hover:border-slate-300 transition active:scale-95 cursor-pointer font-semibold';
                }
            });

            performSearch();
        }

        function clearSearch() {
            const input = document.getElementById('searchBatchInput');
            if (input) {
                input.value = '';
                performSearch();
                input.focus();
            }
        }

        // Event Listeners
        document.getElementById('searchBatchInput')?.addEventListener('input', performSearch);

        // SweetAlert Confirm Logout
        function confirmLogout(event, logoutUrl) {
            event.preventDefault();
            Swal.fire({
                title: 'ยืนยันออกจากระบบ?',
                text: 'คุณต้องการออกจากระบบศิษย์เก่า SKJ ใช่หรือไม่',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'ออกจากระบบ',
                cancelButtonText: 'ยกเลิก',
                customClass: {
                    popup: 'rounded-3xl p-6',
                    confirmButton: 'rounded-xl px-5 py-2.5 font-bold',
                    cancelButton: 'rounded-xl px-5 py-2.5 font-bold'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = logoutUrl;
                }
            });
        }
    </script>
</body>

</html>