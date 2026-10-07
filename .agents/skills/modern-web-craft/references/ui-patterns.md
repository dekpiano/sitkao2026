# UI & UX Component Patterns

คู่มือรูปแบบและ Template ส่วนประกอบหน้าจอที่ใช้งานง่ายสำหรับผู้ใช้ทั่วไป:

## 1. Card & Container Pattern
```html
<div class="bg-white/95 backdrop-blur-md rounded-3xl p-6 sm:p-8 border border-slate-200/70 shadow-xl shadow-slate-200/50 hover:shadow-2xl transition-all duration-300">
    <div class="flex items-center gap-3 mb-4 pb-3 border-b border-slate-100">
        <div class="w-2 h-6 bg-gradient-to-b from-pink-500 to-blue-500 rounded-full"></div>
        <h3 class="text-lg font-bold text-slate-900">หัวข้อการ์ด</h3>
    </div>
    <!-- Card Content -->
</div>
```

## 2. Interactive Button Pattern
```html
<!-- Primary Action Button -->
<button class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-pink-600 via-pink-500 to-blue-600 hover:opacity-95 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-pink-500/25 transition-all duration-200 active:scale-95 cursor-pointer">
    <span>บันทึกข้อมูล</span>
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
</button>

<!-- Secondary Ghost Button -->
<button class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 px-5 py-3 text-sm font-bold transition active:scale-95 cursor-pointer">
    ย้อนกลับ
</button>
```

## 3. SweetAlert2 Notification Standards
```javascript
// Success Alert
Swal.fire({
    icon: 'success',
    title: 'บันทึกสำเร็จ!',
    text: 'ข้อมูลของคุณได้รับการอัปเดตเรียบร้อยแล้ว',
    confirmButtonColor: '#059669',
    confirmButtonText: 'ตกลง',
    customClass: {
        popup: 'rounded-3xl p-6',
        confirmButton: 'rounded-xl px-6 py-2.5 font-bold'
    }
});
```
