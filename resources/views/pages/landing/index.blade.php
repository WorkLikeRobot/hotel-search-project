@extends('layouts.guest')

@section('content')
    @include('pages.landing.partials.header')

    <main>
        @include('pages.landing.partials.hero')
        @include('pages.landing.partials.floating-testimonial')
        @include('pages.landing.partials.feature')
        @include('pages.landing.partials.good-reviews')
        @include('pages.landing.partials.property-listings')
        @include('pages.landing.partials.cta')
    </main>

    @include('pages.landing.partials.footer')

@endsection