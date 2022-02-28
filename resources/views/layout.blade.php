<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ToDo App</title>
  @yield('styles')
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<header>
  <nav class="my-navbar">
    <a class="my-navbar-brand" href="/">ToDo App</a>
    <div class="my-navbar-control">
      @if(Auth::check())
      <!-- ログインしていた場合 -->
       <span class="my-navbar-item">ようこそ、{{ Auth::user()->name }}さん</span>
       |
       <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
         @csrf
       </form>
       @else
       <!-- ログインしていない場合 -->
       <a href="{{ route('login') }}" class="my-navbar-item">ログイン</a>
       |
       <a href="{{ route('register') }}" class="my-navbar-item">会員登録</a>
       @endif
    </div>
  </nav>
</header>
<main>
  @yield('content')
</main>

@if(Auth::check())
  <script>
    document.getElementById('logout').addEventListener('click',function(event){
      event.preventDefault();
      document.getElementById('logout-form').submit();
    });
  </script>
@endif
@if(Auth::check())
  <script>
    document.getElementById('logout').addEventListener('click', function(event) {
      event.preventDefault();
      document.getElementById('logout-form').submit();
    });
  </script>
@endif
@yield('scripts')


</body>
</html>