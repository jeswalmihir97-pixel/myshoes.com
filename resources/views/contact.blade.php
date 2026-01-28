@extends('layout.cmaster')

@section('content')
<div class="container">
    <h2 class="mb-4">Contact Us</h2>
    <p>If you have any questions, feel free to reach out to us!</p>

    <div class="row">
        <!-- Contact Form -->
        <div class="col-md-6">
            <h5>Send us a message</h5>
            <form id="contactForm">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" class="form-control" placeholder="Your name" name="name">
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Your email" name="email">
                </div>
                <div class="mb-3">
                    <label>Message</label>
                    <textarea class="form-control" rows="4" placeholder="Your message" name="message"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>

            <!-- Success Alert -->
            <div id="formSuccess" class="alert alert-success mt-3 d-none">
                Message sent successfully (demo only)!
            </div>
        </div>

        <!-- Demo Messages Table -->
        <div class="col-md-6">
            <h5 class="mt-4 mt-md-0">Previous Messages</h5>
            <table class="table table-bordered table-striped mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Amit Kumar</td>
                        <td>amit@example.com</td>
                        <td>I have a question about my booking.</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Priya Sharma</td>
                        <td>priya@example.com</td>
                        <td>Do you offer support for group bookings?</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Rahul Mehta</td>
                        <td>rahul@example.com</td>
                        <td>Need help with payment issues.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- JavaScript for form handling -->
<script>
    document.getElementById('contactForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Stop form from reloading

        // Show success message
        document.getElementById('formSuccess').classList.remove('d-none');

        // Reset the form
        this.reset();
    });
</script>
@endsection
