<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงประกาศรับสมัครงาน | SKJ Alumni</title>
    <link href="https://fonts.googleapis.com/css2?family=K2D:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style> body { font-family: 'K2D', sans-serif; } </style>
    <script src="<?= base_url('assets/js/floating-bubbles.js') ?>" defer></script>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen py-8 sm:py-12">

    <div class="max-w-3xl mx-auto px-4 sm:px-6">

        <!-- Back Link -->
        <div class="mb-6">
            <a href="<?= base_url('jobs') ?>" class="inline-flex items-center gap-2 text-xs sm:text-sm font-bold text-slate-600 hover:text-pink-600 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                กลับไปกระดานงาน
            </a>
        </div>

        <div class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/80 shadow-sm">
            <div class="border-b border-slate-100 pb-6 mb-6">
                <span class="inline-block px-3 py-1 rounded-full bg-pink-50 text-pink-700 text-xs font-bold mb-2">
                    📢 Post Job Vacancy
                </span>
                <h1 class="text-2xl font-black text-slate-900">ลงประกาศรับสมัครงาน / ฝึกงาน</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">เปิดโอกาสให้ศิษย์เก่าและรุ่นน้องสวนกุหลาบ (จิรประวัติ) ได้ร่วมงานกับองค์กรของคุณ</p>
            </div>

            <form action="<?= base_url('jobs/save') ?>" method="POST" class="space-y-6">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">ชื่อตำแหน่งงาน <span class="text-red-500">*</span></label>
                        <input type="text" name="job_title" required placeholder="เช่น Software Engineer, เจ้าหน้าที่ธุรการ, นักศึกษาฝึกงานการตลาด" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">ชื่อบริษัท / หน่วยงาน <span class="text-red-500">*</span></label>
                        <input type="text" name="job_company" required placeholder="เช่น บจก. เอสเคเจ มีเดีย สตูดิโอ / อบจ.นครสวรรค์" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">สถานที่ปฏิบัติงาน</label>
                        <input type="text" name="job_location" placeholder="เช่น อ.เมือง จ.นครสวรรค์ หรือ Work From Home" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">รูปแบบการจ้างงาน <span class="text-red-500">*</span></label>
                        <select name="job_type" required class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-pink-500 text-sm bg-white outline-none">
                            <option value="Full-time">งานประจำ (Full-time)</option>
                            <option value="Part-time">งานพาร์ตไทม์ (Part-time)</option>
                            <option value="Internship">นักศึกษาฝึกงาน (Internship)</option>
                            <option value="Freelance">ฟรีแลนซ์ / รับงานอิสระ</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">เงินเดือน / อัตราค่าตอบแทน</label>
                        <input type="text" name="job_salary" placeholder="เช่น 18,000 - 25,000 บาท หรือ ตามตกลง" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">รายละเอียดลักษณะงาน <span class="text-red-500">*</span></label>
                    <textarea name="job_description" rows="4" required placeholder="ระบุหน้าที่ความรับผิดชอบหลักของตำแหน่งงานนี้..." class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">คุณสมบัติผู้สมัคร</label>
                    <textarea name="job_qualifications" rows="3" placeholder="เช่น วุฒิการศึกษา, ทักษะที่ต้องมี, ประสบการณ์..." class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm outline-none"></textarea>
                </div>

                <div class="border-t border-slate-100 pt-6">
                    <h3 class="text-sm font-bold text-slate-800 mb-4">ข้อมูลผู้ติดต่อ / วิธีการสมัครงาน</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">ชื่อผู้ติดต่อ / แผนก <span class="text-red-500">*</span></label>
                            <input type="text" name="job_contact" required placeholder="เช่น ฝ่ายทรัพยากรบุคคล (HR)" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-pink-500 text-sm outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">อีเมลติดต่อ / ส่ง Resume</label>
                            <input type="email" name="job_contact_email" placeholder="hr@company.com" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-pink-500 text-sm outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">เบอร์โทรติดต่อ</label>
                            <input type="tel" name="job_contact_phone" placeholder="08x-xxx-xxxx" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-pink-500 text-sm outline-none">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4">
                    <a href="<?= base_url('jobs') ?>" class="px-5 py-2.5 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition">ยกเลิก</a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-pink-600 to-rose-500 hover:from-pink-700 hover:to-rose-600 text-white text-xs sm:text-sm font-bold shadow-md shadow-pink-500/20 transition">
                        ยืนยันการลงประกาศงาน
                    </button>
                </div>
            </form>
        </div>
    </div>

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
