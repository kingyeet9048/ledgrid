function checkOptions() {
    var select = document.getElementById("select");
    var curName = select.options[select.selectedIndex].value;
    
    var container = document.getElementById("newInput");
        
    // Clear previous contents of the container
    while (container.hasChildNodes()) {
        container.removeChild(container.lastChild);
    }
    
    var majorSelection = ['Accounting 0', 'Art: Graphic Design 1', 'Art: I Design 2', 'Art: Studio Art 3', 'Athletic Training 4', 'Biology: Allied Health 5', 'Biology: Cell & Molecular 6', 'Biology: Ecology 7', 'Biology: Environmental Science 8', 'Business Administration 9', 'Business Administration: Human Resources Management 10', 'Business Administration: Management of Information Systems 11', 'Chemistry (ACS) 12', 'Chemistry: Biochemistry (ACS) 13', 'Chemistry: Environmental Chemistry (ACS) 14', 'Chemistry: Materials Chemistry (ACS) 15', 'Chemistry: Physical Science 16', 'Computer Science 17', 'Computer Science: Applied Computer Science 18', 'Communication Studies 19', 'Communication Studies: Leadership & Advocacy 20', 'Communication Studies: Organizational Communication 21', 'Criminal Justice: Corrections 22', 'Criminal Justice: Law Enforcement 23', 'Data Science 24', 'Economics 25', 'Engineering: Composite Materials Engineering 26', 'Engineering: Electronics 27', 'Engineering: Industrial Statistics 28', 'Exercise and Rehabilitative Sciences: Clinical Exercise Science 29', 'Exercise and Rehabilitative Sciences: Exercise Science 30', 'Exercise and Rehabilitative Sciences: Movement Science 31', 'English: Applied Linguistics 32', 'English: Literature and Language 33', 'English: Writing 34', 'Film Studies 35', 'Finance 36', 'Geoscience 37', 'Geoscience: Environmental Science 38', 'Geoscience: Geology 39', 'Global Studies & World Languages 40', 'Healthcare Leadership & Administration 41', 'History 42', 'Individualized Studies 43', 'Legal Studies 44', 'Marketing 45', 'Mass Communications: Advertising 46', 'Mass Communications: Creative Digital Media 47', 'Mass Communications: Journalism 48', 'Mass Communications: Public Relations 49', 'Mathematics 50', 'Medical Laboratory Science 51', 'Music 52', 'Music Business 53', 'Music Performance 54', 'Nursing 55', 'Physics 56', 'Political Science 57', 'Political Science: Public Administration 58', 'Public Health: Community Health 59', 'Public Health: Epidemiology 60', 'Public Health: Health Administration 61', 'Psychology 62', 'Recreation & Tourism Studies 63', 'Social Work 64', 'Sociology 65', 'Spanish 66', 'Statistics 67', 'Teaching: Art Education 68', 'Teaching: Biology, Life Science 69', 'Teaching: Business Education 70', 'Teaching: Chemistry (ACS) 71', 'Teaching: Elementary Education: K-6 72', 'Teaching: Elementary Education: K-6 (Rochester) 73', 'Teaching: Elementary Education - Early Childhood 74', 'Teaching: Elementary Education - Early Childhood (Online) 75', 'Teaching: English, Communication Arts & Literature 76', 'Teaching: English as a Second Language - K-12 77', 'Teaching: Geoscience, Earth Science 78', 'Teaching: Mathematics 79', 'Teaching: Music Education 80', 'Teaching: Physical Education 81', 'Teaching: Physics 82', 'Teaching: Physical Science 83', 'Teaching: Social Science, History 84', 'Teaching: Spanish 85', 'Teaching: Special Education - Academic Behavioral Strategist 86', 'Teaching: Special Education - Early Childhood 87', 'Teaching: Special Education - Learning Disabilities 88', 'Theatre 89', 'Therapeutic Recreation 90', ]
    if(curName == "Faculty") {
        var input = document.createElement("input");
        input.type = "text";
        input.name = "department";
        input.id = "Department";
        input.className = "form-control mb-4";
        input.placeholder = "Department";
        input.required = true;
        container.appendChild(input);

    }
    if (curName == "Student") {

        var selectList = document.createElement("select");
        selectList.id = "SelectID";
        selectList.className = "form-control mb-4";
        selectList.required = true;
        container.appendChild(selectList);
        //Create and append the options
        for (var i = 0; i < majorSelection.length; i++) {
            var option = document.createElement("option");
            option.value = majorSelection[i];
            option.text = majorSelection[i];
            selectList.appendChild(option);
        }
    }
}