@extends('layouts/app')

@include('layouts.header')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="about">
                    <div class="about__description">
                        <p>Sale, Morocco BASED FILMMAKER AND PHOTOGRAPHER. <br/> SPECIALIZING IN COMMERCIAL WORK WITH A FOCUS ON LIFESTYLE, TRAVEL AND ADVENTURE.</p>
                        <h1>LET WORK TOGETHER</h1>
                        <p>Email me at mehdilamaafar@gmail.com or fill out the form below!</p>
                    </div>
                </div>

                <div class="bottom-section">
                    <div class="form">
                        @include('partials.errors')

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" action="/contact" method="POST">
                            {{ csrf_field() }}

                            <fieldset>

                                <!-- Text input-->
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Your name" class="form-control input-md text__input" required>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control input-md" required>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Your subject here" class="form-control input-md">
                                    </div>
                                </div>

                                <!-- Textarea -->
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea class="form-control" name="message" placeholder="Submit message here" required>{{ old('message') }}</textarea>
                                    </div>
                                </div>

                                <!-- Button -->
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary form__btn">Submit</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                </div>
                    <div class="contact">
                        <div class="contact__img"><img src="repository/about/profile.jpg"></div>
                        <div class="contact__social-media ta-c">
                            <div class="contact__social-media__name"><p>Mehdi Lamaaffar</p></div>
                            <a href="https://www.instagram.com/lamaaffar_mehdi/" class="contact__social-media-icon" target="blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="https://twitter.com/mehdilamaaffar" class="contact__social-media-icon" target="blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="mailto:mehdilamaafar@gmail.com" class="contact__social-media-icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
