<?php include("includes/header.php"); ?>

<style>
    .contact-hero {
        background: linear-gradient(to right,
            rgba(25,135,84,0.7),
            rgba(25,135,84,0.5)),
            url('assets/img/contact-bg.jpg');
        background-size: cover;
        background-position: center;
        height: 40vh;
        border-radius: 16px;
    }
</style>

<!-- =============== PAGE HEADER =============== -->
<div class="container mt-4 fade-in">
    <div class="contact-hero d-flex align-items-center px-4">
        <div>
            <h1 class="text-white fw-bold">Get in Touch</h1>
            <p class="text-light mb-0">We’d love to hear from you – send us a message</p>
        </div>
    </div>
</div>

<!-- =============== CONTACT SECTION =============== -->
<div class="container my-5 fade-in">
    <div class="row g-4">

        <!-- LEFT: CONTACT FORM -->
        <div class="col-lg-7">
            <div class="card shadow-sm p-4 rounded-4">
                <h4 class="fw-bold mb-3 text-success">Send Us a Message</h4>

                <form action="#" method="POST">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Full Name</label>
                        <input type="text" class="form-control p-3" placeholder="Enter your name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="email" class="form-control p-3" placeholder="example@gmail.com" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Subject</label>
                        <input type="text" class="form-control p-3" placeholder="Message subject" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Message</label>
                        <textarea class="form-control p-3" rows="6" placeholder="Write your message..." required></textarea>
                    </div>

                    <button class="btn btn-success rounded-pill px-4 py-2">
                        Send Message
                    </button>
                </form>
            </div>
        </div>

        <!-- RIGHT: CONTACT INFO CARD -->
        <div class="col-lg-5">
            <div class="card shadow-sm p-4 rounded-4">

                <h4 class="fw-bold mb-3 text-success">Contact Information</h4>

                <p class="text-muted">You can reach us using the details below:</p>

                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Email:</strong>
                        <span>support@zariamarket.com</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Phone:</strong>
                        <span>+234 812 345 6789</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Address:</strong>
                        <span>Zaria, Kaduna State</span>
                    </li>
                </ul>

                <h5 class="fw-bold">Working Hours</h5>
                <p class="text-muted mb-0">Monday – Friday: 9AM – 5PM</p>
                <p class="text-muted">Saturday: 10AM – 3PM</p>

            </div>
        </div>

    </div>
</div>

<?php include("includes/footer.php"); ?>
