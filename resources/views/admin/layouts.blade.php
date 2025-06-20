<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    @if (!isset($hideSidebar) || !$hideSidebar)
    <div class="flex min-h-screen">
      <div class="w-64">
        @include('admin.partials.sidebar')
      </div>
      <div class="flex-1 p-8">
        @yield('content')
      </div>
    </div>
    @else
      @yield('content')
    @endif
</body>
</html>
