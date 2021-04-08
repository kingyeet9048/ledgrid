function checkOptions() {
    var select = document.getElementById("select");
    var curName = select.options[select.selectedIndex].value;
    
    var container = document.getElementById("newInput");
        
    // Clear previous contents of the container
    while (container.hasChildNodes()) {
        container.removeChild(container.lastChild);
    }
    
    var majorSelection = ['Accounting','Art: Graphic Design','Art: I Design','Art: Studio Art','Athletic Training','Biology: Allied Health','Biology: Cell & Molecular','Biology: Ecology','Biology: Environmental Science','Business Administration','Business Administration: Human Resources Management','Business Administration: Management of Information Systems','Chemistry (ACS)','Chemistry: Biochemistry (ACS)','Chemistry: Environmental Chemistry (ACS)','Chemistry: Materials Chemistry (ACS)','Chemistry: Physical Science','Computer Science','Computer Science: Applied Computer Science','Communication Studies','Communication Studies: Leadership & Advocacy','Communication Studies: Organizational Communication','Criminal Justice: Corrections','Criminal Justice: Law Enforcement','Data Science','Economics','Engineering: Composite Materials Engineering','Engineering: Electronics','Engineering: Industrial Statistics','Exercise and Rehabilitative Sciences: Clinical Exercise Science','Exercise and Rehabilitative Sciences: Exercise Science','Exercise and Rehabilitative Sciences: Movement Science','English: Applied Linguistics','English: Literature and Language','English: Writing','Film Studies','Finance','Geoscience','Geoscience: Environmental Science','Geoscience: Geology','Global Studies & World Languages','Healthcare Leadership & Administration','History','Individualized Studies','Legal Studies','Marketing','Mass Communications: Advertising','Mass Communications: Creative Digital Media','Mass Communications: Journalism','Mass Communications: Public Relations','Mathematics','Medical Laboratory Science','Music','Music Business','Music Performance','Nursing','Physics','Political Science','Political Science: Public Administration','Public Health: Community Health','Public Health: Epidemiology','Public Health: Health Administration','Psychology','Recreation & Tourism Studies','Social Work','Sociology','Spanish','Statistics','Teaching: Art Education','Teaching: Biology, Life Science','Teaching: Business Education','Teaching: Chemistry (ACS)','Teaching: Elementary Education: K-6','Teaching: Elementary Education: K-6 (Rochester)','Teaching: Elementary Education - Early Childhood','Teaching: Elementary Education - Early Childhood (Online)','Teaching: English, Communication Arts & Literature','Teaching: English as a Second Language - K-12','Teaching: Geoscience, Earth Science','Teaching: Mathematics','Teaching: Music Education','Teaching: Physical Education','Teaching: Physics','Teaching: Physical Science','Teaching: Social Science, History','Teaching: Spanish','Teaching: Special Education - Academic Behavioral Strategist','Teaching: Special Education - Early Childhood','Teaching: Special Education - Learning Disabilities','Theatre','Therapeutic Recreation'];
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

function Suggestions() {
    var adas = "asda";
}