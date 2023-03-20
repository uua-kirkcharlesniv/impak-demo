<?php if($paginator->hasPages()): ?>
    <div class="flex flex-col items-end">
        <nav role="navigation" aria-label="<?php echo __('Pagination Navigation'); ?>" class="mb-4 sm:mb-0 sm:order-1">
            <ul class="flex justify-center">
                
                <li class="ml-3 first:ml-0">
                    <?php if($paginator->onFirstPage()): ?>
                        <span class="btn bg-white border-slate-200 text-slate-300 cursor-not-allowed">
                            <?php echo __('pagination.previous'); ?>

                        </span>
                    <?php else: ?>
                        <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" class="btn bg-white border-slate-200 hover:border-slate-300 text-indigo-500">
                            <?php echo __('pagination.previous'); ?>

                        </a>
                    <?php endif; ?>
                </li>

                
                <li class="ml-3 first:ml-0">
                    <?php if($paginator->hasMorePages()): ?>
                        <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" class="btn bg-white border-slate-200 hover:border-slate-300 text-indigo-500">
                            <?php echo __('pagination.next'); ?>

                        </a>
                    <?php else: ?>
                        <span class="btn bg-white border-slate-200 text-slate-300 cursor-not-allowed">
                            <?php echo __('pagination.next'); ?>

                        </span>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </div>
<?php endif; ?>
<?php /**PATH /Volumes/240/valet-sites/mosiac/resources/views/vendor/pagination/simple-tailwind.blade.php ENDPATH**/ ?>