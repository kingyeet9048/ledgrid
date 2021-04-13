// Will add the necessary fields to the signup page depending on what the currently selected option is (student, admin, faculty)
function checkOptions() {
    var select = document.getElementById("select");
    var curName = select.options[select.selectedIndex].value;
    
    var container = document.getElementById("newInput");
        
    // Clear previous contents of the container
    while (container.hasChildNodes()) {
        container.removeChild(container.lastChild);
    }
    
    var majorSelection = ['Accounting','Art: Graphic Design','Art: I Design','Art: Studio Art','Athletic Training','Biology: Allied Health','Biology: Cell & Molecular','Biology: Ecology','Biology: Environmental Science','Business Administration','Business Administration: Human Resources Management','Business Administration: Management of Information Systems','Chemistry (ACS)','Chemistry: Biochemistry (ACS)','Chemistry: Environmental Chemistry (ACS)','Chemistry: Materials Chemistry (ACS)','Chemistry: Physical Science','Computer Science','Computer Science: Applied Computer Science','Communication Studies','Communication Studies: Leadership & Advocacy','Communication Studies: Organizational Communication','Criminal Justice: Corrections','Criminal Justice: Law Enforcement','Data Science','Economics','Engineering: Composite Materials Engineering','Engineering: Electronics','Engineering: Industrial Statistics','Exercise and Rehabilitative Sciences: Clinical Exercise Science','Exercise and Rehabilitative Sciences: Exercise Science','Exercise and Rehabilitative Sciences: Movement Science','English: Applied Linguistics','English: Literature and Language','English: Writing','Film Studies','Finance','Geoscience','Geoscience: Environmental Science','Geoscience: Geology','Global Studies & World Languages','Healthcare Leadership & Administration','History','Individualized Studies','Legal Studies','Marketing','Mass Communications: Advertising','Mass Communications: Creative Digital Media','Mass Communications: Journalism','Mass Communications: Public Relations','Mathematics','Medical Laboratory Science','Music','Music Business','Music Performance','Nursing','Physics','Political Science','Political Science: Public Administration','Public Health: Community Health','Public Health: Epidemiology','Public Health: Health Administration','Psychology','Recreation & Tourism Studies','Social Work','Sociology','Spanish','Statistics','Teaching: Art Education','Teaching: Biology, Life Science','Teaching: Business Education','Teaching: Chemistry (ACS)','Teaching: Elementary Education: K-6','Teaching: Elementary Education: K-6 (Rochester)','Teaching: Elementary Education - Early Childhood','Teaching: Elementary Education - Early Childhood (Online)','Teaching: English, Communication Arts & Literature','Teaching: English as a Second Language - K-12','Teaching: Geoscience, Earth Science','Teaching: Mathematics','Teaching: Music Education','Teaching: Physical Education','Teaching: Physics','Teaching: Physical Science','Teaching: Social Science, History','Teaching: Spanish','Teaching: Special Education - Academic Behavioral Strategist','Teaching: Special Education - Early Childhood','Teaching: Special Education - Learning Disabilities','Theatre','Therapeutic Recreation'];
    var departmentSelection = ['Academic Affairs','Access Services for Students','Accounting Dept','Admissions','Adult Continuing Education','Advancement','Advancement Services','Advising Services','Affirmative Action','Alumni Engagement','Annual Giving','Art & Design Dept','Athletic Development','Athletic Internal Operations','Athletic Training','Athletics Department','Baseball (Mens)','Basketball (Mens)','Basketball (Womens)','Biology Dept','Bookstore','Budget','Building Mtnce, Trades','Business Administration Dept','Business Education Dept','Business Office','Cal Fremling Boat','Camps and Conferences','Campus Card/Purple Pass Office','Career Services','Center for Assessment, Accred, Licencure','Center for Global Education','Center for Student Success (COE)','Center for Teacher Success','Center of Excellence - HealthForce MN','Chemistry Dept','Child Advocacy Studies Dept','Child Care Center','College of Business','College of Education','College of Liberal Arts','College of Nursing and Health Science','College of Science and Engineering','Communication Studies Dept','Composite Materials Engineering Dept','Computer Science Dept','Counseling Services','Counselor Education Dept','Creative Services','Criminal Justice','Cross Country (Men & Womens)','Custodial Services','Data Security','Dean of Students','Development','Digital Transformation & User Experience','Early Childhood and Elem Educ Dept','Economics Dept','Education Studies Dept','English Dept','English Language Programs','Equity & Inclusive Excellence','Facilities','Finance and Administration','Finance Dept','Financial Aid','Fitness Center','Football (Mens)','Geography','Geoscience Dept','Global Studies & World Languages Dept','Golf (Mens)','Golf (Womens)','Graduate Nursing Dept','Graduate Studies','Grants and Sponsored Projects','Grounds Maintenance','Gymnastics (Womens)','Health Care Services','Health Exercise & Rehab Science Dept','Health Force Minnesota','Health Leadership Admin Dept','History Dept','Housing and Residence Life','Human Resources','Information Technology','Infrastructure & Data Services','Inst. Planning and Research','Integrated Digital Communications','Integrated Wellness Center','International Student & Scholar Services','Intramurals','IT Project Management','ITS Communication','Leadership Education Dept','Legal Affairs','Legal Studies Dept','Library Services','Mail and Receiving','Major Gifts','Marketing Dept','Marketing/Communication','Mass Communication Dept','Mathematics & Statistics Dept','Music Dept','Nursing Dept','Office of Associate Provost and VPAA','Outdoor Education and Recreation Ctr','Parking Services','Philosophy Dept','Physical Educ Science Dept','Physics Dept','Planning and Construction','Political Science Dept','Presidents Office','Psychology Dept','Recreation Tourism & Therapeutic Rec Dep','Registrar Office','Residential College','Retiree Center','Rochester Education','Rochester Graduate Nursing','Rochester IT Technical Support','Rochester Masters Social Work','Rochester Nursing Undergraduate','Rochester Social Work','Safety','Security','Soccer (Womens)','Social Work Dept','Sociology & Criminal Justice Dept','Softball (Womens)','Special Education Dept','Student Accounts','Student Conduct','Student Housing','Student Life & Development','Student Union and Activities','Student-Athlete Services','Study Abroad','Teaching, Learning & Tech Services','Tennis (Womens)','Theatre and Dance Dept','Track and Field (Womens)','TRIO Programs','Tutoring Services','University Communications','University Marketing','Volleyball (Womens)','Warrior Hub Enrollment Services','Warrior Hub Student Services','Warrior Success Center','Womens and Gender Studies Dept','Writing Center','WSU Rochester Administration','WSU Rochester Student & Campus Services'];
    if(curName == "Faculty") {
        var input = document.createElement("select");
        input.id = "SelectDepartment";
        input.className = "form-control mb-4";
        container.appendChild(input);

        //Create and append the options
        for (var i = 0; i < departmentSelection.length; i++) {
            var option = document.createElement("option");
            option.value = departmentSelection[i];
            option.text = departmentSelection[i];
            input.appendChild(option);
        }
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
