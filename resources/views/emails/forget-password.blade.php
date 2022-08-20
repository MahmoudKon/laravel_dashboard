<div style="background-color: #ccc; padding: 100px 0">

    <div style="width: 60%; margin: auto; padding: 30px; background-color: #fff; color: #777; font-size: 15px">

        <h3>Hello</h3>

        <p>You are receiving this email because we received a password reset request for your account.</p>

        <p>Pincode: </p>

        <h3>{{ $row->pincode }}</h3>

        <p>This password reset pin code will expire in 60 minutes.</p>

        <p>If you did not request a password reset, no further action is required.</p>

        <p>Regards, <br> <b>{{ setting('site_name') }}</b> </p>

    </div>

</div>
