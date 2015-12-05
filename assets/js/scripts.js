var keys = new Object();

keys[81] = 'Й';
keys[87] = 'Ц';
keys[69] = 'У';
keys[82] = 'К';
keys[84] = 'Е';
keys[89] = 'Н';
keys[85] = 'Г';
keys[73] = 'Ш';
keys[79] = 'Щ';
keys[80] = 'З';
keys[219] = 'Х';
keys[221] = 'Ъ';
keys[65] = 'Ф';
keys[83] = 'Ы';
keys[68] = 'В';
keys[70] = 'А';
keys[71] = 'П';
keys[72] = 'Р';
keys[74] = 'О';
keys[75] = 'Л';
keys[76] = 'Д';
keys[186] = 'Ж';
keys[222] = 'Э';
keys[90] = 'Я';
keys[88] = 'Ч';
keys[67] = 'С';
keys[86] = 'М';
keys[66] = 'И';
keys[78] = 'Т';
keys[77] = 'Ь';
keys[188] = 'Б';
keys[190] = 'Ю';
keys[189] = '-';
keys[109] = '-';
keys[192] = 'Ё';
keys[32] = '';
keys[46] = 'DELETE';
keys[13] = 'ENTER';

$(document).ready(function() {
	$('#loginEmail').focus(function() {
        $('#register-info').html('Укажите рабочий Email адрес');
    });

	$('#loginLogin').focus(function() {
        $('#register-info').html('Разрешенные символы:<br>Буквы латинского алфавита, цыфры, тире "-", знак подчеркивания "_"<br>Длина:<br>От 6 до 15 символов');
    });

    $('#loginPassword').focus(function() {
    	$('#register-info').html('Разрешенные символы:<br>Буквы латинского алфавита, цыфры<br>Длина:<br>От 6 до 15 символов');
    });

    $('#loginRePassword').focus(function() {
    	$('#register-info').html('Повторите свой пароль');
    });

    $('#loginLogin').blur(function() {
        if($(this).val() != '') {
            var pattern = /^([a-z0-9_-]){6,15}$/i;
            if(pattern.test($(this).val())){
                $(this).css({'border' : '1px solid #569b44'});
                $('#validLogin').text('');
            } else {
                $(this).css({'border' : '1px solid #ff0000'});
                $('#validLogin').text('Не верно');
            }
        } else {
            $(this).css({'border' : '1px solid #ff0000'});
            $('#validLogin').text('Логин не должн быть пустым');
        }
        $('#register-info').html('Регистрация нового пользователя');
    });

    $('#loginEmail').blur(function() {
        if($(this).val() != '') {
            var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
            if(pattern.test($(this).val())){
                $(this).css({'border' : '1px solid #569b44'});
                $('#validEmail').text('');
            } else {
                $(this).css({'border' : '1px solid #ff0000'});
                $('#validEmail').text('Не верно');
            }
        } else {
            $(this).css({'border' : '1px solid #ff0000'});
            $('#validEmail').text('Поле email не должно быть пустым');
        }
        $('#register-info').html('Регистрация нового пользователя');
    });

    $('#loginPassword').blur(function() {
        if($(this).val() == '') {
            $(this).css({'border' : '1px solid #ff0000'});
            $('#validPassword').text('Пароль не должно быть пустым');
        } else {
            var pattern = /^([a-zA-Z0-9]){6,15}$/i;
            if(pattern.test($(this).val())){
                $(this).css({'border' : '1px solid #569b44'});
                $('#validPassword').text('');
            } else {
                $(this).css({'border' : '1px solid #ff0000'});
                $('#validPassword').text('Не верно');
            }
        }
        $('#register-info').html('Регистрация нового пользователя');
    });

    $('#loginRePassword').blur(function() {
        if($(this).val() == '') {
            $(this).css({'border' : '1px solid #ff0000'});
            $('#validPassword').text('Пароль не должно быть пустым');
        } else {
            var pass = $('#loginPassword').val();
            var repass = $(this).val();

            if(pass != repass) {
            	$(this).css({'border' : '1px solid #ff0000'});
            	$('#validRePassword').text('Пароли не совпадают');
            } else {
            	$(this).css({'border' : '1px solid #569b44'});
                $('#validRePassword').text('');
            }
        }
        $('#register-info').html('Регистрация нового пользователя');
    });

    
});

function addLetter(obj) {
    var letter = obj.innerText;

    if ((typeof letter) != 'string' || letter.length != 1) {
        letter = ' ';
    }

    letter = letter.toUpperCase();

    generateLetter(letter);
}

function generateLetter(letter) {
    var answer = document.getElementById('answer-group');
    var child = answer.children;

    if (child.length < 30) {
        var div = document.createElement('div');
        div.className = "letter answer";
        div.innerHTML = letter;
        div.setAttribute('onclick', 'deleteLetter(this)');
        answer.appendChild(div);
        if (child.length > 15) {
            $(answer).css('padding-top', '0');
        } else {
            $(answer).css('padding-top', '18px');
        }
    }
}

function deleteLetter(obj) {
    obj.remove();
}

function backspace() {
    var answer = document.getElementById('answer-group');
    var child = answer.children;

    if (child.length > 0) {
        answer.removeChild(child[child.length - 1]);
    }
    if (child.length > 15) {
        $(answer).css('padding-top', '0');
    } else {
        $(answer).css('padding-top', '18px');
    }
}

function test() {
    var question = document.getElementById('question-group');
    console.dir(question);
}

function sendWord(id) {
    var answer = document.getElementById('answer-group');
    var child = answer.children;
    var word = '';

    for (var i = 0; i < child.length; i++) {
        var letter = child[i].innerText.charAt(0);

        if ((typeof letter) != 'string' || letter.length != 1) {
            word += ' ';
        }
        word += child[i].innerText.charAt(0);
    }

    var div = document.createElement('div');
    div.id = 'info';
    div.innerHTML = 'Обработка...';
    answer.appendChild(div);

    $.ajax({
        type: "POST",
        url: "/game/answer/",
        data: "answer_id=" + id + "&answer=" + word,
        success: function(msg){
            var info = document.getElementById('info');
            info.remove();
            switch(msg) {
                case '1':
                    var div = document.createElement('div');
                    div.id = 'info';
                    div.innerHTML = 'Неверное слово';
                    answer.appendChild(div);
                    setTimeout (function() {
                        $('#info').fadeOut('slow');
                    }, 1000);
                    setTimeout (function() {
                        div.remove();
                    }, 1500);
                    break;

                case '2':
                    var div = document.createElement('div');
                    div.id = 'info';
                    div.innerHTML = 'Такое слово уже есть';
                    answer.appendChild(div);
                    setTimeout (function() {
                        $('#info').hide('slow');
                    }, 1000);
                    setTimeout (function() {
                        div.remove();
                    }, 1500);
                    break;

                case '3':
                    /*
                    var div = document.createElement('div');
                    div.id = 'info';
                    div.innerHTML = '<a href="/game/">Продолжить</a>';
                    answer.appendChild(div);
                    
                    document.getElementById('letters-group').remove();*/
                    document.location('/game/');
                    break;

                default:
                    var obj = jQuery.parseJSON(msg);
                    var question = document.getElementById('question-group');
                    var q_child = question.children;

                    while (q_child.length > 1) {
                        question.removeChild(question.lastChild);
                    }

                    for (var i = 0; i < obj.count; i++) {
                        var div = document.createElement('div');

                        if (isset(obj[i])) {
                            div.className = "alert alert-success button-answer";
                            div.innerHTML = obj[i];
                        } else {
                            div.className = "alert alert-danger button-answer";
                            div.innerHTML = i + 1;
                        }

                        question.appendChild(div);
                    }

                    $(answer).html('');
                    break
                }
            }
    });
}

function isset(obj) {
    return typeof obj != 'undefined';
}

function hotkey(event) {
    var id = event.keyCode;

    var str = location.href;
    var m = str.match(/http:\/\/[a-zA-Z0-9-\.]+\/game\/play\/[0-9]+/);

    if (m !== null) {
        if (isset(keys[id])) {
            switch (keys[id]) {
                case 'ENTER':
                    var spl = str.split('/');

                    if (str.charAt(str.length - 1) == '/') {
                        var q_id = spl[spl.length - 2];
                    } else {
                        var q_id = spl[spl.length - 1];
                    }
                    sendWord(q_id);
                    break;

                case 'DELETE':
                    backspace();
                    break;

                default:
                    generateLetter(keys[id]);
                    break;
            }
        }
    }
}