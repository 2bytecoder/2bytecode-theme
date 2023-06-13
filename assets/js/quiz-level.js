
// quiz
function ansTemplate($option, $val, $is_multi = false) {
    $parent = document.querySelectorAll("div.options")[0];

    $parent.insertAdjacentHTML('beforeend', `<div class="form-check mb-2">
    <input class="form-check-input" type="checkbox" name="answer" value="${$val}" id="option-${$val}">
    <label class="form-check-label option" for="option-${$val}">
        ${$option}
    </label>
    </div>`);

    if (!$is_multi) {
        $("input:checkbox").on('click', function () {
            var $box = $(this);
            if ($box.is(":checked")) {
                var group = "input:checkbox[name='" + $box.attr("name") + "']";
                $(group).prop("checked", false);
                $box.prop("checked", true);
            } else {
                $box.prop("checked", false);
            }
        });
    }
}


let questions = {
    1: {
        1: {
            "question": "How much experience do you have in Flutter ?",
            "options": {
                1: "Just Started",
                2: "Less than 6 Months",
                3: "More than a year",
                4: "More than 2 Years"
            },
            "mark": {
                1: 0,
                2: 1,
                3: 3,
                4: 5
            },
            "multichoice": false
        },
        2: {
            "question": "How much knowledge do you have in Dart language ?",
            "options": {
                1: "Basics concepts ( variables, if-else, loops )",
                2: "Object Oriented Programming",
                3: "Data Structures"
            },
            "mark": {
                1: 1,
                2: 3,
                3: 5
            },
            "multichoice": true
        },
        3: {
            "question": "Are you familiar with any of these Programming languages ?",
            "options": {
                1: "C",
                2: "Java/C++",
                3: "Python/JavaScript",
                4: "No, I'm not familiar"
            },
            "mark": {
                1: 1,
                2: 5,
                3: 3,
                4: 0
            },
            "multichoice": true
        },
        4: {
            "question": "Are you familiar with any of these Frameworks ?",
            "options": {
                1: "Android Studio",
                2: "Swift",
                3: "React Native",
                4: "No, not at all"
            },
            "mark": {
                1: 3,
                2: 2,
                3: 3,
                4: 1
            },
            "multichoice": true
        },
        5: {
            "question": "How much time everyday do you spend in learning/practicing Flutter?",
            "options": {
                1: "More than 2 hours",
                2: "More than 4 hours",
                3: "More than 6 hours",
                4: "More than 8 hours"
            },
            "mark": {
                1: 1,
                2: 2,
                3: 3,
                4: 3
            },
            "multichoice": false
        },
        6: {
            "question": "Do you know about state management in flutter? if yes. Then select the given methods which you have used in your projects.",
            "options": {
                1: "Bloc",
                2: "Provider",
                3: "Getx",
                4: "Setstate"
            },
            "mark": {
                1: 4,
                2: 2,
                3: 2,
                4: 1,
            },
            "multichoice": true
        },
        7: {
            "question": "Why do we use 'extends' keywords",
            "options": {
                1: "Differentiate between class variable and functions params",
                2: "For inheriting the properties of parent class",
                3: "To enlarge something ( class, variable or function)",
                4: "I do not know about this"
            },
            "mark": {
                1: 0,
                2: 9,
                3: 0,
                4: 0
            },
            "multichoice": false
        },
        8: {
            "question": "Among the options given below what can be used to make your flutter app responsive.",
            "options": {
                1: "Sizer Package",
                2: "Screenutil Package",
                3: "MediaQuery.of(context).size"
            },
            "mark": {
                1: 3,
                2: 3,
                3: 3
            },
            "multichoice": true
        },
        9: {
            "question": "Can we use setState() with Stateless widget",
            "options": {
                1: "Yes",
                2: "No",
                3: "I'm Learning"
            },
            "mark": {
                1: 0,
                2: 9,
                3: 0
            },
            "multichoice": false
        },
        10: {
            "question": "Do all the widgets have buildcontext of their own?",
            "options": {
                1: "Yes",
                2: "No",
                3: "I am not sure"
            },
            "mark": {
                1: 9,
                2: 0,
                3: 0
            },
            "multichoice": false
        },
        11: {
            "question": "What file type do we upload to the play store?",
            "options": {
                1: ".apk",
                2: ".aab",
                3: ".ipa",
                4: "Any Other"
            },
            "mark": {
                1: 0,
                2: 9,
                3: 0,
                4: 0
            },
            "multichoice": false
        }
    }

}



var $q_cat = 1;
var $max_q = Object.keys(questions[1]).length;
var $cq = 1;
var $score = 0;

if (!!document.querySelectorAll(".quiz-page")[0]) {
    let btn = document.getElementById("quiz-submit");

    setQuestion();
    setOptions();
    questionIn();

    btn.addEventListener("click", resumeQuiz);
}


function setOptions() {
    let i = 1;
    for (i; i <= Object.keys(questions[$q_cat][$cq].options).length; i++) {
        ansTemplate(questions[$q_cat][$cq].options[i], i, questions[$q_cat][$cq].multichoice);
    }
}


function setQuestion() {
    $show_multi_ele = document.querySelector("div.question_wrapper p.small");
    // set question count
    document.querySelector("p.question-count").textContent = "Question " + $cq + " of " + $max_q;
    document.querySelector("h4.question").textContent = questions[$q_cat][$cq].question;

    if (questions[$q_cat][$cq].multichoice && $show_multi_ele.classList.contains("d-none")) {
        $show_multi_ele.classList.remove("d-none");
    } else if (!questions[$q_cat][$cq].multichoice && !$show_multi_ele.classList.contains("d-none")) {
        $show_multi_ele.classList.add("d-none");
    }
}


function AddMark() {
    var $response = false;

    if (questions[$q_cat][$cq].multichoice) {
        $answers = document.querySelectorAll("input[name='answer']:checked");
        // console.log($answers.length);
        $answers.forEach(function ($ans) {
            $score += questions[$q_cat][$cq].mark[parseInt($ans.value)];
            document.querySelectorAll("p.total-score")[0].textContent = "Total Score: " + $score;
        });
        $response = true;
    }
    else {
        let $ans_ele = document.querySelector("input[name='answer']:checked");
        let $ans_val = parseInt($ans_ele.value);
        // console.log($ans_val + "and" + questions[$q_cat][$cq].mark[$ans_val]);
        $score += questions[$q_cat][$cq].mark[$ans_val];
        document.querySelectorAll("p.total-score")[0].textContent = "Total Score: " + $score;
        // remove selection
        $ans_ele.checked = false;
        $response = true;
    }
    return $response;
}

function questionIn() {

    document.querySelector(".quiz-inner-wrapper").classList.remove("questionOut");
    document.querySelector(".quiz-inner-wrapper").classList.add("questionIn");

}
function questionOut() {
    document.querySelector(".quiz-inner-wrapper").classList.remove("questionIn");
    document.querySelector(".quiz-inner-wrapper").classList.add("questionOut");
}


function resumeQuiz() {
    if (document.querySelectorAll("input[name='answer']:checked").length == 0) {
        return;
    } else {
        AddMark();
        questionOut();
        document.querySelectorAll("div.options")[0].innerHTML = "";

        if ($cq == $max_q) {
            finalize();
        }
        else {
            $cq += 1;
            setQuestion();
            setOptions();
            setTimeout(() => {
                questionIn();
            }, 100);
        }
    }
}


function finalize() {
    let tag = "Expert";
    if ($score <= 75 && $score > 30) {
        tag = "Intermediate";
    } else if ($score <= 30) {
        tag = "Beginner";
    }


    $score += 10;
    document.querySelector(".quiz-part1").style.display = "none";
    document.querySelectorAll("p.tag")[0].textContent = "Your level is: " + tag;
    document.querySelectorAll("div.pie")[0].textContent = tag;
    document.querySelectorAll("div.pie")[0].style.setProperty("--p", $score);

    document.querySelector(".quiz-result").style.display = "block";
    document.querySelector(".quiz-page .animation lottie-player").play();

    setTimeout(() => {
        document.querySelector("div.result-wrapper").style.opacity = 1;
        document.querySelector("div.recomendation").style.opacity = 1;

    }, 400);

    document.querySelectorAll("div.quiz-part2")[0].classList.add("d-none");
    document.querySelector("div.certificate-form.d-none").classList.remove("d-none");
    document.querySelector("div.certificate-form").style.opacity = 1;
    document.querySelector("input[name='level']").value = tag;
}



// quiz certificate

if (document.querySelector("form#certificate-form")) {
    // button disable return 0;
    document.querySelector("form#certificate-form").addEventListener("submit", function (e) {
        e.preventDefault();

        if (document.querySelector("form#certificate-form button.disabled")) {
            return;
        }
        tbc_loader(true);
        document.querySelector("form#certificate-form button[type='submit']").classList.add("disabled");

        let $name = document.querySelector("form#certificate-form input[name='cer-name']").value;
        let $email = document.querySelector("form#certificate-form input[name='cer-email']").value;
        let $nonce = document.querySelector("form#certificate-form input[name='_wpnonce']").value;
        let $level = document.querySelector("form#certificate-form input[name='level']").value;

        if ($name == "" || $email == "") {
            mainModal("Certificate Download", "<p>Please Fill all the fields to continue. </p>", false);
        } else {

            $.ajax({
                type: 'POST',
                url: document.querySelector("form#certificate-form").action,
                data: {
                    'cer-name': $name,
                    'cer-email': $email,
                    'nonce': $nonce,
                    'level': $level,
                    'action': 'quiz_certificate_2bc'
                },
                success: function (result) {
                    tbc_loader(false);
                    if (result.success) {
                        mainModal("Certificate", result.data, false);
                    } else {
                        mainModal("Certificate", result.data, true);
                    }
                    document.querySelector("form#certificate-form button[type='submit']").classList.remove("disabled");
                },
                error: function (jqXHR) {
                    tbc_loader(false);
                    // console.log(jqXHR);
                    mainModal("Certificate", "<h4 style='color:rgb(12,12,12)'>OH NO!</h4><br><p>We are unable to process your request right now.<br> Please Try after some time.</p>", true);
                    document.querySelector("form#certificate-form button[type='submit']").classList.remove("disabled");
                }
            });
        }
    });
}


function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

