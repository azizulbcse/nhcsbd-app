@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2 class="title" style="font-weight: bold; color: #7B1FA2;">অ্যাডমিন ড্যাশবোর্ড</h2>
        <p>স্বাগতম, <strong>{{ Auth::user()->name }}</strong>! নার্সেস হেলথ কেয়ার সোসাইটি বাংলাদেশ এর পোর্টালটি সফলভাবে কাজ করছে।</p>
    </div>
</div>
@endsection
