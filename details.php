<?php
// Define service details
$services = [
    'baptism' => [
        'title' => 'Baptism',
        'description' => 'Baptism symbolizes a new beginning in Christ and is a public declaration of faith. It is a sacred act where believers affirm their commitment to following Jesus.
         This church request a donation rather than a set fee.',
        'image' => 'baptism.jpg',
        'offers' => ['Spiritual counseling', 'Guidance on preparation', 'Memorable ceremony', 'Certificates (₱50-₱200 per copy)'],
    ],
    'child_dedication' => [
        'title' => 'Child Dedication',
        'description' => 'Child dedication is a special ceremony where parents commit to raising their child according to God’s principles. It is a promise to guide them on a spiritual path. 
        Costs can include certificates, flowers, or tokens for pastors',
        'image' => 'dedication1.jpeg',
        'offers' => ['Personalized ceremony', 'Family blessings', 'Prayer sessions', 'Certificates (₱50-₱200 per copy)'],
    ],
    'funeral' => [
        'title' => 'Word of God Funeral Service',
        'description' => 'A funeral service is a time to honor and celebrate the life of a loved one who has passed away. It is a meaningful gathering to provide comfort and closure.',
        'image' => 'Fservice.jpg',
        'offers' => ['Spiritual Growth', 'Comforting ceremony', 'Supportive environment',],
    ],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Details - Freedom of Praise Church</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            color: #4A90E2;
            margin-bottom: 20px;
        }

        .service {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 30px;
        }

        .service-item {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .service-item img {
            width: 150px;
            height: 150px;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 20px;
        }

        .service-details {
            flex: 1;
        }

        .service-details h2 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 10px;
        }

        .service-details p {
            font-size: 1rem;
            color: #666;
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .offers {
            list-style: none;
            padding: 0;
            margin: 10px 0;
        }

        .offers li {
            margin-bottom: 8px;
            font-size: 1rem;
            color: #555;
        }

        .offers li::before {
            content: '✔';
            color: #4A90E2;
            margin-right: 10px;
        }

        .back-button {
            display: block;
            text-align: center;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4A90E2;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            max-width: 200px;
        }

        .back-button:hover {
            background-color: #3f7fc2;
        }

        @media (min-width: 768px) {
            .service-item {
                flex-direction: row;
            }
        }

        @media (max-width: 767px) {
            .service-item img {
                margin: 0 auto 20px;
            }

            .service-item {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Service Details</h1>
    <div class="service">
        <?php foreach ($services as $service): ?>
            <div class="service-item">
                <!-- Dynamically load the correct image for each service -->
                <img src="<?php echo htmlspecialchars($service['image']); ?>" alt="<?php echo htmlspecialchars($service['title']); ?>">
                <div class="service-details">
                    <h2><?php echo htmlspecialchars($service['title']); ?></h2>
                    <p><?php echo htmlspecialchars($service['description']); ?></p>
                    <ul class="offers">
                        <?php foreach ($service['offers'] as $offer): ?>
                            <li><?php echo htmlspecialchars($offer); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="book.php" class="back-button">Back to Bookings</a>
</div>

</body>
</html>
