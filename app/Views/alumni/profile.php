<!DOCTYPE html>
<html lang="th" class="h-full bg-slate-50/60">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรไฟล์ศิษย์เก่า | <?= esc($alumni['alm_name'] ?? 'ศิษย์เก่า') ?> - SKJ Alumni</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=K2D:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'K2D', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        .bg-mesh-pattern {
            background-color: #f8fafc;
            background-image: radial-gradient(at 0% 0%, rgba(236, 72, 153, 0.08) 0px, transparent 50%),
                              radial-gradient(at 100% 0%, rgba(59, 130, 246, 0.08) 0px, transparent 50%),
                              radial-gradient(at 50% 100%, rgba(244, 114, 182, 0.05) 0px, transparent 50%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .badge-pulse {
            position: relative;
        }
        .badge-pulse::after {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: inherit;
            background: inherit;
            opacity: 0.4;
            animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            z-index: -1;
        }
        @keyframes pulse-ring {
            0% { transform: scale(0.95); opacity: 0.5; }
            50% { transform: scale(1.15); opacity: 0; }
            100% { transform: scale(0.95); opacity: 0; }
        }
    </style>
    <script src="<?= base_url('assets/js/floating-bubbles.js') ?>" defer></script>
</head>

<body class="min-h-full bg-mesh-pattern text-slate-800 antialiased flex flex-col selection:bg-pink-500 selection:text-white">

    <?php
        $isLoggedIn = session()->get('isLoggedIn');
        $currentUserId = session()->get('id');
        $currentUserRole = session()->get('role');
        $isOwner = ($isLoggedIn && $currentUserId == $alumni['alm_id']);
        $isAdmin = ($isLoggedIn && in_array($currentUserRole, ['admin', 'super_admin']));
        $isOwnerOrAdmin = ($isOwner || $isAdmin);

        // Privacy permissions
        // 1 or 'public' = public, 0 or 'private' = private
        $isPhonePublic = !isset($alumni['alm_privacy_phone']) || ($alumni['alm_privacy_phone'] != 0 && $alumni['alm_privacy_phone'] !== '0' && $alumni['alm_privacy_phone'] !== 'private');
        $showPhone = $isOwnerOrAdmin || $isPhonePublic;

        $isEmailPublic = !isset($alumni['alm_privacy_email']) || ($alumni['alm_privacy_email'] != 0 && $alumni['alm_privacy_email'] !== '0' && $alumni['alm_privacy_email'] !== 'private');
        $showEmail = $isOwnerOrAdmin || $isEmailPublic;

        $isAddressPublic = isset($alumni['alm_privacy_address']) && ($alumni['alm_privacy_address'] == 1 || $alumni['alm_privacy_address'] === '1' || $alumni['alm_privacy_address'] === 'public');
        $showAddress = $isOwnerOrAdmin || $isAddressPublic;

        // School era identity
        $schoolName = $alumni['alm_school'] ?? 'โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์';
        $isJW = (strpos($schoolName, 'จิรประวัติวิทยาคม') !== false);
        $schoolShort = $isJW ? 'จ.ว.' : 'สกจ.';
        $schoolTag = $isJW ? 'จิรประวัติวิทยาคม' : 'สวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์';

        // Avatar fallback
        $avatarUrl = !empty($alumni['alm_image']) ? $alumni['alm_image'] : 'https://ui-avatars.com/api/?name=' . urlencode($alumni['alm_name'] ?? 'Alumni') . '&background=f472b6&color=fff&size=200';
    ?>

    <!-- Top Navigation Bar -->
    <header class="sticky top-0 z-40 w-full border-b border-slate-200/70 bg-white/80 backdrop-blur-md">
        <div class="mx-auto flex h-16 max-w-5xl items-center justify-between px-4 sm:px-6">
            
            <!-- Brand & Breadcrumb -->
            <div class="flex items-center gap-3">
                <a href="<?= base_url('/') ?>" class="flex items-center gap-2 group">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-pink-500 to-blue-500 flex items-center justify-center text-white font-black text-xs shadow-xs group-hover:scale-105 transition">
                        SKJ
                    </div>
                    <div class="hidden sm:block">
                        <span class="block text-xs font-bold text-slate-800 leading-none">ทำเนียบรุ่นศิษย์เก่า</span>
                        <span class="text-[10px] text-slate-400">SKJ Alumni</span>
                    </div>
                </a>

                <span class="text-slate-300 hidden sm:inline">/</span>

                <?php 
                    $batchLinkTarget = !empty($alumni['alm_grad_year']) ? base_url('alumni/batch/' . urlencode($alumni['alm_grad_year'])) : (!empty($alumni['alm_batch']) ? base_url('alumni/batch/' . urlencode($alumni['alm_batch'])) : base_url('/#batches'));
                    $batchDisplayTitle = !empty($alumni['alm_grad_year']) ? 'รุ่นปี พ.ศ. ' . esc($alumni['alm_grad_year']) : (!empty($alumni['alm_batch']) ? esc($alumni['alm_batch']) : 'ทำเนียบรุ่น');
                ?>
                <a href="<?= $batchLinkTarget ?>" 
                   class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-600 hover:text-pink-600 transition truncate max-w-[200px] sm:max-w-xs">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span><?= $batchDisplayTitle ?></span>
                </a>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-2">
                <!-- Share / Copy Link Button -->
                <button type="button" onclick="copyProfileLink()" 
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 hover:text-slate-900 transition cursor-pointer"
                        title="แชร์ลิงก์โปรไฟล์นี้">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                    <span class="hidden sm:inline">แชร์โปรไฟล์</span>
                </button>

                <?php if ($isOwner): ?>
                    <a href="<?= base_url('alumni/edit-profile') ?>" 
                       class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-bold text-white bg-gradient-to-r from-pink-600 via-pink-500 to-blue-600 hover:opacity-95 shadow-sm shadow-pink-500/20 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span>แก้ไขโปรไฟล์</span>
                    </a>
                <?php endif; ?>
            </div>

        </div>
    </header>

    <!-- Main Container -->
    <main class="flex-1 max-w-5xl w-full mx-auto px-4 sm:px-6 py-6 sm:py-8 space-y-6">

        <!-- ============================================== -->
        <!-- HERO PROFILE CARD (Minimal Clean Header)       -->
        <!-- ============================================== -->
        <div class="glass-card rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden relative">
            
            <!-- Modern Minimal Cover Banner -->
            <div class="h-36 sm:h-44 w-full relative overflow-hidden bg-gradient-to-r from-slate-900 via-slate-800 to-indigo-950">
                <!-- Subtle decorative shapes -->
                <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-pink-500/20 blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-blue-500/20 blur-3xl pointer-events-none"></div>
                
                <!-- School Watermark Tag -->
                <div class="absolute top-4 right-4 sm:top-5 sm:right-6 flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold text-white/90 bg-white/10 backdrop-blur-md border border-white/15">
                        <span><?= $isJW ? '🏫 ศิษย์เก่า จ.ว.' : '🌸 ศิษย์เก่า สกจ.' ?></span>
                    </span>
                </div>
            </div>

            <!-- Profile Info Body -->
            <div class="px-6 pb-6 sm:px-8 sm:pb-8 relative">
                
                <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 -mt-16 sm:-mt-20 mb-6">
                    
                    <!-- Avatar with Sleek Border & Badge -->
                    <div class="relative group">
                        <div class="w-28 h-28 sm:w-36 sm:h-36 rounded-2xl p-1 bg-white shadow-xl shadow-slate-900/10 border border-slate-100 relative">
                            <img src="<?= esc($avatarUrl) ?>" 
                                 alt="<?= esc($alumni['alm_name'] ?? 'ศิษย์เก่า') ?>" 
                                 class="w-full h-full rounded-xl object-cover bg-slate-100">
                            
                            <!-- School Badge on Avatar corner -->
                            <span class="absolute -bottom-2 -right-2 px-2.5 py-0.5 rounded-full text-[10px] font-black shadow-md text-white <?= $isJW ? 'bg-gradient-to-r from-blue-600 to-indigo-700' : 'bg-gradient-to-r from-pink-500 to-rose-500' ?>">
                                <?= esc($schoolShort) ?>
                            </span>
                        </div>
                    </div>

                    <!-- Quick Action Chips (Top Right on Desktop) -->
                    <div class="flex items-center gap-2 flex-wrap sm:mb-2">
                        <?php if ($isOwner): ?>
                            <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200/80 px-3 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                <span>โปรไฟล์ของคุณ</span>
                            </span>
                        <?php endif; ?>

                        <?php if ($isAdmin && !$isOwner): ?>
                            <span class="inline-flex items-center gap-1 text-xs font-bold text-purple-700 bg-purple-50 border border-purple-200 px-3 py-1 rounded-full">
                                <span>★ โหมดผู้ดูแลระบบ</span>
                            </span>
                        <?php endif; ?>
                    </div>

                </div>

                <!-- Name & Professional Headline -->
                <div class="space-y-3">
                    <div>
                        <div class="flex items-center gap-2.5 flex-wrap">
                            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                                <?= esc($alumni['alm_name'] ?? 'ไม่ระบุชื่อ') ?>
                            </h1>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-bold bg-slate-100 text-slate-600 border border-slate-200/70">
                                ศิษย์เก่า SKJ
                            </span>
                        </div>
                        
                        <p class="text-base sm:text-lg font-medium text-slate-600 mt-1">
                            <?= esc($alumni['alm_job_title'] ?? 'ศิษย์เก่า') ?>
                        </p>
                    </div>

                    <!-- Minimalist Meta Tags -->
                    <div class="flex items-center gap-2 flex-wrap pt-1">
                        
                        <!-- School Pill -->
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-semibold <?= $isJW ? 'bg-blue-50 text-blue-800 border border-blue-200/80' : 'bg-pink-50 text-pink-800 border border-pink-200/80' ?>">
                            <span><?= $isJW ? '🏫' : '🌸' ?></span>
                            <span><?= esc($schoolTag) ?></span>
                        </div>

                        <!-- School Grad Level Pill -->
                        <?php if (!empty($alumni['alm_school_grad_level'])): ?>
                            <div class="inline-flex items-center gap-1 px-3 py-1 rounded-xl text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200/80">
                                <span>🎓 จบ</span>
                                <span><?= esc($alumni['alm_school_grad_level']) ?></span>
                            </div>
                        <?php endif; ?>

                        <!-- Batch Pill -->
                        <?php if (!empty($alumni['alm_batch'])): ?>
                            <div class="inline-flex items-center gap-1 px-3 py-1 rounded-xl text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                <span class="text-slate-400">รุ่น:</span>
                                <span><?= esc($alumni['alm_batch']) ?></span>
                            </div>
                        <?php endif; ?>

                        <!-- Graduation Year Pill -->
                        <?php if (!empty($alumni['alm_grad_year'])): ?>
                            <div class="inline-flex items-center gap-1 px-3 py-1 rounded-xl text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100">
                                <span class="text-indigo-400">ปีที่จบ:</span>
                                <span>พ.ศ. <?= esc($alumni['alm_grad_year']) ?></span>
                            </div>
                        <?php endif; ?>

                        <!-- Status Pill -->
                        <?php if (!empty($alumni['alm_current_status'])): ?>
                            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <span><?= esc($alumni['alm_current_status']) ?></span>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

            </div>
        </div>

        <!-- ============================================== -->
        <!-- TWO-COLUMN CONTENT GRID                         -->
        <!-- ============================================== -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            
            <!-- LEFT COLUMN: QUICK INFO & CONTACT (1 Col) -->
            <div class="space-y-6 lg:col-span-1">
                
                <!-- Contact Channels Card -->
                <div class="glass-card rounded-2xl border border-slate-200/80 p-5 shadow-xs space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>ช่องทางการติดต่อ</span>
                        </h2>
                    </div>

                    <ul class="space-y-2.5 text-xs sm:text-sm">
                        
                        <!-- Email -->
                        <?php if (!empty($alumni['alm_email'])): ?>
                            <li class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between gap-2 group hover:bg-slate-100/70 transition">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <div class="w-8 h-8 rounded-lg bg-pink-100 text-pink-600 flex items-center justify-center shrink-0">
                                        ✉️
                                    </div>
                                    <div class="min-w-0">
                                        <span class="text-[10px] text-slate-400 block font-medium">อีเมล</span>
                                        <?php if ($showEmail): ?>
                                            <a href="mailto:<?= esc($alumni['alm_email']) ?>" class="font-bold text-slate-800 hover:text-pink-600 truncate block transition" title="<?= esc($alumni['alm_email']) ?>">
                                                <?= esc($alumni['alm_email']) ?>
                                            </a>
                                        <?php else: ?>
                                            <span class="text-slate-400 italic text-[11px] block">🔒 ซ่อนตามการตั้งค่าส่วนตัว</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if ($showEmail): ?>
                                    <button type="button" onclick="copyText('<?= esc($alumni['alm_email']) ?>', 'คัดลอกอีเมลเรียบร้อยแล้ว')" 
                                            class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-white transition cursor-pointer" title="คัดลอกอีเมล">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    </button>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>

                        <!-- Phone -->
                        <?php if (!empty($alumni['alm_phone'])): ?>
                            <li class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between gap-2 group hover:bg-slate-100/70 transition">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                                        📞
                                    </div>
                                    <div class="min-w-0">
                                        <span class="text-[10px] text-slate-400 block font-medium">เบอร์โทรศัพท์</span>
                                        <?php if ($showPhone): ?>
                                            <a href="tel:<?= esc(preg_replace('/[^0-9+]/', '', $alumni['alm_phone'])) ?>" class="font-bold text-slate-800 hover:text-blue-600 truncate block transition">
                                                <?= esc($alumni['alm_phone']) ?>
                                            </a>
                                        <?php else: ?>
                                            <span class="text-slate-400 italic text-[11px] block">🔒 ซ่อนตามการตั้งค่าส่วนตัว</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if ($showPhone): ?>
                                    <a href="tel:<?= esc(preg_replace('/[^0-9+]/', '', $alumni['alm_phone'])) ?>" 
                                       class="p-1.5 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition" title="โทรออก">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    </a>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>

                        <!-- Line / Social -->
                        <?php if (!empty($alumni['alm_contact_other'])): ?>
                            <li class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between gap-2 group hover:bg-slate-100/70 transition">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                                        💬
                                    </div>
                                    <div class="min-w-0">
                                        <span class="text-[10px] text-slate-400 block font-medium">Line / โซเชียลมีเดีย</span>
                                        <span class="font-bold text-slate-800 truncate block"><?= esc($alumni['alm_contact_other']) ?></span>
                                    </div>
                                </div>
                                <button type="button" onclick="copyText('<?= esc($alumni['alm_contact_other']) ?>', 'คัดลอกข้อมูลติดต่อเรียบร้อย')" 
                                        class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-white transition cursor-pointer" title="คัดลอก">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                </button>
                            </li>
                        <?php endif; ?>

                        <!-- Current Address -->
                        <?php if (!empty($alumni['alm_current_address'])): ?>
                            <li class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex items-start gap-2.5 group">
                                <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center shrink-0 mt-0.5">
                                    📍
                                </div>
                                <div class="min-w-0">
                                    <span class="text-[10px] text-slate-400 block font-medium">ที่อยู่ปัจจุบัน</span>
                                    <?php if ($showAddress): ?>
                                        <span class="font-medium text-slate-800 text-xs leading-relaxed block"><?= nl2br(esc($alumni['alm_current_address'])) ?></span>
                                    <?php else: ?>
                                        <span class="text-slate-400 italic text-[11px] block">🔒 ซ่อนตามการตั้งค่าส่วนตัว</span>
                                    <?php endif; ?>
                                </div>
                            </li>
                        <?php endif; ?>

                    </ul>
                </div>

                <!-- Education Card -->
                <?php if (!empty($alumni['alm_grad_level']) || !empty($alumni['alm_grad_major']) || !empty($alumni['alm_study_place'])): ?>
                    <div class="glass-card rounded-2xl border border-slate-200/80 p-5 shadow-xs space-y-3">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                </svg>
                                <span>ระดับการศึกษา</span>
                            </h2>
                        </div>

                        <div class="space-y-3">
                            <?php if (!empty($alumni['alm_grad_level'])): ?>
                                <div>
                                    <span class="text-[10px] text-slate-400 font-semibold block uppercase tracking-wider">วุฒิการศึกษาสูงสุดปัจจุบัน:</span>
                                    <div class="text-sm font-bold text-slate-900 flex items-center gap-1.5 mt-0.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-pink-500"></span>
                                        <span><?= esc($alumni['alm_grad_level']) ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($alumni['alm_school_grad_level'])): ?>
                                <div class="text-xs text-slate-600">
                                    <span class="text-slate-400 block text-[10px] font-semibold uppercase tracking-wider">ระดับชั้นที่จบจากโรงเรียน:</span>
                                    <span class="font-semibold text-slate-800"><?= esc($alumni['alm_school_grad_level']) ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($alumni['alm_grad_major'])): ?>
                                <div class="p-2.5 rounded-xl bg-pink-50/50 border border-pink-100/70 text-xs">
                                    <span class="text-pink-600 font-bold block mb-0.5">สาขาวิชา / แผนการเรียน:</span>
                                    <span class="text-slate-800 font-semibold"><?= esc($alumni['alm_grad_major']) ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($alumni['alm_study_place'])): ?>
                                <div class="text-xs text-slate-600 pt-1">
                                    <span class="text-slate-400 block text-[10px]">สถาบันที่ศึกษาต่อ:</span>
                                    <span class="font-medium text-slate-800"><?= esc($alumni['alm_study_place']) ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Support Needs / Preferences (If provided) -->
                <?php if (!empty($alumni['alm_school_support_needs'])): ?>
                    <div class="glass-card rounded-2xl border border-slate-200/80 p-5 shadow-xs space-y-3">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400 flex items-center gap-1.5">
                                <span>🤝 สิ่งที่ต้องการให้สนับสนุน</span>
                            </h2>
                        </div>
                        <p class="text-xs text-slate-700 leading-relaxed bg-slate-50 p-3 rounded-xl border border-slate-100">
                            <?= esc($alumni['alm_school_support_needs']) ?>
                        </p>
                    </div>
                <?php endif; ?>

            </div>

            <!-- RIGHT COLUMN: BIO & WORK EXPERIENCE (2 Cols) -->
            <div class="space-y-6 lg:col-span-2">
                
                <!-- PAO Nakhon Sawan Match Banner (If job seeker or ready) -->
                <div class="rounded-2xl bg-gradient-to-r from-amber-500/10 via-pink-500/5 to-blue-500/10 border border-amber-300/70 p-4 sm:p-5 shadow-xs">
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-xs">
                            📌
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-xs sm:text-sm font-bold text-slate-900">
                                ฐานข้อมูลเพื่อการพิจารณาตำแหน่งงาน อบจ.นครสวรรค์
                            </h3>
                            <p class="text-xs text-slate-600 mt-0.5 leading-relaxed">
                                ประวัติการศึกษาและประสบการณ์ทำงานของศิษย์เก่าจะถูกใช้เป็นฐานข้อมูลหลักในการประสานงานโอกาสทางอาชีพ
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Work Experience & Career Profile Card -->
                <div class="glass-card rounded-2xl border border-slate-200/80 p-6 sm:p-7 shadow-xs space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <h2 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-600"></span>
                            <span>ประสบการณ์ทำงาน & ทักษะความเชี่ยวชาญ</span>
                        </h2>
                        <span class="text-[11px] font-medium text-slate-400">Career & Skills</span>
                    </div>

                    <?php if (!empty($alumni['alm_work_experience'])): ?>
                        <div class="p-4 sm:p-5 rounded-2xl bg-slate-50 border border-slate-100 text-xs sm:text-sm text-slate-700 leading-relaxed space-y-2">
                            <?= nl2br(esc($alumni['alm_work_experience'])) ?>
                        </div>
                    <?php else: ?>
                        <div class="py-8 text-center text-slate-400 text-xs sm:text-sm bg-slate-50/50 rounded-2xl border border-dashed border-slate-200">
                            ยังไม่มีข้อมูลประสบการณ์ทำงานเพิ่มเติม
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Bio & About Me Card -->
                <div class="glass-card rounded-2xl border border-slate-200/80 p-6 sm:p-7 shadow-xs space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <h2 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-pink-500"></span>
                            <span>ประวัติและข้อความแนะนำตัว (About / Bio)</span>
                        </h2>
                        <span class="text-[11px] font-medium text-slate-400">About Me</span>
                    </div>

                    <?php if (!empty($alumni['alm_bio'])): ?>
                        <div class="p-4 sm:p-5 rounded-2xl bg-slate-50 border border-slate-100 text-xs sm:text-sm text-slate-700 leading-relaxed relative">
                            <span class="text-3xl text-slate-200 font-serif absolute top-2 right-4 select-none">“</span>
                            <p class="relative z-10"><?= nl2br(esc($alumni['alm_bio'])) ?></p>
                        </div>
                    <?php else: ?>
                        <div class="py-8 text-center text-slate-400 text-xs sm:text-sm bg-slate-50/50 rounded-2xl border border-dashed border-slate-200">
                            ยังไม่ได้เขียนข้อความแนะนำตัว
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Suggestions for School (If provided and owner/admin) -->
                <?php if ($isOwnerOrAdmin && !empty($alumni['alm_suggestions'])): ?>
                    <div class="glass-card rounded-2xl border border-slate-200/80 p-6 shadow-xs space-y-3">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400 flex items-center gap-1.5">
                                <span>💡 ข้อเสนอแนะถึงโรงเรียน / อบจ.</span>
                            </h2>
                            <span class="text-[10px] text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full font-bold">เฉพาะเจ้าของ & ผู้ดูแล</span>
                        </div>
                        <p class="text-xs text-slate-700 leading-relaxed bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <?= nl2br(esc($alumni['alm_suggestions'])) ?>
                        </p>
                    </div>
                <?php endif; ?>

            </div>

        </div>

    </main>

    <!-- Footer -->
    <footer class="mt-auto border-t border-slate-200/60 bg-white py-6 text-center text-xs text-slate-400">
        <div class="max-w-5xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-2">
            <p>© 2026 ทำเนียบรุ่นศิษย์เก่า SKJ | สวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์</p>
            <p>สนับสนุนโดย องค์การบริหารส่วนจังหวัดนครสวรรค์ (อบจ.นครสวรรค์)</p>
        </div>
    </footer>

    <!-- Interactive Scripts -->
    <script>
        function copyProfileLink() {
            const url = window.location.href;
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(url).then(() => {
                    showToast('คัดลอกลิงก์โปรไฟล์เรียบร้อยแล้ว');
                }).catch(() => {
                    fallbackCopy(url);
                });
            } else {
                fallbackCopy(url);
            }
        }

        function copyText(text, successMsg) {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(() => {
                    showToast(successMsg);
                });
            } else {
                fallbackCopy(text);
            }
        }

        function fallbackCopy(text) {
            const input = document.createElement('input');
            input.value = text;
            document.body.appendChild(input);
            input.select();
            document.execCommand('copy');
            document.body.removeChild(input);
            showToast('คัดลอกเรียบร้อยแล้ว');
        }

        function showToast(title) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: title,
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                customClass: {
                    popup: 'rounded-2xl shadow-lg border border-slate-100 text-xs'
                }
            });
        }
    </script>
</body>

</html>
