<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการผู้ดูแลระบบ (Admin Management) | SKJ Alumni Backoffice</title>
    <link href="https://fonts.googleapis.com/css2?family=K2D:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'K2D', sans-serif; }
    </style>
    <script src="<?= base_url('assets/js/floating-bubbles.js') ?>" defer></script>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen">

    <!-- Top Navbar -->
    <header class="bg-white border-b border-slate-200/80 sticky top-0 z-50 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo & Brand -->
                <div class="flex items-center gap-3">
                    <a href="<?= base_url() ?>" class="flex items-center gap-2.5 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-pink-600 to-rose-400 flex items-center justify-center text-white font-bold text-base shadow-md shadow-pink-500/20 group-hover:scale-105 transition-transform">
                            SKJ
                        </div>
                        <div>
                            <span class="text-sm font-bold text-slate-900 block leading-tight">ระบบบริหารจัดการศิษย์เก่า</span>
                            <span class="text-[11px] font-semibold text-pink-600 block">อบจ.นครสวรรค์ & รร.สวนกุหลาบ (จิรประวัติ)</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center gap-1 bg-slate-100/80 p-1 rounded-xl">
                    <a href="<?= base_url('admin/dashboard') ?>" class="px-4 py-1.5 rounded-lg text-xs font-medium text-slate-600 hover:text-slate-900 transition">แดชบอร์ดสถิติ</a>
                    <a href="<?= base_url('admin/alumni') ?>" class="px-4 py-1.5 rounded-lg text-xs font-medium text-slate-600 hover:text-slate-900 transition">จัดการศิษย์เก่า</a>
                    <a href="<?= base_url('admin/managers') ?>" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-white text-pink-600 shadow-xs">จัดการผู้ดูแลระบบ</a>
                    <a href="<?= base_url('jobs') ?>" class="px-4 py-1.5 rounded-lg text-xs font-medium text-slate-600 hover:text-slate-900 transition">ประกาศงาน</a>
                    <a href="<?= base_url('news') ?>" class="px-4 py-1.5 rounded-lg text-xs font-medium text-slate-600 hover:text-slate-900 transition">ข่าวสาร & กิจกรรม</a>
                </div>

                <!-- Action Controls -->
                <div class="flex items-center gap-3">
                    <a href="<?= base_url('admin/export-survey') ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-sm shadow-emerald-600/20 transition-all hover:scale-105">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Export Excel
                    </a>
                    <a href="<?= base_url() ?>" class="text-xs font-bold text-slate-600 hover:text-pink-600 transition px-3 py-2 rounded-xl hover:bg-slate-100">
                        กลับหน้าหลัก
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Page Title & Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-pink-100 text-pink-700">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Security & Role Management
                    </span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">จัดการผู้ดูแลระบบ (Admin)</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">รายชื่อผู้มีสิทธิ์เข้าถึงระบบจัดการหลังบ้านผ่าน Google Login ทั้งหมด (<?= $totalCount ?> บัญชี)</p>
            </div>

            <!-- Add Admin Button -->
            <?php if ($isSuperAdmin): ?>
            <button type="button" 
                    onclick="openAddAdminModal()"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-pink-600 via-rose-600 to-indigo-600 hover:from-pink-500 hover:to-indigo-500 text-white text-xs sm:text-sm font-bold shadow-md shadow-pink-500/20 transition-all hover:scale-105 active:scale-95 cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                <span>+ เพิ่มผู้ดูแลระบบใหม่</span>
            </button>
            <?php else: ?>
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 border border-slate-200 text-slate-500 text-xs font-semibold">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                <span>สิทธิ์เพิ่ม Admin: เฉพาะ Super Admin</span>
            </div>
            <?php endif; ?>
        </div>

        <!-- Info Notice -->
        <div class="mb-6 p-4 rounded-2xl bg-blue-50/80 border border-blue-100 flex items-start gap-3">
            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div class="text-xs text-blue-900 space-y-1">
                <p class="font-bold">คำแนะนำการเพิ่มผู้ดูแลระบบ (Admin)</p>
                <p class="text-blue-700">สามารถระบุอีเมล Google ของคุณครูหรือเจ้าหน้าที่ (เช่น <code class="bg-blue-100/80 px-1.5 py-0.5 rounded font-mono text-blue-800">name@skj.ac.th</code> หรือ Gmail) เมื่อเพิ่มแล้ว ผู้ใช้ท่านนั้นจะสามารถเข้าสู่ระบบด้วย Google ที่หน้า <a href="<?= base_url('admin/login') ?>" target="_blank" class="underline font-bold hover:text-blue-950">/admin/login</a> ได้ทันที</p>
            </div>
        </div>

        <!-- Admin Table Card -->
        <div class="bg-white rounded-2xl shadow-xs border border-slate-200/80 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-sm font-bold text-slate-800">รายชื่อผู้ดูแลระบบในปัจจุบัน</h2>
                <span class="text-xs text-slate-400 font-medium">ทั้งหมด <?= count($admins) ?> บัญชี</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm text-slate-600">
                    <thead class="bg-slate-50 text-[11px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                        <tr>
                            <th class="py-3 px-6">ผู้ดูแลระบบ</th>
                            <th class="py-3 px-6">อีเมล Google ที่ได้รับสิทธิ์</th>
                            <th class="py-3 px-6">เบอร์โทรศัพท์</th>
                            <th class="py-3 px-6">ระดับสิทธิ์ (Role)</th>
                            <th class="py-3 px-6 text-right">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php if (empty($admins)): ?>
                            <tr>
                                <td colspan="5" class="py-12 text-center text-slate-400">
                                    ไม่พบรายชื่อผู้ดูแลระบบ
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($admins as $adm): ?>
                            <?php 
                                $isCurrent = ($adm['admin_id'] == session()->get('admin_id') || $adm['admin_id'] == session()->get('id')); 
                                $isTargetSuper = ($adm['admin_role'] === 'super_admin');
                            ?>
                            <tr class="hover:bg-slate-50/80 transition-colors <?= $isTargetSuper ? 'bg-amber-50/20' : ($isCurrent ? 'bg-pink-50/30' : '') ?>">
                                <td class="py-4 px-6 font-medium text-slate-900">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-slate-100 overflow-hidden border <?= $isTargetSuper ? 'border-amber-400 ring-2 ring-amber-400/30' : 'border-slate-200' ?> flex-shrink-0 flex items-center justify-center font-bold text-pink-600 text-sm shadow-xs">
                                            <?php if (!empty($adm['admin_image'])): ?>
                                                <img src="<?= esc($adm['admin_image']) ?>" class="w-full h-full object-cover" alt="avatar">
                                            <?php else: ?>
                                                <?= mb_substr($adm['admin_first_name'] ?: $adm['admin_name'] ?: 'A', 0, 1) ?>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-900 flex items-center gap-2">
                                                <?= esc($adm['admin_name'] ?: ($adm['admin_first_name'] . ' ' . $adm['admin_last_name'])) ?>
                                                <?php if ($isCurrent): ?>
                                                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-pink-100 text-pink-700 font-bold border border-pink-200">คุณ</span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="flex items-center gap-1.5 mt-0.5">
                                                <span class="text-[11px] text-slate-500 font-medium">
                                                    <?= esc($adm['admin_department'] ?: 'ผู้ดูแลระบบระบบทำเนียบศิษย์เก่า') ?>
                                                </span>
                                                <?php if (!empty($adm['alumni_id'])): ?>
                                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                        🎓 ศิษย์เก่า (ID: <?= $adm['alumni_id'] ?>)
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 border border-slate-200 text-slate-800 font-mono text-xs">
                                        <svg class="w-3.5 h-3.5 text-red-500" viewBox="0 0 24 24">
                                            <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                                            <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/>
                                            <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 10.03 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                                            <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                                        </svg>
                                        <?= esc($adm['admin_email'] ?: '-') ?>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-slate-600 font-mono">
                                    <?= esc($adm['admin_phone'] ?: '-') ?>
                                </td>
                                <td class="py-4 px-6">
                                    <?php if ($isTargetSuper): ?>
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-amber-500/15 to-orange-500/15 text-amber-800 border border-amber-300">
                                            <svg class="w-3.5 h-3.5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            Super Admin (สูงสุด)
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-pink-500"></span>
                                            Admin ทั่วไป
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <?php if ($isTargetSuper): ?>
                                        <span class="inline-flex items-center gap-1 text-xs font-bold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-lg border border-amber-200">
                                            🔒 บัญชีหลัก (ถาวร)
                                        </span>
                                    <?php elseif ($isCurrent): ?>
                                        <span class="text-xs text-slate-400 italic">ไม่สามารถปลดสิทธิ์ตนเองได้</span>
                                    <?php elseif ($isSuperAdmin): ?>
                                        <button type="button" 
                                                onclick="confirmRemoveAdmin(<?= $adm['admin_id'] ?>, '<?= esc($adm['admin_name']) ?>')"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-rose-600 hover:bg-rose-50 border border-rose-200 transition cursor-pointer">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6" />
                                            </svg>
                                            ปลดสิทธิ์ Admin
                                        </button>
                                    <?php else: ?>
                                        <span class="text-xs text-slate-400">เฉพาะ Super Admin จัดการได้</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- Modal: Add New Admin -->
    <div id="addAdminModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-100 relative animate-in fade-in zoom-in-95 duration-200">
            <!-- Close Button -->
            <button type="button" onclick="closeAddAdminModal()" class="absolute top-6 right-6 text-slate-400 hover:text-slate-600 p-1 rounded-xl hover:bg-slate-100 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <!-- Header -->
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-pink-600 to-indigo-600 flex items-center justify-center text-white shadow-md shadow-pink-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-900">แต่งตั้งผู้ดูแลระบบใหม่</h2>
                    <p class="text-xs text-slate-500">กำหนดสิทธิ์ Admin สำหรับเข้าใช้งานระบบหลังบ้าน</p>
                </div>
            </div>

            <!-- Form -->
            <form action="<?= base_url('admin/managers/add') ?>" method="POST" class="space-y-4">
                <?= csrf_field() ?>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">อีเมล Google (Google Account) <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                        </div>
                        <input type="email" 
                               name="email" 
                               required 
                               placeholder="teacher@skj.ac.th หรือ user@gmail.com" 
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition">
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1">ใช้อีเมลที่ผู้ใช้จะใช้กดปุ่ม Login with Google</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">คำนำหน้า</label>
                        <select name="prefix" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
                            <option value="นาย">นาย</option>
                            <option value="นาง">นาง</option>
                            <option value="นางสาว">นางสาว</option>
                            <option value="ครู">ครู</option>
                            <option value="ดร.">ดร.</option>
                            <option value="อาจารย์">อาจารย์</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">ชื่อจริง <span class="text-rose-500">*</span></label>
                        <input type="text" name="first_name" required placeholder="ชื่อ" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">นามสกุล <span class="text-rose-500">*</span></label>
                        <input type="text" name="last_name" required placeholder="นามสกุล" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">กลุ่มสาระ / หน่วยงาน / หน้าที่</label>
                        <input type="text" name="department" placeholder="เช่น กลุ่มงานสารสนเทศ, ครูแนะแนว" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">เบอร์โทรศัพท์ (ถ้ามี)</label>
                        <input type="text" name="phone" placeholder="08x-xxx-xxxx" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">ระดับสิทธิ์ (Role)</label>
                    <select name="role" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
                        <option value="admin">Admin ทั่วไป (จัดการศิษย์เก่า, งาน, ข่าว)</option>
                        <option value="super_admin">Super Admin (สิทธิ์สูงสุด จัดการรายชื่อ Admin ได้)</option>
                    </select>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button type="button" onclick="closeAddAdminModal()" class="px-4 py-2.5 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition cursor-pointer">
                        ยกเลิก
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-pink-600 to-indigo-600 hover:from-pink-700 hover:to-indigo-700 text-white text-xs sm:text-sm font-bold shadow-md shadow-pink-500/20 transition cursor-pointer">
                        ยืนยันการแต่งตั้ง Admin
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200/80 py-6 mt-16 text-center text-xs text-slate-500">
        <p>© 2026 โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์ | องค์การบริหารส่วนจังหวัดนครสวรรค์</p>
    </footer>

    <!-- SweetAlert2 Alerts & Functions -->
    <script>
        <?php if(session()->getFlashdata('msg')): ?>
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: '<?= addslashes((string)session()->getFlashdata('msg')) ?>',
                confirmButtonColor: '#db2777',
                confirmButtonText: 'ตกลง'
            });
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: '<?= addslashes((string)session()->getFlashdata('error')) ?>',
                confirmButtonColor: '#db2777',
                confirmButtonText: 'ตกลง'
            });
        <?php endif; ?>

        function openAddAdminModal() {
            document.getElementById('addAdminModal').classList.remove('hidden');
        }

        function closeAddAdminModal() {
            document.getElementById('addAdminModal').classList.add('hidden');
        }

        function confirmRemoveAdmin(id, name) {
            Swal.fire({
                title: 'ยืนยันปลดสิทธิ์ Admin?',
                text: `คุณต้องการปลดสิทธิ์ผู้ดูแลระบบของ "${name}" ใช่หรือไม่?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'ใช่, ปลดสิทธิ์',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `<?= base_url('admin/managers/remove') ?>/${id}`;
                }
            });
        }
    </script>
</body>
</html>
