<!-- Modern Interactive Animated Grid Background Component -->
<script src="<?= base_url('assets/js/floating-bubbles.js') ?>" defer></script>

<?php if (!empty($title)): ?>
    <!-- Optional Hero Presentation Container (replicates FloatingBubblesBackground React component) -->
    <div class="relative min-h-[50vh] sm:min-h-[70vh] w-full flex items-center justify-center overflow-hidden">
        <div class="relative z-10 container mx-auto px-4 md:px-6 text-center py-12">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl sm:text-6xl md:text-7xl font-extrabold mb-6 tracking-tight">
                    <span class="inline-block text-transparent bg-clip-text bg-gradient-to-r from-pink-600 via-purple-600 to-blue-600">
                        <?= esc($title) ?>
                    </span>
                </h1>

                <?php if (!empty($subtitle)): ?>
                    <p class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto mb-8 font-medium">
                        <?= esc($subtitle) ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($buttonUrl)): ?>
                    <div class="inline-block group relative bg-gradient-to-b from-pink-500/30 via-purple-500/30 to-blue-500/30 p-px rounded-2xl backdrop-blur-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300">
                        <a href="<?= esc($buttonUrl) ?>" class="inline-flex items-center justify-center rounded-[1.15rem] px-8 py-4 text-base sm:text-lg font-bold backdrop-blur-md bg-white/90 hover:bg-white text-pink-600 hover:text-pink-700 transition-all duration-300 group-hover:-translate-y-0.5 border border-pink-200/50 shadow-sm">
                            <span class="opacity-95 group-hover:opacity-100"><?= esc($buttonText ?? 'เข้าสู่ระบบ / สำรวจทำเนียบ') ?></span>
                            <span class="ml-3 opacity-80 group-hover:opacity-100 group-hover:translate-x-1.5 transition-all duration-300">→</span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
