<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Receipt</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Custom styles -->
  <style>
    body {
      padding: 20px;
      color: #fff; /* Set text color to white */
      /* background-color: #1f2937; Set background color */
    }
    .receipt-container {
        background-color: #1f2937;
      max-width: 600px;
      margin: 0 auto;
      border: 1px solid #111827; /* Add border */
      padding: 20px;
      border-radius: 8px; /* Add border radius */
    }
    .list-group-item {
      background-color: #111827; /* Set background color for list items */
      border: none; /* Remove border */
    }
    .list-group-item:last-child {
      border-bottom: none; /* Remove bottom border for the last list item */
    }
  </style>
</head>
<body>

<div class="receipt-container">
  <h1 class="mt-4 mb-3">Receipt</h1>
  <div class="row">
    <div class="col">
      <p><strong>Date:</strong> January 1, 2023</p>
      <p><strong>Receipt Number:</strong> #123456789</p>
      <p><strong>Ordered By:</strong> Tulasha Karki</p>
      <p><strong>Email:</strong> tulashakarki@gmail.com</p>
    </div>
  </div>

  <h3 class="mt-4 mb-3">Items:</h3>
  <ul class="list-group mb-3">
    <li class="list-group-item d-flex justify-content-between lh-condensed">
      <div>
        <h6 class="my-0">Item 1</h6>
        <small class="text-muted">Price: $10 x 2</small>
      </div>
      <span class="text-muted">$20</span>
    </li>
    <li class="list-group-item d-flex justify-content-between lh-condensed">
      <div>
        <h6 class="my-0">Item 2</h6>
        <small class="text-muted">Price: $15 x 1</small>
      </div>
      <span class="text-muted">$15</span>
    </li>
    <li class="list-group-item d-flex justify-content-between">
      <span>Total (USD)</span>
      <strong>$35</strong>
    </li>
  </ul>

  <p><strong>Payment Method:</strong> Khalti</p>
</div>

</body>
</html>
