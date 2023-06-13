function qsa(sel) {
    return Array.apply(null, document.querySelectorAll(sel));
}

// highlighter
var editor = {};
function codeHighlighter() {
    highlighters = $("textarea[id='codeZone']").length;
    if (highlighters > 0) {


        var loopvar = 0;
        qsa("#codeZone").forEach(function (editorEl) {

            editorEl.classList.add(`codeZone${loopvar}`)

            editor[loopvar] = CodeMirror.fromTextArea(editorEl, {
                lineNumbers: true,
                mode: "application/dart",
                theme: "default",
                readOnly: "nocursor",
                // matchBrackets: true,
                lineWrapping: false,
                smartIndent: true,
                indentWithTabs: true
            });
            loopvar++;
        });

        loopvar = 0;
        qsa(".CodeMirror").forEach(function (editorEl) {
            // $(editorEl).prepend(`<button type="button" id="btn-copyCode${loopvar}" class="btn btn-outline-secondary py-1">Copy</button>`);
            $(`<button type="button" id="btn-copyCode${loopvar}" class="btn py-1"><i class="bi bi-clipboard"></i></button>`).insertBefore(editorEl);
            loopvar++;
        });

        $("button[id^='btn-copyCode']").on('click', function (e) {
            e.preventDefault();
            var id = $(this).attr('id').replace(/btn-copyCode/, '');
            var editor = `textarea.codeZone${id}`;
            var copyText = document.querySelectorAll(editor)[0];
            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */
            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);
            $(this).html('<i class="bi bi-clipboard-check"></i>');
            setInterval(() => {
                $(this).html('<i class="bi bi-clipboard"></i>');
            }, 3000);
        })
    }
}
codeHighlighter();

function changeHighlighterTheme(theme) {
    $.each(editor, function (i) {
        editor[i].setOption("theme", theme);
    });
}





// const themeBtnIcon = document.querySelector("li.theme-btn i");
const themeBtnIcon = document.querySelectorAll("li.theme-btn i, div.mobile-theme-btn i");

function setTheme(themeName) {
    localStorage.setItem('theme', themeName);
    if (themeName == "dark-mode") {
        document.body.classList.add(themeName);
        if (document.body.classList.contains('light-mode')) {
            document.body.classList.remove("light-mode");
        }
        themeChanged("dark-mode");
    }
    else {
        document.body.classList.add(themeName);
        if (document.body.classList.contains('dark-mode')) {
            document.body.classList.remove("dark-mode");
        }
        themeChanged("light-mode");
    }
}


function toggleTheme(ele) {

    if (localStorage.getItem('theme') === 'dark-mode') {
        setTheme('light-mode');
        changeHighlighterTheme("default");
        ele.className = "bi bi-brightness-high-fill";
        registerMediaListener("light");
    } else {
        setTheme('dark-mode');
        changeHighlighterTheme("ayu-mirage");
        ele.className = "bi bi-moon-fill";
        registerMediaListener("dark");
    }
}

// Immediately invoked function to set the theme on initial load
(function () {
    // if (localStorage.getItem('theme') === 'dark-mode') {
    //     setTheme('dark-mode');
    //     themeBtnIcon.forEach(function (e) { e.className = "bi bi-moon-fill" });
    //     changeHighlighterTheme("ayu-mirage");
    // }
    // else {
    //     setTheme('light-mode');
    // }

    switch (localStorage.getItem("theme")) {
        case 'dark-mode': {
            setTheme('dark-mode');
            themeBtnIcon.forEach(function (e) { e.className = "bi bi-moon-fill" });
            changeHighlighterTheme("ayu-mirage");
            registerMediaListener("dark");
            break;
        }
        case 'light-mode': {
            setTheme('light-mode');
            changeHighlighterTheme("default");
            themeBtnIcon.forEach(function (e) { e.className = "bi bi-brightness-high-fill" });
            registerMediaListener("light");
            break;
        }
        default: { // using system setting
            
            if(window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches) {
                setTheme('dark-mode');
                themeBtnIcon.forEach(function (e) { e.className = "bi bi-moon-fill" });
                changeHighlighterTheme("ayu-mirage");
                registerMediaListener("dark");
            }else{
                setTheme('light-mode');
                changeHighlighterTheme("default");
                themeBtnIcon.forEach(function (e) { e.className = "bi bi-brightness-high-fill" });
                registerMediaListener("light");
            }
            break;
        }
    }
})();



function registerMediaListener(scheme) {
  window.matchMedia(`(prefers-color-scheme: ${scheme})`).addEventListener('change', onSchemeChange);
}

function onSchemeChange(scheme) {
  if (scheme.matches) {
    setTheme('light-mode');
    changeHighlighterTheme("default");
    themeBtnIcon.forEach(function (e) { e.className = "bi bi-brightness-high-fill" });
  } else {
    setTheme('dark-mode');
    themeBtnIcon.forEach(function (e) { e.className = "bi bi-moon-fill" });
    changeHighlighterTheme("ayu-mirage");
  }
}







function themeChanged(theme) {
    if (theme == "dark-mode") {
        $.each($('.text-dark'), function (index, element) {
            $(this).removeClass("text-dark");
            $(this).addClass("text-light");
        });

        $.each($("section.features div.card img, section.service img:nth-child(1)"), function (index, element) {
            $(this).attr('src', $(this).attr("data-dark-src"));
        });

        // if (!$("ul.dropdown-menu").hasClass("dropdown-menu-dark")) {
        //     $("ul.dropdown-menu").addClass("dropdown-menu-dark");
        // }

        $.each($(".bg-white"), function (index, element) {
            $(this).removeClass("bg-white");
            $(this).addClass("bg-dark");
        });
        $.each($(".link-dark"), function (index, element) {
            $(this).removeClass("link-dark");
            $(this).addClass("link-light");
        });
    }

    if (theme == "light-mode") {
        $.each($('.text-light'), function (index, element) {
            $(this).removeClass("text-light");
            $(this).addClass("text-dark");
        });

        $.each($("section.features div.card img, section.service img:nth-child(1)"), function (index, element) {
            $(this).attr('src', $(this).attr("data-light-src"));
        });

        // if ($("ul.dropdown-menu").hasClass("dropdown-menu-dark")) {
        //     $("ul.dropdown-menu").removeClass("dropdown-menu-dark");
        // }

        $.each($(".bg-dark"), function (index, element) {
            $(this).removeClass("bg-dark");
            $(this).addClass("bg-white");
        });
        $.each($(".link-light"), function (index, element) {
            $(this).removeClass("link-light");
            $(this).addClass("link-dark");
        });
    }
}




// mobile menu
function mobileMenu() {
    document.body.classList.add("modal-active");
    document.querySelector("header.site-header nav#main-mobile-menu").classList.add("open");
    $("header.site-header nav#main-mobile-menu").animate({
        right: '0%'
    });
}

function closeMobileMenu() {

    document.body.classList.remove("modal-active");
    $("header.site-header nav#main-mobile-menu").animate({
        right: '-100%'
    });
    setTimeout(function () { document.querySelector("header.site-header nav#main-mobile-menu").classList.remove("open"); }, 400);
}


$('a[href*="#"]').click(() => {
    setTimeout(() => {
        removeHash();
    }, 5);
});
function removeHash() {
    history.replaceState('', document.title, window.location.origin + window.location.pathname + window.location.search);
}



// show comments
function showComments(){
    document.querySelectorAll("div.HiddenCommentSection")[0].classList.toggle("hidden");
    document.querySelectorAll("div#comments.comments-area")[0].classList.toggle("d-none");
}


// lesson menu
$("div.lessonMenu").on('click', function () {
    if ($("div.lessonMenu").hasClass("lessonMenuopen")) {
        $(function () {
            $("div.sidebar").animate({
                left: '-290px'
            }, { duration: 200, queue: false });

            $("div.lessonMenu").animate({
                left: '0%'
            }, { duration: 200, queue: false });
        });
        document.querySelector("div.lessonMenu").classList.remove("lessonMenuopen");
    } else {
        document.querySelector("div.lessonMenu").classList.add("lessonMenuopen");
        $(function () {
            $("div.sidebar").animate({
                left: '0%'
            }, { duration: 200, queue: false });

            $("div.lessonMenu").animate({
                left: '260px'
            }, { duration: 200, queue: false });
        });
    }

});





// login modal add html to body
function loginModalHTML() {
    document.body.insertAdjacentHTML('afterbegin', `<div class="tutor-login-modal tutor-modal tutor-is-sm tutor-modal-is-close-inside-inner">
    <span class="tutor-modal-overlay"></span>
    <div class="tutor-modal-root">
        <div class="tutor-modal-inner">
            <button data-tutor-modal-close="" class="tutor-modal-close">
                <span class="tutor-icon-line-cross-line tutor-icon-40"></span>
            </button>
            
            <div class="tutor-modal-body">
                <div class="tutor-fs-5 tutor-color-black tutor-mb-32">
                    Hi, Welcome back!                </div>
                <form id="tutor-login-form" method="post">
        
    <input type="hidden" name="tutor_action" value="tutor_user_login">
    <input type="hidden" name="redirect_to" value="${window.location.href}">

    <div class="tutor-input-group tutor-form-control-has-icon-right tutor-mb-20">
        <input type="text" class="tutor-form-control" placeholder="Username or Email Address" name="log" value="" size="20">
    </div>
    <div class="tutor-input-group tutor-form-control-has-icon-right tutor-mb-32">
        <input type="password" class="tutor-form-control" placeholder="Password" name="pwd" value="" size="20" autocomplete="current-password" >
    </div>
    <div class="tutor-login-error">

    </div>
        <div class="tutor-d-flex tutor-justify-content-between tutor-align-items-center tutor-mb-40">
        <div class="tutor-form-check">
            <input id="tutor-login-agmnt-1" type="checkbox" class="tutor-form-check-input tutor-bg-black-40" name="rememberme" value="forever">
            <label for="tutor-login-agmnt-1" class="tutor-fs-7 tutor-color-muted">
                Keep me signed in            </label>
        </div>
        <a href="${window.location.protocol + "//" + window.location.hostname}/dashboard/retrieve-password" class="tutor-fs-6 tutor-fw-medium tutor-color-black-60 td-none">
            Forgot?        </a>
    </div>

        <button type="submit" class="tutor-btn is-primary tutor-is-block">
        Sign In    </button>
                    <div class="tutor-text-center tutor-fs-6 tutor-color-black-60 tutor-mt-20">
            Don't have an account?&nbsp;
            <a href="${window.location.protocol + "//" + window.location.hostname}/signup/?redirect_to=${window.location.href}" class="tutor-fw-medium td-none tutor-color-design-brand">
                Registration Now            </a>
        </div>
    </form>                            </div>
        </div>
    </div>
</div>`
    );

}



var logTimer = 15000;
var onlyoneTime = 0;
var loginModalOpen = false;
var is_other_modal_active = false;

function twoByte_showlogin() {
    if (loginModalOpen || is_other_modal_active) {
        return;
    }

    if (!$("div.lesson-page").hasClass("user-logged-in")) {
        if (!$("div.tutor-login-modal").hasClass("tutor-is-active")) {
            $("div.tutor-login-modal").addClass("tutor-is-active");

            loginModalOpen = true;
        }
    }
    if (!!document.querySelector("div.doc-page")) {
        if (!$("div.doc-page").hasClass("user-logged-in")) {
            if (!document.querySelector('div.tutor-login-modal')) {
                loginModalHTML();
            }
            if (!$("div.tutor-login-modal").hasClass("tutor-is-active")) {
                $("div.tutor-login-modal").addClass("tutor-is-active");
                loginModalOpen = true;
            }
        }
    }
    if (!!document.querySelector("div.article-page")) {
        if (!$("div.article-page").hasClass("user-logged-in")) {
            if (!document.querySelector('div.tutor-login-modal')) {
                loginModalHTML();
            }
            if (!$("div.tutor-login-modal").hasClass("tutor-is-active")) {
                $("div.tutor-login-modal").addClass("tutor-is-active");
                loginModalOpen = true;
            }
        }
    }
    // on close
    if ($("div.tutor-login-modal").hasClass("tutor-is-active")) {
        document.body.addEventListener('click', event => {
            for (onlyoneTime; onlyoneTime < 1; onlyoneTime++) {
                if (event.target.className == "tutor-modal-overlay" || event.target.className == "tutor-modal-close" || event.target.className == "tutor-icon-line-cross-line tutor-icon-40") {
                    logTimer += 200000;
                    loginModalOpen = false;
                }
            }

        });
    }

}


var loginModaltimer;
var login_modal_first_interval = 0;

(function repeat() {
    if (login_modal_first_interval > 0 && loginModalOpen != true) {
        onlyoneTime = 0;
        twoByte_showlogin();
    }
    login_modal_first_interval = 1;
    if (loginModalOpen || is_other_modal_active) {
        logTimer += 200000
    }

    loginModaltimer = setTimeout(repeat, logTimer);
})();









if ($('.lesson-item.active').length > 0) {
    $('.lesson-item.active').closest('ul').parent().parent().children().children('button').click();
}


// share
if ($(".sd-sharing ul").length != 0) {

    if (navigator.share) {
        $(".sd-sharing ul li:nth-last-child(1)").before('<li class="share-mobile"><a href="javascript:;" class="sd-button share-icon"></a></li>');
        let shareButton = document.querySelector(".share-mobile a");
        let titleEle = !!document.querySelectorAll("article.article h1")[0];
        if (titleEle) {
            titleEle = document.querySelectorAll("article.article h1")[0];
        } else {
            titleEle = document.querySelector(".entry-header .entry-title");
        }
        let titleText = titleEle.innerText || titleEle.textContent;

        shareButton.addEventListener('click', event => {
            if (navigator.share) {
                navigator.share({
                    title: "2ByteCode Blog",
                    text: titleText,
                    url: window.location.href
                }).then(() => {
                    console.log('Thanks for sharing!');
                })
                    .catch(console.error);
            } else {
                $(".sd-sharing ul li.share-mobile").remove();
            }
        });
    }
}



// make menu active
const firstPath = window.location.pathname.split('/')[1]; // 2 if subdirectory
if (firstPath) {
    var totalMenus = $("ul#primary-menu li").length;
    for (var i = 0; i < totalMenus; i++) {
        let ele = document.querySelectorAll("ul#primary-menu li")[i].children[0];
        let is_available = document.querySelectorAll("ul#primary-menu li")[i].children[0].getAttribute("aria-current");
        if (ele.href) {
            if ((ele.href.indexOf(firstPath) > -1) && (is_available == null)) {

                ele.setAttribute("aria-current", "page");
            }
        }
    }

}

// register username same as email + full name + password
const validateEmail = (email) => {
    return String(email)
        .toLowerCase()
        .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
};

if (!!document.querySelectorAll("form#tutor-registration-from")[0]) {

    $('input[name="email"]').keyup(function () {
        // $('input[name="user_login"]').val($('input[name="email"]').val());

        if ($('input[name="email"]').val().length > 0 && !validateEmail($('input[name="email"]').val())) {
            $('input[name="email"]').attr('style', 'border-color: red !important;');
        }
        else {
            $('input[name="email"]').removeAttr('style');
        }
    });

    // $('input[name="full_name"]').keyup(function () {
    //     var fullname = $('input[name="full_name"]').val();

    //     var fname = fullname.substring(0, fullname.lastIndexOf(" ") + 1);
    //     var lname = fullname.substring(fullname.lastIndexOf(" ") + 1, fullname.length);

    //     if (fname == "") {
    //         $('input[name="first_name"]').val(lname);
    //         $('input[name="last_name"]').val(fullname);
    //     } else {
    //         $('input[name="first_name"]').val(fname);
    //         $('input[name="last_name"]').val(lname);
    //     }

    // });

    $('input[name="password"]').keyup(function () {
        if ($('input[name="password"]').val().length < 6 && $('input[name="password"]').val().length > 0) {
            $('input[name="password"]').attr('style', 'border-color: red !important;');

            return;

        } else {
            $('input[name="password"]').removeAttr('style');
        }
    });

}


function verifyUserData() {
    if ($('input[name="password"]').val().length < 6 || validateEmail($('input[name="email"]').val()) == null) {
        return false;
    }
    else {
        return true;
    }
}








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










// quiz
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
                2: "For inheriting the the properties of parent class",
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
    document.querySelector("lottie-player").play();

    setTimeout(() => {
        document.querySelector("div.result-wrapper").style.opacity = 1;
        document.querySelector("div.recomendation").style.opacity = 1;

    }, 400);
}





function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

// anm doc
function docLevelCompleted() {
    level = document.querySelector(".doc-page .leftbar article").getAttribute('data-doclevel');
    next_level = document.querySelector(".doc-page .leftbar article").getAttribute('data-next-doc-level');
    p_ele = document.querySelector(".doc-animation .card p");
    a_ele = document.querySelector(".doc-animation .card a");


    p_ele.innerHTML = p_ele.innerHTML.replace("beginner", level);
    if (level == "expert") {
        a_ele.innerHTML = "Start from Beginner";
    } else {
        a_ele.innerHTML = a_ele.innerHTML.replace("Intermediate", next_level);
    }
    a_ele.href = document.querySelector(".doc-page .sidebar a.upcoming-level").href;


    is_other_modal_active = true;
    document.querySelector("lottie-player.lottie-doc-anam-upper").removeAttribute("style");
    document.querySelectorAll("lottie-player").forEach((e) => {
        e.play()
    });
    document.querySelector(".doc-animation").classList.add("active");
    setTimeout(function () {
        document.querySelector("lottie-player.lottie-doc-anam-upper").style.display = "none"
    }, 1900);


    // on close
    document.body.addEventListener('click', event => {
        if (event.target.className == "doc-animation-overlay" || event.target.className == "lottie-doc-anam-right" ||
            event.target.className == "lottie-doc-anam-left" || event.target.className == "lottie-doc-anam") {
            document.querySelector(".doc-animation").classList.remove("active");
            is_other_modal_active = false;
            document.querySelectorAll("lottie-player").forEach((e) => {
                e.stop();
            });
        }
    });
}
















