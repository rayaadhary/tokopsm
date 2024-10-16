@extends('customer.partials.app')

@section('content')
    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <!-- Kategori di sebelah kiri -->
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Categories</span>
                        </div>
                        <ul>
                            <li>
                                <a href="{{ route('customer.shop') }}"
                                    class="{{ !request()->get('category') ? 'active' : '' }}">
                                    All Categories
                                </a>
                            </li>
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('customer.shop', array_merge(request()->all(), ['category' => $category->slug])) }}"
                                        class="{{ request()->get('category') == $category->slug ? 'active' : '' }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Pencarian dan Pengurutan di sebelah kanan -->
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="{{ route('customer.shop') }}" method="GET">
                                <input type="text" name="search" placeholder="What do you need?"
                                    value="{{ request()->get('search') }}">
                                <input type="hidden" name="category" value="{{ request()->get('category') }}">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Product Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <div class="filter__sort d-flex align-items-center">
                                <span class="mr-1">Sort By:</span>
                                <form action="{{ route('customer.shop') }}" method="GET">
                                    <input type="hidden" name="search" value="{{ request()->get('search') }}">
                                    <input type="hidden" name="category" value="{{ request()->get('category') }}">
                                    <select name="sort" onchange="this.form.submit()">
                                        <option value="">Default</option>
                                        <option value="name_asc" {{ request()->get('sort') === 'name_asc' ? 'selected' : '' }}>A-Z</option>
                                        <option value="name_desc" {{ request()->get('sort') === 'name_desc' ? 'selected' : '' }}>Z-A</option>
                                        <option value="price_asc" {{ request()->get('sort') === 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                                        <option value="price_desc" {{ request()->get('sort') === 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <a href="{{ route('customer.shop.detail', $product) }}">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg"
                                            data-setbg="{{ asset('storage/' . $product->images->first()->image) }}">
                                        </div>
                                        <div class="product__item__text">
                                            <h6>{{ $product->name }}</h6>
                                            <h5>Rp. {{ number_format($product->price, 0, ',', '.') }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection
