@extends('layouts.app')

@section('content')
<div class="m-3 container-fluid">
    @if (isset($module))
    <div class="row pb-4">
        <div class="col-8">
            <h2><strong>{{ $module->name }}</strong></h2>
        </div>
        <div class="col-4">
            <a href=" {{ route('post.create', $module->id) }} " class="btn btn-success float-right">Create post!</a>
        </div>
    </div>
        
        <div class="row justify-content-center">
                
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 d-none d-sm-none d-md-block ">
                @foreach ($module->users as $user)
                    <div class="card">
                        <div class="card-body" >
                            <div class="row">
                                <div class="col-lg-2 d-none d-lg-block d-xl-none"></div>
                                <div class="col-md-2 d-none d-md-block d-lg-none"></div>
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-4 justify-content-center pt-2 pb-2">
                                    <img class="rounded-circle" src="{{ Storage::url($user->avatar) }}"  style="width: 100%;">
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-8 pt-2">
                                    <a href=" # "> <h5 class="m-0">{{ $user->name }}</h5> </a>
                                    <P class="m-0">{{ $user->profile->career->name }}</P>
                                    <p class="text-muted mb-0">{{ $user->roles->first()->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if (count($module->posts) > 0)
                <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 d-none d-sm-block d-block d-sm-nonecol-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 d-none d-sm-block">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">{{ $user->name }}</h5>
                        </div>
                        <div class="card-body">
                            
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 d-none d-sm-block d-block d-sm-none">
                    <h3 class="text-center"> There are no posts!</h3>
                </div> 
            @endif

        </div>
    @else
        <h3 class="text-center"> There are no data!</h3>
    @endif
</div>
@endsection