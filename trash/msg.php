<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Excel File</title>
</head>
<body>
    <form action="msg.php" method="post" enctype="multipart/form-data">
        <label for="file">Upload an .xlsx file:</label>
        <input type="file" name="file" id="file" accept=".xlsx" required>
        <button type="submit">Upload and Display</button>
    </form>
</body>
</html>
<?php

function readXlsxFile($filePath)
{
    // Open the .xlsx file as a zip archive
    $zip = new ZipArchive;
    if ($zip->open($filePath) === TRUE) {
        // Try to extract the shared strings XML
        $sharedStringsXml = $zip->getFromName('xl/sharedStrings.xml');
        $sharedStrings = [];
        if ($sharedStringsXml !== false) {
            // Parse the shared strings XML
            $sharedStringsXmlObj = simplexml_load_string($sharedStringsXml);
            foreach ($sharedStringsXmlObj->si as $sharedString) {
                $sharedStrings[] = (string) $sharedString->t;
            }
        }

        // Try to extract the main sheet XML
        $sheetXml = $zip->getFromName('xl/worksheets/sheet1.xml');
        if ($sheetXml === false) {
            echo "Failed to find the sheet XML.";
            return;
        }

        // Close the zip archive
        $zip->close();

        // Load the XML and parse it
        $xml = simplexml_load_string($sheetXml);
        $namespaces = $xml->getNamespaces(true);

        // Register namespaces
        $xml->registerXPathNamespace('a', $namespaces['']);

        // Start the HTML table
        echo "<table border='1'>";

        // Iterate over each row
        foreach ($xml->sheetData->row as $row) {
            echo "<tr>"; // Start a new table row

            // Iterate over each cell in the row
            foreach ($row->c as $cell) {
                $value = (string) $cell->v; // Get the cell value

                // Check if the cell value is a shared string
                if (isset($cell['t']) && $cell['t'] == 's') {
                    // Convert the value using the shared strings array
                    $value = $sharedStrings[(int) $value];
                }

                echo "<td>" . htmlspecialchars($value) . "</td>"; // Output the value in a table cell
            }
            echo "</tr>"; // End the table row
        }

        // End the HTML table
        echo "</table>";
    } else {
        echo "Failed to open the .xlsx file.";
    }
}

// Check if a file is uploaded
if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    // Get the uploaded file path
    $uploadedFilePath = $_FILES['file']['tmp_name'];

    // Read the uploaded .xlsx file
    readXlsxFile($uploadedFilePath);
} else {
    echo "Please upload a valid .xlsx file.";
}
