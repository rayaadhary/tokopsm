      <header class="header">
          <div class="container">
              <div class="row">
                  <div class="col-lg-5">
                      <div class="header__logo">
                          <a href="{{ route('customer.home') }}"><img style="width: 80px; height: 80px;" src="{{ asset('customer/img/hero/header_logo.png') }}"
                                  alt=""></a>
                      </div>
                  </div>
                  <div class="col-lg-7">
                      <nav class="header__menu">
                          <ul>
                              <li class="{{ request()->is('/') ? 'active' : '' }}"><a
                                      href="{{ route('customer.home') }}">Home</a></li>
                              <li class="{{ request()->is('shop*') ? 'active' : '' }}"> <a
                                      href="{{ route('customer.shop') }}">Shop</a>
                              </li>
                              <li class="{{ request()->is('contact*') ? 'active' : '' }}"> <a
                                      href="{{ route('customer.contact') }}">Contact</a>
                              </li>
                          </ul>
                      </nav>
                  </div>
              </div>
              <div class="humberger__open">
                  <i class="fa fa-bars"></i>
              </div>
          </div>
      </header>
