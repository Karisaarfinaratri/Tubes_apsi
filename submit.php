<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "StudentInfoSystem";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil data dari form
$name = $_POST['name'];
$email = $_POST['email'];
$status = $_POST['status'];
$details = $_POST['details'];

// Memasukkan data mahasiswa
$sql = "INSERT INTO Students (name, email, status, details) VALUES ('$name', '$email', '$status', '$details')";
$conn->query($sql);
$student_id = $conn->insert_id;

// Memasukkan data tambahan berdasarkan status
if ($status == 'employed') {
    $sql = "INSERT INTO Employment (student_id, job_position, company_name) VALUES ($student_id, '$details', '')";
} elseif ($status == 'competition') {
    $sql = "INSERT INTO Competitions (student_id, competition_name, result) VALUES ($student_id, '$details', '')";
} elseif ($status == 'scholarship') {
    $sql = "INSERT INTO Scholarships (student_id, scholarship_name, status) VALUES ($student_id, '$details', '')";
}
$conn->query($sql);

// Menutup koneksi
$conn->close();

echo "Form submitted successfully!";
?>
