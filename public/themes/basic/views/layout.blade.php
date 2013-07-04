<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Shopavel Basic Theme</title>

        @stylesheets('application')
    </head>
    <body>
        <nav class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="brand" href="/">Shopavel</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            @loop_categories()
                                <li><a href="{{ URL::route('category.show', ['category' => $category->id]) }}">{{ $category->title }}</a></li>
                            @end_loop()
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container">
            @yield('content')
        </div>

        <footer class="container">
            <p>Shopavel - <a href="http://www.shopavel.org">www.shopavel.org</a></p>
        </footer>
    </body>
</html>