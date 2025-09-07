<!doctype html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <title>Új jelszó beállítása</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Tailwind CSS (CDN fejlesztéshez) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center p-4">
<div class="w-full max-w-md">
    <div class="bg-white/90 backdrop-blur rounded-2xl shadow-xl p-8">
        <div class="flex items-center gap-3 mb-6">
            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo" class="h-8 w-8 rounded-md object-contain" onerror="this.style.display='none'">
            <h1 class="text-xl font-semibold text-slate-800">Új jelszó beállítása</h1>
        </div>

        <?php if($errors->any()): ?>
            <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-rose-800 text-sm">
                <ul class="list-disc list-inside">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($e); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('password.update')); ?>" class="space-y-5">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="token" value="<?php echo e($token); ?>">
            <input type="hidden" name="email" value="<?php echo e(request('email', $email ?? '')); ?>">

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Új jelszó</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    minlength="8"
                    class="block w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 px-4 py-2.5 text-slate-800 placeholder-slate-400"
                    placeholder="********"
                />
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Új jelszó megerősítése</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    minlength="8"
                    class="block w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 px-4 py-2.5 text-slate-800 placeholder-slate-400"
                    placeholder="********"
                />
            </div>

            <button
                type="submit"
                class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2.5 transition active:scale-[.99]">
                <!-- ikon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17 8V6a5 5 0 0 0-10 0v2H5v14h14V8h-2Zm-6 9.73V18h2v-.27a2 2 0 1 0-2 0ZM9 8V6a3 3 0 0 1 6 0v2H9Z"/>
                </svg>
                Jelszó frissítése
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="<?php echo e(route('login')); ?>" class="text-sm text-slate-600 hover:text-slate-800 underline underline-offset-4">
                ← Vissza a bejelentkezéshez
            </a>
        </div>
    </div>
</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\gyros2\resources\views/auth/passwords/reset.blade.php ENDPATH**/ ?>