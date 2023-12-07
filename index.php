<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instruction Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center my-3">Instruction Calculator</h1>
                        <h2 class="text-center" id="result"></h2>
                        <form enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="file" class="form-label">Select Instructions File:</label>
                                <input type="file" name="file" id="file" class="form-control" accept=".txt" required>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="calculate()">Calculate</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calculate() {
            const fileInput = document.getElementById('file');
            const file = fileInput.files[0];

            if (file) {
                
                const formData = new FormData();
                formData.append('file', file);

                fetch('calculator.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json()) 
                .then(result => {
                    document.getElementById('result').innerText = "Result == " + result?.result;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }
    </script>
</body>
</html> 