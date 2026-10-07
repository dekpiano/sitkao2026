<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลศิษย์เก่า | SKJ Admin Backoffice</title>
    <link href="https://fonts.googleapis.com/css2?family=K2D:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style> body { font-family: 'K2D', sans-serif; } </style>
    <script src="<?= base_url('assets/js/floating-bubbles.js') ?>" defer></script>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen">

    <!-- Top Navbar -->
    <header class="bg-white border-b border-slate-200/80 sticky top-0 z-50 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <a href="<?= base_url() ?>" class="flex items-center gap-2.5 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-pink-600 to-rose-400 flex items-center justify-center text-white font-bold text-base shadow-md shadow-pink-500/20">
                            SKJ
                        </div>
                        <div>
                            <span class="text-sm font-bold text-slate-900 block leading-tight">ระบบบริหารจัดการศิษย์เก่า</span>
                            <span class="text-[11px] font-semibold text-pink-600 block">อบจ.นครสวรรค์ & สกจ.</span>
                        </div>
                    </a>
                </div>

                <div class="hidden md:flex items-center gap-1 bg-slate-100/80 p-1 rounded-xl">
                    <a href="<?= base_url('admin/dashboard') ?>" class="px-4 py-1.5 rounded-lg text-xs font-medium text-slate-600 hover:text-slate-900 transition">แดชบอร์ดสถิติ</a>
                    <a href="<?= base_url('admin/alumni') ?>" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-white text-pink-600 shadow-xs">จัดการศิษย์เก่า</a>
                    <a href="<?= base_url('admin/managers') ?>" class="px-4 py-1.5 rounded-lg text-xs font-medium text-slate-600 hover:text-slate-900 transition">จัดการผู้ดูแลระบบ</a>
                    <a href="<?= base_url('jobs') ?>" class="px-4 py-1.5 rounded-lg text-xs font-medium text-slate-600 hover:text-slate-900 transition">ประกาศงาน</a>
                    <a href="<?= base_url('news') ?>" class="px-4 py-1.5 rounded-lg text-xs font-medium text-slate-600 hover:text-slate-900 transition">ข่าวสาร & กิจกรรม</a>
                </div>

                <div class="flex items-center gap-3">
                    <a href="<?= base_url('admin/export-survey') ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition">
                        Export CSV
                    </a>
                    <a href="<?= base_url() ?>" class="text-xs font-bold text-slate-600 hover:text-pink-600 px-3 py-2 rounded-xl hover:bg-slate-100">
                        หน้าหลัก
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-black text-slate-900">จัดการข้อมูลทำเนียบศิษย์เก่า</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-0.5">ค้นหา กรอง และจัดการสิทธิ์ผู้ใช้งานในระบบ (ทั้งหมด <?= number_format($totalCount) ?> รายชื่อ)</p>
            </div>
            <a href="<?= base_url('admin/export-survey') ?>" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 text-white text-xs font-bold shadow-xs hover:bg-emerald-700 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Export Excel รายละเอียดแบบสำรวจ
            </a>
        </div>

        <!-- Filter & Search Bar -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/80 shadow-xs mb-6">
            <form action="<?= base_url('admin/alumni') ?>" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                <div class="sm:col-span-4">
                    <input type="text" name="search" value="<?= esc($search ?? '') ?>" placeholder="ค้นหาด้วยชื่อ, อีเมล, เบอร์โทร, อาชีพ, สาขาวิชา..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-xs sm:text-sm outline-none">
                </div>
                <div class="sm:col-span-3">
                    <select name="school" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 text-xs sm:text-sm bg-white outline-none">
                        <option value="">-- ทุกสถาบัน (จ.ว. / สกจ.) --</option>
                        <option value="skj" <?= ($school ?? '') === 'skj' ? 'selected' : '' ?>>🌸 สวนกุหลาบฯ จิรประวัติ (สกจ.)</option>
                        <option value="jw" <?= ($school ?? '') === 'jw' ? 'selected' : '' ?>>🏫 จิรประวัติวิทยาคม (จ.ว.)</option>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <select name="batch" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 text-xs sm:text-sm bg-white outline-none">
                        <option value="">-- ทุกรุ่นที่จบ --</option>
                        <?php foreach ($allBatches as $b): ?>
                            <option value="<?= esc($b['alm_batch']) ?>" <?= ($batch ?? '') === $b['alm_batch'] ? 'selected' : '' ?>><?= esc($b['alm_batch']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <select name="status" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-pink-500 text-xs sm:text-sm bg-white outline-none">
                        <option value="">-- ทุกสถานภาพ --</option>
                        <option value="ทำงานแล้ว" <?= ($status ?? '') === 'ทำงานแล้ว' ? 'selected' : '' ?>>ทำงานแล้ว</option>
                        <option value="กำลังศึกษาต่อ" <?= ($status ?? '') === 'กำลังศึกษาต่อ' ? 'selected' : '' ?>>กำลังศึกษาต่อ</option>
                        <option value="ว่างงาน" <?= ($status ?? '') === 'ว่างงาน' ? 'selected' : '' ?>>ว่างงาน</option>
                    </select>
                </div>
                <div class="sm:col-span-1 flex gap-1">
                    <button type="submit" class="flex-1 px-3 py-2.5 rounded-xl bg-pink-600 hover:bg-pink-700 text-white text-xs font-bold shadow-xs transition" title="ค้นหา">
                        🔍
                    </button>
                    <a href="<?= base_url('admin/alumni') ?>" class="px-2.5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold transition flex items-center justify-center" title="รีเซ็ต">
                        ✕
                    </a>
                </div>
            </form>
        </div>

        <!-- Table Container -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm">
                    <thead>
                        <tr class="bg-slate-50/80 text-slate-400 font-bold border-b border-slate-100 text-[11px] uppercase">
                            <th class="py-3.5 px-4">#</th>
                            <th class="py-3.5 px-4">ศิษย์เก่า</th>
                            <th class="py-3.5 px-4">สถาบัน / รุ่น</th>
                            <th class="py-3.5 px-4">สถานภาพ & อาชีพ</th>
                            <th class="py-3.5 px-4">ติดต่อ</th>
                            <th class="py-3.5 px-4 text-center">สิทธิ์ผู้ใช้</th>
                            <th class="py-3.5 px-4 text-right">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php if (empty($alumniList)): ?>
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400 font-medium">
                                ไม่พบข้อมูลศิษย์เก่าตามเงื่อนไขที่ค้นหา
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php foreach ($alumniList as $alm): ?>
                        <?php 
                            $schName = $alm['alm_school'] ?? 'โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์';
                            $isJW = (strpos($schName, 'จิรประวัติวิทยาคม') !== false);
                        ?>
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-3.5 px-4 font-mono text-slate-400 text-xs">
                                <?= $alm['alm_id'] ?>
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-3">
                                    <img src="<?= esc($alm['alm_image'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($alm['alm_name']) . '&background=random&color=fff&size=80') ?>" class="w-10 h-10 rounded-2xl object-cover border border-slate-200">
                                    <div>
                                        <div class="font-bold text-slate-900"><?= esc($alm['alm_name']) ?></div>
                                        <div class="text-[11px] text-slate-400"><?= esc($alm['alm_email']) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-1.5 mb-0.5">
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-black <?= $isJW ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'bg-pink-50 text-pink-700 border border-pink-200' ?>">
                                        <?= $isJW ? 'จ.ว.' : 'สกจ.' ?>
                                    </span>
                                    <span class="font-semibold text-slate-800"><?= esc($alm['alm_batch']) ?></span>
                                </div>
                                <div class="text-[11px] text-slate-400">จบปี <?= esc($alm['alm_grad_year']) ?> (<?= esc($alm['alm_school_grad_level'] ?: ($alm['alm_grad_level'] ?: 'ม.6')) ?>)</div>
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="font-medium text-slate-900"><?= esc($alm['alm_job_title'] ?: ($alm['alm_study_place'] ?: '-')) ?></div>
                                <div>
                                    <?php if (strpos($alm['alm_current_status'] ?? '', 'ทำงานแล้ว') !== false): ?>
                                        <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">ทำงานแล้ว</span>
                                    <?php elseif (strpos($alm['alm_current_status'] ?? '', 'กำลังศึกษาต่อ') !== false): ?>
                                        <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full border border-blue-200">ศึกษาต่อ</span>
                                    <?php else: ?>
                                        <span class="text-[10px] font-bold text-rose-600 bg-rose-50 px-2 py-0.5 rounded-full border border-rose-200">ว่างงาน / หางาน</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 font-mono text-xs text-slate-600">
                                <div><?= esc($alm['alm_phone'] ?: '-') ?></div>
                                <div class="text-[11px] text-slate-400"><?= esc($alm['alm_contact_other'] ?: '-') ?></div>
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <?php if (($alm['alm_role'] ?? 'alumni') === 'super_admin'): ?>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-100 text-amber-800 border border-amber-300">
                                        ⭐ Super Admin
                                    </span>
                                <?php else: ?>
                                    <a href="<?= base_url('admin/alumni/toggle-role/' . $alm['alm_id']) ?>" title="คลิกเพื่อสลับสิทธิ์ Admin/Alumni" class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold <?= ($alm['alm_role'] ?? 'alumni') === 'admin' ? 'bg-purple-100 text-purple-700 hover:bg-purple-200' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' ?> transition">
                                        <?= ($alm['alm_role'] ?? 'alumni') === 'admin' ? '★ Admin' : 'Alumni' ?>
                                    </a>
                                <?php endif; ?>
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="<?= base_url('alumni/profile/' . $alm['alm_id']) ?>" class="p-1.5 rounded-lg text-slate-500 hover:text-pink-600 hover:bg-pink-50 transition" title="ดูหน้าโปรไฟล์">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    <button onclick="confirmDelete(<?= $alm['alm_id'] ?>, '<?= esc(addslashes($alm['alm_name'])) ?>')" class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition" title="ลบข้อมูล">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if (isset($pager)): ?>
            <div class="p-4 border-t border-slate-100 flex justify-center">
                <?= $pager->links() ?>
            </div>
            <?php endif; ?>
        </div>

    </main>

    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'ยืนยันการลบข้อมูล?',
                text: `คุณต้องการลบข้อมูลศิษย์เก่า "${name}" ออกจากระบบใช่หรือไม่`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'ใช่, ลบข้อมูล',
                cancelButtonText: 'ยกเลิก',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl px-5 py-2 font-bold',
                    cancelButton: 'rounded-xl px-5 py-2 font-bold'
                }
            }).then((res) => {
                if (res.isConfirmed) {
                    window.location.href = `<?= base_url('admin/alumni/delete/') ?>/${id}`;
                }
            });
        }
    </script>
</body>
</html>
