<?php if($paginator->hasPages()): ?>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <nav class="flex justify-center mb-4 sm:mb-0 sm:order-1" role="navigation" aria-label="<?php echo __('Pagination Navigation'); ?>">
            
            <div class="mr-2">
                <?php if($paginator->onFirstPage()): ?>
                    <span class="inline-flex items-center justify-center rounded leading-5 px-2.5 py-2 bg-white border border-slate-200 text-slate-300">
                        <span class="sr-only"><?php echo __('pagination.previous'); ?></span><wbr />
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 16 16">
                            <path d="M9.4 13.4l1.4-1.4-4-4 4-4-1.4-1.4L4 8z" />
                        </svg>
                    </span>
                <?php else: ?>
                    <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="inline-flex items-center justify-center rounded leading-5 px-2.5 py-2 bg-white hover:bg-indigo-500 border border-slate-200 text-slate-600 hover:text-white shadow-sm">
                        <span class="sr-only"><?php echo __('pagination.previous'); ?></span><wbr />
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 16 16">
                            <path d="M9.4 13.4l1.4-1.4-4-4 4-4-1.4-1.4L4 8z" />
                        </svg>
                    </a>                
                <?php endif; ?>
            </div>

            
            <ul class="inline-flex text-sm font-medium -space-x-px shadow-sm">
                <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php if(is_string($element)): ?>
                        <li aria-disabled="true">
                            <span class="inline-flex items-center justify-center leading-5 px-3.5 py-2 bg-white border border-slate-200 text-slate-400"><?php echo e($element); ?></span>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($page == $paginator->currentPage()): ?>
                                <li aria-current="page">
                                    <span class="inline-flex items-center justify-center leading-5 px-3.5 py-2 bg-white border border-slate-200 text-indigo-500 <?php if($page === 1): ?><?php echo e('rounded-l'); ?><?php elseif($page === $paginator->lastPage()): ?><?php echo e('rounded-r'); ?><?php endif; ?>"><?php echo e($page); ?></span>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a href="<?php echo e($url); ?>" class="inline-flex items-center justify-center leading-5 px-3.5 py-2 bg-white hover:bg-indigo-500 border border-slate-200 text-slate-600 hover:text-white <?php if($page === 1): ?><?php echo e('rounded-l'); ?><?php elseif($page === $paginator->lastPage()): ?><?php echo e('rounded-r'); ?><?php endif; ?>"><?php echo e($page); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            
            <div class="ml-2">
                <?php if($paginator->hasMorePages()): ?>
                    <a href="<?php echo e($paginator->nextPageUrl()); ?>" class="inline-flex items-center justify-center rounded leading-5 px-2.5 py-2 bg-white hover:bg-indigo-500 border border-slate-200 text-slate-600 hover:text-white shadow-sm">
                        <span class="sr-only"><?php echo __('pagination.next'); ?></span><wbr />
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 16 16">
                            <path d="M6.6 13.4L5.2 12l4-4-4-4 1.4-1.4L12 8z" />
                        </svg>
                    </a>                
                <?php else: ?>
                    <span class="inline-flex items-center justify-center rounded leading-5 px-2.5 py-2 bg-white border border-slate-200 text-slate-300">
                        <span class="sr-only"><?php echo __('pagination.next'); ?></span><wbr />
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 16 16">
                            <path d="M6.6 13.4L5.2 12l4-4-4-4 1.4-1.4L12 8z" />
                        </svg>
                    </span>                
                <?php endif; ?>
            </div>        
        </nav>
        
        <div class="text-sm text-slate-500 text-center sm:text-left">
            <?php echo __('Showing'); ?>

            <?php if($paginator->firstItem()): ?>
                <span class="font-medium text-slate-600"><?php echo e($paginator->firstItem()); ?></span>
                <?php echo __('to'); ?>

                <span class="font-medium text-slate-600"><?php echo e($paginator->lastItem()); ?></span>
            <?php else: ?>
                <?php echo e($paginator->count()); ?>

            <?php endif; ?>
            <?php echo __('of'); ?>

            <span class="font-medium text-slate-600"><?php echo e($paginator->total()); ?></span>
            <?php echo __('results'); ?>            
        </div>    
    </div>
<?php endif; ?>
<?php /**PATH D:\laravel\mosiac\resources\views/vendor/pagination/tailwind.blade.php ENDPATH**/ ?>