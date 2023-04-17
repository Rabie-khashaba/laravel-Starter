<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mail user</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


    </head>
    <body>
            <h1>Hello My name Is: Rabie Khashaba </h1>
            <div> {{$details['title']}} Languages</div>
            <p>{{$details['body']}} Laravel 10 </p>


    </body>
</html>
