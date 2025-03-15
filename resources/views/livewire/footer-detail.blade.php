<section class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="footer-widget about-widget">
                    <h2>About</h2>
                    <p>{{ $systemDetail->description }}</p>
                    <img src="{{ asset('frontend/img/cards.png') }}" alt="">
                </div>
            </div>

            <div class="col-lg-6 col-sm-12">
                <div class="footer-widget contact-widget">
                    <h2>Contact</h2>
                    <div class="con-info">
                        <span>C.</span>
                        <p>{{ $systemDetail->name }} </p>
                    </div>
                    <div class="con-info">
                        <span>B.</span>
                        <p>{{ $systemDetail->address }} </p>
                    </div>
                    <div class="con-info">
                        <span>T.</span>
                        <p>{{ $systemDetail->tel }}</p>
                    </div>
                    <div class="con-info">
                        <span>E.</span>
                        <p>{{ $systemDetail->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
