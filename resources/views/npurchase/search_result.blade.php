@forelse($search_products as $product )
    <a href="javascript:" onclick="addToPurchaseCart('{{ $product->id }}')" class="single-sch-item-area nav-link">
        <div class="search-content">
        <span class="schItem schresultItemImage">
            @if (isset($product->image))
                <img class="img-fluid" src="{{ asset('storage/images/ecommerce/product/'.$product->image) }}" alt="">
            @else
                <img class="img-fluid" src="{{ asset('storage/images/medicine/default.png') }}" alt="">
            @endif
        </span>
            <span class="schItem schresultItemDescription" title="{{ $product->name }}">
                {{ $product->name }}
                <span class="sku" title="Tablet">{{ $product->strength }}</span>
                <span class="gener-name text-muted">{{ __('pages.Generic name') }}:{{ $product->generic_name }}</span>
                <span class="gener-name text-muted">{{ __('pages.supplier') }}:
                    {{ $product->supplier ? $product->supplier->name : '' }}</span>
            </span>
        </div>
        <span class="search-price">
        {{\App\Models\Shop::setting('currency')}}{{number_format($product->price,2)}}
    </span>
    </a>
@empty
    <div class="text-center p-5 ">
        <i class="fa fa-hourglass-empty h4 text-muted"></i>
        <h6 class="text-muted">{{ __('pages.Sorry! We couldn\'t find your Medicine or Product') }}.</h6>
    </div>
@endforelse