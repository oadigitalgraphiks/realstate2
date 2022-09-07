@extends('frontend.layouts.app')
@section('meta_title'){{ $page->meta_title }}@stop
@php
    if (Session::has('locale')) {
        $lang = Session::get('locale', Config::get('app.locale'));
    } else {
        $lang = 'en';
    }
@endphp
@section('content')

<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a> <span></span> Contact
            </div>
        </div>
    </div>
    <div class="page-content pt-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-11 col-lg-12 m-auto">
                    <section class="row align-items-top mb-50">
                        <div class="col-lg-4 mb-lg-0 mb-md-5 mb-sm-5">
                            <h4 class="mb-20 text-brand">{{ get_setting('contact_heading', null, $lang) ?? "" }}</h4>
                            <h1 class="mb-30">{{ get_setting('contact_second_heading', null, $lang) ?? "" }}</h1>
                            <div class=" mb-4">
                                <h4 class="mb-15 text-brand">{{ get_setting('contact_address_heading_one', null, $lang) ?? "" }}</h4>
                                {!! get_setting('contact_address_one',null,$lang) !!}
                            </div>
                            <div class=" mb-4">
                                <h4 class="mb-15 text-brand">{{ get_setting('contact_address_heading_second', null, $lang) ?? "" }}</h4>
                                {!! get_setting('contact_address_second',null,$lang) !!}
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-12 pl-30">
                                    <div class="contact-from-area padding-20-row-col">
                                        <h5 class="text-brand mb-10">{{ get_setting('contact_form_heading', null, $lang) ?? "" }}</h5>
                                        <h2 class="mb-10">{{ get_setting('contact_form_second_heading', null, $lang) ?? "" }}</h2>
                                        <p class="text-muted mb-30 font-sm">{!! get_setting('contact_form',null,$lang) !!}</p>
                                        <form class="contact-form-style mt-30" id="contact-form" action="{{ route('contact_store') }}" method="POST" autocomplete="off">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="input-style mb-20">
                                                        <input name="name" placeholder="First Name" type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="input-style mb-20">
                                                        <input name="email" placeholder="Your Email" type="email" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="input-style mb-20">
                                                        <input name="phone" placeholder="Your Phone" type="tel" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="input-style mb-20">
                                                        <input name="subject" placeholder="Subject" type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="textarea-style mb-30">
                                                        <textarea name="message" placeholder="Message"></textarea>
                                                    </div>
                                                    <button class="submit submit-auto-width" type="submit">Send message</button>
                                                </div>
                                            </div>
                                        </form>
                                        <p class="form-messege"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection
