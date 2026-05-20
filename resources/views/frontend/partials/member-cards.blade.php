@foreach($members as $member)
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 member-item" style="margin-bottom: 25px;">
        <div class="card member-card border-0 shadow-sm h-100 text-center position-relative" style="border-radius: 20px; background: #ffffff; padding: 25px 15px; border-bottom: 4px solid #1A237E; transition: 0.3s;">
            
            <!-- স্মার্টলি টপ-রাইটে মেম্বার আইডি ব্যাজ (আপনার টেবিলের mid কলাম) -->
            <div class="position-absolute top-0 end-0 m-3 px-2 py-1 badge text-primary" style="border-radius: 6px; font-size: 11px; font-weight: 700; background-color: rgba(26, 35, 126, 0.05);">
                ID: {{ $member->mid }}
            </div>

            <div class="card-body p-0 d-flex flex-column justify-content-between">
                
                <!-- প্রফেশনাল মেম্বার অবতার বা ইমেজ এরিয়া (১০০ পিক্সেল স্মার্ট সাইজ কম্বিনেশন সহ) -->
                <div class="mb-3 text-center d-flex justify-content-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm avatar-wrapper" 
                         style="width: 100px; height: 100px; background-color: #f8fafc; border: 4px solid #ffffff; overflow: hidden; transition: 0.3s;">
                        @if(!empty($member->userpic))
                            <img src="{{ asset('uploads/user/' . basename($member->userpic)) }}" 
                                 alt="NHCS Member" 
                                 class="w-100 h-100 object-fit-cover"
                                 loading="lazy"
                                 style="mix-blend-mode: multiply;"
                                 onerror="this.src='https://placehold.co'">
                        @else
                            <div class="d-flex align-items-center justify-content-center w-100 h-100" style="background: rgba(26, 35, 126, 0.05); color: #1A237E;">
                                <i class="bi bi-person-fill fs-2"></i>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- মেম্বার নেম ও ডাটাবেজ টেবিল থেকে আসা ডাইনামিক হাসপাতাল নাম -->
                <div class="mb-1">
                    <h6 class="fw-bold text-dark mb-2 member-name" style="font-size: 15px; line-height: 1.4; letter-spacing: 0.2px; text-transform: uppercase;">
                        {{ $member->name_english ?? 'Registered Nurse' }}
                    </h6>
                    
                    <div class="d-flex justify-content-center align-items-start gap-1 text-muted px-2" style="font-size: 12px; line-height: 1.5; min-height: 48px;">
                        <i class="bi bi-hospital text-danger" style="flex-shrink: 0; font-size: 13px; margin-top: 1px;"></i>
                        <span style="text-align: center; font-weight: 500;">
                            <!-- leftJoin কুয়েরি থেকে আসা আসল হাসপাতালের নাম প্রদর্শন করা হচ্ছে -->
                            {{ $member->true_hospital_name ?? 'Government Hospital, Dhaka' }}
                        </span>
                    </div>
                </div>

                <hr class="my-2 opacity-5" style="border-color: #eee;">

                <!-- ব্লাড গ্রুপ এবং মোবাইল মাস্কিং ট্র্যাকার ফুটার -->
                <div class="mt-auto d-flex justify-content-between align-items-center px-1 pt-1">
                    <span style="font-size: 11px; font-weight: 700; color: #e74c3c;">
                        <i class="bi bi-droplet-fill"></i> Blood: {{ $member->bloodgroup ?? 'O+' }}
                    </span>
                    @if(!empty($member->mobileno))
                        @php
                            $cleanPhone = trim($member->mobileno);
                            $maskedPhone = (strlen($cleanPhone) >= 11) ? substr($cleanPhone, 0, 5) . '***' . substr($cleanPhone, -3) : $cleanPhone;
                        @endphp
                        <span class="text-muted" style="font-size: 11px; font-weight: 600;">
                            <i class="bi bi-telephone-fill text-primary"></i> {{ $maskedPhone }}
                        </span>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endforeach
