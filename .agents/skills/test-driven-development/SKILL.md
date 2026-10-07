---
name: test-driven-development
description: >-
  Use this skill when implementing critical business logic, calculations, API endpoints, or database operations requiring high reliability and test coverage. Enforces TDD Red-Green-Refactor cycle.
---

# Superpowers: Test-Driven Development (TDD) Workflow

แนวทางการพัฒนาซอฟต์แวร์ด้วยการเขียนชุดทดสอบก่อนลงมือเขียนโค้ดจริง (TDD Cycle) เพื่อความแม่นยำและป้องกันข้อผิดพลาดในระยะยาว

---

## The TDD Cycle (Red -> Green -> Refactor)

```text
┌──────────────┐      ┌──────────────┐      ┌──────────────┐
│   1. RED     │ ───> │  2. GREEN    │ ───> │ 3. REFACTOR  │
│ เขียน Test   │      │ เขียนโค้ดให้ │      │ จัดโค้ดให้   │
│ ให้รันไม่ผ่าน │      │ Test ผ่าน    │      │ สะอาด/เร็วขึ้น │
└──────────────┘      └──────────────┘      └──────────────┘
       ▲                                            │
       └────────────────────────────────────────────┘
```

---

## 3 ขั้นตอนหลักในการทำ TDD

### 1. RED (เขียน Test ให้ล้มเหลว)
- กำหนดกรณีทดสอบ (Test Case) ตามความต้องการจริง เช่น:
  - กรณีข้อมูลถูกต้อง (Happy path)
  - กรณีข้อมูลไม่ถูกต้อง หรือรูปแบบผิด (Invalid input)
  - กรณีสิทธิ์ไม่เพียงพอ (Unauthorized access)
- รันชุดทดสอบเพื่อยืนยันว่า Test ทำงานถูกต้องและกำลัง "ตก (Fail)" เพราะยังไม่มีโค้ดมารองรับ

### 2. GREEN (เขียนโค้ดที่เรียบง่ายที่สุดให้ผ่าน)
- เขียนโค้ดเฉพาะเท่าที่จำเป็นเพื่อให้ Test ผ่าน (Keep it simple)
- รันคำสั่งทดสอบซ้ำ (เช่น `php spark test` หรือ PHPUnit) จนกว่าไฟจะเขียว (Pass)

### 3. REFACTOR (ปรับปรุงคุณภาพโค้ด)
- จัดโครงสร้างโค้ดให้สะอาดขึ้น ลบโค้ดซ้ำซ้อน (DRY principle)
- รัน Test ซ้ำอีกครั้งเพื่อยืนยันว่าการ Refactor ไม่ได้ทำลายการทำงานเดิม
