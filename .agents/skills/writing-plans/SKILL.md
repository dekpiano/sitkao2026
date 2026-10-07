---
name: writing-plans
description: >-
  Use this skill when designing multi-step implementation roadmaps, refactoring large modules, or planning complex database migrations and feature rollouts. Ensures all tasks have clear verification criteria.
---

# Superpowers: Structured Implementation Planning

คู่มือการวางแผนพัฒนาฟังก์ชันขนาดกลาง-ใหญ่ (Implementation Roadmap) เพื่อให้การทำงานมีทิศทางที่ชัดเจนและวัดผลได้ทุกขั้นตอน

---

## 1. โครงสร้างของแผนงานที่ดี (Plan Structure)

แผนงานทุกฉบับควรประกอบด้วยองค์ประกอบสำคัญดังนี้:

### 1. บทนำและเป้าหมาย (Overview & Objectives)
- อธิบายสั้นๆ ว่ากำลังจะทำอะไร และผลลัพธ์สุดท้ายคืออะไร

### 2. ผลกระทบต่อไฟล์และฐานข้อมูล (Impact Analysis)
- รายการไฟล์ที่จะสร้างใหม่ หรือแก้ไข
- รายการตาราง/คอลัมน์ใน Database ที่จะมีการ Migration

### 3. ขั้นตอนการลงมือทำทีละส่วน (Task-by-Task Breakdown)
แบ่งงานออกเป็นชิ้นเล็กๆ ที่ทำเสร็จได้ในแต่ละสเต็ป:
```markdown
### Task 1: [ชื่อขั้นตอน เช่น สร้าง Database Migration]
- **ไฟล์ที่เกี่ยวข้อง**: `app/Database/Migrations/...`
- **สิ่งที่ต้องทำ**: เพิ่มคอลัมน์ `xxx` พร้อม default value
- **วิธีตรวจสอบ (Verification)**: รัน `php spark migrate` และตรวจสอบ schema ผ่าน MySQL

### Task 2: [ชื่อขั้นตอน เช่น พัฒนา Backend Controller]
- **ไฟล์ที่เกี่ยวข้อง**: `app/Controllers/...`
- **สิ่งที่ต้องทำ**: เพิ่มฟังก์ชัน `saveData()` และ Validation rules
- **วิธีตรวจสอบ (Verification)**: ทดสอบยิง Request และรัน `php -l`
```

### 4. แผนรองรับข้อผิดพลาด (Rollback / Fallback Plan)
- หากเกิดข้อผิดพลาด สามารถกู้คืนสถานะเดิมได้อย่างไร
