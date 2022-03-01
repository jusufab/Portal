<?php

include_once("config.php");
include("header.php");

$post = 'SELECT * FROM content';
$result = mysqli_query($mysqli, $post);

if (mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){

?>
<div class="container">
    <div class="row">
            <div class="col-lg-4 col-md-10 mx-auto" style="display:inline-block">
            <h3><?php echo $row['contact_title']; ?></h3>
            <p><?php echo $row['contact_text']; ?></p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d740.9741508896547!2d21.432705903270936!3d42.023950455489015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x135415abaac10cb9%3A0xe03cbc322c4f9fb9!2sDigital%20School%20Chair!5e0!3m2!1sen!2smk!4v1624286823215!5m2!1sen!2smk" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>

            <div class="col-lg-4 col-md-10 mx-auto" style="display:inline-block">
            <div class="form-group floating-label-form-group controls">
                <?php if (isset($_SESSION['sent'])) : ?>
                <div class="alert alert-warning sty <?php echo $_SESSION['alert-class']; ?> " style="width:70%">
                    <?php
                        echo $_SESSION['sent'];
                        unset($_SESSION['sent']);
                        unset($_SESSION['alert-class']);
                        ?>
                </div>
                <?php endif; ?>

                <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon
                    as possible!</p>
                <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work.-->
                <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address!-->
                <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally!-->
                <form id="contactForm" name="sentMessage" action="send-email.php" method="POST">
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">


                            <label>Name</label>
                            <div style="background-color: red;">
                                <?php if (isset($_SESSION['sent'])) : ?>
                                <div class="alert alert-warning <?php echo $_SESSION['alert-class']; ?> ">
                                    <?php
                                        echo $_SESSION['sent'];
                                        unset($_SESSION['sent']);
                                        unset($_SESSION['alert-class']);
                                        ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <input class="form-control" id="name" name="name" type="text" placeholder="Name"
                                data-validation-required-message="Please enter your name." />
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Email Address</label>
                            <input class="form-control" id="email" name="email" type="email" placeholder="Email Address"
                                data-validation-required-message="Please enter your email address." />
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Phone Number</label>
                            <input class="form-control" id="phone" type="tel" name="phone" placeholder="Phone Number"
                                data-validation-required-message="Please enter your phone number." />
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Message"
                                data-validation-required-message="Please enter a message."></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <br />
                    <div id="success"></div>
                    <button class="btn btn-primary" name="submit" id="sendMessageButton" type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>
    <hr />
</div>

<?php

}
}else{
    echo "0 results";
}
mysqli_close($mysqli);

include('footer.php');

?>
