@props([
    'icon' => 'fa-solid fa-chart-line',
    'count' => '0',
    'title' => '',
    'class' => 'col-4',
    'iconBg' => 'bg-primary',
])

<div class="{{$class}} statistic">
    <div class="card">
        <div class="card-body d-flex gap-2 align-items-center">
            <div class="icon-box {{ $iconBg }}">
                <i class="{{ $icon }}"></i>
            </div>
            <div class="text">
                <h3 class="count">{{ $count }}</h3>
                <h4 class="mb-0">{{ translate($title) }}</h4>
            </div>
        </div>
    </div>
</div>
