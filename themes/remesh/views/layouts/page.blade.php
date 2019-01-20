@php
$hasAnnouncement = get_field('announcements_enabled', 'options');
$announcement = get_field('announcement', 'options');
@endphp
<!DOCTYPE html>
<html {{ language_attributes() }} lang="en">
    <head>
        <meta charset="{{ bloginfo( 'charset' ) }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="distribution" content="global" />
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#FC5047s">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        {{-- @header outputs the wordpress header stuff --}}
        @header
        {{-- Here you can use in your child templates to insert what you need in the <head> element. --}}
        @yield('head')
    </head>
    <body class="@yield('body-classes') @if(getenv('WP_ENV')=='development') debug @endif {{$body_class}} @if($hasAnnouncement) has-announcement @endif">
        <div id="breakpoints"></div>
        {{-- Used for debugging css breakpoints --}}
        <div id="breakpoint-debug"></div>
        <?php if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); } ?>


        <header>
            @if($hasAnnouncement)
                <div id="announcement">
                    {!! $announcement !!}
                </div>
            @endif
            <div class="interior">
                <a href="/">@svg('logo-remesh.svg')</a>
                <nav>
                    @remeshNav('primary')
                    <button class="hamburger hamburger--spin" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                    </button>
                </nav>

                <div id="mobile-menu" class="removed hidden">
                    <div class="header">
                        <a href="/">@svg('logo-remesh.svg')</a>
                    </div>
                    <div class="contents">
                        @remeshMenuTemplate('primary', 'partials.mobile-menu')
                    </div>
                </div>
            </div>
        </header>

        <main>
            @yield('main')
            <footer>
                <div class="interior">
                    <div class="header">
                        <a href="/">@svg('logo-remesh.svg')</a>
                        <span class="footer-header">Newsletter</span>
                    </div>
                    <div class="columns">
                        <div class="left">
                            <p>{!! get_field('footer_text', 'options') !!}</p>
                            <div class="social">
                                @remeshSocialNav('social')
                            </div>
                        </div>
                        <div class="middle">
                            <nav>
                                @flatmenu('footer')
                            </nav>
                        </div>
                        <div class="right">
                            <span class="footer-header">Newsletter</span>
                            {!! get_field('footer_form_embed', 'options') !!}
                            <div class="social">
                                @remeshSocialNav('social')
                            </div>
                            <span class="copy">&copy;{{date('Y')}}&nbsp;&nbsp;|&nbsp;&nbsp;All rights reserved</span>
                        </div>
                    </div>
                </div>
                @yield('footer')
            </footer>
        </main>



        {{-- @footer outputs all the WordPress footer stuff --}}
        @footer

        {{-- If your templates need scripts output in the bottom of the page, they go in this section --}}
        @yield('scripts')

        {{-- Include page analytics --}}
        @include('partials/analytics')
    </body>
</html>