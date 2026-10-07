---
name: systematic-debugging
description: >-
  Use this skill whenever investigating bugs, unexpected errors, visual/CSS glitches, broken endpoints, or performance degradation. Follows a disciplined 4-phase root cause analysis methodology.
---

# Superpowers: Systematic Debugging Framework

กระบวนการค้นหาและแก้ไข Bug อย่างมีแบบแผน 4 ขั้นตอน (Four-Phase Root Cause Analysis) โดยหลีกเลี่ยงการเดาสุ่ม

---

## 4-Phase Debugging Methodology

### Phase 1: Reproduce & Isolate (จำลองปัญหาและจำกัดขอบเขต)
1. **สร้างเงื่อนไขจำลองปัญหา (Reproduction)**: ระบุขั้นตอน, URL, ข้อมูลนำเข้า, หรือ Request ที่ทำให้เกิดข้อผิดพลาด
2. **เก็บหลักฐานจริง (Evidence Gathering)**:
   - ตรวจสอบ Error log (`writable/logs/`, Web server logs, Browser Console)
   - ตรวจสอบ HTTP Status Code (เช่น 404, 500, Token mismatch)
3. **ตัดตัวแปรที่ไม่เกี่ยวข้องออก (Isolate)**: แยกแยะว่าเป็นปัญหาที่ Database, Backend Controller, Routing, หรือ Frontend View/CSS

### Phase 2: Formulate Hypotheses (ตั้งสมมติฐานตามหลักฐาน)
- ตั้งสมมติฐานอย่างน้อย 1-3 ข้อที่เป็นไปได้จริง
  - *ตัวอย่าง*: "แท็กปิด `</div>` หายไปทำให้ Layout พัง" หรือ "Foreign key ใน DB ไม่ตรงทำให้ Query ไม่พบข้อมูล"
- เรียงลำดับสมมติฐานจากจุดที่ตรวจพบง่ายและเป็นไปได้มากที่สุด

### Phase 3: Test Hypotheses (พิสูจน์สมมติฐานโดยไม่แก้ไขมั่ว)
- ใช้เครื่องมือตรวจสอบเฉพาะจุด (เช่น Linter `php -l`, Unit test, Log dump, หรือ DOM inspect)
- ยืนยันว่าสมมติฐานข้อใดคือ **Root Cause (ต้นตอที่แท้จริง)**

### Phase 4: Minimal & Clean Fix + Regression Verification
1. **แก้ไขที่ต้นเหตุอย่างตรงจุด**: แก้ไขเฉพาะส่วนที่ทำให้เกิดปัญหา ไม่แก้หว่านจนกระทบโค้ดส่วนอื่น
2. **ทดสอบซ้ำ (Verify)**: ทดสอบเงื่อนไขเดิมว่าปัญหาหายไปแล้ว
3. **ตรวจสอบผลกระทบข้างเคียง (Regression Check)**: ตรวจสอบหน้าจอหรือฟังก์ชันใกล้เคียงว่ายังทำงานได้ตามปกติ
