<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>নতুন কন্টাক্ট মেসেজ - NHCSBD</title>
</head>
<body style="font-family: 'Segoe UI', Arial, sans-serif; background-color: #f4f6f9; padding: 20px; margin: 0;">
    <div style="background-color: #ffffff; padding: 35px; border-radius: 12px; max-width: 600px; margin: 20px auto; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 6px solid #05B262;">
        <h2 style="color: #1A237E; margin-top: 0; margin-bottom: 20px; font-size: 22px; font-weight: bold; border-bottom: 1px solid #eee; padding-bottom: 15px;">
            <span style="vertical-align: middle;">📩 PORTAL CONTACT MESSAGE</span>
        </h2>
        
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <tr>
                <td style="padding: 6px 0; font-weight: bold; color: #4a5568; width: 120px;">প্রেরকের নাম:</td>
                <td style="padding: 6px 0; color: #2d3748;">{{ $data['name'] }}</td>
            </tr>
            <tr>
                <td style="padding: 6px 0; font-weight: bold; color: #4a5568;">ইমেইল ঠিকানা:</td>
                <td style="padding: 6px 0; color: #2d3748;"><a href="mailto:{{ $data['email'] }}" style="color: #1A237E; text-decoration: none;">{{ $data['email'] }}</a></td>
            </tr>
            <tr>
                <td style="padding: 6px 0; font-weight: bold; color: #4a5568;">বিষয়ের শিরোনাম:</td>
                <td style="padding: 6px 0; color: #2d3748; font-weight: 600;">{{ $data['subject'] }}</td>
            </tr>
        </table>
        
        <div style="margin-top: 25px;">
            <p style="margin-bottom: 8px; font-weight: bold; color: #1A237E; font-size: 15px;">বার্তার বিবরণ বা কমপ্লেইন:</p>
            <div style="background-color: #f8fafc; padding: 20px; border-radius: 8px; color: #334155; font-size: 15px; line-height: 1.6; border: 1px solid #e2e8f0; white-space: pre-line;">
                {{ $data['message'] }}
            </div>
        </div>
        
        <footer style="margin-top: 35px; padding-top: 15px; border-top: 1px solid #eee; text-align: center; color: #94a3b8; font-size: 12px;">
            This email was automatically generated from the Nurses Health Care Society Bangladesh Portal.
        </footer>
    </div>
</body>
</html>
