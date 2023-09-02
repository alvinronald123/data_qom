<?php
require 'vendor/autoload.php'; // Include the Composer autoloader for PhpSpreadsheet

$servername = "localhost";
$username = "root"; // Change this if you have a different MySQL username
$password = "";     // Change this if you have a different MySQL password
$dbname = "coursework1";   // Use the name of your database

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM old_student_databse"; // Modify the table name if needed
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

// Create a new PhpSpreadsheet object
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$headerStyle = [
    'font' => [
        'bold' => true,
        'size' => 14, // Change this to your desired font size
        'color' => ['rgb' => 'FFFFFF'], // Change this to your desired color
    ],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'color' => ['rgb' => '8090B0'], // Change this to your desired background color
    ],
];

// Apply the style to the header row
$sheet->getStyle('A1:K1')->applyFromArray($headerStyle);

// Add header row
$sheet->setCellValue("A1", "ID");
$sheet->setCellValue("B1", "Name");
$sheet->setCellValue("C1", "Email");
$sheet->setCellValue("D1", "Phone Number");
$sheet->setCellValue("E1", "University");
$sheet->setCellValue("F1", "Course");
$sheet->setCellValue("G1", "Address");
$sheet->setCellValue("H1", "Occupation");
$sheet->setCellValue("I1", "Year From");
$sheet->setCellValue("J1", "Year To");
$sheet->setCellValue("K1", "Age");
// ... other headers

$rowNumber = 2; // Start from the second row for data

while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue("A$rowNumber", $row['ID']);
    $sheet->setCellValue("B$rowNumber", $row['name']);
    $sheet->setCellValue("C$rowNumber", $row['email']);
    $sheet->setCellValue("D$rowNumber", $row['phone_number']);
    $sheet->setCellValue("E$rowNumber", $row['university']);
    $sheet->setCellValue("F$rowNumber", $row['course']);
    $sheet->setCellValue("G$rowNumber", $row['address']);
    $sheet->setCellValue("H$rowNumber", $row['occupation']);
    $sheet->setCellValue("I$rowNumber", $row['year_from']);
    $sheet->setCellValue("J$rowNumber", $row['year_to']);
    $sheet->setCellValue("K$rowNumber", $row['age']);
    
    $rowNumber++; // Move to the next row
}

// Set the appropriate header for Excel file download
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="MyData.xls"');
header('Cache-Control: max-age=0');

// Create the writer and output the spreadsheet
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');

$conn->close();
?>


