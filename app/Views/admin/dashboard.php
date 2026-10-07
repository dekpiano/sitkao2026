<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แดชบอร์ดผู้ดูแลระบบ | SKJ Alumni Backoffice</title>
    <link href="https://fonts.googleapis.com/css2?family=K2D:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
                    <a href="<?= base_url('admin/dashboard') ?>" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-white text-pink-600 shadow-xs">แดชบอร์ดสถิติ</a>
                    <a href="<?= base_url('admin/alumni') ?>" class="px-4 py-1.5 rounded-lg text-xs font-medium text-slate-600 hover:text-slate-900 transition">จัดการศิษย์เก่า</a>
                    <a href="<?= base_url('admin/managers') ?>" class="px-4 py-1.5 rounded-lg text-xs font-medium text-slate-600 hover:text-slate-900 transition">จัดการผู้ดูแลระบบ</a>
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

        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-pink-50 border border-pink-100 text-pink-700 text-xs font-bold mb-2">
                    <span class="w-2 h-2 rounded-full bg-pink-500 animate-pulse"></span>
                    รายงานวิเคราะห์แบบสำรวจภาวะการมีงานทำ
                </div>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900">แดชบอร์ดสรุปสถิติและข้อมูลศิษย์เก่า</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">สรุปข้อมูลเพื่อการวางแผนสนับสนุนด้านอาชีพและการศึกษาต่อ สังกัด อบจ.นครสวรรค์</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="<?= base_url('admin/managers') ?>" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-slate-900 hover:bg-slate-800 text-white text-xs sm:text-sm font-bold shadow-md transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    จัดการผู้ดูแลระบบ
                </a>
                <a href="<?= base_url('admin/export-survey') ?>" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-xs sm:text-sm font-bold shadow-md shadow-emerald-500/20 hover:shadow-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    ส่งออก Excel
                </a>
            </div>
        </div>

        <!-- 4 KPI Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            <!-- Total Alumni -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs relative overflow-hidden group hover:border-pink-300 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">ศิษย์เก่าทั้งหมดในระบบ</span>
                    <div class="w-12 h-12 rounded-2xl bg-pink-50 text-pink-600 flex items-center justify-center font-black">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl sm:text-4xl font-black text-slate-900"><?= number_format($totalAlumni) ?></span>
                    <span class="text-xs font-semibold text-slate-500">คน</span>
                </div>
                <div class="mt-3 flex items-center gap-1.5 text-xs font-bold text-emerald-600">
                    <span>✓ ลงทะเบียนครบทุกรุ่น</span>
                </div>
            </div>

            <!-- Employed -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs relative overflow-hidden group hover:border-emerald-300 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">มีงานทำแล้ว</span>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl sm:text-4xl font-black text-emerald-600"><?= number_format($employedCount) ?></span>
                    <span class="text-xs font-semibold text-slate-500">คน (<?= $totalAlumni > 0 ? round(($employedCount / $totalAlumni) * 100, 1) : 0 ?>%)</span>
                </div>
                <div class="mt-3 flex items-center gap-1 text-xs font-medium text-slate-500">
                    <span>อัตราการได้งานทำของศิษย์เก่า</span>
                </div>
            </div>

            <!-- Studying -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs relative overflow-hidden group hover:border-blue-300 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">กำลังศึกษาต่อ</span>
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center font-black">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl sm:text-4xl font-black text-blue-600"><?= number_format($studyingCount) ?></span>
                    <span class="text-xs font-semibold text-slate-500">คน (<?= $totalAlumni > 0 ? round(($studyingCount / $totalAlumni) * 100, 1) : 0 ?>%)</span>
                </div>
                <div class="mt-3 flex items-center gap-1 text-xs font-medium text-slate-500">
                    <span>ศึกษาต่อระดับ ป.ตรี / ปวส.</span>
                </div>
            </div>

            <!-- Unemployed / Job Seekers -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs relative overflow-hidden group hover:border-rose-300 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">ว่างงาน / หางาน</span>
                    <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center font-black">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl sm:text-4xl font-black text-rose-600"><?= number_format($unemployedCount) ?></span>
                    <span class="text-xs font-semibold text-slate-500">คน (<?= $totalAlumni > 0 ? round(($unemployedCount / $totalAlumni) * 100, 1) : 0 ?>%)</span>
                </div>
                <div class="mt-3 flex items-center gap-1 text-xs font-medium text-rose-600 font-bold">
                    <span>เป้าหมาย อบจ. ช่วยเหลือ</span>
                </div>
            </div>
        </div>

        <!-- School Representation Card (จ.ว. vs สกจ.) -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
                <div>
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span>🏛️</span>
                        <span>สัดส่วนศิษย์เก่าแยกตามสังกัดสถาบัน</span>
                    </h3>
                    <p class="text-xs text-slate-500">เปรียบเทียบผู้ลงทะเบียนระหว่าง โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์ และ โรงเรียนจิรประวัติวิทยาคม</p>
                </div>
                <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-pink-50 text-pink-700 border border-pink-200">
                        <span class="w-2 h-2 rounded-full bg-pink-500"></span>
                        สกจ.: <?= number_format($skjCount ?? 0) ?> คน (<?= $totalAlumni > 0 ? round(($skjCount / $totalAlumni) * 100, 1) : 0 ?>%)
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                        <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                        จ.ว.: <?= number_format($jwCount ?? 0) ?> คน (<?= $totalAlumni > 0 ? round(($jwCount / $totalAlumni) * 100, 1) : 0 ?>%)
                    </span>
                </div>
            </div>

            <!-- Visual Progress Bar -->
            <div class="w-full bg-slate-100 h-3.5 rounded-full overflow-hidden flex shadow-inner">
                <?php 
                    $skjPercent = $totalAlumni > 0 ? round(($skjCount / $totalAlumni) * 100, 1) : 50;
                    $jwPercent  = $totalAlumni > 0 ? round(($jwCount / $totalAlumni) * 100, 1) : 50;
                ?>
                <div class="h-full bg-gradient-to-r from-pink-500 to-rose-500 transition-all duration-500" style="width: <?= $skjPercent ?>%" title="สวนกุหลาบฯ จิรประวัติ: <?= $skjPercent ?>%"></div>
                <div class="h-full bg-gradient-to-r from-blue-600 to-indigo-700 transition-all duration-500" style="width: <?= $jwPercent ?>%" title="จิรประวัติวิทยาคม: <?= $jwPercent ?>%"></div>
            </div>
        </div>

        <!-- 2 Main Analytics Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-8">
            
            <!-- Donut Chart: Status Breakdown -->
            <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-slate-900">สัดส่วนภาวะการมีงานทำ</h3>
                        <p class="text-xs text-slate-400">Employment Status Breakdown</p>
                    </div>
                </div>
                <div id="statusChart" class="min-h-[300px] flex items-center justify-center"></div>
            </div>

            <!-- Bar Chart: Top Support Needs for PAO & School -->
            <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-slate-900">สิ่งที่ศิษย์เก่าต้องการให้ อบจ. & รร. ช่วยเหลือ</h3>
                        <p class="text-xs text-slate-400">Top Requested Support from PAO Nakhon Sawan</p>
                    </div>
                    <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200">
                        ประเด็นสำคัญ 📌
                    </span>
                </div>
                <div id="supportChart" class="min-h-[300px]"></div>
            </div>

        </div>

        <!-- Recent Registered Alumni Table -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs mb-8">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100 flex-wrap gap-4">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">ศิษย์เก่าที่ลงทะเบียนล่าสุด</h3>
                    <p class="text-xs text-slate-400">รายชื่อศิษย์เก่า 10 คนล่าสุดที่ลงทะเบียนแบบสำรวจ</p>
                </div>
                <a href="<?= base_url('admin/alumni') ?>" class="text-xs font-bold text-pink-600 hover:text-pink-700 inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-pink-50 hover:bg-pink-100 transition">
                    ดูรายชื่อศิษย์เก่าทั้งหมด
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm">
                    <thead>
                        <tr class="text-slate-400 font-bold border-b border-slate-100 text-[11px] uppercase">
                            <th class="pb-3 px-3">ศิษย์เก่า</th>
                            <th class="pb-3 px-3">รุ่น / ปีจบ</th>
                            <th class="pb-3 px-3">สถานภาพ</th>
                            <th class="pb-3 px-3">ตำแหน่ง / สถานศึกษา</th>
                            <th class="pb-3 px-3">สิทธิ์</th>
                            <th class="pb-3 px-3 text-right">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php foreach ($recentAlumni as $alm): ?>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3 px-3">
                                <div class="flex items-center gap-3">
                                    <img src="<?= esc($alm['alm_image'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($alm['alm_name']) . '&background=random&color=fff&size=80') ?>" class="w-9 h-9 rounded-xl object-cover">
                                    <div>
                                        <a href="<?= base_url('alumni/profile/' . $alm['alm_id']) ?>" class="font-bold text-slate-900 hover:text-pink-600 block leading-tight">
                                            <?= esc($alm['alm_name']) ?>
                                        </a>
                                        <span class="text-[11px] text-slate-400"><?= esc($alm['alm_email']) ?></span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-3">
                                <span class="font-semibold text-slate-700 block"><?= esc($alm['alm_batch']) ?></span>
                                <span class="text-[11px] text-slate-400">ปีการศึกษา <?= esc($alm['alm_grad_year']) ?></span>
                            </td>
                            <td class="py-3 px-3">
                                <?php if (strpos($alm['alm_current_status'] ?? '', 'ทำงานแล้ว') !== false): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">ทำงานแล้ว</span>
                                <?php elseif (strpos($alm['alm_current_status'] ?? '', 'กำลังศึกษาต่อ') !== false): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-blue-50 text-blue-700 border border-blue-200">กำลังศึกษาต่อ</span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-200">ว่างงาน / หางาน</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3 px-3">
                                <span class="text-slate-800 font-medium block truncate max-w-[200px]"><?= esc($alm['alm_job_title'] ?: ($alm['alm_study_place'] ?: '-')) ?></span>
                                <span class="text-[11px] text-slate-400"><?= esc($alm['alm_grad_major'] ?: '-') ?></span>
                            </td>
                            <td class="py-3 px-3">
                                <span class="text-[11px] font-bold px-2 py-0.5 rounded-md <?= ($alm['alm_role'] ?? 'alumni') === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-slate-100 text-slate-600' ?>">
                                    <?= ($alm['alm_role'] ?? 'alumni') === 'admin' ? 'Admin' : 'Alumni' ?>
                                </span>
                            </td>
                            <td class="py-3 px-3 text-right">
                                <a href="<?= base_url('alumni/profile/' . $alm['alm_id']) ?>" class="text-xs font-bold text-slate-500 hover:text-pink-600 px-2.5 py-1 rounded-lg hover:bg-pink-50 transition">
                                    ดูโปรไฟล์
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- ApexCharts Scripts -->
    <script>
        // Status Breakdown Donut Chart
        const statusOptions = {
            series: [
                <?= $statusBreakdown['employed'] ?>, 
                <?= $statusBreakdown['studying'] ?>, 
                <?= $statusBreakdown['unemployed'] ?>, 
                <?= $statusBreakdown['other'] ?>
            ],
            labels: ['ทำงานแล้ว', 'กำลังศึกษาต่อ', 'ว่างงาน / กำลังหางาน', 'อื่นๆ'],
            colors: ['#10b981', '#3b82f6', '#f43f5e', '#94a3b8'],
            chart: {
                type: 'donut',
                height: 320,
                fontFamily: 'K2D, sans-serif'
            },
            legend: {
                position: 'bottom'
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'รวมศิษย์เก่า',
                                fontSize: '13px',
                                fontFamily: 'K2D, sans-serif',
                                color: '#64748b'
                            }
                        }
                    }
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val.toFixed(1) + "%";
                }
            }
        };
        const statusChart = new ApexCharts(document.querySelector("#statusChart"), statusOptions);
        statusChart.render();

        // Support Needs Bar Chart
        const supportCategories = <?= json_encode(array_keys($topSupportNeeds), JSON_UNESCAPED_UNICODE) ?>;
        const supportData = <?= json_encode(array_values($topSupportNeeds)) ?>;

        const supportOptions = {
            series: [{
                name: 'จำนวนศิษย์เก่าที่ระบุ (คน)',
                data: supportData
            }],
            chart: {
                type: 'bar',
                height: 320,
                fontFamily: 'K2D, sans-serif',
                toolbar: { show: false }
            },
            colors: ['#db2777'],
            plotOptions: {
                bar: {
                    borderRadius: 8,
                    horizontal: true,
                    dataLabels: { position: 'top' }
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) { return val + " คน"; },
                offsetX: 25,
                style: { fontSize: '11px', colors: ['#475569'] }
            },
            xaxis: {
                categories: supportCategories
            },
            grid: {
                borderColor: '#f1f5f9'
            }
        };
        const supportChart = new ApexCharts(document.querySelector("#supportChart"), supportOptions);
        supportChart.render();
    </script>
</body>
</html>
