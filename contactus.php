<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            font-family: 'Arial', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .contact-form {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
        }

        h2 {
            color: #3f51b5;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-label {
            color: #495057;
            font-weight: bold;
            text-align: center;
            display: block;
        }

        .form-control {
            border-radius: 10px;
            transition: border-color 0.3s, box-shadow 0.3s;
            background-color: #f8f9fa;
            padding: 10px;
            border: 1px solid #ced4da;
            width: 100%;
            margin: 0 auto;
        }

        .form-control:focus {
            border-color: #3f51b5;
            box-shadow: 0 0 5px rgba(63, 81, 181, 0.5);
        }

        button {
            border-radius: 10px;
            background-color: #3f51b5;
            color: #ffffff;
            transition: background-color 0.3s, transform 0.2s;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            display: block;
            margin: 20px auto 0;
        }

        button:hover {
            background-color: #303f9f;
            transform: translateY(-2px);
        }

        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9em;
            color: #6c757d;
        }

        .form-group {
            position: relative;
        }

        .form-control::placeholder {
            color: #a1a1a1;
            opacity: 0.8;
        }

        .form-control:placeholder-shown {
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="contact-form">
        <h2>Contact Us</h2>
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Your message has been sent successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <form action="contact.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject of your message" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Your message here" required></textarea>
            </div>
            <button type="submit" class="btn">Send Message</button>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
