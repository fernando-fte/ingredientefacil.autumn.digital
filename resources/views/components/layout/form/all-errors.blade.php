@if ($errors->any())
    <div class="alert alert-danger m-2 rounded-pill p-2 px-3 small" style="font-size: 0.92em;">
        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
                <li class="small">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
