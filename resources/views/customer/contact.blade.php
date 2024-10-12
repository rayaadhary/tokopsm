@extends('customer.partials.app')

@section('content')
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>Phone</h4>
                        <p>+62858-6309-9783</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Address</h4>
                        <p>Bunisari, Pameuntasan, Kec. Kutawaringin, Kabupaten Bandung, Jawa Barat 40911</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>Open time</h4>
                        <p>07:00 am to 04:30 pm</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.298980642902!2d107.5391800738884!3d-6.9740092682869115!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68ef177b012661%3A0x17b05791ca765a42!2sPutra%20subur%20makmur!5e0!3m2!1sen!2sid!4v1728652020607!5m2!1sen!2sid"
            height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        <div class="map-inside">
            <i class="icon_pin"></i>
            <div class="inside-widget">
                <h4>Putra Subur Makmur</h4>
                <ul>
                    <li>Furniture Store</li>
                    <li>+62858-6309-9783</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Leave Message</h2>
                    </div>
                </div>
            </div>
            <form id="whatsapp-form">
                <div class="row">
                    <div class="col-lg-12 col-md-6">
                        <input type="text" id="subject" placeholder="Subject" required>
                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea id="message" placeholder="Your message" required></textarea>
                        <button type="submit" class="site-btn">SEND MESSAGE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('whatsapp-form').addEventListener('submit', function(e) {
            e.preventDefault();
            var subject = document.getElementById('subject').value;
            var message = document.getElementById('message').value;

            var whatsappMessage = `Subject: ${subject}%0A%0A${message}`;

            var whatsappNumber = '6289525670855';

            var whatsappURL = `https://wa.me/${whatsappNumber}?text=${whatsappMessage}`;
            window.open(whatsappURL, '_blank');
        });
    </script>
@endpush
