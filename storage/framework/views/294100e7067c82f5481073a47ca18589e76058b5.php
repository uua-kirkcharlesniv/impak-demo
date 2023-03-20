<?php foreach($attributes->onlyProps([
    'placeholder' => 'Search…'
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'placeholder' => 'Search…'
]); ?>
<?php foreach (array_filter(([
    'placeholder' => 'Search…'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<form class="relative">
    <label for="action-search" class="sr-only">Search</label>
    <input id="action-search" class="form-input pl-9 focus:border-slate-300" type="search" placeholder="<?php echo e($placeholder); ?>" />
    <button class="absolute inset-0 right-auto group" type="submit" aria-label="Search">
        <svg class="w-4 h-4 shrink-0 fill-current text-slate-400 group-hover:text-slate-500 ml-3 mr-2" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
            <path d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z" />
            <path d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z" />
        </svg>
    </button>
</form><?php /**PATH D:\laravel\mosiac\resources\views/components/search-form.blade.php ENDPATH**/ ?>