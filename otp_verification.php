<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Trigger Button to Show the Modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#otpModal">
        Check your email for OTP
    </button>

    <!-- Modal Structure -->
    <div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="otpModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="otpModalLabel">Verify OTP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="otpForm">
                        <div class="form-group">
                            <label for="otp" style="color:green; font-weight:bold;">Check your email for OTP</label>
                            <input type="text" class="form-control" id="otp" name="otp" placeholder="One Time Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Verify</button>
                    </form>
                    <div id="alert-container" style="margin-top: 10px;"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#otpForm').on('submit', function(event) {
                event.preventDefault();
                var otp = $('#otp').val();
                
                $.ajax({
                    url: 'verify_otp.php', // URL of the PHP file to handle OTP verification
                    type: 'POST',
                    data: { otp: otp },
                    success: function(response) {
                        var alertType = response.status === 'success' ? 'alert-success' : 'alert-danger';
                        var alertMessage = `
                            <div class="alert ${alertType} alert-dismissible fade show" role="alert">
                                ${response.message}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`;
                        $('#alert-container').html(alertMessage);

                        if (response.status === 'success') {
                            setTimeout(function() {
                                $('#otpModal').modal('hide');
                            }, 2000); // Close modal after 2 seconds
                        }
                    },
                    error: function() {
                        var alertMessage = `
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Failed to verify OTP. Please try again.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`;
                        $('#alert-container').html(alertMessage);
                    }
                });
            });
        });
    </script>
</body>
</html>
