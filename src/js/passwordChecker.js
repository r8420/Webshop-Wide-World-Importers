$(function () {
    const $password = $(".validate");
    const $passwordAlert = $(".password-alert");
    const $requirements = $(".requirements");
    let leng, bigLetter, num, smallLetter;
    const $leng = $(".leng");
    const $bigLetter = $(".big-letter");
    const $num = $(".num");
    const $smallLetter = $(".small-letter");

    $requirements.addClass("wrong");
    $password.on("focus", function() {
        $passwordAlert.show();
    });

    $password.on("input blur", function (e) {
        const el = $(this);
        const val = el.val();
        $passwordAlert.show();

        leng = val.length >= 8;
        let bigLetterRegex = /[A-Z]/;
        bigLetter = bigLetterRegex.test(val);
        let numRegex = /.*\d.*\d.*\d/;
        num = numRegex.test(val);
        let smallLetterRegex = /[a-z]/;
        smallLetter = smallLetterRegex.test(val);

        console.log(leng, bigLetter, num, smallLetter);

        if(leng && bigLetter && num && smallLetter) {
            $(this).addClass("valid").removeClass("invalid");
            $requirements.removeClass("wrong").addClass("good");
            $passwordAlert.removeClass("alert-warning").addClass("alert-success");
        } else {
            $(this).addClass("invalid").removeClass("valid");
            $passwordAlert.removeClass("alert-success").addClass("alert-warning");

            if(!leng) {
                $leng.addClass("wrong").removeClass("good");
            } else {
                $leng.addClass("good").removeClass("wrong");
            }

            if(!bigLetter) {
                $bigLetter.addClass("wrong").removeClass("good");
            } else {
                $bigLetter.addClass("good").removeClass("wrong");
            }

            if(!num) {
                $num.addClass("wrong").removeClass("good");
            } else {
                $num.addClass("good").removeClass("wrong");
            }

            if(!smallLetter) {
                $smallLetter.addClass("wrong").removeClass("good");
            } else {
                $smallLetter.addClass("good").removeClass("wrong");
            }
        }

        if(e.type == "blur") {
            $passwordAlert.hide();
        }
    });
});