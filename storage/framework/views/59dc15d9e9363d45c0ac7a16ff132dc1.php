<div class="max-w-7xl mx-auto py-6 sm:py-10 px-4 sm:px-6 lg:px-8" wire:poll.keep-alive.10s>
    <div class="mb-8 gsap-fade-up">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Dashboard Admin</h1>
            <p class="mt-1 text-sm text-gray-500">Ringkasan operasional gudang secara keseluruhan.</p>
        <?php else: ?>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Monitoring Stok Barang</h1>
            <p class="mt-1 text-sm text-gray-500">Pantau ketersediaan barang yang ready di gudang.</p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-5 mb-6 sm:mb-8">
        <div class="gsap-stagger-item h-full">
            <div class="group h-full bg-white overflow-hidden shadow-sm rounded-md border border-gray-100 p-4 sm:p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 ease-in-out cursor-default">
                <div class="flex items-center">
                    <div
                        class="shrink-0 bg-blue-100 rounded-md p-2.5 sm:p-3 group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-300">
                        <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <div class="ml-3 sm:ml-4 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Stok Barang</dt>
                            <dd class="text-xl sm:text-2xl font-bold text-gray-900" x-data="{
                                value: 0,
                                animate() {
                                    let target = parseInt(this.$el.dataset.value, 10) || 0;
                                    if (window.gsap) window.gsap.to(this, { value: target, duration: 1.5, ease: 'power3.out' });
                                    else this.value = target;
                                },
                                init() {
                                    this.animate();
                                    let observer = new MutationObserver(() => this.animate());
                                    observer.observe(this.$el, { attributes: true, attributeFilter: ['data-value'] });
                                }
                            }"
                                data-value="<?php echo e($totalStock); ?>" x-text="Math.round(value).toLocaleString('id-ID')">0</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>
            <div class="gsap-stagger-item h-full">
                <div class="group h-full bg-white overflow-hidden shadow-sm rounded-md border border-gray-100 p-4 sm:p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 ease-in-out cursor-default">
                    <div class="flex items-center">
                        <div
                            class="shrink-0 bg-green-100 rounded-md p-2.5 sm:p-3 group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-300">
                            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <div class="ml-3 sm:ml-4 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Barang Masuk (Bulan Ini)</dt>
                                <dd class="text-xl sm:text-2xl font-bold text-gray-900" x-data="{
                                    value: 0,
                                    animate() {
                                        let target = parseInt(this.$el.dataset.value, 10) || 0;
                                        if (window.gsap) window.gsap.to(this, { value: target, duration: 1.5, ease: 'power3.out' });
                                        else this.value = target;
                                    },
                                    init() {
                                        this.animate();
                                        let observer = new MutationObserver(() => this.animate());
                                        observer.observe(this.$el, { attributes: true, attributeFilter: ['data-value'] });
                                    }
                                }"
                                    data-value="<?php echo e($monthlyInbound); ?>" x-text="Math.round(value).toLocaleString('id-ID')">0
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gsap-stagger-item h-full">
                <div class="group h-full bg-white overflow-hidden shadow-sm rounded-md border border-gray-100 p-4 sm:p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 ease-in-out cursor-default">
                    <div class="flex items-center">
                        <div
                            class="shrink-0 bg-red-100 rounded-md p-2.5 sm:p-3 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </div>
                        <div class="ml-3 sm:ml-4 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Barang Keluar (Bulan Ini)</dt>
                                <dd class="text-xl sm:text-2xl font-bold text-gray-900" x-data="{
                                    value: 0,
                                    animate() {
                                        let target = parseInt(this.$el.dataset.value, 10) || 0;
                                        if (window.gsap) window.gsap.to(this, { value: target, duration: 1.5, ease: 'power3.out' });
                                        else this.value = target;
                                    },
                                    init() {
                                        this.animate();
                                        let observer = new MutationObserver(() => this.animate());
                                        observer.observe(this.$el, { attributes: true, attributeFilter: ['data-value'] });
                                    }
                                }"
                                    data-value="<?php echo e($monthlyOutbound); ?>" x-text="Math.round(value).toLocaleString('id-ID')">0
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="gsap-stagger-item h-full">
                <div class="group h-full bg-white overflow-hidden shadow-sm rounded-md border border-gray-100 p-4 sm:p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 ease-in-out cursor-default">
                    <div class="flex items-center">
                        <div
                            class="shrink-0 bg-green-100 rounded-md p-2.5 sm:p-3 group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-300">
                            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3 sm:ml-4 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Barang Ready</dt>
                                <dd class="text-xl sm:text-2xl font-bold text-green-600"><span x-data="{
                                    value: 0,
                                    animate() {
                                        let target = parseInt(this.$el.dataset.value, 10) || 0;
                                        if (window.gsap) window.gsap.to(this, { value: target, duration: 1.5, ease: 'power3.out' });
                                        else this.value = target;
                                    },
                                    init() {
                                        this.animate();
                                        let observer = new MutationObserver(() => this.animate());
                                        observer.observe(this.$el, { attributes: true, attributeFilter: ['data-value'] });
                                    }
                                }"
                                        data-value="<?php echo e($readyItems->count()); ?>"
                                        x-text="Math.round(value).toLocaleString('id-ID')">0</span> item</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gsap-stagger-item h-full">
                <div class="group h-full bg-white overflow-hidden shadow-sm rounded-md border border-gray-100 p-4 sm:p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 ease-in-out cursor-default">
                    <div class="flex items-center">
                        <div
                            class="shrink-0 bg-orange-100 rounded-md p-2.5 sm:p-3 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                            <svg class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                        </div>
                        <div class="ml-3 sm:ml-4 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Stok Habis</dt>
                                <dd class="text-xl sm:text-2xl font-bold text-red-600"><span x-data="{
                                    value: 0,
                                    animate() {
                                        let target = parseInt(this.$el.dataset.value, 10) || 0;
                                        if (window.gsap) window.gsap.to(this, { value: target, duration: 1.5, ease: 'power3.out' });
                                        else this.value = target;
                                    },
                                    init() {
                                        this.animate();
                                        let observer = new MutationObserver(() => this.animate());
                                        observer.observe(this.$el, { attributes: true, attributeFilter: ['data-value'] });
                                    }
                                }"
                                        data-value="<?php echo e($outOfStockItems->count()); ?>"
                                        x-text="Math.round(value).toLocaleString('id-ID')">0</span> item</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if (! ($isAdmin)): ?>
        <div class="bg-white shadow-sm rounded-md border border-gray-100 overflow-hidden mb-6 sm:mb-8">
            <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Daftar Barang Ready</h3>
                <p class="mt-1 text-sm text-gray-500">Barang yang tersedia dan siap digunakan.</p>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($readyItems->isEmpty()): ?>
                <div class="p-8 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium text-gray-900">Tidak Ada Barang Ready</h3>
                    <p class="mt-1 text-sm text-gray-500">Semua stok barang sedang kosong.</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    SKU</th>
                                <th
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Barang</th>
                                <th
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori</th>
                                <th
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Stok</th>
                                <th
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Satuan</th>
                                <th
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $readyItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <tr class="hover:bg-gray-50 transition-colors duration-150 gsap-list-item">
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-500">
                                        <?php echo e($item->sku); ?></td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?php echo e($item->name); ?></td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo e($item->category->name ?? '-'); ?></td>
                                    <td
                                        class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-bold <?php echo e($item->stock <= 10 ? 'text-orange-600' : 'text-gray-900'); ?>">
                                        <?php echo e(number_format($item->stock, 0, ',', '.')); ?>

                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo e($item->unit); ?></td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->stock <= 10): ?>
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">Stok
                                                Rendah</span>
                                        <?php else: ?>
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Tersedia</span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 truncate max-w-xs">
                                        <?php echo e($item->description ?: '-'); ?>

                                    </td>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($outOfStockItems->isNotEmpty()): ?>
            <div class="bg-white shadow-sm rounded-md border border-orange-200 overflow-hidden mb-6 sm:mb-8">
                <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-orange-200 bg-orange-50">
                    <h3 class="text-lg leading-6 font-medium text-orange-800">Barang Stok Habis</h3>
                    <p class="mt-1 text-sm text-orange-600">Barang berikut perlu di-restock segera.</p>
                </div>
                <ul role="list" class="divide-y divide-gray-200">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $outOfStockItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <li
                            class="px-6 py-4 flex items-center justify-between hover:bg-orange-50 transition-colors duration-150">
                            <div>
                                <span class="text-sm font-medium text-gray-900"><?php echo e($item->name); ?></span>
                                <span class="ml-2 text-xs text-gray-500">(<?php echo e($item->sku); ?>)</span>
                            </div>
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Habis</span>
                        </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </ul>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>
        <div class="bg-white shadow-sm rounded-md border border-gray-100 overflow-hidden">
            <div
                class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Riwayat Transaksi Terbaru</h3>
                    <p class="mt-1 text-sm text-gray-500">Daftar barang masuk dan keluar.</p>
                </div>
                <div class="flex items-center gap-2">
                    <label for="perPage" class="text-sm text-gray-600">Tampilkan:</label>
                    <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['id' => 'perPage','wire:model.live' => 'perPage','class' => 'text-sm py-1.5 pl-3 pr-8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'perPage','wire:model.live' => 'perPage','class' => 'text-sm py-1.5 pl-3 pr-8']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $attributes = $__attributesOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__attributesOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $component = $__componentOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__componentOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
                </div>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($recentTransactions->isEmpty()): ?>
                <div class="p-8 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium text-gray-900">Belum Ada Transaksi</h3>
                    <p class="mt-1 text-sm text-gray-500">Belum ada barang masuk atau keluar yang dicatat.</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Transaksi</th>
                                <th scope="col"
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Detail</th>
                                <th scope="col"
                                    class="px-4 sm:px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status & Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $recentTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <tr class="hover:bg-gray-50 transition-colors duration-150 gsap-list-item">
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="shrink-0 h-10 w-10 rounded-full <?php echo e($transaction->type === \App\Enums\TransactionType::Inbound ? 'bg-green-100' : 'bg-red-100'); ?> flex items-center justify-center">
                                                <svg class="h-5 w-5 <?php echo e($transaction->type === \App\Enums\TransactionType::Inbound ? 'text-green-600' : 'text-red-600'); ?>"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($transaction->type === \App\Enums\TransactionType::Inbound): ?>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 4v16m8-8H4" />
                                                    <?php else: ?>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <?php echo e($transaction->code); ?>

                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    Oleh: <?php echo e($transaction->user->name); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900"><?php echo e($transaction->item->name); ?></div>
                                        <div class="text-sm text-gray-500">Qty: <?php echo e($transaction->quantity); ?>

                                            <?php echo e($transaction->item->unit); ?> &bull;
                                            <?php echo e($transaction->source_or_destination); ?></div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($transaction->notes): ?>
                                            <div class="text-xs text-gray-500 mt-1 italic">
                                                Catatan: <?php echo e($transaction->notes); ?>

                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-right">
                                        <p
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($transaction->type === \App\Enums\TransactionType::Inbound ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                            <?php echo e($transaction->type->label()); ?>

                                        </p>
                                        <div class="text-xs text-gray-500 mt-1">
                                            <?php echo e($transaction->created_at->translatedFormat('d M Y, H:i')); ?>

                                        </div>
                                    </td>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($recentTransactions->hasPages()): ?>
                    <div class="px-6 py-4 border-t border-gray-200">
                        <?php echo e($recentTransactions->links()); ?>

                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </div>
<?php /**PATH /home/whoami/Documents/Projects/Wilson/resources/views/livewire/dashboard/dashboard-page.blade.php ENDPATH**/ ?>