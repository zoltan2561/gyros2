<!-- Footer Start Here -->
<footer>
    <!------------------- Footer Features Start Here ------------------->
    <div class="theme-2-product-service">
        <div class="container">
            <div class="row justify-content-center my-4">
                @foreach (helper::footer_features() as $feature)
                    <div class="col-xl-3 col-md-6 col-sm-6">
                        <div class="card border-0 bg-transparent">
                            <div class="card-body d-flex gap-3 p-md-3 p-2">
                                <div class="quality-icon col-3">
                                    {!! $feature->icon !!}
                                </div>
                                <div class="quality-content">
                                    <h3>{{ $feature->title }}</h3>
                                    <p class="m-0 text-muted fs-7">{{ $feature->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!------------------- Footer Features End Here ------------------->

    <div class="footer pt-3">
        <div class="container">
            <div class="py-sm-5 py-4 border-bottom-primary">
                <div class="row justify-content-between g-4 footer-area py-4">
                    <div class="col-lg-4 left-side mt-3">
                        <a href="{{ route('home') }}">
                            <img src="{{ helper::image_path(@helper::appdata()->logo) }}" height="55" class="my-3"
                                alt="footer_logo">
                        </a>
                        <h1>{{ @helper::appdata()->footer_title }}</h1>
                        <p class="mb-0">{{ @helper::appdata()->footer_description }}</p>
                    </div>

                    <div class="col-lg-8 right-side">
                        <div class="row g-3">
                            <div class="col-md-4 col-lg-4 col-xl-4 col-6 mb-4 mb-sm-0">
                                <h4>{{ trans('labels.pages') }}</h4>
                                <ul>
                                    <li><a href="{{ route('about-us') }}"
                                            class="text-white">{{ trans('labels.about') }}</a>
                                    </li>
                                    <li><a href="{{ route('privacy-policy') }}"
                                            class="text-white">{{ trans('labels.privacy_policy') }}</a></li>
                                    <li><a href="{{ route('refund-policy') }}"
                                            class="text-white">{{ trans('labels.refund_policy') }}</a></li>
                                    <li><a href="{{ route('terms-conditions') }}"
                                            class="text-white">{{ trans('labels.terms_condition') }}</a></li>
                                </ul>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4 col-6 mb-4 mb-sm-0">
                                <h4>{{ trans('labels.other') }}</h4>
                                <ul>
                                    <li><a href="{{ route('categories') }}"
                                            class="text-white">{{ trans('labels.menu') }}</a>
                                    </li>
                                    <li><a href="{{ route('faq') }}" class="text-white">{{ trans('labels.faq') }}</a>
                                    </li>
                                    <li><a href="{{ route('contact-us') }}"
                                            class="text-white">{{ trans('labels.help_contact_us') }}</a></li>
                                    <li><a href="{{ route('gallery') }}"
                                            class="text-white">{{ trans('labels.gallery') }}</a>
                                    </li>
                                    @if (@helper::checkaddons('blog'))
                                        <li><a href="{{ route('blogs') }}"
                                                class="text-white">{{ trans('labels.blogs') }}</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4 col-12 mb-4 mb-sm-0">
                                <h4>{{ trans('labels.help_contact_us') }}</h4>
                                <ul class="contact-detail">
                                    <a href="callto:{{ helper::appdata()->mobile }}">
                                        <li class="d-flex align-items-center text-white">
                                            <i
                                                class="fa-light fa-phone {{ session()->get('direction') == '2' ? 'ms-2' : 'me-2' }}"></i>
                                            <p class="mb-0">{{ helper::appdata()->mobile }}</p>
                                        </li>
                                    </a>
                                    <a href="mailto:{{ helper::appdata()->email }}">
                                        <li class="d-flex align-items-center text-white">
                                            <i
                                                class="fa-light fa-envelope {{ session()->get('direction') == '2' ? 'ms-2' : 'me-2' }}"></i>
                                            <p class="mb-0">{{ helper::appdata()->email }}</p>
                                        </li>
                                    </a>
                                </ul>
                                <div class="col-auto mt-3 d-flex flex-wrap gap-2">
                                    @foreach (helper::sociallinks() as $sociallink)
                                        <div class="footer-box">
                                            <a class="text-white " href="{{ $sociallink->link }}" target="_blank">
                                                {!! $sociallink->icon !!} </a>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <img src="{{ asset('barion.png') }}"
                             alt="Barion"
                             style="height:40px; margin-top:10px; max-width:100%;"
                             class="d-block d-sm-inline"
                        >
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="max-width: 800px;">
            <div class="d-flex flex-column align-items-center text-center py-4">
                <a href="https://pzoli.com" target="_blank" class="matrix-text fs-6 mb-0 text-decoration-none">
                    {{ helper::appdata()->copyright }}
                </a>
            </div>
        </div>

        <style>
            .matrix-text {
                color: #00ff66; /* Matrix-zöld */
                font-family: 'Courier New', monospace;
                text-shadow: 0 0 5px #00ff66;
                animation: blink 3s infinite; /* lassabb */
                transition: color 0.3s ease-in-out;
            }

            @keyframes blink {
                0%, 90% { opacity: 1; }
                95%     { opacity: 0.6; }
                100%    { opacity: 1; }
            }

            .matrix-text:hover {
                color: #ffffff; /* hover-re váltson fehérre */
                text-shadow: 0 0 10px #00ff66, 0 0 20px #00ff66;
            }
        </style>



</footer>
<!-- Footer End here -->
