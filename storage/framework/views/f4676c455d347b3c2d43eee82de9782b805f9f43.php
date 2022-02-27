<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ToDo App</title>
  <?php echo $__env->yieldContent('styles'); ?>
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<header>
  <nav class="my-navbar">
    <a class="my-navbar-brand" href="/">ToDo App</a>
    <div class="my-navbar-control">
      <?php if(Auth::check()): ?>
      <!-- ログインしていた場合 -->
       <span class="my-navbar-item">ようこそ、<?php echo e(Auth::user()->name); ?>さん</span>
       |
       <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
       <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
         <?php echo csrf_field(); ?>
       </form>
       <?php else: ?>
       <!-- ログインしていない場合 -->
       <a href="<?php echo e(route('login')); ?>" class="my-navbar-item">ログイン</a>
       |
       <a href="<?php echo e(route('register')); ?>" class="my-navbar-item">会員登録</a>
       <?php endif; ?>
    </div>
  </nav>
</header>
<main>
  <?php echo $__env->yieldContent('content'); ?>
</main>

<?php if(Auth::check()): ?>
  <script>
    document.getElementById('logout').addEventListener('click',function(event){
      event.preventDefault();
      document.getElementById('logout-form').submit();
    });
  </script>
<?php endif; ?>

<?php echo $__env->yieldContent('scripts'); ?>


</body>
</html><?php /**PATH /var/www/html/ToDoApp/resources/views/layout.blade.php ENDPATH**/ ?>