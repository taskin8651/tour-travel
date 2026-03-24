<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Enquiry</title>
</head>
<body style="font-family: Arial; background:#f4f4f4; padding:20px;">

<div style="max-width:600px; margin:auto; background:#fff; padding:20px; border-radius:8px;">

    <h2 style="color:#333;">📩 New Enquiry Received</h2>

    <table width="100%" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">

    <tr><td><strong>Name:</strong></td><td>{{ $enquiry->name }}</td></tr>

    @if($enquiry->email)
    <tr><td><strong>Email:</strong></td><td>{{ $enquiry->email }}</td></tr>
    @endif

    <tr><td><strong>Phone:</strong></td><td>{{ $enquiry->phone }}</td></tr>

    @if($enquiry->category?->name)
    <tr><td><strong>Category:</strong></td><td>{{ $enquiry->category->name }}</td></tr>
    @endif

    @if($enquiry->listing?->title)
    <tr><td><strong>Listing:</strong></td><td>{{ $enquiry->listing->title }}</td></tr>
    @endif

    @if($enquiry->travel_date)
    <tr>
        <td><strong>Travel Date:</strong></td>
        <td>{{ \Carbon\Carbon::parse($enquiry->travel_date)->format('d M Y') }}</td>
    </tr>
    @endif

    @if($enquiry->persons)
    <tr><td><strong>Persons:</strong></td><td>{{ $enquiry->persons }}</td></tr>
    @endif

    @if($enquiry->checkin_date)
    <tr>
        <td><strong>Check-in:</strong></td>
        <td>{{ \Carbon\Carbon::parse($enquiry->checkin_date)->format('d M Y') }}</td>
    </tr>
    @endif

    @if($enquiry->checkout_date)
    <tr>
        <td><strong>Check-out:</strong></td>
        <td>{{ \Carbon\Carbon::parse($enquiry->checkout_date)->format('d M Y') }}</td>
    </tr>
    @endif

    @if($enquiry->rooms)
    <tr><td><strong>Rooms:</strong></td><td>{{ $enquiry->rooms }}</td></tr>
    @endif

    @if($enquiry->package_requirements)
    <tr><td><strong>Package:</strong></td><td>{{ $enquiry->package_requirements }}</td></tr>
    @endif

    @if($enquiry->message)
    <tr>
        <td><strong>Message:</strong></td>
        <td>{{ $enquiry->message }}</td>
    </tr>
    @endif

</table>

    <p style="margin-top:20px; font-size:12px; color:#777;">
        This email was generated automatically from your website enquiry form.
    </p>

</div>

</body>
</html>
