<?php if($errors->any()): ?>
    <div <?php echo e($attributes); ?>>
        <div class="px-4 py-2 rounded-sm text-sm bg-rose-100 border border-rose-200 text-rose-600">
            <div class="font-medium"><?php echo e(__('Whoops! Something went wrong.')); ?></div>
            <ul class="mt-1 list-disc list-inside text-sm">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>         
    </div>
<?php endif; ?>
<?php /**PATH /Users/pasqualevitiello/My Folder/Job/Projects/Gits/cruip-templates-v2/templates/mosaic-laravel-livewire/resources/views/vendor/jetstream/components/validation-errors.blade.php ENDPATH**/ ?>