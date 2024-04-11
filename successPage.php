<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/index.css" />
    <title>Recipe Updated</title>
    <style>
        body {
            background-color: #f8f9fa; 
            font-family: 'Poppins', sans-serif;
        }
        .success-container {
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
            text-align: center;
        }
        .success-container img {
            width: 100px;
            margin: 20px 0;
        }
        .success-container h1 {
            color: #28a745; 
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <img src="image/32.png" alt="Success"> 
        <h1>Recipe Updated Successfully!</h1>
        <p>Your recipe has been updated successfully. You can now view it in the recipes list.</p>
        <a href="Cooks_Dash.php" class="btn btn-primary">View Recipes</a> 
    </div>
</body>
</html>
