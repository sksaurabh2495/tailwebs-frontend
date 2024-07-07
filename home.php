<?php
session_start();
if (!isset($_SESSION['teacher_id'])) {
    header('Location: index.php');
    exit();
}

include 'db.php';

$stmt = $conn->prepare("SELECT * FROM students");
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

$frontend_url = "http://127.0.0.1/tailwebs-frontend/";
$backend_url = "http://127.0.0.1/tailwebs-backend/";
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $frontend_url; ?>styles.css">
    <script src="<?php echo $frontend_url; ?>script.js"></script>
</head>
<body>
    <span><h1>Welcome to the Teacher Portal</h1><h4 onclick="session_destroy()">Logout</h4></span>
    <button onclick="showAddStudentModal()">Add Student</button>
    <table id="studentsTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Subject</th>
                <th>Marks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr data-id="<?= $student['id'] ?>">
                    <td id="student-id"><?= $student['id'] ?></td>
                    <td><?= $student['name'] ?></td>
                    <td><?= $student['subject'] ?></td>
                    <td><?= $student['marks'] ?></td>
                    <td>
                        <button class="editButton">Edit</button>
                        <button onclick="deleteStudent(<?= $student['id'] ?>)">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div id="addStudentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddStudentModal()">&times;</span>
            <form id="addStudentForm">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required>
                <label for="marks">Marks:</label>
                <input type="number" id="marks" name="marks" required>
                <button type="submit" id="addButton">Add Student</button>
            </form>
        </div>
    </div>

    <!-- Modal -->
<div id="editModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Edit Student</h2>
    <form id="editForm">
      <input type="text" id="editId" name="editId" required>
      <label for="editName">Name:</label>
      <input type="text" id="editName" name="editName" required>
      <label for="editSubject">Subject:</label>
      <input type="text" id="editSubject" name="editSubject" required>
      <label for="editMarks">Marks:</label>
      <input type="number" id="editMarks" name="editMarks" required>
      <button type="submit">Update</button>
    </form>
  </div>
</div>
</body>
</html>
