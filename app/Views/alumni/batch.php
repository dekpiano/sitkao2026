<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมาชิกศิษย์เก่า <?= esc($batch_name) ?> | SKJ Alumni</title>
    <link href="https://fonts.googleapis.com/css2?family=K2D:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'K2D', sans-serif; scroll-behavior: smooth; }
        .swal2-popup { font-family: 'K2D', sans-serif !important; border-radius: 1.25rem !important; }
        
        .animated-bg {
            position: fixed;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
            background-color: #f8fafc;
            background-image: 
                linear-gradient(to right, rgba(0, 0, 0, 0.02) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.02) 1px, transparent 1px);
            background-size: 32px 32px;
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0.35;
            animation: floatBlob 24s infinite alternate cubic-bezier(0.4, 0, 0.2, 1);
        }

        .blob-1 {
            top: 5%;
            left: 5%;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, #f472b6 0%, transparent 70%);
        }

        .blob-2 {
            bottom: 10%;
            right: 5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, #60a5fa 0%, transparent 70%);
            animation-duration: 28s;
        }

        @keyframes floatBlob {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(70px, 50px) scale(1.1); }
            100% { transform: translate(-50px, 70px) scale(0.95); }
        }

        /* Modal Transitions */
        .modal-enter {
            opacity: 0;
            transform: scale(0.95) translateY(10px);
        }
        .modal-enter-active {
            opacity: 1;
            transform: scale(1) translateY(0);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .modal-exit {
            opacity: 1;
            transform: scale(1);
        }
        .modal-exit-active {
            opacity: 0;
            transform: scale(0.95) translateY(10px);
            transition: all 0.2s ease-in;
        }
    </style>
    <script src="<?= base_url('assets/js/floating-bubbles.js') ?>" defer></script>
</head>
<body class="bg-slate-50 min-h-screen text-slate-800 antialiased relative">

    <!-- Animated Ambient Background -->
    <div class="animated-bg">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

    <!-- Navbar -->
    <header class="sticky top-0 z-40 w-full border-b bg-white/85 backdrop-blur-md transition-shadow duration-200 border-slate-100">
        <div class="mx-auto flex h-16 max-w-[1440px] items-center justify-between px-4 sm:px-6 lg:px-10">
            <a href="<?= base_url('/') ?>" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-blue-500 rounded-lg flex items-center justify-center text-white font-bold text-lg shadow-sm">SKJ</div>
                <div>
                    <span class="block text-base font-bold text-slate-900 leading-tight">ทำเนียบรุ่นศิษย์เก่า SKJ</span>
                    <span class="block text-[10px] text-slate-500">สวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์</span>
                </div>
            </a>
            
            <div class="flex items-center gap-1.5 sm:gap-2">
                <a href="<?= base_url('jobs') ?>" class="hidden sm:inline-flex h-9 items-center justify-center rounded-full bg-slate-100 hover:bg-pink-50 hover:text-pink-600 px-3.5 text-xs font-semibold text-slate-700 transition">
                    💼 ตำแหน่งงาน
                </a>
                <a href="<?= base_url('news') ?>" class="hidden sm:inline-flex h-9 items-center justify-center rounded-full bg-slate-100 hover:bg-pink-50 hover:text-pink-600 px-3.5 text-xs font-semibold text-slate-700 transition">
                    📰 ข่าวสาร
                </a>
                <?php if(in_array(session()->get('role'), ['admin', 'super_admin'])): ?>
                    <a href="<?= base_url('admin/dashboard') ?>" class="inline-flex h-9 items-center justify-center rounded-full bg-purple-50 text-purple-700 border border-purple-200 px-3.5 text-xs font-bold hover:bg-purple-100 transition">
                        ★ Admin
                    </a>
                <?php endif; ?>
                <a href="<?= base_url('/') ?>" class="inline-flex h-9 items-center justify-center rounded-full bg-slate-100 px-3.5 text-xs sm:text-sm font-medium text-slate-700 hover:bg-slate-200 transition">
                    ← รวมรุ่น
                </a>
                <?php if(session()->get('isLoggedIn')): ?>
                    <a href="<?= base_url('alumni/profile/' . session()->get('id')) ?>" class="inline-flex h-9 items-center justify-center rounded-full bg-slate-100 hover:bg-pink-50 hover:text-pink-600 px-3 text-xs sm:text-sm font-semibold text-slate-700 transition gap-1.5">
                        <span>👤</span>
                        <span class="max-w-[100px] sm:max-w-[140px] truncate"><?= esc(session()->get('name')) ?></span>
                    </a>
                    <a href="<?= base_url('alumni/edit-profile') ?>" class="inline-flex h-9 items-center justify-center rounded-full bg-gradient-to-r from-pink-600 to-blue-600 px-3 text-xs sm:text-sm font-medium text-white shadow-sm hover:opacity-90 transition gap-1">
                        <span>✏️</span>
                        <span class="hidden sm:inline">แก้ไขโปรไฟล์</span>
                    </a>
                    <a href="<?= base_url('logout') ?>" onclick="confirmLogout(event, '<?= base_url('logout') ?>')" title="ออกจากระบบ" class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-red-50 hover:text-red-600 transition">
                        🚪
                    </a>
                <?php else: ?>
                    <a href="<?= base_url('login') ?>" class="inline-flex h-9 items-center justify-center rounded-full px-3.5 text-xs sm:text-sm font-medium text-slate-700 hover:bg-slate-100 transition">เข้าสู่ระบบ</a>
                    <a href="<?= base_url('register') ?>" class="inline-flex h-9 items-center justify-center rounded-full bg-gradient-to-r from-pink-600 to-blue-600 px-3.5 text-xs sm:text-sm font-medium text-white shadow-sm hover:opacity-90 transition">ลงทะเบียน</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main class="max-w-[1440px] mx-auto px-4 py-8 sm:py-12 sm:px-6 lg:px-10 relative z-10">
        
        <!-- Breadcrumb & Header Banner -->
        <div class="mb-10">
            <nav class="flex items-center gap-2 text-sm text-slate-500 mb-4">
                <a href="<?= base_url('/') ?>" class="hover:text-pink-600 transition">หน้าหลัก (ทำเนียบรุ่น)</a>
                <span>/</span>
                <span class="text-slate-900 font-bold"><?= esc($batch_name) ?></span>
            </nav>

            <div class="bg-gradient-to-r from-pink-600 via-pink-500 to-blue-600 rounded-3xl p-6 sm:p-10 text-white shadow-xl shadow-pink-500/15 flex flex-col sm:flex-row sm:items-center justify-between gap-6 relative overflow-hidden">
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/20 backdrop-blur-md text-white border border-white/30">
                            ห้องรวมรุ่นศิษย์เก่า
                        </span>
                        <?php if(!empty($grad_year)): ?>
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-900/30 backdrop-blur-md text-blue-100 border border-white/20">
                                ปีการศึกษา <?= esc($grad_year) ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <h1 class="text-3xl sm:text-5xl font-bold tracking-tight mb-2">
                        <?= esc($batch_name) ?>
                    </h1>
                    <p class="text-pink-100 text-sm sm:text-base max-w-xl">
                        รายชื่อเพื่อนร่วมรุ่นและศิษย์เก่าโรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์
                    </p>
                </div>

                <div class="relative z-10 flex sm:flex-col items-center sm:items-end justify-between sm:justify-center bg-white/10 backdrop-blur-md rounded-2xl p-4 sm:p-6 border border-white/20 shrink-0">
                    <span class="text-xs text-pink-100 uppercase tracking-wider font-semibold">จำนวนสมาชิกในรุ่น</span>
                    <span class="text-3xl sm:text-4xl font-extrabold text-white mt-1"><?= $total_count ?> ท่าน</span>
                </div>

                <!-- Decorative blur circle -->
                <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
            </div>
        </div>

        <!-- Search in this batch -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
            <h2 class="text-xl font-bold text-slate-900">
                รายชื่อสมาชิกในรุ่นนี้
            </h2>
            <div class="w-full sm:w-80">
                <div class="relative flex h-11 items-center rounded-full border border-slate-200 bg-white px-3 shadow-sm focus-within:border-pink-500 focus-within:ring-2 focus-within:ring-pink-500/20">
                    <svg class="w-4 h-4 text-slate-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    <input type="text" id="memberSearchInput" placeholder="ค้นหาชื่อ หรือตำแหน่งงาน..." class="w-full bg-transparent text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none">
                </div>
            </div>
        </div>

        <!-- Members Grid (2-column on mobile, 4-column on desktop) -->
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 pb-12 sm:pb-0" id="membersGrid">
            <?php if(!empty($members) && is_array($members)): ?>
                <?php foreach($members as $alumni): ?>
                    <div class="member-card group bg-white rounded-2xl sm:rounded-[24px] p-3.5 sm:p-6 transition-all duration-300 hover:shadow-[0_20px_40px_-15px_rgba(219,39,119,0.15)] hover:-translate-y-1 active:scale-[0.98] border border-slate-200/80 hover:border-pink-200 overflow-hidden relative flex flex-col justify-between">
                        
                        <div>
                            <!-- Top Badge Row (School + Batch) -->
                            <?php 
                                $mSchool = $alumni['alm_school'] ?? 'โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์';
                                $mIsJW = (strpos($mSchool, 'จิรประวัติวิทยาคม') !== false);
                            ?>
                            <div class="flex justify-between items-center mb-1.5 sm:mb-2 gap-1">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-black <?= $mIsJW ? 'bg-indigo-50 text-indigo-700 border border-indigo-100' : 'bg-pink-50 text-pink-700 border border-pink-100' ?>">
                                    <?= $mIsJW ? 'จ.ว.' : 'สกจ.' ?>
                                </span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] sm:text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200 truncate">
                                    <?= esc($alumni['alm_batch']) ?>
                                </span>
                            </div>

                            <div class="flex flex-col items-center text-center">
                                <div class="relative mb-2 sm:mb-4 cursor-pointer" onclick='openProfileModal(<?= htmlspecialchars(json_encode($alumni), ENT_QUOTES, "UTF-8") ?>)'>
                                    <div class="absolute inset-0 bg-blue-400 rounded-full blur opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                                    <img src="<?= esc($alumni['alm_image']) ?>" alt="<?= esc($alumni['alm_name']) ?>" class="relative w-16 h-16 sm:w-24 sm:h-24 rounded-full object-cover border-2 border-slate-100 shadow-sm group-hover:border-pink-300 transition-colors">
                                </div>
                                
                                <h3 class="member-name text-sm sm:text-lg font-bold text-slate-900 mb-0.5 sm:mb-1 leading-tight group-hover:text-pink-600 transition-colors line-clamp-1 cursor-pointer" onclick='openProfileModal(<?= htmlspecialchars(json_encode($alumni), ENT_QUOTES, "UTF-8") ?>)'><?= esc($alumni['alm_name']) ?></h3>
                                <p class="member-job text-[11px] sm:text-sm text-slate-500 mb-2 sm:mb-4 line-clamp-1">
                                    <?= esc($alumni['alm_job_title']) ?>
                                </p>
                            </div>
                        </div>

                        <!-- Modal Trigger Button -->
                        <button type="button" onclick='openProfileModal(<?= htmlspecialchars(json_encode($alumni), ENT_QUOTES, "UTF-8") ?>)' class="w-full inline-flex justify-center items-center gap-1 h-9 sm:h-11 rounded-xl text-xs sm:text-sm font-bold text-slate-700 bg-slate-50 hover:bg-gradient-to-r hover:from-pink-600 hover:to-blue-600 hover:text-white transition-all duration-300 mt-1 shadow-sm cursor-pointer active:scale-95">
                            <span>ดูโปรไฟล์</span>
                        </button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full py-16 sm:py-20 px-6 text-center bg-white rounded-3xl border border-dashed border-slate-300 shadow-xs max-w-2xl mx-auto">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-gradient-to-tr from-pink-100 to-blue-100 text-pink-600 flex items-center justify-center text-3xl sm:text-4xl mx-auto mb-4 shadow-inner">
                        👥
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900 mb-2">ยังไม่มีข้อมูลสมาชิกในห้องรุ่นนี้</h3>
                    <p class="text-xs sm:text-sm text-slate-500 max-w-md mx-auto leading-relaxed mb-6">
                        ยังไม่มีศิษย์เก่าในรุ่นนี้ลงทะเบียนในระบบ หรือข้อมูลกำลังอยู่ระหว่างการรวบรวม หากท่านเป็นศิษย์เก่าสามารถลงทะเบียนเพื่อเชื่อมต่อเครือข่ายเพื่อนร่วมรุ่นได้ทันที
                    </p>
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <a href="<?= base_url('register') ?>" 
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-pink-600 to-blue-600 hover:opacity-95 text-white text-xs sm:text-sm font-bold shadow-md shadow-pink-500/20 transition active:scale-95">
                            <span>📝 ลงทะเบียนเป็นสมาชิกคนแรก</span>
                        </a>
                        <a href="<?= base_url('/#batches') ?>" 
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs sm:text-sm font-bold transition">
                            <span>← ดูทำเนียบรุ่นทั้งหมด</span>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </main>

    <!-- Interactive Profile Modal (Mobile Bottom-Sheet on small screens) -->
    <div id="profileModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop with Blur -->
        <div id="modalBackdrop" class="fixed inset-0 bg-slate-900/60 backdrop-blur-md transition-opacity duration-300 opacity-0" onclick="closeProfileModal()"></div>

        <div class="flex min-h-full items-end sm:items-center justify-center p-0 sm:p-6 text-center">
            <!-- Modal Container (Bottom Sheet on Mobile, Centered Card on Desktop) -->
            <div id="modalCard" class="relative w-full max-w-2xl max-h-[92vh] overflow-y-auto transform rounded-t-[32px] sm:rounded-[32px] bg-white text-left shadow-2xl transition-all duration-300 modal-enter border border-slate-100">
                
                <!-- Modal Top Accent Banner -->
                <div class="h-28 sm:h-32 bg-gradient-to-r from-pink-500 via-purple-600 to-blue-600 w-full relative">
                    <!-- Geometric Mesh Overlay -->
                    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(#fff_1.5px,transparent_1.5px)] [background-size:16px_16px]"></div>
                    
                    <!-- Mobile Drag Indicator -->
                    <div class="w-12 h-1.5 bg-white/60 rounded-full mx-auto mt-2.5 sm:hidden relative z-10"></div>
                    
                    <!-- Close Button -->
                    <button type="button" onclick="closeProfileModal()" class="absolute top-3.5 right-3.5 sm:top-4 sm:right-4 w-9 h-9 rounded-full bg-black/30 hover:bg-white text-white hover:text-slate-900 backdrop-blur-md flex items-center justify-center transition shadow-lg z-20 cursor-pointer" aria-label="ปิดหน้าต่าง">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Modal Content Area (Pure White Background) -->
                <div class="px-5 pb-8 pt-0 sm:px-8 bg-white">
                    
                    <!-- Avatar & Badges Row (Only the Avatar floats up into the banner) -->
                    <div class="flex flex-col sm:flex-row items-center sm:items-end justify-between gap-3 -mt-14 sm:-mt-16 mb-4">
                        <!-- Floating Avatar -->
                        <div class="relative shrink-0 z-10">
                            <img id="mAvatar" src="" alt="Alumni" class="w-24 h-24 sm:w-28 sm:h-28 rounded-3xl object-cover border-4 border-white shadow-xl bg-white ring-2 ring-slate-100 shrink-0">
                            <div class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full bg-emerald-500 border-2 border-white flex items-center justify-center text-white text-[10px] font-bold shadow-md" title="สมาชิกศิษย์เก่า">
                                ✓
                            </div>
                        </div>

                        <!-- Badges Row -->
                        <div class="flex flex-wrap justify-center sm:justify-end gap-1.5 z-10">
                            <span id="mSchoolBadge" class="px-3 py-1 rounded-full text-xs font-bold bg-pink-100 text-pink-800 border border-pink-200"></span>
                            <span id="mBatch" class="px-3 py-1 rounded-full text-xs font-bold bg-slate-900 text-white shadow-sm"></span>
                            <span id="mYear" class="px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100"></span>
                            <span id="mStatus" class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100"></span>
                        </div>
                    </div>

                    <!-- Name & Current Job Section (Solid Crisp High Contrast on White) -->
                    <div class="text-center sm:text-left mb-5 pb-4 border-b border-slate-100">
                        <h3 id="mName" class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight leading-tight"></h3>
                        <div class="mt-1.5 flex flex-wrap items-center justify-center sm:justify-start gap-2">
                            <span id="mJob" class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-bold bg-pink-50 text-pink-600 border border-pink-100"></span>
                        </div>
                    </div>

                    <!-- Member Status Alert Banner -->
                    <?php if(session()->get('isLoggedIn')): ?>
                        <div class="mb-5 p-3 rounded-2xl bg-gradient-to-r from-pink-50 via-purple-50 to-blue-50 border border-pink-200/70 flex items-center justify-between gap-3 text-xs">
                            <div class="flex items-center gap-2 text-slate-800 font-medium">
                                <span class="text-base">👑</span>
                                <span>คุณอยู่ในสถานะ <strong>สมาชิกศิษย์เก่า</strong> สามารถดูข้อมูลติดต่อและสายอาชีพได้เต็มรูปแบบ</span>
                            </div>
                            <span class="hidden sm:inline-flex px-2 py-0.5 rounded-md bg-emerald-100 text-emerald-800 font-bold text-[10px] shrink-0">
                                ยืนยันสิทธิ์แล้ว
                            </span>
                        </div>
                    <?php endif; ?>

                    <!-- Modal Body Content -->
                    <div class="space-y-4">
                        
                        <!-- Contact Channels Box -->
                        <div id="mContactSection" class="p-4 sm:p-5 rounded-3xl bg-slate-50/90 border border-slate-200/80 space-y-3">
                            <div class="flex items-center justify-between pb-2 border-b border-slate-200/60">
                                <span class="font-bold text-slate-800 text-xs sm:text-sm flex items-center gap-2">
                                    <span>📇</span> ข้อมูลและช่องทางการติดต่อ
                                </span>
                                <span class="text-[10px] text-slate-400">คลิกเพื่อโทร / ส่งอีเมล / คัดลอก</span>
                            </div>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-xs">
                                <!-- Phone Card -->
                                <div id="mPhoneWrap" class="p-3 bg-white rounded-2xl border border-slate-200/70 shadow-sm flex items-center justify-between gap-2 hover:border-blue-300 transition group">
                                    <div class="flex items-center gap-2.5 min-w-0">
                                        <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 text-sm font-bold">
                                            📞
                                        </div>
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-1.5">
                                                <span class="text-[10px] text-slate-400 block font-medium">เบอร์โทรศัพท์:</span>
                                                <span id="mPhonePrivacyBadge" class="hidden text-[9px] font-bold text-amber-700 bg-amber-50 px-1.5 py-0.2 rounded border border-amber-200"></span>
                                            </div>
                                            <span id="mPhone" class="font-bold text-slate-900 truncate block"></span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1 shrink-0">
                                        <a id="mPhoneCallBtn" href="#" class="p-1.5 rounded-lg bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white transition" title="โทรออก">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        </a>
                                        <button type="button" id="mPhoneCopyBtn" onclick="copyContactText('mPhone', 'เบอร์โทรศัพท์')" class="p-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 transition cursor-pointer" title="คัดลอกเบอร์โทร">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Email Card -->
                                <div id="mEmailWrap" class="p-3 bg-white rounded-2xl border border-slate-200/70 shadow-sm flex items-center justify-between gap-2 hover:border-pink-300 transition group">
                                    <div class="flex items-center gap-2.5 min-w-0">
                                        <div class="w-8 h-8 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center shrink-0 text-sm font-bold">
                                            ✉️
                                        </div>
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-1.5">
                                                <span class="text-[10px] text-slate-400 block font-medium">อีเมล:</span>
                                                <span id="mEmailPrivacyBadge" class="hidden text-[9px] font-bold text-amber-700 bg-amber-50 px-1.5 py-0.2 rounded border border-amber-200"></span>
                                            </div>
                                            <span id="mEmail" class="font-bold text-slate-900 truncate block"></span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1 shrink-0">
                                        <a id="mEmailSendBtn" href="#" class="p-1.5 rounded-lg bg-pink-50 hover:bg-pink-600 text-pink-600 hover:text-white transition" title="ส่งอีเมล">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        </a>
                                        <button type="button" id="mEmailCopyBtn" onclick="copyContactText('mEmail', 'อีเมล')" class="p-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 transition cursor-pointer" title="คัดลอกอีเมล">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Line / Social Card -->
                                <div id="mContactOtherWrap" class="p-3 bg-white rounded-2xl border border-slate-200/70 shadow-sm flex items-center justify-between gap-2 hover:border-purple-300 transition">
                                    <div class="flex items-center gap-2.5 min-w-0">
                                        <div class="w-8 h-8 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0 text-sm font-bold">
                                            💬
                                        </div>
                                        <div class="min-w-0">
                                            <span class="text-[10px] text-slate-400 block font-medium">Line / Social:</span>
                                            <span id="mContactOther" class="font-bold text-slate-900 truncate block"></span>
                                        </div>
                                    </div>
                                    <button type="button" id="mContactOtherCopyBtn" onclick="copyContactText('mContactOther', 'Line/โซเชียล')" class="p-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 transition cursor-pointer shrink-0" title="คัดลอกข้อมูล">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    </button>
                                </div>

                                <!-- Current Address Card -->
                                <div id="mAddressWrap" class="p-3 bg-white rounded-2xl border border-slate-200/70 shadow-sm flex items-center justify-between gap-2 hover:border-emerald-300 transition">
                                    <div class="flex items-center gap-2.5 min-w-0">
                                        <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 text-sm font-bold">
                                            🏠
                                        </div>
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-1.5">
                                                <span class="text-[10px] text-slate-400 block font-medium">ที่อยู่ปัจจุบัน:</span>
                                                <span id="mAddressPrivacyBadge" class="hidden text-[9px] font-bold text-amber-700 bg-amber-50 px-1.5 py-0.2 rounded border border-amber-200"></span>
                                            </div>
                                            <span id="mAddress" class="font-bold text-slate-900 truncate block"></span>
                                        </div>
                                    </div>
                                    <button type="button" id="mAddressCopyBtn" onclick="copyContactText('mAddress', 'ที่อยู่')" class="p-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 transition cursor-pointer shrink-0" title="คัดลอกที่อยู่">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Education & Major (PAO Nakhon Sawan Highlight Card) -->
                        <div id="mEducationWrap" class="p-4 sm:p-5 rounded-3xl bg-gradient-to-br from-blue-50/80 to-indigo-50/60 border border-blue-200/80 text-xs sm:text-sm">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-bold text-blue-900 uppercase tracking-wider text-[11px] flex items-center gap-1.5">
                                    <span>🎓</span> ประวัติการศึกษา & แผนการเรียน
                                </span>
                                <span class="text-[10px] font-bold bg-amber-100 text-amber-800 px-2.5 py-0.5 rounded-full border border-amber-200">
                                    ⭐ สายอาชีพ อบจ.
                                </span>
                            </div>
                            <div class="text-slate-900 text-sm sm:text-base">
                                <strong id="mGradLevel" class="font-bold"></strong>
                                <span id="mGradMajor" class="text-pink-600 font-semibold ml-1"></span>
                            </div>
                            <div id="mStudyPlaceWrap" class="text-xs text-slate-600 mt-1.5 flex items-center gap-1.5">
                                <span class="text-slate-400">🏫 กำลังศึกษาต่อ:</span>
                                <span id="mStudyPlace" class="font-bold text-slate-800"></span>
                            </div>
                        </div>

                        <!-- Work Experience & Skills Card -->
                        <div id="mExperienceWrap" class="p-4 sm:p-5 rounded-3xl bg-slate-50 border border-slate-200/80 text-xs sm:text-sm">
                            <div class="font-bold text-slate-800 uppercase tracking-wider text-[11px] mb-2 flex items-center gap-1.5">
                                <span>💼</span> การทำงาน ประสบการณ์ & ทักษะ
                            </div>
                            <p id="mExperience" class="text-slate-700 whitespace-pre-line leading-relaxed text-xs sm:text-sm"></p>
                        </div>

                        <!-- School Support Needs & Suggestions Card -->
                        <div id="mSupportNeedsWrap" class="p-4 sm:p-5 rounded-3xl bg-amber-50/60 border border-amber-200/70 text-xs sm:text-sm">
                            <div class="font-bold text-amber-900 uppercase tracking-wider text-[11px] mb-2 flex items-center gap-1.5">
                                <span>💡</span> ความต้องการให้โรงเรียนสนับสนุน / ความคิดเห็น
                            </div>
                            <p id="mSupportNeeds" class="text-slate-700 whitespace-pre-line leading-relaxed text-xs"></p>
                        </div>

                        <!-- Bio / Self Introduction Quote Card -->
                        <div id="mBioWrap" class="p-4 sm:p-5 rounded-3xl bg-gradient-to-r from-pink-50/80 to-purple-50/60 border border-pink-200/70 text-xs sm:text-sm relative overflow-hidden">
                            <span class="absolute right-4 top-2 text-6xl text-pink-200 font-serif select-none pointer-events-none opacity-50">“</span>
                            <div class="font-bold text-pink-900 uppercase tracking-wider text-[11px] mb-1.5 flex items-center gap-1.5">
                                <span>💬</span> ข้อความฝากถึงเพื่อนร่วมรุ่น (Bio)
                            </div>
                            <p id="mBio" class="text-slate-700 whitespace-pre-line leading-relaxed italic relative z-10 text-xs sm:text-sm"></p>
                        </div>

                    </div>

                    <!-- Modal Actions Footer -->
                    <div class="mt-6 pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
                        <div class="flex items-center gap-3 text-xs">
                            <a id="mDirectLink" href="#" class="text-slate-500 hover:text-pink-600 transition flex items-center gap-1 font-semibold">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                <span>เปิดหน้าโปรไฟล์แยก</span>
                            </a>
                            <button type="button" id="mCopyLinkBtn" onclick="copyCurrentProfileLink()" class="text-slate-400 hover:text-slate-600 transition flex items-center gap-1 cursor-pointer">
                                <span>📋 คัดลอกลิงก์</span>
                            </button>
                        </div>

                        <div class="flex items-center gap-2 w-full sm:w-auto">
                            <div id="mEditButtonWrap" class="hidden">
                                <a href="<?= base_url('alumni/edit-profile') ?>" class="inline-flex items-center gap-1 px-4 py-2.5 rounded-xl text-xs font-bold bg-pink-50 text-pink-600 hover:bg-pink-100 transition">
                                    <span>✏️</span> แก้ไขข้อมูลของฉัน
                                </a>
                            </div>
                            <button type="button" onclick="closeProfileModal()" class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-slate-900 text-white hover:bg-slate-800 text-xs sm:text-sm font-bold transition cursor-pointer active:scale-95 shadow-sm">
                                ปิดหน้าต่าง
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900 pt-16 pb-8 border-t border-slate-800 mt-20">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-10 text-center">
            <h2 class="text-2xl font-bold text-white mb-2">SKJ Alumni Network</h2>
            <p class="text-slate-400 mb-6 max-w-md mx-auto text-sm">แพลตฟอร์มรวมศิษย์เก่าสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์ สนับสนุนโดย อบจ. นครสวรรค์</p>
            
            <!-- Admin Portal Entry Button -->
            <div class="mb-8 flex items-center justify-center">
                <a href="<?= base_url('admin') ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-800/90 hover:bg-slate-700 text-slate-300 hover:text-white text-xs font-semibold border border-slate-700 hover:border-pink-500/60 transition-all shadow-sm group">
                    <svg class="w-4 h-4 text-pink-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <span>ระบบจัดการผู้ดูแลระบบ (Admin Portal)</span>
                </a>
            </div>

            <div class="border-t border-slate-800 pt-8 flex justify-center">
                <p class="text-slate-500 text-sm">© 2026 SKJ Alumni. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Current logged in user ID and status
        const currentUserId = <?= json_encode(session()->get('id')) ?>;
        const isLoggedIn = <?= json_encode((bool)session()->get('isLoggedIn')) ?>;
        let currentModalAlumniId = null;

        // Search filter in this batch
        document.getElementById('memberSearchInput').addEventListener('keyup', function(e) {
            const term = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.member-card');
            cards.forEach(card => {
                const name = card.querySelector('.member-name').textContent.toLowerCase();
                const job = card.querySelector('.member-job').textContent.toLowerCase();
                if(name.includes(term) || job.includes(term)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Copy contact helper
        function copyContactText(elementId, label) {
            const el = document.getElementById(elementId);
            if (!el) return;
            const text = el.textContent.trim();
            if (!text || text === '-') return;

            navigator.clipboard.writeText(text).then(() => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'คัดลอก ' + label + ' แล้ว!',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        }

        // Copy profile link helper
        function copyCurrentProfileLink() {
            if (!currentModalAlumniId) return;
            const profileUrl = '<?= base_url("alumni/profile/") ?>/' + currentModalAlumniId;
            navigator.clipboard.writeText(profileUrl).then(() => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'คัดลอกลิงก์โปรไฟล์แล้ว!',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        }

        // Profile Modal Logic
        const modal = document.getElementById('profileModal');
        const backdrop = document.getElementById('modalBackdrop');
        const card = document.getElementById('modalCard');

        function openProfileModal(alumni) {
            if (!alumni) return;
            currentModalAlumniId = alumni.alm_id;

            // Fill basic info
            document.getElementById('mAvatar').src = alumni.alm_image || ('https://ui-avatars.com/api/?name=' + encodeURIComponent(alumni.alm_name) + '&background=random&color=fff&size=150');
            document.getElementById('mName').textContent = alumni.alm_name || '-';
            document.getElementById('mJob').textContent = alumni.alm_job_title || 'ศิษย์เก่า';
            
            // Badges
            const schoolBadge = document.getElementById('mSchoolBadge');
            const sch = alumni.alm_school || 'โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์';
            const isJW = (sch.indexOf('จิรประวัติวิทยาคม') !== -1);
            if (schoolBadge) {
                schoolBadge.textContent = isJW ? '🏫 จิรประวัติวิทยาคม (จ.ว.)' : '🌸 สวนกุหลาบฯ จิรประวัติ (สกจ.)';
                schoolBadge.className = isJW 
                    ? 'px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 border border-blue-200 shadow-sm'
                    : 'px-3 py-1 rounded-full text-xs font-bold bg-pink-100 text-pink-800 border border-pink-200 shadow-sm';
            }

            document.getElementById('mBatch').textContent = alumni.alm_batch || 'ทำเนียบรุ่น';
            
            const yearEl = document.getElementById('mYear');
            if (alumni.alm_grad_year) {
                yearEl.textContent = 'ปี ' + alumni.alm_grad_year + (alumni.alm_school_grad_level ? (' (' + alumni.alm_school_grad_level + ')') : '');
                yearEl.classList.remove('hidden');
            } else {
                yearEl.classList.add('hidden');
            }

            const statusEl = document.getElementById('mStatus');
            if (alumni.alm_current_status) {
                statusEl.textContent = alumni.alm_current_status;
                statusEl.classList.remove('hidden');
            } else {
                statusEl.classList.add('hidden');
            }

            const currentRole = <?= json_encode(session()->get('role')) ?>;
            const currentUserId = <?= json_encode(session()->get('id')) ?>;
            const isOwner = (currentUserId && String(currentUserId) === String(alumni.alm_id));
            const isAdmin = (currentRole === 'admin' || currentRole === 'super_admin');
            const isOwnerOrAdmin = (isOwner || isAdmin);

            // Privacy DB Rules:
            // 1 = Public (เปิดเผย), 0 = Private (ปิดซ่อน)
            // Phone: Default is public (1) unless explicitly set to 0/'0'/'private'
            const isPhonePublic = !(alumni.alm_privacy_phone === 0 || alumni.alm_privacy_phone === '0' || alumni.alm_privacy_phone === 'private');
            const showPhone = isOwnerOrAdmin || isPhonePublic;

            // Email: Default is public (1) unless explicitly set to 0/'0'/'private'
            const isEmailPublic = !(alumni.alm_privacy_email === 0 || alumni.alm_privacy_email === '0' || alumni.alm_privacy_email === 'private');
            const showEmail = isOwnerOrAdmin || isEmailPublic;

            // Address: Default is private (0) unless explicitly set to 1/'1'/'public'
            const isAddressPublic = (alumni.alm_privacy_address == 1 || alumni.alm_privacy_address == '1' || alumni.alm_privacy_address === 'public');
            const showAddress = isOwnerOrAdmin || isAddressPublic;

            // 1. Phone Card Rendering
            const phoneWrap = document.getElementById('mPhoneWrap');
            if (phoneWrap) {
                if (alumni.alm_phone && alumni.alm_phone.trim() !== '') {
                    const phoneEl = document.getElementById('mPhone');
                    const phoneCallBtn = document.getElementById('mPhoneCallBtn');
                    const phoneCopyBtn = document.getElementById('mPhoneCopyBtn');
                    const phonePrivacyBadge = document.getElementById('mPhonePrivacyBadge');

                    if (showPhone) {
                        phoneEl.textContent = alumni.alm_phone;
                        phoneEl.className = 'font-bold text-slate-900 truncate block';
                        if (phoneCallBtn) {
                            phoneCallBtn.href = 'tel:' + alumni.alm_phone.replace(/[^0-9+]/g, '');
                            phoneCallBtn.classList.remove('hidden');
                        }
                        if (phoneCopyBtn) phoneCopyBtn.classList.remove('hidden');

                        if (!isPhonePublic && isOwnerOrAdmin && phonePrivacyBadge) {
                            phonePrivacyBadge.textContent = '🔒 ปิดซ่อน (' + (isOwner ? 'คุณเป็นเจ้าของ' : 'Admin') + ')';
                            phonePrivacyBadge.classList.remove('hidden');
                        } else if (phonePrivacyBadge) {
                            phonePrivacyBadge.classList.add('hidden');
                        }
                    } else {
                        phoneEl.textContent = '🔒 ซ่อนตามการตั้งค่าความเป็นส่วนตัว';
                        phoneEl.className = 'text-xs text-slate-400 font-normal italic truncate block';
                        if (phoneCallBtn) phoneCallBtn.classList.add('hidden');
                        if (phoneCopyBtn) phoneCopyBtn.classList.add('hidden');
                        if (phonePrivacyBadge) phonePrivacyBadge.classList.add('hidden');
                    }
                    phoneWrap.classList.remove('hidden');
                } else {
                    phoneWrap.classList.add('hidden');
                }
            }

            // 2. Email Card Rendering
            const emailWrap = document.getElementById('mEmailWrap');
            if (emailWrap) {
                if (alumni.alm_email && alumni.alm_email.trim() !== '') {
                    const emailEl = document.getElementById('mEmail');
                    const emailSendBtn = document.getElementById('mEmailSendBtn');
                    const emailCopyBtn = document.getElementById('mEmailCopyBtn');
                    const emailPrivacyBadge = document.getElementById('mEmailPrivacyBadge');

                    if (showEmail) {
                        emailEl.textContent = alumni.alm_email;
                        emailEl.className = 'font-bold text-slate-900 truncate block';
                        if (emailSendBtn) {
                            emailSendBtn.href = 'mailto:' + alumni.alm_email;
                            emailSendBtn.classList.remove('hidden');
                        }
                        if (emailCopyBtn) emailCopyBtn.classList.remove('hidden');

                        if (!isEmailPublic && isOwnerOrAdmin && emailPrivacyBadge) {
                            emailPrivacyBadge.textContent = '🔒 ปิดซ่อน (' + (isOwner ? 'คุณเป็นเจ้าของ' : 'Admin') + ')';
                            emailPrivacyBadge.classList.remove('hidden');
                        } else if (emailPrivacyBadge) {
                            emailPrivacyBadge.classList.add('hidden');
                        }
                    } else {
                        emailEl.textContent = '🔒 ซ่อนตามการตั้งค่าความเป็นส่วนตัว';
                        emailEl.className = 'text-xs text-slate-400 font-normal italic truncate block';
                        if (emailSendBtn) emailSendBtn.classList.add('hidden');
                        if (emailCopyBtn) emailCopyBtn.classList.add('hidden');
                        if (emailPrivacyBadge) emailPrivacyBadge.classList.add('hidden');
                    }
                    emailWrap.classList.remove('hidden');
                } else {
                    emailWrap.classList.add('hidden');
                }
            }

            // 3. Line / Social Card Rendering
            const contactOtherWrap = document.getElementById('mContactOtherWrap');
            if (contactOtherWrap) {
                if (alumni.alm_contact_other && alumni.alm_contact_other.trim() !== '') {
                    document.getElementById('mContactOther').textContent = alumni.alm_contact_other;
                    contactOtherWrap.classList.remove('hidden');
                } else {
                    contactOtherWrap.classList.add('hidden');
                }
            }

            // 4. Current Address Card Rendering
            const addressWrap = document.getElementById('mAddressWrap');
            if (addressWrap) {
                if (alumni.alm_current_address && alumni.alm_current_address.trim() !== '') {
                    const addressEl = document.getElementById('mAddress');
                    const addressCopyBtn = document.getElementById('mAddressCopyBtn');
                    const addressPrivacyBadge = document.getElementById('mAddressPrivacyBadge');

                    if (showAddress) {
                        addressEl.textContent = alumni.alm_current_address;
                        addressEl.className = 'font-bold text-slate-900 truncate block';
                        if (addressCopyBtn) addressCopyBtn.classList.remove('hidden');

                        if (!isAddressPublic && isOwnerOrAdmin && addressPrivacyBadge) {
                            addressPrivacyBadge.textContent = '🔒 ปิดซ่อน (' + (isOwner ? 'คุณเป็นเจ้าของ' : 'Admin') + ')';
                            addressPrivacyBadge.classList.remove('hidden');
                        } else if (addressPrivacyBadge) {
                            addressPrivacyBadge.classList.add('hidden');
                        }
                    } else {
                        addressEl.textContent = '🔒 ซ่อนตามการตั้งค่าความเป็นส่วนตัว';
                        addressEl.className = 'text-xs text-slate-400 font-normal italic truncate block';
                        if (addressCopyBtn) addressCopyBtn.classList.add('hidden');
                        if (addressPrivacyBadge) addressPrivacyBadge.classList.add('hidden');
                    }
                    addressWrap.classList.remove('hidden');
                } else {
                    addressWrap.classList.add('hidden');
                }
            }

            // Education & Major
            const eduWrap = document.getElementById('mEducationWrap');
            if (alumni.alm_grad_level || alumni.alm_grad_major || alumni.alm_study_place) {
                document.getElementById('mGradLevel').textContent = alumni.alm_grad_level || (alumni.alm_grad_level_other || 'ศิษย์เก่า');
                document.getElementById('mGradMajor').textContent = alumni.alm_grad_major ? ('(สาขา ' + alumni.alm_grad_major + ')') : '';
                
                const studyPlaceWrap = document.getElementById('mStudyPlaceWrap');
                if (alumni.alm_study_place && alumni.alm_study_place.trim() !== '') {
                    document.getElementById('mStudyPlace').textContent = alumni.alm_study_place;
                    studyPlaceWrap.classList.remove('hidden');
                } else {
                    studyPlaceWrap.classList.add('hidden');
                }
                eduWrap.classList.remove('hidden');
            } else {
                eduWrap.classList.add('hidden');
            }

            // Work Experience
            const expWrap = document.getElementById('mExperienceWrap');
            if (alumni.alm_work_experience && alumni.alm_work_experience.trim() !== '') {
                document.getElementById('mExperience').textContent = alumni.alm_work_experience;
                expWrap.classList.remove('hidden');
            } else {
                expWrap.classList.add('hidden');
            }

            // School Support Needs / Suggestions
            const supportWrap = document.getElementById('mSupportNeedsWrap');
            if (supportWrap) {
                let supportContent = [];
                if (alumni.alm_school_support_needs) supportContent.push('• ต้องการให้โรงเรียนสนับสนุน: ' + alumni.alm_school_support_needs);
                if (alumni.alm_suggestions) supportContent.push('• ข้อเสนอแนะ: ' + alumni.alm_suggestions);
                if (alumni.alm_job_hunt_obstacles) supportContent.push('• อุปสรรคในการทำงาน: ' + alumni.alm_job_hunt_obstacles);

                if (supportContent.length > 0) {
                    document.getElementById('mSupportNeeds').textContent = supportContent.join('\n');
                    supportWrap.classList.remove('hidden');
                } else {
                    supportWrap.classList.add('hidden');
                }
            }

            // Bio
            const bioWrap = document.getElementById('mBioWrap');
            if (alumni.alm_bio && alumni.alm_bio.trim() !== '') {
                document.getElementById('mBio').textContent = alumni.alm_bio;
                bioWrap.classList.remove('hidden');
            } else {
                bioWrap.classList.add('hidden');
            }

            // Direct profile link
            document.getElementById('mDirectLink').href = '<?= base_url("alumni/profile/") ?>/' + alumni.alm_id;

            // Edit button if owner
            const editWrap = document.getElementById('mEditButtonWrap');
            if (currentUserId && String(currentUserId) === String(alumni.alm_id)) {
                editWrap.classList.remove('hidden');
            } else {
                editWrap.classList.add('hidden');
            }

            // Open with animation
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                backdrop.classList.add('opacity-100');
                card.classList.remove('modal-enter');
                card.classList.add('modal-enter-active');
            }, 10);
        }

        function closeProfileModal() {
            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0');
            card.classList.remove('modal-enter-active');
            card.classList.add('modal-exit-active');
            setTimeout(() => {
                modal.classList.add('hidden');
                card.classList.remove('modal-exit-active');
                card.classList.add('modal-enter');
                document.body.style.overflow = '';
            }, 200);
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeProfileModal();
            }
        });

        function confirmLogout(e, url) {
            e.preventDefault();
            Swal.fire({
                title: 'ยืนยันการออกจากระบบ?',
                text: 'คุณต้องการออกจากระบบ SKJ Alumni หรือไม่',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#db2777',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'ออกจากระบบ',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>
</body>
</html>
