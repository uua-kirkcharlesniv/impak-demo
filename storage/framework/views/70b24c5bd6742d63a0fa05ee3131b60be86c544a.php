<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <?php echo \Livewire\Livewire::styles(); ?>


        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body class="font-inter antialiased bg-slate-100 text-slate-600">

        <?php echo e($slot); ?>


        <?php echo \Livewire\Livewire::scripts(); ?>

    </body>
</html>
<?php /**PATH /Volumes/240/valet-sites/mosiac/resources/views/layouts/empty.blade.php ENDPATH**/ ?>