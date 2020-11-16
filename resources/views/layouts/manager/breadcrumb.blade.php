<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
        @if(!empty($breadcrumbs))
            @foreach($breadcrumbs as $bread)
                @if(request()->getRequestUri() === '/'.Route::current()->uri())
                    <li class="breadcrumb-item active" aria-current="page"><span>{{ $bread->name }}</span></li>
                @else
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ $bread->path }}">{{ $bread->name }}</a></li>
                @endif
            @endforeach
        @endif
    </ol>
</nav>
