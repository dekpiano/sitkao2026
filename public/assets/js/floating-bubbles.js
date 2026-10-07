/**
 * SKJ Alumni - Modern Interactive Animated Grid Background (ตารางกริดโมเดิร์น)
 * Linear & Vercel inspired aesthetic with dynamic light beams, intersection dots, and interactive cursor glow.
 */
(function () {
    'use strict';

    function initGridBackground() {
        if (document.getElementById('skj-grid-bg-canvas')) return;

        const canvas = document.createElement('canvas');
        canvas.id = 'skj-grid-bg-canvas';
        canvas.style.position = 'fixed';
        canvas.style.inset = '0';
        canvas.style.width = '100%';
        canvas.style.height = '100%';
        canvas.style.pointerEvents = 'none';
        canvas.style.zIndex = '-1';
        canvas.style.opacity = '1';

        // Ensure body has a stacking context so z-index: -1 sits above body background but behind all cards
        function attachCanvas() {
            if (document.body) {
                document.body.style.isolation = 'isolate';
                document.body.style.position = 'relative';
                document.body.prepend(canvas);
            }
        }

        if (document.body) {
            attachCanvas();
        } else {
            document.addEventListener('DOMContentLoaded', attachCanvas);
        }

        const ctx = canvas.getContext('2d', { alpha: true });
        let width = 0;
        let height = 0;
        let dpr = window.devicePixelRatio || 1;

        // Grid Configuration
        const gridSize = 40; // 40px grid cells
        let cols = 0;
        let rows = 0;

        // Mouse interaction state
        const mouse = {
            x: -1000,
            y: -1000,
            targetX: -1000,
            targetY: -1000,
            radius: 180,
            active: false
        };

        function resize() {
            dpr = window.devicePixelRatio || 1;
            width = window.innerWidth;
            height = window.innerHeight;

            canvas.width = Math.floor(width * dpr);
            canvas.height = Math.floor(height * dpr);
            ctx.scale(dpr, dpr);

            cols = Math.ceil(width / gridSize) + 1;
            rows = Math.ceil(height / gridSize) + 1;
        }

        resize();

        // Mouse & Touch listeners for interactive glow
        window.addEventListener('mousemove', (e) => {
            mouse.targetX = e.clientX;
            mouse.targetY = e.clientY;
            mouse.active = true;
        }, { passive: true });

        window.addEventListener('mouseleave', () => {
            mouse.active = false;
            mouse.targetX = -1000;
            mouse.targetY = -1000;
        }, { passive: true });

        window.addEventListener('touchmove', (e) => {
            if (e.touches.length > 0) {
                mouse.targetX = e.touches[0].clientX;
                mouse.targetY = e.touches[0].clientY;
                mouse.active = true;
            }
        }, { passive: true });

        window.addEventListener('touchend', () => {
            mouse.active = false;
        }, { passive: true });

        // Resize with debounce
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(resize, 100);
        });

        // Glowing Light Beams traversing grid lines
        class LightBeam {
            constructor() {
                this.reset();
            }

            reset() {
                this.isVertical = Math.random() > 0.5;
                if (this.isVertical) {
                    this.colIndex = Math.floor(Math.random() * cols);
                    this.x = this.colIndex * gridSize;
                    this.y = Math.random() > 0.5 ? -100 : height + 100;
                    this.speed = (Math.random() * 2.5 + 1.2) * (this.y < 0 ? 1 : -1);
                    this.length = Math.random() * 120 + 80;
                } else {
                    this.rowIndex = Math.floor(Math.random() * rows);
                    this.y = this.rowIndex * gridSize;
                    this.x = Math.random() > 0.5 ? -100 : width + 100;
                    this.speed = (Math.random() * 2.5 + 1.2) * (this.x < 0 ? 1 : -1);
                    this.length = Math.random() * 120 + 80;
                }

                // SKJ Color Themes: Pink (#ec4899) and Blue (#3b82f6)
                this.color = Math.random() > 0.4 ? '236, 72, 153' : '59, 130, 246'; // Pink or Blue
                this.maxAlpha = Math.random() * 0.45 + 0.25;
            }

            update() {
                if (this.isVertical) {
                    this.y += this.speed;
                    if ((this.speed > 0 && this.y - this.length > height) || (this.speed < 0 && this.y + this.length < 0)) {
                        this.reset();
                    }
                } else {
                    this.x += this.speed;
                    if ((this.speed > 0 && this.x - this.length > width) || (this.speed < 0 && this.x + this.length < 0)) {
                        this.reset();
                    }
                }
            }

            draw(ctx) {
                ctx.save();
                if (this.isVertical) {
                    const gradient = ctx.createLinearGradient(this.x, this.y - this.length, this.x, this.y);
                    gradient.addColorStop(0, `rgba(${this.color}, 0)`);
                    gradient.addColorStop(0.5, `rgba(${this.color}, ${this.maxAlpha * 0.6})`);
                    gradient.addColorStop(1, `rgba(${this.color}, ${this.maxAlpha})`);

                    ctx.strokeStyle = gradient;
                    ctx.lineWidth = 1.8;
                    ctx.beginPath();
                    ctx.moveTo(this.x, this.y - (this.speed > 0 ? this.length : -this.length));
                    ctx.lineTo(this.x, this.y);
                    ctx.stroke();

                    // Leading glowing tip
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, 2, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(${this.color}, ${this.maxAlpha * 1.2})`;
                    ctx.fill();
                } else {
                    const gradient = ctx.createLinearGradient(this.x - this.length, this.y, this.x, this.y);
                    gradient.addColorStop(0, `rgba(${this.color}, 0)`);
                    gradient.addColorStop(0.5, `rgba(${this.color}, ${this.maxAlpha * 0.6})`);
                    gradient.addColorStop(1, `rgba(${this.color}, ${this.maxAlpha})`);

                    ctx.strokeStyle = gradient;
                    ctx.lineWidth = 1.8;
                    ctx.beginPath();
                    ctx.moveTo(this.x - (this.speed > 0 ? this.length : -this.length), this.y);
                    ctx.lineTo(this.x, this.y);
                    ctx.stroke();

                    // Leading glowing tip
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, 2, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(${this.color}, ${this.maxAlpha * 1.2})`;
                    ctx.fill();
                }
                ctx.restore();
            }
        }

        // Sparkling Grid Node Crosses (+)
        class GridSparkle {
            constructor() {
                this.reset();
            }

            reset() {
                this.col = Math.floor(Math.random() * cols);
                this.row = Math.floor(Math.random() * rows);
                this.x = this.col * gridSize;
                this.y = this.row * gridSize;
                this.phase = Math.random() * Math.PI * 2;
                this.speed = Math.random() * 0.03 + 0.015;
                this.size = Math.random() * 3.5 + 2.5; // Cross arm length
                this.color = Math.random() > 0.5 ? '236, 72, 153' : '99, 102, 241';
            }

            update(time) {
                this.alpha = Math.max(0, Math.sin(time * this.speed + this.phase));
            }

            draw(ctx) {
                if (this.alpha <= 0.02) return;
                ctx.save();
                ctx.strokeStyle = `rgba(${this.color}, ${this.alpha * 0.7})`;
                ctx.lineWidth = 1.2;

                // Draw tiny plus cross (+)
                ctx.beginPath();
                ctx.moveTo(this.x - this.size, this.y);
                ctx.lineTo(this.x + this.size, this.y);
                ctx.moveTo(this.x, this.y - this.size);
                ctx.lineTo(this.x, this.y + this.size);
                ctx.stroke();

                ctx.restore();
            }
        }

        const beamCount = Math.min(10, Math.max(4, Math.floor(width / 240)));
        const sparkleCount = Math.min(24, Math.max(10, Math.floor((width * height) / 45000)));

        const beams = Array.from({ length: beamCount }, () => new LightBeam());
        const sparkles = Array.from({ length: sparkleCount }, () => new GridSparkle());

        // Animation Loop
        let animationFrameId;
        let lastTime = 0;

        function animate(timestamp) {
            const time = timestamp * 0.05;

            // Smooth cursor interpolation
            mouse.x += (mouse.targetX - mouse.x) * 0.12;
            mouse.y += (mouse.targetY - mouse.y) * 0.12;

            ctx.clearRect(0, 0, width, height);

            // 1. Draw Base Grid Lines (Clean subtle tech mesh)
            ctx.save();
            ctx.strokeStyle = 'rgba(203, 213, 225, 0.35)'; // Slate 300 subtle line
            ctx.lineWidth = 0.75;

            ctx.beginPath();
            // Vertical lines
            for (let x = 0; x <= width; x += gridSize) {
                ctx.moveTo(x, 0);
                ctx.lineTo(x, height);
            }
            // Horizontal lines
            for (let y = 0; y <= height; y += gridSize) {
                ctx.moveTo(0, y);
                ctx.lineTo(width, y);
            }
            ctx.stroke();
            ctx.restore();

            // 2. Interactive Cursor Radial Glow & Highlighting
            if (mouse.x > -500) {
                ctx.save();
                const radialGlow = ctx.createRadialGradient(
                    mouse.x, mouse.y, 10,
                    mouse.x, mouse.y, mouse.radius
                );
                radialGlow.addColorStop(0, 'rgba(236, 72, 153, 0.18)'); // Pink tint
                radialGlow.addColorStop(0.5, 'rgba(59, 130, 246, 0.08)'); // Blue tint
                radialGlow.addColorStop(1, 'rgba(255, 255, 255, 0)');

                ctx.fillStyle = radialGlow;
                ctx.beginPath();
                ctx.arc(mouse.x, mouse.y, mouse.radius, 0, Math.PI * 2);
                ctx.fill();

                // Highlight grid intersections near cursor with crisp dots
                const startCol = Math.max(0, Math.floor((mouse.x - mouse.radius) / gridSize));
                const endCol = Math.min(cols, Math.ceil((mouse.x + mouse.radius) / gridSize));
                const startRow = Math.max(0, Math.floor((mouse.y - mouse.radius) / gridSize));
                const endRow = Math.min(rows, Math.ceil((mouse.y + mouse.radius) / gridSize));

                for (let c = startCol; c <= endCol; c++) {
                    for (let r = startRow; r <= endRow; r++) {
                        const px = c * gridSize;
                        const py = r * gridSize;
                        const dist = Math.hypot(px - mouse.x, py - mouse.y);
                        if (dist < mouse.radius) {
                            const intensity = (1 - dist / mouse.radius);
                            ctx.fillStyle = `rgba(236, 72, 153, ${intensity * 0.75})`;
                            ctx.beginPath();
                            ctx.arc(px, py, 1.8 * intensity, 0, Math.PI * 2);
                            ctx.fill();
                        }
                    }
                }
                ctx.restore();
            }

            // 3. Draw Sparkles / Intersections (+)
            for (let i = 0; i < sparkles.length; i++) {
                sparkles[i].update(time);
                sparkles[i].draw(ctx);
            }

            // 4. Draw Animated Light Beams
            for (let i = 0; i < beams.length; i++) {
                beams[i].update();
                beams[i].draw(ctx);
            }

            animationFrameId = requestAnimationFrame(animate);
        }

        // Pause animation when tab is inactive to save battery
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                cancelAnimationFrame(animationFrameId);
            } else {
                animationFrameId = requestAnimationFrame(animate);
            }
        });

        animationFrameId = requestAnimationFrame(animate);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initGridBackground);
    } else {
        initGridBackground();
    }
})();
