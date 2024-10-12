@extends('customer.partials.app')

@section('content')
    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{ asset('storage/' . $product->images->first()->image) }}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel owl-loaded owl-drag">

                            <div class="owl-stage-outer">
                                <div class="owl-stage"
                                    style="transform: translate3d(-470px, 0px, 0px); transition: 1.2s; width: 1410px;">
                                    @foreach ($product->images as $image)
                                        <div class="owl-item cloned" style="width: 97.5px; margin-right: 20px;"><img
                                                data-imgbigurl="{{ asset('storage/' . $image->image) }}"
                                                src="{{ asset('storage/' . $image->image) }}" alt=""></div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span
                                        aria-label="Previous">‹</span></button><button type="button" role="presentation"
                                    class="owl-next"><span aria-label="Next">›</span></button></div>
                            <div class="owl-dots disabled"><button role="button"
                                    class="owl-dot active"><span></span></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $product->name }}</h3>
                        <div class="product__details__price">Rp. {{ number_format($product->price, 0, ',', '.') }}</div>
                        <p>{{ $product->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
