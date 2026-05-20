<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{

    public function photoGallery()
    {
        // লারাভেল কুয়েরি বিল্ডার দিয়ে ডাটা লেটেস্ট ক্রমানুসারে তুলে আনা হলো
        $photos = DB::table('galleries')
                    ->where('media_type', 'image')
                    ->where('status', 2)
                    ->orderBy('upload_date', 'desc')
                    ->paginate(12); // প্রতি পেজে ১২টি করে ছবি দেখাবে (Pagination Friendly)

        // resources/views/frontend/photo-gallery.blade.php ফাইলে ডেটা পাঠানো হলো
        return view('frontend.photo-gallery', compact('photos'));
    }

    /**
     * ২. ভিডিও গ্যালারি পেজ (Video Gallery)
     * ডেটাবেজ থেকে শুধুমাত্র ভিডিও (media_type = video) এবং সক্রিয় (status = 2) রেকর্ডগুলো নিয়ে আসবে।
     */
    public function videoGallery()
    {
        $videos = DB::table('galleries')
                    ->where('media_type', 'video')
                    ->where('status', 2)
                    ->orderBy('upload_date', 'desc')
                    ->paginate(9); // প্রতি পেজে ৯টি করে ভিডিও দেখাবে

        // resources/views/frontend/video-gallery.blade.php ফাইলে ডেটা পাঠানো হলো
        return view('frontend.video-gallery', compact('videos'));
    }
}
