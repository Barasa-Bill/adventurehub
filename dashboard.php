<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit();
}

// Include database connection
require_once 'connectdb.php';

// Fetch user data from the database
$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Initialize booking details variable
$booking_details = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if it's a profile update or booking submission
    if (isset($_POST['full_name'])) {
        // Handle profile update
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);

        // File upload logic for profile picture
        $profile_picture = $user['profile_picture'];  // Default to current profile picture
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
            $upload_dir = 'uploads/'; // Directory to store uploaded files

            // Check if uploads directory exists, if not, create it
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true); // Create the directory with proper permissions
            }

            // Generate a unique file name
            $file_extension = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
            $file_name = uniqid() . '.' . $file_extension;
            $file_path = $upload_dir . $file_name;

            // Attempt to move the uploaded file
            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $file_path)) {
                // Successfully uploaded
                $profile_picture = $file_path;
            } else {
                echo "Failed to upload file. Check directory permissions.";
            }
        }

        // Update user details in the database
        $sql = "UPDATE users SET full_name = '$full_name', email = '$email', phone = '$phone', profile_picture = '$profile_picture' WHERE id = '$user_id'";

        if (mysqli_query($conn, $sql)) {
            // Update session data in case the profile was updated
            $_SESSION['full_name'] = $full_name;
            $profile_update_message = "Profile updated successfully!";
        } else {
            $profile_update_error = "Error updating profile: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['destination'])) {
        // Handle booking submission
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $destination = mysqli_real_escape_string($conn, $_POST['destination']);
        $package = mysqli_real_escape_string($conn, $_POST['package']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $special_requests = mysqli_real_escape_string($conn, $_POST['special-requests']);

        // Store booking details to display
        $booking_details = [
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'destination' => $destination,
            'package' => $package,
            'date' => $date,
            'special_requests' => $special_requests,
            'timestamp' => date('Y-m-d H:i:s')
        ];

        // Here you would normally save to database, but we'll just store in session for this example
        $_SESSION['booking_details'] = $booking_details;
        
        // You can add database insertion logic here if needed
        // $sql = "INSERT INTO bookings (...) VALUES (...)";
        // mysqli_query($conn, $sql);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdventureHub - Update Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .booking-confirmation {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 20px;
            margin-top: 30px;
            border-left: 5px solid #28a745;
        }
        .confirmation-title {
            color: #28a745;
            margin-bottom: 20px;
        }
        .booking-detail {
            margin-bottom: 10px;
        }
        .detail-label {
            font-weight: bold;
            color: #495057;
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">AdventureHub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="destinations.php">Destinations</a></li>
                    
                    
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <?php if (isset($profile_update_message)): ?>
            <div class="alert alert-success"><?php echo $profile_update_message; ?></div>
        <?php endif; ?>
        
        <?php if (isset($profile_update_error)): ?>
            <div class="alert alert-danger"><?php echo $profile_update_error; ?></div>
        <?php endif; ?>

        <h2 class="mb-4">Update Your Profile</h2>

        <!-- Profile Update Form -->
        <form action="dashboard.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" name="profile_picture">
                <small class="form-text text-muted">Current Profile Picture:</small>
                <?php if (!empty($user['profile_picture'])): ?>
                    <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" width="100" class="mt-2">
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>

        <hr>

        <h2 class="mt-5">Book Your Next Adventure</h2>
        <form id="booking-form" method="POST" action="dashboard.php">
            <!-- Booking Form Fields -->
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($_SESSION['full_name']); ?>" required id="name" readonly>
            </div>
            
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" name="phone" required id="phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required id="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>">
            </div>
            
            <div class="mb-3">
                <label for="destination" class="form-label">Select Destination</label>
                <select class="form-select" name="destination" id="destination" required>
                    <option value="">Choose a Destination</option>
                    <option value="maldives">Maldives - Beach Getaway</option>
                    <option value="kenya">Kenya - Safari Adventure</option>
                    <option value="paris">Paris - European Tour</option>
                    <option value="bali">Bali - Tropical Retreat</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="package" class="form-label">Select Package</label>
                <select class="form-select" name="package" id="package" required>
                    <option value="">Choose a Package</option>
                    <option value="standard">Standard Package</option>
                    <option value="luxury">Luxury Package</option>
                    <option value="custom">Customized Experience</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="date" class="form-label">Preferred Travel Date</label>
                <input type="date" class="form-control" name="date" required id="date">
            </div>
            
            <div class="mb-3">
                <label for="special-requests" class="form-label">Special Requests (Optional)</label>
                <textarea class="form-control" name="special-requests" id="special-requests" rows="4"></textarea>
            </div>
            
            <button type="submit" class="btn btn-success">Submit Booking Request</button>
        </form>

        <?php if (isset($_SESSION['booking_details']) || $booking_details): 
            $details = $booking_details ?? $_SESSION['booking_details'];
            ?>
            <div class="booking-confirmation mt-5">
                <h3 class="confirmation-title">Booking Confirmation</h3>
                
                <div class="booking-detail">
                    <span class="detail-label">Name:</span> <?php echo htmlspecialchars($details['name']); ?>
                </div>
                
                <div class="booking-detail">
                    <span class="detail-label">Phone:</span> <?php echo htmlspecialchars($details['phone']); ?>
                </div>
                
                <div class="booking-detail">
                    <span class="detail-label">Email:</span> <?php echo htmlspecialchars($details['email']); ?>
                </div>
                
                <div class="booking-detail">
                    <span class="detail-label">Destination:</span> <?php echo htmlspecialchars($details['destination']); ?>
                </div>
                
                <div class="booking-detail">
                    <span class="detail-label">Package:</span> <?php echo htmlspecialchars($details['package']); ?>
                </div>
                
                <div class="booking-detail">
                    <span class="detail-label">Travel Date:</span> <?php echo htmlspecialchars($details['date']); ?>
                </div>
                
                <?php if (!empty($details['special_requests'])): ?>
                <div class="booking-detail">
                    <span class="detail-label">Special Requests:</span> <?php echo htmlspecialchars($details['special_requests']); ?>
                </div>
                <?php endif; ?>
                
                <div class="booking-detail">
                    <span class="detail-label">Booking Time:</span> <?php echo htmlspecialchars($details['timestamp']); ?>
                </div>
                
                <p class="mt-3">Thank you for booking with AdventureHub! We'll contact you shortly to confirm your trip details.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS (for things like modals, dropdowns, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>