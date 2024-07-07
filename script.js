const frontend_url = "http://127.0.0.1/tailwebs-frontend/";
const backend_url = "http://127.0.0.1/tailwebs-backend/";

function session_destroy() {
  fetch(backend_url + 'logout.php', {
        method: 'POST',
        credentials: 'same-origin'  // Include cookies in the request if needed
    })
    .then(response => {
        window.location.href = frontend_url + 'index.php';
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function showAddStudentModal() {
    document.getElementById('addStudentModal').style.display = 'block';
}

function closeAddStudentModal() {
    document.getElementById('addStudentModal').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function() {
    const addButton = document.getElementById('addButton');
    if (addButton) {
        addButton.addEventListener('click', function() {
            console.log('Button clicked!');
            // Add your logic here for adding a student
            const name = document.getElementById('name').value;
            const subject = document.getElementById('subject').value;
            const marks = document.getElementById('marks').value;

            fetch(backend_url + 'add_student.php', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json'
                },
              body: JSON.stringify({ name, subject, marks })
            }).then(response => response.json())
            .then(data => {
              if (data.success) {
                location.reload();
              } else {
                alert(data.message);
              }
          });
        });
    } else {
        console.error('Button not found in the DOM.');
    }
});

function deleteStudent(id) {
    if (confirm('Are you sure you want to delete this student?')) {
        fetch(backend_url + 'delete_student.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id })
        }).then(response => response.json())
          .then(data => {
              if (data.success) {
                  location.reload();
              } else {
                  alert(data.message);
              }
          });
    }
}

document.addEventListener('DOMContentLoaded', (event) => {
    var modal = document.getElementById('editModal');
    var closeBtn = modal.getElementsByClassName('close')[0];

    const editButtons = document.querySelectorAll('.editButton');

    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const studentRow = this.closest('tr');
            const studentId = studentRow.getAttribute('data-id');
            const tds = studentRow.getElementsByTagName('td');

            const id = tds[0].innerText;
            const name = tds[1].innerText;
            const subject = tds[2].innerText;
            const marks = tds[3].innerText;

            document.getElementById('editId').value = id;
            document.getElementById('editName').value = name;
            document.getElementById('editSubject').value = subject;
            document.getElementById('editMarks').value = marks;

            modal.style.display = 'block';
        });
    });

    closeBtn.onclick = function() {
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    document.getElementById('editForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);
        fetch(backend_url + 'update_student.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            location.reload();
            if (response.ok) {
                console.log('Student updated successfully');
                modal.style.display = 'none';
            } else {
                console.error('Failed to update student');
            }
        })
        .catch(error => console.error('Error updating student:', error));
    });
});
