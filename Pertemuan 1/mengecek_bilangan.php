<!DOCTYPE html>
<html>
<head>
    <title>Mengecek Bilangan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Mengecek Bilangan</h1>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#checkModal">
            Check
        </button>

        <div class="modal fade" id="checkModal" tabindex="-1" role="dialog" aria-labelledby="checkModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkModalLabel">Mengecek Bilangan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="checkForm">
                            <div class="form-group">
                                <label for="number1">Bilangan Pertama:</label>
                                <input type="number" class="form-control" id="number1" name="number1" placeholder="Masukkan bilangan pertama" required>
                            </div>
                            <div class="form-group">
                                <label for="number2">Bilangan Kedua:</label>
                                <input type="number" class="form-control" id="number2" name="number2" placeholder="Masukkan bilangan kedua" required>
                            </div>
                        </form>

                        <div id="result" style="display: none;">
                            <h2>Hasil Perhitungan:</h2>
                            <p id="checkResult"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#number1, #number2').keyup(function() {
                checkNumbers();
            });

            function checkNumbers() {
                var number1 = parseInt($('#number1').val());
                var number2 = parseInt($('#number2').val());
                var result = "";

                if (number1 === number2) {
                    result = "Bilangan " + number1 + " sama dengan bilangan " + number2;
                } else if (number1 > number2) {
                    result = "Bilangan " + number1 + " lebih besar dari bilangan " + number2;
                } else {
                    result = "Bilangan " + number1 + " lebih kecil dari bilangan " + number2;
                }

                $('#checkResult').text(result);
                $('#result').show();
            }
        });
    </script>
</body>
</html>
