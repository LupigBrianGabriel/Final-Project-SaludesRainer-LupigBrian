<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
        /* CSS styles for results */
        body {
            background: url("../bg.jpg") fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: white;
        }

        #results {
            padding: 20px;
            max-width: 800px; /* Increased width */
            width: 100%; /* Ensures responsiveness */
            margin: 20px auto;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: rgba(255, 255, 255, 0.5); /* Reduced opacity */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-family: Century Gothic;
            font-weight: bold;
            color: black;
        }

        #results p {
            margin: 10px 0;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        #results p:last-child {
            border-bottom: none;
        }

        #results p strong {
            display: block;
            font-size: 24px;
            margin-bottom: 5px;
        }

        #results p span {
            margin-top: 10px;
            color: darkviolet;
            display: block;
            font-size: 20px;
            text-align: center;
        }

        .document-image {
            display: block;
            margin: 10px auto;
            max-width: 200px; /* Adjust the size as needed */
            height: auto;
        }
    </style>
</head>
<body>
    <div id="results">
        <?php
        if (isset($_POST['query'])) {
            $query = strtolower(trim($_POST['query']));
            $xml = simplexml_load_file('data.xml');
            $results = '';

            foreach ($xml->document as $document) {
                if (strpos(strtolower($document->type), $query) !== false) {
                    $results .= '<p><strong>Document Type: </strong>' . $document->type;
                    $results .= '<br><img src="../images/document.png" alt="Document Image" class="document-image">';
                    $results .= '<br><span>Content: ' . $document->content . '</span></p>';
                }
            }

            if (empty($results)) {
                echo '<p>No results found.</p>';
            } else {
                echo $results;
            }
        } else {
            echo '<p>Please enter a search query.</p>';
        }
        ?>
    </div>
</body>
</html>
