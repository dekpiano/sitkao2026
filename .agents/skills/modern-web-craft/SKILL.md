---
name: modern-web-craft
description: >-
  Expert guidelines and workflows for crafting modern, aesthetically stunning, and user-friendly web applications with clean code architecture, intuitive UX hierarchy, and responsive design. Use this skill when designing UI/UX, structuring pages, implementing CodeIgniter/PHP features, refactoring components, or polishing user interactions.
---

# Modern Web Craft & UX Design System

คู่มือมาตรฐานระดับมืออาชีพสำหรับการพัฒนาเว็บไซต์ที่ผสมผสานระหว่าง **ความสวยงามทันสมัย (Modern Visual Aesthetics)**, **โครงสร้างโค้ดที่ถูกต้องปลอดภัย (Clean Code Architecture)**, และ **ประสบการณ์ใช้งานที่เข้าใจง่ายสำหรับผู้ใช้ทั่วไป (Intuitive UX Hierarchy)**

---

## 1. หลักการออกแบบ UX / UI (Human-Centered & Modern Design)

### 1.1 การจัดลำดับสายตาและโครงสร้างหน้าจอ (Visual Hierarchy)
* **Progressive Disclosure**: ในหน้าจอที่มีข้อมูลจำนวนมาก (เช่น แบบสำรวจ หรือแบบฟอร์มลงทะเบียน) ให้แบ่งเป็น **Multi-Step Wizard** ที่ชัดเจน (เช่น ขั้นตอนที่ 1 -> 2 -> 3) แทนการรวมอยู่ในหน้าเดียว เพื่อลดความสับสน
* **Visual Anchors (จุดดึงดูดสายตา)**:
  * **H1 / Page Title**: ใช้ฟอนต์คมชัด (`K2D`, `Inter`) มี Accent Bar หรือไอคอนนำหน้า
  * **Primary Action**: ปุ่มกดหลักต้องโดดเด่น ชัดเจน (เช่น ไล่เฉดสี Gradient, มีเงาตกกระทบแบบ Glow Shadow)
  * **Secondary Action**: ปุ่มรองใช้โทนสีกลาง (Ghost / Outline / Subtle Slate)
* **Touch-Friendly & Spacing**: พื้นที่กด (Click/Touch target) ไม่เล็กกว่า `44px` และเว้นระยะห่าง (`gap`, `padding`) ให้โล่งสบายตา ไม่แออัด

### 1.2 มาตรฐานด้านความสวยงาม (Design Aesthetics)
* **Glassmorphism & Soft Cards**: ใช้การ์ดสีขาวโปร่งแสง (`bg-white/90 backdrop-blur-md`) ผสานขอบบางเนียนตา (`border border-slate-200/70`) และเงาแบบพรีเมียม (`shadow-sm`, `shadow-xl shadow-slate-200/50`)
* **Curated Color Harmonies**:
  * **สกจ. (สวนกุหลาบวิทยาลัย จิรประวัติ)**: ชมพูสดใส (`#ec4899`, `rose-500`) + ฟ้าคราม (`#0ea5e9`, `blue-500`)
  * **จ.ว. (จิรประวัติวิทยาคม)**: น้ำเงินคลาสสิก (`#1d4ed8`, `#3b82f6`, `indigo-700`)
  * **Status Tones**: เขียวมรกต (สำเร็จ/ทำงานแล้ว), แอมเบอร์/ส้ม (ข้อความสำคัญ/รอตรวจสอบ), กุหลาบแดง (แจ้งเตือน/ผิดพลาด)
* **Micro-Animations & Feedback**:
  * Hover & Active states: ขยับเล็กน้อย `hover:-translate-y-0.5 active:scale-95 transition-all`
  * Floating Canvas Particles / Bubbles สำหรับพื้นหลังที่ดูมีชีวิตชีวา
  * SweetAlert2 สำหรับแจ้งเตือนที่สวยงาม ไม่ใช้ `alert()` แบบดั้งเดิม

---

## 2. มาตรฐานการเขียนโปรแกรมและการพัฒนา (Clean Code Architecture)

### 2.1 โครงสร้าง MVC ใน CodeIgniter 4
1. **Model (`app/Models/`)**:
   - กำหนด `$allowedFields` ครบถ้วนทุกคอลัมน์
   - เปิดใช้งาน `$useTimestamps = true` เพื่อบันทึกเวลา `created_at` / `updated_at` เสมอ
2. **Controller (`app/Controllers/`)**:
   - ตรวจสอบสิทธิ์ (Auth/Role Check) ก่อนดำเนินการ
   - แยก Business Logic และการ Validate Input ออกมาอย่างรัดกุม
   - ป้องกัน XSS / SQL Injection ผ่าน Query Builder หรือ ORM
3. **View (`app/Views/`)**:
   - แยก Reusable Partials (เช่น `components/floating_bubbles.php`, `components/navbar.php`)
   - ใช้ `esc()` สำหรับข้อมูลที่ผู้ใช้กรอกเสมอเพื่อป้องกัน XSS
   - ตรวจสอบความสมบูรณ์ของการเปิด-ปิดแท็ก HTML ทุกครั้ง

### 2.2 การตรวจสอบคุณภาพโค้ด (Quality Assurance)
* **Syntax Linter**: ทดสอบความถูกต้องของโค้ดด้วย `php -l <filepath>` เสมอหลังแก้ไข
* **Response Verification**: ทดสอบการส่ง HTTP Request (Status 200) เพื่อยืนยันว่า Route และ Controller ตอบสนองได้สมบูรณ์

---

## 3. Checklist สำหรับการสร้างหน้าจอใหม่ (Step-by-Step Checklist)

เมื่อสร้างหรือปรับปรุงหน้าจอใดๆ ให้ตรวจสอบตาม Checklist ดังนี้:

- [ ] **เข้าใจง่ายใน 3 วินาที**: ผู้ใช้มองแวบแรกแล้วรู้ทันทีว่าหน้านี้คืออะไร และต้องทำอะไรต่อไป
- [ ] **มีตัวอย่างชัดเจน**: มี Placeholder หรือคำอธิบายประกอบในช่องกรอกข้อมูล
- [ ] **ตอบสนองทุกขนาดหน้าจอ (Responsive)**: ใช้งานได้สมบูรณ์ทั้งบนมือถือ (Mobile), แท็บเล็ต, และคอมพิวเตอร์
- [ ] **มีสถานะแจ้งเตือน (Feedback Loop)**: มี Toast หรือ Modal แจ้งเมื่อทำรายการสำเร็จหรือพบข้อผิดพลาด
- [ ] **ปุ่มย้อนกลับ / ทางออกที่ชัดเจน**: มีปุ่มย้อนกลับหรือ Breadcrumb ลิงก์กลับหน้าหลักเสมอ
