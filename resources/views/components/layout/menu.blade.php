<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">
            <i class="fa fa-utensils me-2"></i> {{ config('app.name', 'Laravel') }}
        </a>
        <div class="d-flex align-items-center ms-auto">
            @auth
                <x-profile.dropdown />
            @endauth
        </div>
    </div>
</nav>
