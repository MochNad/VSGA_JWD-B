<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai input dari form
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $emailPrefix = $_POST["emailPrefix"];
    $emailDomain = $_POST["emailDomain"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $address = $_POST["address"];
    $birthplace = $_POST["birthplace"];
    $birthdate = $_POST["birthdate"];

    // Proses validasi data
    if (empty($emailPrefix)) {
        $response = array("success" => false, "message" => "Email tidak boleh kosong!");
    } elseif ($password !== $confirmPassword) {
        $response = array("success" => false, "message" => "Konfirmasi password tidak sesuai!");
    } elseif (strlen($password) < 8) {
        $response = array("success" => false, "message" => "Password harus terdiri dari minimal 8 karakter!");
    } elseif (!preg_match('/[!@#$%^&*()_+\-=[\]{};:\'\\",.<>\/?]/', $password)) {
        $response = array("success" => false, "message" => "Password harus mengandung setidaknya satu simbol!");
    } elseif (!preg_match('/\d/', $password)) {
        $response = array("success" => false, "message" => "Password harus mengandung setidaknya satu angka!");
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $response = array("success" => false, "message" => "Password harus mengandung setidaknya satu huruf kapital!");
    } else {
        $email = $emailPrefix . $emailDomain;
        $message = "Registrasi berhasil! <br>";
        $message .= "Nama: " . $firstname . " " . $lastname . "<br>";
        $message .= "Email: " . $email . "<br>";

        $response = array("success" => true, "message" => $message);
    }

    // Mengembalikan response sebagai JSON
    header("Content-Type: application/json");
    echo json_encode($response);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body>
    <div class="container m-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Register</h2>
                    </div>
                    <div class="card-body">
                        <form id="registerForm" method="POST">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="firstname">Nama Depan</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lastname">Nama Belakang</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="birthplace">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="birthplace" name="birthplace" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="birthdate">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="emailPrefix" name="emailPrefix" required>
                                    <div class="input-group-append">
                                        <select class="form-control" id="emailDomain" name="emailDomain">
                                            <option value="@gmail.com">@gmail.com</option>
                                            <option value="@outlook.com">@outlook.com</option>
                                            <option value="@outlook.co.id">@outlook.co.id</option>
                                            <option value="@yahoo.com">@yahoo.com</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <div id="password-strength-bar" class="progress mt-2" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar"></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="confirmPassword">Konfirmasi Password</label>
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" form="registerForm" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Handle form submission using Ajax
            $("#registerForm").submit(function (event) {
                event.preventDefault();

                var form = $(this);
                var url = form.attr("action");
                var method = form.attr("method");
                var data = form.serialize();

                var emailPrefix = $("#emailPrefix").val();
                var emailDomain = $("#emailDomain").val();
                var email = emailPrefix + emailDomain;
                data += "&emailPrefix=" + emailPrefix + "&emailDomain=" + emailDomain + "&email=" + email;

                // Send request to the server
                $.ajax({
                    url: url,
                    type: method,
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        // Show notification using Toastr
                        if (response.success) {
                            toastr.success(response.message);
                            form[0].reset();
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        // Show notification if an error occurs
                        toastr.error("An error occurred: " + error);
                    }
                });
            });

            // Password strength meter
            $("#password").on("input", function () {
                var password = $(this).val();
                var strength = 0;

                // Check length
                if (password.length >= 8) {
                    strength += 1;
                }

                // Check for symbol
                if (/[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/.test(password)) {
                    strength += 1;
                }

                // Check for number
                if (/\d/.test(password)) {
                    strength += 1;
                }

                // Check for uppercase letter
                if (/[A-Z]/.test(password)) {
                    strength += 1;
                }

                // Update the strength bar
                var progressBar = $("#password-strength-bar .progress-bar");
                progressBar.removeClass("bg-danger bg-warning bg-info bg-success");

                if (strength === 1) {
                    progressBar.addClass("bg-danger");
                } else if (strength === 2) {
                    progressBar.addClass("bg-warning");
                } else if (strength === 3) {
                    progressBar.addClass("bg-info");
                } else if (strength === 4) {
                    progressBar.addClass("bg-success");
                }

                progressBar.css("width", (strength * 25) + "%");
            });
        });
    </script>
</body>
</html>