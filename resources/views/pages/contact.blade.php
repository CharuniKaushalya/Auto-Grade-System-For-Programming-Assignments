@extends('layouts.front')

@section('content')
<!-- page content wrapper -->
                <div class="page-content-wrap">                    
                    
                    <!-- page content holder -->
                    <div class="page-content-holder">
                    
                        <div class="row">
                            <div class="col-md-7 this-animate" data-animate="fadeInLeft">
                                
                                <div class="text-column">
                                    <h4>Contact Us</h4>
                                    <div class="text-column-info">
                                        Proin luctus nulla fringilla massa euismod commodo. Donec sit amet elementum libero. Curabitur ut lorem id tellus malesuada tincidunt et eget purus. 
                                    </div>
                                </div>
                                
                                <div class="row">
                                <form role="form" method="POST" action="{{ url('/contact') }}">
                                {!! csrf_field() !!}

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name <span class="text-hightlight">*</span></label>
                                            <input type="text" class="form-control" name="name"/>
                                            @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>E-mail <span class="text-hightlight">*</span></label>
                                            <input type="text" class="form-control" name="email"/>
                                            @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Subject <span class="text-hightlight">*</span></label>
                                            <input type="text" class="form-control" name="subject"/>
                                            @if ($errors->has('subject'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('subject') }}</strong>
                                            </span>
                                        @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Message <span class="text-hightlight">*</span></label>
                                            <textarea type="text" class="form-control" rows="8" name="message"></textarea>
                                            @if ($errors->has('message'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('message') }}</strong>
                                            </span>
                                        @endif
                                        </div>
                                        <button class="btn btn-primary btn-lg pull-right">Send Message</button>
                                    </div>
                                </form>
                                </div>
                                
                            </div>
                            <div class="col-md-5 this-animate" data-animate="fadeInRight">
                                
                                <div class="text-column text-column-centralized">
                                    <div class="text-column-icon">
                                        <span class="fa fa-home"></span>
                                    </div>                                    
                                    <h4>Our Office</h4>
                                    <div class="text-column-info">
                                        <p><strong><span class="fa fa-map-marker"></span> Address: </strong> 64/A, Mabima, Makevita, Ja-Ela, SL 11000</p>
                                        <p><strong><span class="fa fa-phone"></span> Phone: </strong> (071) 122-30-45</p>
                                        <p><strong><span class="fa fa-envelope"></span> E-mail: </strong> <a href="#">snkaushi@gmail.com</a></p>
                                    </div>
                                </div>
                                
                                <div class="text-column text-column-centralized">
                                    <div class="text-column-icon">
                                        <span class="fa fa-clock-o"></span>
                                    </div>
                                    <h4>Bussines Hours</h4>
                                    <div class="text-column-info">
                                        <p><strong>Monday &mdash; Friday</strong>: 10:00am - 6:00pm</p>
                                        <p><strong>Saturday &mdash; Sunday</strong>: 10:00am - 2:00pm</p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                    <!-- ./page content holder -->
                </div>
                <!-- ./page content wrapper -->
@endsection