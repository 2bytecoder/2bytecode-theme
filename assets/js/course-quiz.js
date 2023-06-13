$.ajax({
    type: 'POST',
    url: twobytecode.ajax_url,
    data: {
        'course': 296,
        'action': 'course_quiz_response_init'
    },
    success: function (result) {
        $data = result.result;

        $formData = new FormData();
        Object.keys($data).forEach( (key) => $formData.append(key, $data[key]) );
        $formData.append("Userans", "Option2");
        $formData.append("action", "course_quiz_response");
        secondAPI($formData);
    }
});

    // $formData = new FormData();
    // Object.keys(result.result).forEach((key) => $formData.append(key, result.result[key]));
    // $formData.append("Userans", "Option1");
    // $formData.append("action", "course_quiz_response");

    // $data = result.result;
    // $data.action = "course_quiz_response";
    // $data.Userans = "Option1";



function secondAPI($data){
    $.ajax({
        type: 'POST',
        url: twobytecode.ajax_url,
        data: $data,
        processData: false,
        contentType: false,
        success: function (result2) {
            console.log(result2);
        },
        error: function (error) {
            console.log(error);
        }
    });
}


