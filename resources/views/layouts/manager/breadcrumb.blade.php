<div class="d-flex align-items-center flex-wrap mr-1">
    <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
        <span></span>
    </button>
    <div class="d-flex align-items-baseline flex-wrap mr-5">
        <h5 class="text-dark font-weight-bold my-1 mr-5">{{ !empty($breadcrumbs) ? end($breadcrumbs)->name : 'Dashboard' }}</h5>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            @if(!empty($breadcrumbs))
                @foreach($breadcrumbs as $bread)
                    <li class="breadcrumb-item">
                        <a href="{{ $bread->path }}" class="text-muted">{{ $bread->name }}</a>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
