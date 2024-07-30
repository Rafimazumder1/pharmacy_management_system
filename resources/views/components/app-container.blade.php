@props([
'title' => '',
'breadcrumbs' => [],
'button' => false,
'route' => '',
'buttonTitle' => '',
])
<div class="row  mb-0  mb-1 align-content-center">
    <div class="col-10">
        <h3 class="mb-0">{{ translate($title) }}</h3>
        @if ($breadcrumbs && count($breadcrumbs) > 0)
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ translate('Dashboard') }}</a></li>
                    @foreach ($breadcrumbs as $item)
                        <li class="breadcrumb-item {{ $loop->last ? 'active':'' }}">
                            <a @if(isset($item['link'])) href="{{ isset($item['link']) ? $item['link'] : '#' }}" @endif >
                                {{ translate($item['label']) }}
                            </a>
                        </li>
                    @endforeach
                </ol>
            </nav>
        @endif
    </div>
    @if ($button)
        <div class="col-2 text-end">
            @if(auth()->user()->super_admin)
                <a class="btn btn-primary" href="{{ route($route) }}">
                    {{ $buttonTitle }}
                </a>
            @else
                <a class="btn btn-primary" href="{{ route($route) }}">
                    {{ $buttonTitle }}
                </a>
            @endif
        </div>
    @endif
</div>
<div class="card border-0 bg-white">
    <div class="card-body">
        {!! $slot !!}
    </div>
</div>
