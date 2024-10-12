 <!-- Hero Section Begin -->
 @extends('customer.partials.app')

 @section('content')
     <section class="hero">
         <div class="container">
             <div class="row">
                 <div class="col-lg-3">
                     <div class="hero__categories">
                         <div class="hero__categories__all">
                             <i class="fa fa-bars"></i>
                             <span>Categories</span>
                         </div>
                         <ul>
                             @foreach ($categoryDropdown as $category)
                                 <li>
                                     <a href="{{ route('customer.shop', ['category' => $category->slug]) }}"
                                         class="{{ request()->get('category') == $category->slug ? 'active' : '' }}">
                                         {{ $category->name }}
                                     </a>
                                 </li>
                             @endforeach
                         </ul>
                     </div>
                 </div>
                 <div class="col-lg-9">
                     <div class="hero__item set-bg" data-setbg="{{ asset('customer/img/hero/banner.jpg') }}">
                         <div class="hero__text">
                             <span>FRUIT FRESH</span>
                             <h2>Vegetable <br />100% Organic</h2>
                             <p>Free Pickup and Delivery Available</p>
                             <a href="{{ route('customer.shop') }}" class="primary-btn">SHOP NOW</a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- Hero Section End -->

     <!-- Categories Section Begin -->
     <section class="categories">
         <div class="container">
             <div class="row">
                 <div class="categories__slider owl-carousel">
                     @foreach ($carouselItems as $item)
                         <div class="col-lg-3">
                             <div class="categories__item set-bg"
                                 data-setbg="{{ asset('storage/' . $item->images->first()->image) }}">
                                 <h5><a
                                         href="{{ route('customer.shop', ['category' => $item->category->slug]) }}">{{ $item->category->name }}</a>
                                 </h5>
                             </div>
                         </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </section>
     <!-- Categories Section End -->

     <!-- Featured Section Begin -->
     <section class="featured spad">
         <div class="container">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-title">
                         <h2>Product Us</h2>
                     </div>
                     <div class="featured__controls">
                         <ul>
                             <li class="active" data-filter="*">All</li>
                             @foreach ($categories as $category)
                                 <li data-filter=".{{ strtolower(str_replace(' ', '-', $category->name)) }}">
                                     {{ $category->name }}
                                 </li>
                             @endforeach
                         </ul>
                     </div>
                 </div>
             </div>

             <div class="row featured__filter">
                 {{-- Display 8 products for "All" --}}
                 @foreach ($allProducts as $item)
                     <div class="col-lg-3 col-md-4 col-sm-6 mix">
                         <a href="#">
                             <div class="featured__item">
                                 <div class="featured__item__pic set-bg"
                                     data-setbg="{{ asset('storage/' . $item->images->first()->image) }}">
                                 </div>
                                 <div class="featured__item__text">
                                     <h6>{{ $item->name }}</h6>
                                     <h5>Rp. {{ number_format($item->price, 0, ',', '.') }}</h5>
                                 </div>
                             </div>
                         </a>
                     </div>
                 @endforeach

                 {{-- Display up to 8 products per category --}}
                 @foreach ($categories as $category)
                     @foreach ($products[$category->id] as $item)
                         <div
                             class="col-lg-3 col-md-4 col-sm-6 mix {{ strtolower(str_replace(' ', '-', $category->name)) }}">
                             <a href="{{ route('customer.shop.detail', $item) }}">
                                 <div class="featured__item">
                                     <div class="featured__item__pic set-bg"
                                         data-setbg="{{ asset('storage/' . $item->images->first()->image) }}">
                                     </div>
                                     <div class="featured__item__text">
                                         <h6>{{ $item->name }}</h6>
                                         <h5>Rp. {{ number_format($item->price, 0, ',', '.') }}</h5>
                                     </div>
                                 </div>
                             </a>
                         </div>
                     @endforeach
                 @endforeach
             </div>
         </div>
     </section>
     <!-- Featured Section End -->
 @endsection
