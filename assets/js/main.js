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





// theme
const themeBtnIcon = document.querySelectorAll("li.theme-btn span, div.mobile-theme-btn span");

// theme btn lottie
const data = { "v": "5.5.8", "fr": 60, "ip": 0, "op": 52, "w": 24, "h": 24, "nm": "Night Toggle", "ddd": 0, "assets": [], "layers": [{ "ddd": 0, "ind": 1, "ty": 4, "nm": "l6", "sr": 1, "ks": { "o": { "a": 1, "k": [{ "i": { "x": [0.667], "y": [1] }, "o": { "x": [0.333], "y": [0] }, "t": 11, "s": [100] }, { "t": 18, "s": [0] }] }, "r": { "a": 0, "k": 300 }, "p": { "a": 0, "k": [12, 12, 0] } }, "ao": 0, "shapes": [{ "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ks": { "a": 0, "k": { "i": [[0, 0], [0, 0]], "o": [[0, 0], [0, 0]], "v": [[0, -6.004], [0, -10.941]], "c": false } }, "nm": "Path 1", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [1, 1, 1, 1] }, "o": { "a": 0, "k": 100 }, "w": { "a": 0, "k": 2 }, "lc": 2, "lj": 1, "ml": 4, "bm": 0, "d": [{ "n": "d", "nm": "dash", "v": { "a": 0, "k": 10 } }, { "n": "g", "nm": "gap", "v": { "a": 0, "k": 10 } }, { "n": "o", "nm": "offset", "v": { "a": 1, "k": [{ "i": { "x": [0.431], "y": [1] }, "o": { "x": [0.45], "y": [0] }, "t": 0, "s": [0] }, { "t": 20, "s": [-5] }] } }], "nm": "Stroke 1", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [0, 0] }, "a": { "a": 0, "k": [0, 0] }, "s": { "a": 0, "k": [100, 100] }, "r": { "a": 0, "k": 0 }, "o": { "a": 0, "k": 100 }, "sk": { "a": 0, "k": 0 }, "sa": { "a": 0, "k": 0 }, "nm": "Transform" }], "nm": "Shape 1", "bm": 0, "hd": false }], "ip": 0, "op": 52, "st": 0, "bm": 0 }, { "ddd": 0, "ind": 2, "ty": 4, "nm": "l5", "sr": 1, "ks": { "o": { "a": 1, "k": [{ "i": { "x": [0.667], "y": [1] }, "o": { "x": [0.333], "y": [0] }, "t": 11, "s": [100] }, { "t": 18, "s": [0] }] }, "r": { "a": 0, "k": 240 }, "p": { "a": 0, "k": [12, 12, 0] } }, "ao": 0, "shapes": [{ "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ks": { "a": 0, "k": { "i": [[0, 0], [0, 0]], "o": [[0, 0], [0, 0]], "v": [[0, -6.004], [0, -10.941]], "c": false } }, "nm": "Path 1", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [1, 1, 1, 1] }, "o": { "a": 0, "k": 100 }, "w": { "a": 0, "k": 2 }, "lc": 2, "lj": 1, "ml": 4, "bm": 0, "d": [{ "n": "d", "nm": "dash", "v": { "a": 0, "k": 10 } }, { "n": "g", "nm": "gap", "v": { "a": 0, "k": 10 } }, { "n": "o", "nm": "offset", "v": { "a": 1, "k": [{ "i": { "x": [0.431], "y": [1] }, "o": { "x": [0.45], "y": [0] }, "t": 0, "s": [0] }, { "t": 20, "s": [-5] }] } }], "nm": "Stroke 1", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [0, 0] }, "a": { "a": 0, "k": [0, 0] }, "s": { "a": 0, "k": [100, 100] }, "r": { "a": 0, "k": 0 }, "o": { "a": 0, "k": 100 }, "sk": { "a": 0, "k": 0 }, "sa": { "a": 0, "k": 0 }, "nm": "Transform" }], "nm": "Shape 1", "bm": 0, "hd": false }], "ip": 0, "op": 52, "st": 0, "bm": 0 }, { "ddd": 0, "ind": 3, "ty": 4, "nm": "l4", "sr": 1, "ks": { "o": { "a": 1, "k": [{ "i": { "x": [0.667], "y": [1] }, "o": { "x": [0.333], "y": [0] }, "t": 11, "s": [100] }, { "t": 18, "s": [0] }] }, "r": { "a": 0, "k": 180 }, "p": { "a": 0, "k": [12, 12, 0] } }, "ao": 0, "shapes": [{ "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ks": { "a": 0, "k": { "i": [[0, 0], [0, 0]], "o": [[0, 0], [0, 0]], "v": [[0, -6.004], [0, -10.941]], "c": false } }, "nm": "Path 1", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [1, 1, 1, 1] }, "o": { "a": 0, "k": 100 }, "w": { "a": 0, "k": 2 }, "lc": 2, "lj": 1, "ml": 4, "bm": 0, "d": [{ "n": "d", "nm": "dash", "v": { "a": 0, "k": 10 } }, { "n": "g", "nm": "gap", "v": { "a": 0, "k": 10 } }, { "n": "o", "nm": "offset", "v": { "a": 1, "k": [{ "i": { "x": [0.431], "y": [1] }, "o": { "x": [0.45], "y": [0] }, "t": 0, "s": [0] }, { "t": 20, "s": [-5] }] } }], "nm": "Stroke 1", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [0, 0] }, "a": { "a": 0, "k": [0, 0] }, "s": { "a": 0, "k": [100, 100] }, "r": { "a": 0, "k": 0 }, "o": { "a": 0, "k": 100 }, "sk": { "a": 0, "k": 0 }, "sa": { "a": 0, "k": 0 }, "nm": "Transform" }], "nm": "Shape 1", "bm": 0, "hd": false }], "ip": 0, "op": 52, "st": 0, "bm": 0 }, { "ddd": 0, "ind": 4, "ty": 4, "nm": "l3", "sr": 1, "ks": { "o": { "a": 1, "k": [{ "i": { "x": [0.667], "y": [1] }, "o": { "x": [0.333], "y": [0] }, "t": 11, "s": [100] }, { "t": 18, "s": [0] }] }, "r": { "a": 0, "k": 120 }, "p": { "a": 0, "k": [12, 12, 0] } }, "ao": 0, "shapes": [{ "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ks": { "a": 0, "k": { "i": [[0, 0], [0, 0]], "o": [[0, 0], [0, 0]], "v": [[0, -6.004], [0, -10.941]], "c": false } }, "nm": "Path 1", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [1, 1, 1, 1] }, "o": { "a": 0, "k": 100 }, "w": { "a": 0, "k": 2 }, "lc": 2, "lj": 1, "ml": 4, "bm": 0, "d": [{ "n": "d", "nm": "dash", "v": { "a": 0, "k": 10 } }, { "n": "g", "nm": "gap", "v": { "a": 0, "k": 10 } }, { "n": "o", "nm": "offset", "v": { "a": 1, "k": [{ "i": { "x": [0.431], "y": [1] }, "o": { "x": [0.45], "y": [0] }, "t": 0, "s": [0] }, { "t": 20, "s": [-5] }] } }], "nm": "Stroke 1", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [0, 0] }, "a": { "a": 0, "k": [0, 0] }, "s": { "a": 0, "k": [100, 100] }, "r": { "a": 0, "k": 0 }, "o": { "a": 0, "k": 100 }, "sk": { "a": 0, "k": 0 }, "sa": { "a": 0, "k": 0 }, "nm": "Transform" }], "nm": "Shape 1", "bm": 0, "hd": false }], "ip": 0, "op": 52, "st": 0, "bm": 0 }, { "ddd": 0, "ind": 5, "ty": 4, "nm": "l2", "sr": 1, "ks": { "o": { "a": 1, "k": [{ "i": { "x": [0.667], "y": [1] }, "o": { "x": [0.333], "y": [0] }, "t": 11, "s": [100] }, { "t": 18, "s": [0] }] }, "r": { "a": 0, "k": 60 }, "p": { "a": 0, "k": [12, 12, 0] } }, "ao": 0, "shapes": [{ "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ks": { "a": 0, "k": { "i": [[0, 0], [0, 0]], "o": [[0, 0], [0, 0]], "v": [[0, -6.004], [0, -10.941]], "c": false } }, "nm": "Path 1", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [1, 1, 1, 1] }, "o": { "a": 0, "k": 100 }, "w": { "a": 0, "k": 2 }, "lc": 2, "lj": 1, "ml": 4, "bm": 0, "d": [{ "n": "d", "nm": "dash", "v": { "a": 0, "k": 10 } }, { "n": "g", "nm": "gap", "v": { "a": 0, "k": 10 } }, { "n": "o", "nm": "offset", "v": { "a": 1, "k": [{ "i": { "x": [0.431], "y": [1] }, "o": { "x": [0.45], "y": [0] }, "t": 0, "s": [0] }, { "t": 20, "s": [-5] }] } }], "nm": "Stroke 1", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [0, 0] }, "a": { "a": 0, "k": [0, 0] }, "s": { "a": 0, "k": [100, 100] }, "r": { "a": 0, "k": 0 }, "o": { "a": 0, "k": 100 }, "sk": { "a": 0, "k": 0 }, "sa": { "a": 0, "k": 0 }, "nm": "Transform" }], "nm": "Shape 1", "bm": 0, "hd": false }], "ip": 0, "op": 52, "st": 0, "bm": 0 }, { "ddd": 0, "ind": 6, "ty": 4, "nm": "l1", "sr": 1, "ks": { "o": { "a": 1, "k": [{ "i": { "x": [0.667], "y": [1] }, "o": { "x": [0.333], "y": [0] }, "t": 11, "s": [100] }, { "t": 18, "s": [0] }] }, "p": { "a": 0, "k": [12, 12, 0] } }, "ao": 0, "shapes": [{ "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ks": { "a": 0, "k": { "i": [[0, 0], [0, 0]], "o": [[0, 0], [0, 0]], "v": [[0, -6.004], [0, -10.941]], "c": false } }, "nm": "Path 1", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [1, 1, 1, 1] }, "o": { "a": 0, "k": 100 }, "w": { "a": 0, "k": 2 }, "lc": 2, "lj": 1, "ml": 4, "bm": 0, "d": [{ "n": "d", "nm": "dash", "v": { "a": 0, "k": 10 } }, { "n": "g", "nm": "gap", "v": { "a": 0, "k": 10 } }, { "n": "o", "nm": "offset", "v": { "a": 1, "k": [{ "i": { "x": [0.431], "y": [1] }, "o": { "x": [0.45], "y": [0] }, "t": 0, "s": [0] }, { "t": 20, "s": [-5] }] } }], "nm": "Stroke 1", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [0, 0] }, "a": { "a": 0, "k": [0, 0] }, "s": { "a": 0, "k": [100, 100] }, "r": { "a": 0, "k": 0 }, "o": { "a": 0, "k": 100 }, "sk": { "a": 0, "k": 0 }, "sa": { "a": 0, "k": 0 }, "nm": "Transform" }], "nm": "Shape 1", "bm": 0, "hd": false }], "ip": 0, "op": 52, "st": 0, "bm": 0 }, { "ddd": 0, "ind": 7, "ty": 4, "nm": "c", "sr": 1, "ks": { "p": { "a": 0, "k": [12, 12, 0] }, "a": { "a": 0, "k": [-1.237, -2.112, 0] } }, "ao": 0, "hasMask": true, "masksProperties": [{ "inv": false, "mode": "s", "pt": { "a": 1, "k": [{ "i": { "x": 0, "y": 1 }, "o": { "x": 0.333, "y": 0 }, "t": 25, "s": [{ "i": [[3.55, 0], [0, -3.55], [-3.55, 0], [0, 3.55]], "o": [[-3.55, 0], [0, 3.55], [3.55, 0], [0, -3.55]], "v": [[9.94, -19.487], [3.513, -13.06], [9.94, -6.633], [16.367, -13.06]], "c": true }] }, { "t": 52, "s": [{ "i": [[3.55, 0], [0, -3.55], [-3.55, 0], [0, 3.55]], "o": [[-3.55, 0], [0, 3.55], [3.55, 0], [0, -3.55]], "v": [[3.065, -12.362], [-3.362, -5.935], [3.065, 0.492], [9.492, -5.935]], "c": true }] }] }, "o": { "a": 0, "k": 100 }, "x": { "a": 0, "k": 0 }, "nm": "Mask 1" }], "shapes": [{ "ty": "gr", "it": [{ "d": 1, "ty": "el", "s": { "a": 1, "k": [{ "i": { "x": [0.667, 0.667], "y": [1, 1] }, "o": { "x": [0.396, 0.396], "y": [0, 0] }, "t": 16, "s": [6, 6] }, { "t": 41, "s": [16, 16] }] }, "p": { "a": 0, "k": [0, 0] }, "nm": "Ellipse Path 1", "hd": false }, { "ty": "fl", "c": { "a": 0, "k": [1, 1, 1, 1] }, "o": { "a": 0, "k": 100 }, "r": 1, "bm": 0, "nm": "Fill 1", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [-1.237, -2.112] }, "a": { "a": 0, "k": [0, 0] }, "s": { "a": 0, "k": [100, 100] }, "r": { "a": 0, "k": 0 }, "o": { "a": 0, "k": 100 }, "sk": { "a": 0, "k": 0 }, "sa": { "a": 0, "k": 0 }, "nm": "Transform" }], "nm": "Ellipse 1", "bm": 0, "hd": false }], "ip": 0, "op": 52, "st": 0, "bm": 0 }], "markers": [] };

var themeBtnIconsCounter = 0;
var themeBtnIconAnim1 = "";
var themeBtnIconAnim2 = "";
var themeBtnIconAnim1Dir = 1;
var themeBtnIconAnim2Dir = 1;

themeBtnIcon.forEach((e) => {
    if (themeBtnIconsCounter == 0) {
        themeBtnIconAnim1 = lottie.loadAnimation({
            container: e,
            renderer: 'svg',
            loop: false,
            autoplay: true,
            animationData: data,
        });
        themeBtnIconsCounter = themeBtnIconsCounter + 1;

        // e.addEventListener('click', () => {
        //     themeBtnIconAnim1Dir = -themeBtnIconAnim1Dir;
        //     themeBtnIconAnim1.setDirection(themeBtnIconAnim1Dir);
        //     themeBtnIconAnim1.play();
        // });
    }

    else if (themeBtnIconsCounter == 1) {
        themeBtnIconAnim2 = lottie.loadAnimation({
            container: e,
            renderer: 'svg',
            loop: false,
            autoplay: true,
            animationData: data,
        });

        // e.addEventListener('click', () => {
        //     themeBtnIconAnim2Dir = -themeBtnIconAnim2Dir;
        //     themeBtnIconAnim2.setDirection(themeBtnIconAnim2Dir);
        //     themeBtnIconAnim2.play();
        // });
    }
});

function themeBtnOnThemeChange() {
    themeBtnIconAnim2Dir = -themeBtnIconAnim2Dir;
    themeBtnIconAnim2.setDirection(themeBtnIconAnim2Dir);
    themeBtnIconAnim2.play();

    themeBtnIconAnim1Dir = -themeBtnIconAnim1Dir;
    themeBtnIconAnim1.setDirection(themeBtnIconAnim1Dir);
    themeBtnIconAnim1.play();
}


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
        registerMediaListener("light");
    } else {
        setTheme('dark-mode');
        changeHighlighterTheme("ayu-mirage");
        registerMediaListener("dark");
    }

    themeBtnOnThemeChange();
}

// Immediately invoked function to set the theme on initial load
(function () {

    switch (localStorage.getItem("theme")) {
        case 'dark-mode': {
            setTheme('dark-mode');
            themeBtnOnThemeChange();
            changeHighlighterTheme("ayu-mirage");
            registerMediaListener("dark");
            break;
        }
        case 'light-mode': {
            setTheme('light-mode');
            changeHighlighterTheme("default");
            registerMediaListener("light");
            break;
        }
        default: { // using system setting

            if (window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches) {
                setTheme('dark-mode');
                themeBtnOnThemeChange();
                changeHighlighterTheme("ayu-mirage");
                registerMediaListener("dark");
            } else {
                setTheme('light-mode');
                changeHighlighterTheme("default");
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
    } else {
        setTheme('dark-mode');
        changeHighlighterTheme("ayu-mirage");
        themeBtnOnThemeChange();
    }
}







function themeChanged(theme) {

    if (theme == "dark-mode") {
        $.each($('.text-dark'), function (index, element) {
            $(this).removeClass("text-dark");
            $(this).addClass("text-light");
        });
        $.each($('.border-dark'), function (index, element) {
            $(this).removeClass("border-dark");
            $(this).addClass("border-light");
        });

        $.each($("img[data-dark-src]"), function (index, element) {
            $(this).attr('src', $(this).attr("data-dark-src"));
        });

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

        $.each($('.border-light'), function (index, element) {
            $(this).removeClass("border-light");
            $(this).addClass("border-dark");
        });

        $.each($("img[data-light-src]"), function (index, element) {
            $(this).attr('src', $(this).attr("data-light-src"));
        });

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



// course launch

function addCourseLaunchHeaderAlertHTML() {
    if (window.location.pathname == "/" || window.location.pathname == "/docs/" || window.location.pathname == "/dart/" || window.location.pathname == "/flutter/" || window.location.pathname == "/articles/") {
        document.body.insertAdjacentHTML("afterbegin", `<div class="course_launch_alert alert alert-success alert-dismissible fade show mb-0 border-top-0 border-end-0 border-start-0 rounded-0" role="alert">
    <div class="container ps-md-4">
    Hurry up! get Flutter 4 Freelancers course worth $12.95 for free. No payment method required. <a href="/new-flutter-course-launch/" class="text-decoration-none">Go to offer page <i class="bi bi-arrow-right"></i></a>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    </div>`);
    }
}
function courseLaunchHeaderAlert() {

    if (window.location.pathname == "/new-flutter-course-launch/") return;
    addCourseLaunchHeaderAlertHTML();

    var countDownDate = new Date("oct 19, 2022 23:59:59").getTime();

    var x = setInterval(function () {

        var now = new Date().getTime();
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.querySelector(".course_launch_alert .course_launch_count_down").innerHTML = days + "d " + hours + "h "
            + minutes + "m " + seconds + "s ";

        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.querySelector(".course_launch_alert").style.display = "none";
        }
    }, 1000);
}

// window.onload = addCourseLaunchHeaderAlertHTML;


// mainModal
function mainModal(mtitle, mdata, isError = false) {
    $("#mainModal h5#modalLabel").html(mtitle);
    // $("#mainModal div.modal-body").html(mdata);
    if (isError) {
        $("#mainModal div.modal-body").html('<i class="bi bi-exclamation-triangle-fill fs-1 d-block"></i>&nbsp;' + mdata);
    } else {
        $("#mainModal div.modal-body").html('<i class="bi bi-check-circle-fill fs-1 d-block"></i>&nbsp;' + mdata);
    }
    $("#mainModal").modal('show');
}
$("#mainModal").on('hidden.bs.modal', function (event) {
    $("#mainModal h5#modalLabel").html("");
    $("#mainModal div.modal-body").html("");
});


// show comments
function showComments() {
    document.querySelectorAll("div.HiddenCommentSection")[0].classList.toggle("hidden");
    document.querySelectorAll("div#comments.comments-area")[0].classList.toggle("d-none");
}


// lesson menu mobile
$("div.lessonMenu").on('click', function () {
    if ($("div.lessonMenu").hasClass("lessonMenuopen")) {
        $(function () {
            $("div.sidebar").animate({
                left: '-320px'
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
                left: '290px'
            }, { duration: 200, queue: false });
        });
    }

});




// video course sidebar
$("div.sidebar-top-txt span").on('click', function () {
    showHideVideoLessonSidebar();
});

$("div.sidebar-icon").on("click", function () {
    showHideVideoLessonSidebar();
});

$("button.view-course-content").on("click", function () {
    showHideVideoLessonSidebar();
});

function getDeviceWidth() {
    if (typeof (window.innerWidth) == 'number') {
        //Non-IE
        return window.innerWidth;
    } else if (document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) {
        //IE 6+ in 'standards compliant mode'
        return document.documentElement.clientWidth;
    } else if (document.body && (document.body.clientWidth || document.body.clientHeight)) {
        //IE 4 compatible
        return document.body.clientWidth;
    }
    return 0;
}


// on load show sidebar on big screens 
function showVideoLessonSidebar() {
    if (document.querySelector("div.lesson-page.video-course")) {
        if (getDeviceWidth() >= 800) {
            document.querySelector("div.lesson-page.video-course").classList.add("sidebar-open");
        }

        // reg event - hide sidebar on outside click
        if (getDeviceWidth() <= 800) {
            window.addEventListener('click', function (e) {
                if (document.querySelector("div.lesson-page.video-course.sidebar-open div.sidebar.opened")) {
                    if (!document.querySelector('div.lesson-page.video-course.sidebar-open div.sidebar.opened').contains(e.target)) {
                        console.log(e.target);
                        document.body.classList.remove("modal-active");
                        document.querySelectorAll("div.lesson-page.video-course")[0].classList.remove("sidebar-open");
                        document.querySelector("div.lesson-page.video-course div.sidebar").classList.remove("opened");
                    }
                }
            });
        }
    }
}
window.onload = showVideoLessonSidebar;


function showHideVideoLessonSidebar() {

    document.querySelectorAll("div.lesson-page.video-course")[0].classList.toggle("sidebar-open");
    if (getDeviceWidth() <= 800) {
        document.body.classList.toggle("modal-active");
        setTimeout(function () {
            document.querySelector("div.lesson-page.video-course div.sidebar").classList.toggle("opened");
        }, 500);
        document.body.scrollTop = document.documentElement.scrollTop = 0;
    }
}





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
    $('.lesson-item.active').closest('ul').parent().parent().children().children('button')[0].click();
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
        if (!titleEle) {
            titleEle = document.querySelector(".lesson-item.active")
        }
        let titleText = titleEle.innerText || titleEle.textContent;
        if (titleText.indexOf('.') > -1) { titleText = titleText.split(',') }
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

if (document.querySelectorAll(".lesson-page.video-course")[0]) {
    document.addEventListener('contextmenu', event => event.preventDefault());
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



// cart
function waitForElm(selector) {
    return new Promise(resolve => {
        if (document.querySelector(selector)) {
            return resolve(document.querySelector(selector));
        }

        const observer = new MutationObserver(mutations => {
            if (document.querySelector(selector)) {
                resolve(document.querySelector(selector));
                observer.disconnect();
            }
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    });
}
if (document.querySelector(".woocommerce-cart")) {
    waitForElm('.woocommerce-cart .entry-content .woocommerce #cart_empty').then((elm) => {

        lottie.loadAnimation({
            container: elm,
            renderer: 'svg',
            loop: false,
            autoplay: true,
            path: 'https://assets10.lottiefiles.com/private_files/lf30_oqpbtola.json'
        });

        elm.classList.add("open");
    });
}




// anm dart doc
function dartDocLevelCompleted() {

    a_ele = document.querySelector(".doc-animation .card a");

    a_ele.href = document.querySelector(".doc-page .sidebar a.upcoming-level").href;


    is_other_modal_active = true;
    document.querySelector(".doc-animation lottie-player.lottie-doc-anam-upper").removeAttribute("style");
    document.querySelectorAll(".doc-animation lottie-player").forEach((e) => {
        e.play();
    });
    document.querySelector(".doc-animation").classList.add("active");
    setTimeout(function () {
        document.querySelector(".doc-animation lottie-player.lottie-doc-anam-upper").style.display = "none"
    }, 1900);


    // on close
    document.body.addEventListener('click', event => {
        if (event.target.className == "doc-animation-overlay" || event.target.className == "lottie-doc-anam-right" ||
            event.target.className == "lottie-doc-anam-left" || event.target.className == "lottie-doc-anam") {
            document.querySelector(".doc-animation").classList.remove("active");
            is_other_modal_active = false;
            document.querySelectorAll(".doc-animation lottie-player").forEach((e) => {
                e.stop()
            });
        }
    });
}



// add shadow to header on scroll
window.addEventListener('scroll', function () {
    var scrollTop = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;
    var headerEle = document.querySelector("header.site-header");
    if (scrollTop > 20) {
        if (!headerEle.classList.contains("headerShadow")) {
            headerEle.classList.add("headerShadow");
        }
    } else {
        headerEle.classList.remove("headerShadow");
    }
}, true);







// newsletter
if (document.querySelector("form#newsletter-form")) {
    document.querySelector("form#newsletter-form").addEventListener("submit", function (e) {
        e.preventDefault();
        let email = $('form#newsletter-form input[name="newsletter_email"]').val();
        let nonce = $('form#newsletter-form input[name="_wpnonce"]').val();

        if (email == "") {
            mainModal("Newsletter Susbcription", "Empty Input, Please Enter Your Email.", true);
            return false;
        }

        $.ajax({
            type: 'POST',
            url: document.querySelector("form#newsletter-form").action,
            data: {
                'newsletter_email': email,
                'nonce': nonce,
                'action': 'ns8888_get_newsletter_response_content'
            },
            success: function (result) {

                if (result.success) {
                    mainModal("Newsletter Susbcription", "<h4 style='color:rgb(12,12,12)' >SUCCESS!</h4><br><p>Thank you for susbcribing to our Newsletter.<br> You will receive latest Flutter, Dart Tutorials directly in your inbox </p>", false);
                } else {
                    mainModal("Newsletter Susbcription", "<h4 style='color:rgb(12,12,12)' >OH NO!</h4><br><p>We are unable to process your request right now.<br> Please Try after some time.</p>", true);
                }
            },
            error: function () {
                mainModal("Newsletter Susbcription", "<h4 style='color:rgb(12,12,12)' >OH NO!</h4><br><p>We are unable to process your request right now.<br> Please Try after some time.</p>", true);
            }
        });

    });
}


// loader
function tbc_loader(is_show) {
    if (is_show) {
        document.body.insertAdjacentHTML('afterbegin',
            `<div id="tbc_loader">
            <img class="mb-5 mb-md-0" src="https://2bytecode.in/wp-content/uploads/2022/03/cropped-Happy-Dussehra-512-x-512-px-1.png" alt="2bytecode short image">
            <div class="spinner-border mb-5 mb-md-0" style="width: 4rem; height: 4rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>`)
    } else {
        document.getElementById("tbc_loader").remove();
    }
}





if (document.querySelector("div.social-log-sign-btns")) {
    qsa("div.social-log-sign-btns button").forEach(function (ele) {
        ele.addEventListener("click", function (e) {

            tbc_loader(true);

            const params = new Proxy(new URLSearchParams(window.location.search), {
                get: (searchParams, prop) => searchParams.get(prop),
            });
            if (params.redirect_to) {
                document.cookie = `socialAfterRedirect=${params.redirect_to}; max-age=${3600}; path=/;`
            }

            // console.log(this.id, this.dataset.nonce, twobytecode.ajax_url );
            $.ajax({
                type: 'POST',
                url: twobytecode.ajax_url,
                data: {
                    'type': this.id,
                    'nonce': this.dataset.nonce,
                    'action': 'tbc_social_login_link'
                },
                success: function (result) {
                    if (result.success) {
                        window.open(result.message, "_self")
                    } else {
                        tbc_loader(false);
                        mainModal("Error!", "<h4 style='color:rgb(12,12,12)' >OH NO!</h4><br><p>We are unable to process your request right now.<br> Please Try after some time.</p>", true);
                    }
                },
                error: function () {
                    tbc_loader(false);
                    mainModal("Error", "<h4 style='color:rgb(12,12,12)' >OH NO!</h4><br><p>We are unable to process your request right now.<br> Please Try after some time.</p>", true);
                }
            });

        });
    });
}

