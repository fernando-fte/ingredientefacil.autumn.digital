<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">
            <i class="fa fa-utensils me-2"></i> {{ config('app.name', 'Laravel') }}
        </a>
        <div class="collapse navbar-collapse justify-content-center">
            <x-layout.menu.center />
            <div class="d-flex align-items-center position-absolute end-0 pe-3">
                <x-profile.dropdown />
            </div>
        </div>
    </div>
</nav>
