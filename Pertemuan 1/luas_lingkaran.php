<!DOCTYPE html>
<html>
<head>
    <title>Luas Lingkaran</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Luas Lingkaran</h1>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#calculateModal">
            Hitung
        </button>

        <div class="modal fade" id="calculateModal" tabindex="-1" role="dialog" aria-labelledby="calculateModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="calculateModalLabel">Luas Lingkaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="calculateForm">
                            <div class="form-group">
                                <label for="radius">Jari-jari Lingkaran:</label>
                                <input type="number" class="form-control" id="radius" name="radius" placeholder="Masukkan jari-jari lingkaran" required>
                            </div>
                        </form>

                        <div id="result" style="display: none;">
                            <h2>Hasil Perhitungan:</h2>
                            <p id="luas"></p>
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
            $('#radius').keyup(function() {
                calculateLuas();
            });

            function calculateLuas() {
                var radius = $('#radius').val();
                var phi = 3.14;
                var luas = phi * radius * radius;

                $('#luas').text('Luas lingkaran dengan jari-jari ' + radius + ' adalah ' + luas);
                $('#result').show();
            }
        });
    </script>
</body>
</html>
