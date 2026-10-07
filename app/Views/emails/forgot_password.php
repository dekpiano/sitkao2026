<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ยืนยันการตั้งรหัสผ่านใหม่ | SKJ Alumni</title>
    <script src="<?= base_url('assets/js/floating-bubbles.js') ?>" defer></script>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; color: #1e293b;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f1f5f9; padding: 30px 10px;">
        <tr>
            <td align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 580px; background-color: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.06);">
                    
                    <!-- Header Banner -->
                    <tr>
                        <td align="center" style="background: linear-gradient(135deg, #db2777 0%, #2563eb 100%); padding: 35px 25px; text-align: center;">
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="background-color: #ffffff; width: 48px; height: 48px; border-radius: 12px; font-weight: 900; font-size: 20px; color: #db2777; line-height: 48px; text-align: center;">
                                        SKJ
                                    </td>
                                </tr>
                            </table>
                            <h1 style="color: #ffffff; font-size: 20px; font-weight: bold; margin: 15px 0 4px 0;">ระบบทำเนียบศิษย์เก่า SKJ</h1>
                            <p style="color: rgba(255,255,255,0.85); font-size: 12px; margin: 0;">โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์</p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 35px 30px;">
                            <p style="font-size: 16px; font-weight: bold; color: #0f172a; margin-top: 0; margin-bottom: 12px;">
                                เรียน คุณ <?= esc($name) ?>,
                            </p>
                            
                            <p style="font-size: 14px; color: #475569; line-height: 1.6; margin-bottom: 24px;">
                                เราได้รับคำขอตั้งรหัสผ่านใหม่สำหรับบัญชีผู้ใช้งานระบบทำเนียบศิษย์เก่า SKJ ที่เชื่อมโยงกับอีเมลนี้ (<strong><?= esc($email) ?></strong>)
                            </p>

                            <!-- Primary Action Button -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 25px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="<?= esc($resetLink) ?>" target="_blank" style="display: inline-block; background: linear-gradient(135deg, #db2777 0%, #2563eb 100%); color: #ffffff; text-decoration: none; font-size: 15px; font-weight: bold; padding: 14px 34px; border-radius: 50px; box-shadow: 0 4px 15px rgba(219, 39, 119, 0.35);">
                                            🔗 คลิกที่นี่เพื่อตั้งรหัสผ่านใหม่
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <!-- OTP Box Section -->
                            <?php if(!empty($otpCode)): ?>
                            <div style="background-color: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 14px; padding: 16px; text-align: center; margin: 24px 0;">
                                <p style="font-size: 12px; color: #64748b; margin: 0 0 6px 0;">หรือใช้รหัสยืนยัน OTP 6 หลักนี้:</p>
                                <span style="font-size: 26px; font-weight: 800; letter-spacing: 6px; color: #db2777; font-family: monospace;">
                                    <?= esc($otpCode) ?>
                                </span>
                            </div>
                            <?php endif; ?>

                            <!-- Expiry Info -->
                            <p style="font-size: 12px; color: #64748b; line-height: 1.5; margin-bottom: 20px;">
                                ⏳ ลิงก์และรหัสยืนยันนี้จะมีอายุการใช้งาน <strong><?= $expireMin ?? 30 ?> นาที</strong> เพื่อความปลอดภัยของข้อมูล
                            </p>

                            <!-- Direct Link Fallback -->
                            <div style="background-color: #f8fafc; border-radius: 8px; padding: 12px; word-break: break-all; margin-bottom: 24px;">
                                <p style="font-size: 11px; color: #94a3b8; margin: 0 0 4px 0;">หากปุ่มด้านบนใช้งานไม่ได้ สามารถคัดลอกลิงก์ด้านล่างไปวางในเบราว์เซอร์ได้โดยตรง:</p>
                                <a href="<?= esc($resetLink) ?>" style="font-size: 11px; color: #2563eb; text-decoration: underline;">
                                    <?= esc($resetLink) ?>
                                </a>
                            </div>

                            <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 24px 0;">

                            <p style="font-size: 12px; color: #94a3b8; line-height: 1.5; margin: 0;">
                                ⚠️ หากคุณไม่ได้เป็นผู้ส่งคำขอนี้ โปรดเพิกเฉยต่ออีเมลฉบับนี้ รหัสผ่านเดิมของคุณจะยังคงปลอดภัยและไม่มีการเปลี่ยนแปลงใดๆ
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #0f172a; padding: 22px 25px; text-align: center;">
                            <p style="color: #94a3b8; font-size: 11px; margin: 0 0 4px 0;">
                                © 2026 โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์
                            </p>
                            <p style="color: #64748b; font-size: 10px; margin: 0;">
                                แพลตฟอร์มรวมศิษย์เก่า สนับสนุนโดย อบจ. นครสวรรค์
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
