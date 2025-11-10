
        <form wire:submit.prevent="search" method="">
            <div class="search-bar">
                <input type="text" placeholder="Search for products..." class="form-control" wire:model.debounce.500ms="query">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        @if($results && count($results) > 0)
        <div class="search-reesults mt-">
            @foreach ( $results as $product )
                <a href="">{{$product->product_name}}</a>
            @endforeach
        </div>
        @endif
  

