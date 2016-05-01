
@extends('layouts.email')

@section('content')
  <div style="Margin-left: 20px;Margin-right: 20px;">
      <h3 style="Margin-top: 0;Margin-bottom: 0;font-style: normal;font-weight: normal;color: #788991;font-size: 16px;line-height: 24px;text-align: center;">WELCOME</h3>
      <h1 style="Margin-top: 12px;Margin-bottom: 0;font-style: normal;font-weight: normal;color: #3e4751;font-size: 26px;line-height: 34px;font-family: Ubuntu,sans-serif;text-align: center;">
      To The Cnsytex Commiunity</h1>
      <p style="Margin-top: 20px;Margin-bottom: 20px;">
        <span>Hi there, </span><span>
            Thanks for creating an account with our greetingcard shop.
            To complete your sign up, please verify your email using the following link:<br/>
           <!-- {{ URL::to('register_verify_' .  $confirmation_code ) }}. -->
            <br/>.&nbsp;</span></p>
    </div>
    
            <div style="Margin-left: 20px;Margin-right: 20px;">
      <div class="divider" style="display: block;font-size: 2px;line-height: 2px;width: 40px;background-color: #b4b4c4;Margin-left: 260px;Margin-right: 260px;Margin-bottom: 20px;">&nbsp;</div>
    </div>
    
            <div style="Margin-left: 20px;Margin-right: 20px;">
      <div style="line-height:5px;font-size:1px">&nbsp;</div>
    </div>
    
            <div style="Margin-left: 20px;Margin-right: 20px;">
      
<h2 class="size-16" style="Margin-top: 0;Margin-bottom: 0;font-style: normal;font-weight: normal;color: #3e4751;font-size: 16px;line-height: 24px;font-family: Ubuntu,sans-serif;">
<strong>What does this mean for me?</strong></h2>
<p style="Margin-top: 16px;Margin-bottom: 0;">As a loyal Co.Banking customer, you will now have free access to the Payback
 platform including the integration between the two apps. Now when you share payments on Payback, all the details will be 
 available in your Co.
 Banking account and transactions made through Payback will be free for all your Co.Banking accounts.
 Additionally with this integration, you'll be able to leverage Co.Banking reporting services for all your activity.</p>
 <p style="Margin-top: 20px;Margin-bottom: 20px;">
 For more information, please check out our official blog.&nbsp;</p>
    </div>
@endsection
