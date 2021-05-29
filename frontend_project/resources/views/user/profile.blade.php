@extends('layouts.app')
@section('content')
<style>


.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: #BA68C8;
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}
</style>
<form action="{{ route('user.update' , $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="container rounded bg-white mt-5">
    <div class="row">
        <div class="col-md-4 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img style="cursor: pointer" id="output" class="rounded-circle mt-5 avatar_user" src="{{ (empty($user->image))? 'https://upload.wikimedia.org/wikipedia/commons/f/f4/User_Avatar_2.png' : asset($user->image) }}" width="90"><span class="font-weight-bold">{{ $user->name }}</span><span class="text-black-50">{{ $user->email }}</span><span>{{ $user->address }}</span></div>
            <input type="file" name="image" hidden>
        </div>
            <div class="col-md-8">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-row align-items-center back"><i class="fa fa-long-arrow-left mr-1 mb-1"></i>
                            <h6>Back to home</h6>
                        </div>
                        <h6 class="text-right">Edit Profile</h6>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><input type="text" class="form-control" name="name" placeholder="Name" value="{{ $user->name }}" required></div>
                        <div class="col-md-6"><input type="text" class="form-control" name="email" value="{{ $user->email }}" placeholder="Email" required></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><input type="text" class="form-control" name="phone" placeholder="Phone" value="{{ $user->phone }}}" required></div>
                        <div class="col-md-6"><input type="text" class="form-control" name="address" value="{{ $user->address }}" placeholder="Address"></div>
                    </div>
                    <div class="mt-3">
                        @php
                            $count_order = DB::table('orders')->where('user_id' , $user->id )->count();
                        @endphp
                        <div class="col-md-6">Order: {{ $count_order }}</div>
                        <div class="col-md-6"><a href="">Check order</a> </div>
                    </div>
                    {{-- <div class="row mt-3">
                        <div class="col-md-6"><input type="text" class="form-control" placeholder="Bank Name" value="Bank of America"></div>
                        <div class="col-md-6"><input type="text" class="form-control" value="043958409584095" placeholder="Account Number"></div>
                    </div> --}}
                    <div class="mt-5 text-right"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
                </div>
            </div>
    </div>
</div>
</form>

<script>
    $('.avatar_user').click(function(){
            $('input[name=image]').click();
        })
        
        var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
@endsection