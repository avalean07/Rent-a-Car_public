<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback - Customer Operation</title>
</head>
<body>
    <h1>Feedback on Customer Operation</h1>
    <div>
        <?php if (isset($_GET['success'])): ?>
            <p>Your customer operation was successful!</p>
        <?php elseif (isset($_GET['error'])): ?>
            <p>There was an error with your customer operation: <?= htmlspecialchars($_GET['error']); ?></p>
        <?php else: ?>
            <p>Invalid access.</p>
        <?php endif; ?>
    </div>
    <a href="../maintenance.html">Back to Maintenance Page</a>
</body>
</html>
