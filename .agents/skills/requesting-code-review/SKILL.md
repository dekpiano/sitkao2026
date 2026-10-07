---
name: requesting-code-review
description: >-
  Use this skill to perform pre-flight code reviews, self-inspections, security audits, and quality checks before committing or completing tasks. Covers security, performance, responsive UI, and regression safety.
---

# Superpowers: Code Review & Quality Checklist

คู่มือการตรวจทานโค้ด (Pre-flight Review) เพื่อรับประกันความปลอดภัย ประสิทธิภาพ และความถูกต้องก่อนส่งมอบงาน

---

## Code Review Checklist

### 1. ความปลอดภัย (Security & Permissions)
- [ ] มีการตรวจสอบสิทธิ์ผู้ใช้ (`isLoggedIn`, Role check) ก่อนประมวลผลข้อมูลสำคัญหรือไม่?
- [ ] มีการ Escape ข้อมูลนำเข้าและส่งออก (`esc()`, parameterized queries) ป้องกัน XSS / SQL Injection หรือไม่?
- [ ] รหัสผ่านถูกแฮชด้วย `password_hash()` อย่างปลอดภัย และไม่หลุดแสดงใน View/Log?

### 2. ความถูกต้องและการจัดการข้อผิดพลาด (Correctness & Robustness)
- [ ] มีการ Validate ข้อมูลนำเข้าครบถ้วน ทั้งฝั่ง Frontend และ Backend?
- [ ] มีการดักจับ Exception หรือแสดง Flash message แจ้งเตือนผู้ใช้เมื่อเกิดข้อผิดพลาดหรือไม่?
- [ ] ผ่านการตรวจสอบ Syntax Linter (`php -l`) ทุกไฟล์โดยไม่มี Warning/Error?

### 3. ประสบการณ์ผู้ใช้และความสวยงาม (UX & Responsive UI)
- [ ] แท็ก HTML เปิดและปิดถูกต้อง สมดุล ไม่ทำให้ Layout เพี้ยน?
- [ ] แสดงผลสวยงามบนทั้ง Desktop, Tablet และ Mobile (Responsive)?
- [ ] ข้อความภาษาไทยสะกดถูกต้อง ชัดเจน และเป็นมิตรกับผู้ใช้งาน?

### 4. ประสิทธิภาพ (Performance)
- [ ] ไม่มี Query ที่ซ้ำซ้อนใน Loop (N+1 Query)?
- [ ] สคริปต์และแอนิเมชันไม่หน่วงเครื่อง (ใช้ `defer`, Canvas loop ที่ pause เมื่อ inactive)?
