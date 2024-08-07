<?php if(session('stock') == 'emergency-stock'): ?>
    <div class="product-card card shadow-sm pvl26" onclick="emrgQuickView('<?php echo e($product->id); ?>')">
        <div class="card-header inline_product clickable p-3 pvl27">
            <div class="d-flex align-items-center justify-content-center d-block">
                <img src="<?php echo e(asset('storage/images/medicine/'.$product['image'] ?? ''.'')); ?>"
                     onerror="this.src='<?php echo e(asset('pos/img/160x160/imag.png')); ?>'"
                     class="pvl28">
            </div>
        </div>
        <div class="card-body inline_product text-center p-1 py-2 clickable">
            <h5 class="product-title1 text-dark font-weight-bold pvl30">
                <?php echo e(Str::limit($product['name'], 13)); ?> (<?php echo e(Str::limit($product['strength'], 13)); ?>)
            </h5>
        </div>
    </div>
<?php else: ?>
    <div class="position-relative">
        <div class="product-card card shadow-sm pvl26 position-relative"
             onclick="ADD_TO_CART('<?php echo e($product->id); ?>','<?php echo e(route('pos.add-to-cart')); ?>')">
            <div class="card-header inline_product clickable p-3 pvl27">
                <div class="d-flex align-items-center justify-content-center d-block">
                    <img src="<?php echo e(asset('storage/images/medicine/'.$product['image'] ?? ''.'')); ?>"
                         onerror="this.src='<?php echo e(asset('pos/img/160x160/imag.png')); ?>'"
                         class="pvl28">
                </div>
            </div>
            <div class="card-body inline_product text-center p-1 py-2 clickable">
                <h5 class="product-title1 text-dark font-weight-bold pvl30">
                    <?php echo e(Str::limit($product['name'], 13)); ?> (<?php echo e(Str::limit($product['strength'], 13)); ?>)
                </h5>
            </div>
        </div>
        <?php if($product['total_quantity'] > 0): ?>
            <span class="position-absolute top-0 end-0 badge bg-primary text-white m-1">
           QTY: <?php echo e($product['total_quantity']); ?>

        </span>
        <?php else: ?>
            <div class="stockout">
                <span class="badge bg-danger text-white">Stockout</span>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php /**PATH E:\xampp\htdocs\PHARMACY\resources\views/pos/_single_product.blade.php ENDPATH**/ ?>