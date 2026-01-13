@foreach ($menus as $menu)
    <div class="col-md-6 col-lg-6 col-xl-4">
        <div class="rounded position-relative fruite-item">
            <div class="fruite-img">
                <img src="{{ asset('img_item_upload/'.$menu->img) }}" class="img-fluid w-100 rounded-top" alt="" onerror="this.onerror=null;this.src='{{ $menu->img }}'">
            </div>
            <div class="text-white px-3 py-1 rounded position-absolute @if($menu->category_id == '1') 
            bg-primary 
            @elseif($menu->category_id == '2')
            bg-secondary
            @endif" style="top: 10px; left: 10px;">
                {{ $menu->category->cat_name }}
            </div>
            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                <h4>{{ $menu->name }}</h4>
                <p class="text-limited">{{ $menu->description }}</p>
                <div class="d-flex justify-content-between flex-lg-wrap">
                    <p class="text-dark fs-5 fw-bold mb-0">Rp.{{ number_format($menu->price, 2, ',', '.') }}</p>
                    <a href="#" onclick="addToCart({{ $menu->id }})" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Tambah Keranjang</a>
                </div>
            </div>
        </div>
    </div>
@endforeach
                                    