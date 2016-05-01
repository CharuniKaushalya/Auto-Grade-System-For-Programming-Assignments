<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Registration for Cnsytex</h2>

        <div>
            {{ $name }},
            <br/>
            <br/>
            <br/>

            You are registered for Cnsytex-Auto-Grade System For Programming Assignments
            you can access our website http://charuni.onlinecompiler.cnsytex.com/<br/>
            <br/>
            <br/>

            To complete your sign up, please verify your email using the following link:<br/>
            {{ URL::to('register_verify_' .  $confirmation_code ) }}.
            <br/>
            <br/>
            <br/>

            Your Email {{ $email }}
            <br/>
            <br/>
            Your Password {{ $password }}
            <br/>
            <br/>
            <br/>

        </div>
        <p>Cheers,</p>
        <h3>Cnsytex Team</h3>

    </body>
</html>