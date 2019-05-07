@extends('layouts.app')

@section('content')
<div class="row">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9">
                        @csrf
                        <div class="card-body">
    
                            <div class="card-title text-center">
                                <h4> Create a Post </h4>
                            </div>

                            <div class="row">
                                
                                @include('messages.messages')
                                <form action="{{ route('post.store') }}" method="POST" class="row">

                                @if(Auth::user()->hasRole('tutor'))
                                
                                @csrf 
                                <!-- User_Id -->
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">


                                <!-- Subject -->
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">{{ __('Subject') }}</label>
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                            value="{{ isset($post) ? $post->name : old('name') }}" required autofocus>
                                
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <!-- Description -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-heart"></i></span>
                                    </div>
                                    <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" cols="5" rows="5" placeholder="Description" style="resize: none;">{{ isset($post->description) ? $post->description : old('description') }}</textarea>
                                    
                                    @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>


                                <!-- Botones -->
                                <div class="col-md-5">
                                    <a href="{{ route('post.store') }}" class="btn btn-danger btn-block">
                                            {{ __('Cancel') }}
                                    </a>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-primary btn-block">
                                            {{ __('Save') }}
                                    </button>
                                </div>

                                @endif

                            </div>
                        
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection