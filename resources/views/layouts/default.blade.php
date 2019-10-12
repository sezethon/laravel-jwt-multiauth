<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/css/app.css">
  <title>@yield('title', 'learnku1') - 教程learnku1</title>
</head>

<body>
  @include('layouts.header')

  <div class="container">
    <div class="offset-md-1 col-md-10">
      @yield('content')
      @include('layouts.footer')
    </div>
  </div>
</body>

</html>