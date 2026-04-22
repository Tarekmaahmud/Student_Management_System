<form method="POST">
    <div class="form-row">
        <div class="form-group">

            <label>Registration ID (024xxxxxxxxxxxxx):</label>
            <input type="number" name="registration_id" required pattern="024\d{13}">
        </div>
        <div class="form-group">
            <label>Initial ID (xxx-xx-xxx):</label>
            <input type="text" name="initial_id" required pattern="\w{3}-\w{2}-\w{3}">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>First Name:</label>
            <input type="text" name="first_name" required>
        </div>
        <div class="form-group">
            <label>Last Name:</label>
            <input type="text" name="last_name" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>Faculty:</label>
            <select name="faculty" id="faculty" required>
                <option value="">Select Faculty</option>
                <option value="Faculty of Business & Entrepreneurship (FBE)">Faculty of Business & Entrepreneurship
                    (FBE)</option>
                <option value="Faculty of Science & Information Technology (FSIT)">Faculty of Science & Information
                    Technology (FSIT)</option>
                <option value="Faculty of Engineering (FE)">Faculty of Engineering (FE)</option>
                <option value="Faculty of Health & Life Sciences (FHLS)">Faculty of Health & Life Sciences (FHLS)
                </option>
                <option value="Faculty of Humanities & Social Sciences (FHSS)">Faculty of Humanities & Social Sciences
                    (FHSS)</option>
            </select>
        </div>
        <div class="form-group">
            <label>Department:</label>
            <select name="department" id="department" required>
                <option value="">Select Department</option>
            </select>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Phone:</label>
            <input type="tel" name="phone" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>Date of Birth:</label>
            <input type="date" name="date_of_birth">
        </div>
        <div class="form-group">
            <label>Gender:</label>
            <select name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label>Address:</label>
        <textarea name="address" required></textarea>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>City:</label>
            <input type="text" name="city" required>
        </div>
        <div class="form-group">
            <label>State:</label>
            <input type="text" name="state" required>
        </div>
    </div>

    <div class="form-group">
        <label>Zip Code:</label>
        <input type="text" name="zip_code" required>
    </div>

    <button type="submit" name="add_student" class="btn btn-success">Add Student</button>
    <a href="?page=view_students" class="btn btn-danger">Cancel</a>
</form>
<script>
    const departments = {
        "Faculty of Business & Entrepreneurship (FBE)": [
            "Business Administration",
            "Management",
            "Real Estate",
            "Tourism & Hospitality Management",
            "Innovation & Entrepreneurship",
            "Finance & Banking",
            "Accounting",
            "Marketing"
        ],
        "Faculty of Science & Information Technology (FSIT)": [
            "Computer Science & Engineering (CSE)",
            "Software Engineering (SWE)",
            "Multimedia & Creative Technology (MCT)",
            "Computing & Information Systems (CIS)",
            "Information Technology & Management (ITM)",
            "Environmental Science & Disaster Management",
            "Physical Education & Sports Science"
        ],
        "Faculty of Engineering (FE)": [
            "Electrical & Electronic Engineering (EEE)",
            "Textile Engineering",
            "Civil Engineering",
            "Information & Communication Engineering (ICE)",
            "Architecture",
            "Robotics & Mechatronics Engineering"
        ],
        "Faculty of Health & Life Sciences (FHLS)": [
            "Pharmacy",
            "Public Health",
            "Nutrition & Food Engineering",
            "Agricultural Science",
            "Genetic Engineering & Biotechnology"
        ],
        "Faculty of Humanities & Social Sciences (FHSS)": [
            "English",
            "Law",
            "Journalism & Mass Communication",
            "Development Studies",
            "Information Science & Library Management"
        ]
    };

    document.getElementById('faculty').addEventListener('change', function () {
        const faculty = this.value;
        const deptSelect = document.getElementById('department');
        deptSelect.innerHTML = '<option value="">Select Department</option>';
        if (faculty && departments[faculty]) {
            departments[faculty].forEach(dept => {
                const option = document.createElement('option');
                option.value = dept;
                option.textContent = dept;
                deptSelect.appendChild(option);
            });
        }
    });
</script>