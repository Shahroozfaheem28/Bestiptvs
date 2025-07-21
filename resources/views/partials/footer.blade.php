<footer class="bg-dark text-white pt-5 pb-4 mt-5">
    <div class="container text-md-left">
        <div class="row text-md-left">

            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Best IPTV UK</h5>
                <p>
                    High-quality IPTV service with premium UK, USA & international channels. No buffering, fast delivery
                    & 24/7 support.
                </p>
            </div>

            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Quick Links</h5>
                <p><a href="{{ url('/') }}" class="text-white" style="text-decoration: none;">Home</a></p>
                <p><a href="{{ url('/plan') }}" class="text-white" style="text-decoration: none;">Shop</a></p>
                <p><a href="{{ url('/faq') }}" class="text-white" style="text-decoration: none;">FAQ</a></p>
                <p><a href="{{ url('/contact') }}" class="text-white" style="text-decoration: none;">Contact</a></p>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">About Company</h5>

                <p><a href="{{ url('/about-company') }}" class="text-white" style="text-decoration: none;">About
                        Company</a></p>
                <p><a href="{{ url('/Privacy-Policy') }}" class="text-white" style="text-decoration: none;">Privacy
                        Policy</a></p>
                <p><a href="{{ url('/refund-return') }}" class="text-white" style="text-decoration: none;">Refund &
                        Returns</a></p>
                <p><a href="{{ url('/terms-conditions') }}" class="text-white" style="text-decoration: none;">Terms &
                        Conditions</a></p>
            </div>

            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Contact</h5>
                <p><i class="fas fa-home mr-3"></i> {{ $contact->address }}</p>
                <p><i class="fas fa-envelope mr-3"></i> {{ $contact->email }}</p>
                <p><i class="fab fa-whatsapp mr-3"></i> {{ $contact->whatsapp_number }}</p>
            </div>

        </div>

        <hr class="mb-4">

        <div class="row align-items-center">
            <div class="col-md-7 col-lg-8">
                <p>© 2025 All Rights Reserved by <a href="{{ url('/') }}" class="text-warning"
                        style="text-decoration: none;"><strong>Best IPTV UK</strong></a></p>
            </div>

            <div class="col-md-5 col-lg-4">
                <div class="text-center text-md-right">
                    <a class="btn btn-outline-light btn-floating m-1" href="#"><i
                            class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-floating m-1" href="#"><i
                            class="fab fa-instagram"></i></a>
                    <a class="btn btn-outline-light btn-floating m-1" href="https://wa.me/message/KHBXAI3XFZNHC1"><i
                            class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>

    </div>
</footer>
