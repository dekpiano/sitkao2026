---
name: brainstorming
description: >-
  Use this skill before writing code when exploring new features, architectural decisions, ambiguous requirements, or evaluating multiple technical approaches. It guides structured requirement refinement and design trade-off analysis.
---

# Superpowers: Brainstorming & Requirements Analysis

คู่มือสำหรับการวิเคราะห์ความต้องการ สำรวจทางเลือก และวางโครงสร้างฟีเจอร์อย่างรอบคอบก่อนลงมือเขียนโค้ดจริง

---

## 1. วัตถุประสงค์ (Goals)
- หลีกเลี่ยงการเขียนโค้ดที่ผิดทิศทางหรือต้องรื้อทำใหม่ (Rework)
- ค้นหา Edge cases, ข้อจำกัดของระบบ, และความต้องการที่แท้จริงของผู้ใช้
- นำเสนอทางเลือก (Options) พร้อมข้อดี-ข้อเสีย (Pros & Cons) เพื่อให้ตัดสินใจได้อย่างแม่นยำ

---

## 2. ขั้นตอนการวิเคราะห์แบบเป็นระบบ (Step-by-Step)

### ขั้นที่ 1: ทำความเข้าใจเป้าหมาย (Clarify Intent)
- เป้าหมายสูงสุดของฟีเจอร์นี้คืออะไร? ผู้ใช้งานหลักคือใคร?
- มีข้อมูลนำเข้า (Inputs) อะไรบ้าง และผลลัพธ์ที่ต้องการ (Outputs/Outcome) คืออะไร?
- หากมีความคลุมเครือ ให้ถามคำถามที่ตรงประเด็นเพื่อชี้แจงความต้องการ

### ขั้นที่ 2: สำรวจบริบทของระบบเดิม (Context & Constraints)
- ระบบปัจจุบันใช้ Database schema, Route, Controller, หรือ Service อะไรอยู่แล้ว?
- มีส่วนใดที่สามารถนำกลับมาใช้ซ้ำ (Reuse) ได้บ้าง?
- มีผลกระทบต่อ Security, Authentication, หรือสิทธิ์การใช้งาน (Roles) หรือไม่?

### ขั้นที่ 3: นำเสนอทางเลือกและข้อเปรียบเทียบ (Evaluate Alternatives)
- **Option A (ทางเลือกที่แนะนำ)**: ทางเลือกที่เรียบง่าย ปลอดภัย และยั่งยืนที่สุด
- **Option B**: ทางเลือกที่รวดเร็ว (Quick win) หรือทางเลือกที่ยืดหยุ่นสูง
- ระบุข้อดี-ข้อเสีย และความเสี่ยงของแต่ละทางเลือก

### ขั้นที่ 4: สรุปข้อตกลงและแนวทางการทำ (Definition of Done)
- วางขอบเขตงานที่ชัดเจน (Scope)
- กำหนดเกณฑ์ความสำเร็จ (Success Criteria) ที่สามารถทดสอบและยืนยันได้จริง
