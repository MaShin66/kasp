function f_preview_image_selected2(e, obj_id, obj_name) {
    var files = e.target.files;
    var filesArr = Array.prototype.slice.call(files);
    var obj_t = obj_name+obj_id;

    filesArr.forEach(function(f) {
        if(!f.type.match("image.*")) {
            alert("확장자는 이미지 확장자만 가능합니다.");
            return;
        }

        if(f.size>12000000) {
            alert("이미지는 10메가 이하만 가능합니다.");
            return;
        }

        var reader = new FileReader();
        reader.onload = function(e) {
            $("#"+obj_t+"_box").css('border', 'none');
            $("#"+obj_t+"_box").html('<img src="'+e.target.result+'" class="rounded-circle" onerror="this.src=\'../images/noimg.png\'" />');
            $("#"+obj_t+"_del").show();
        }
        reader.readAsDataURL(f);
    });
}
function f_preview_image_delete(obj_id, obj_name, obj_image) {
    var obj_t = obj_name+obj_id;

    if(obj_t) {
        $('#'+obj_t).val('');
        $('#'+obj_t+'_on').val('');
        $('#'+obj_t+'_del').hide();
        $('input[name='+obj_t+'_del]').val(obj_image)
        $('#'+obj_t+'_box').css('border', '1px dashed #ddd');
        $('#'+obj_t+'_box').html('<i class="mdi mdi-plus"></i>');
    }
}

var ycommon = (function(ycommon, $, window) {

    //채팅 목록 오픈
    ycommon.openChat = function(url, name, width, height) {
        var filterBool = false;
        var filter = "win16|win32|win64|mac|macintel";
        if (navigator.platform && ycommon.getCookie('app') != '1') {
            if (filter.indexOf(navigator.platform.toLowerCase()) >= 0) {
                filterBool = true;
            }
        }
        if (filterBool) {
            var screenWidth = screen.availWidth;
            var screenHeight = screen.availHeight;
            if (screenWidth < width) {
                width = screenWidth;
            } else if (screenWidth / 3 > width) {
                width = screenWidth / 3;
            }
            height = screenHeight;
        }
        var chatWindow = ycommon.winOpen(url,name,'width='+width+',height='+height+',scrollbars=1');
        if (filterBool) chatWindow.moveTo(0,0);
    }

    //앞에 0채움
    ycommon.isMobile = function() {
        var UserAgent = navigator.userAgent;
        if (UserAgent.match(/iPhone|iPod|Android|Windows CE|BlackBerry|Symbian|Windows Phone|webOS|Opera Mini|Opera Mobi|POLARIS|IEMobile|lgtelecom|nokia|SonyEricsson/i) != null || UserAgent.match(/LG|SAMSUNG|Samsung/) != null) {
            return true;
        } else {
            return false;
        }
    };

    // URL 에서 파라미터를 가져온다
    ycommon.getUrlParams = function() {
        return ycommon.getParams(window.location.search);
    };

    ycommon.getParams = function(text) {
        var params = {};
        text.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(str, key, value) { params[key] = value; });
        return params;
    }

    ycommon.setCookie = function(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    };

    ycommon.getCookie = function(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    };

    ycommon.deleteCookie = function(cname) {
        var expireDate = new Date();
        expireDate.setDate( expireDate.getDate() - 1 );
        document.cookie = cname + "= " + "; expires=" + expireDate.toGMTString() + "; path=/";
    }

    ycommon.getSegment = function(idx) {
        var site_domain_location = document.location.pathname;
        var se = site_domain_location.split("/");
        if (idx === undefined) return se;
        else se[idx];
    }

    //날자 선택시 트리거로 요일찾아서 넣어준다.
    ycommon.dayCall = function(id) {
        var sDate = $("#"+id).val();

        var yy = parseInt(sDate.substr(0, 4), 10);
        var mm = parseInt(sDate.substr(5, 2), 10);
        var dd = parseInt(sDate.substr(8), 10);

        var d = new Date(yy,mm - 1, dd);
        var weekday=new Array(7);
        weekday[0]="일";
        weekday[1]="월";
        weekday[2]="화";
        weekday[3]="수";
        weekday[4]="목";
        weekday[5]="금";
        weekday[6]="토";

        $("#"+id).parent().find('.dayCall').text( weekday[d.getDay()] );
    };

    ycommon.setDatepicker = function() {
        var dates = $('.cal').datepicker({
            onSelect: function( selectedDate ) {
                var trigger = $(this).attr('trigger');
                var f = eval;

                if (this.id.indexOf('from') !== -1  ||  this.id.indexOf('to') !== -1) {
                    var option = this.id.indexOf('from') !== -1 ? "from" : "to";
                    var instance = $( this ).data( "datepicker" );
                    var date = $.datepicker.parseDate( instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings );
                    var target = '';
                    //프롬이 포함되어있으면..
                    if (option == "from") {
                        target = "#" + this.id.replace('from', 'to');
                    } else {
                        target = "#" + this.id.replace('to', 'from');
                    }
                    var targetDate = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, $(target).val(), instance.settings);
                    if (targetDate != null) {
                        if (option == "from") {
                            //to보다 뒤에 날자를 선택한거라면 to의 값을 비움.
                            if (date > targetDate) $(target).val("");
                        } else {
                            //form보다 이전 날자를 선택한거라면 from값을 비움.
                            if (date < targetDate) $(target).val("");
                        }
                    }
                }
                if(trigger != undefined) {
                    f(trigger);
                }
                $(this).change();
            },
            changeMonth:true,
            changeYear:true,
            dateFormat:"yy-mm-dd",
            dayNames : ['일요일','월요일','화요일','수요일','목요일','금요일','토요일'],
            dayNamesMin : ['일','월','화','수','목','금','토'],
            monthNamesShort:  [ "1월", "2월", "3월", "4월", "5월", "6월","7월", "8월", "9월", "10월", "11월", "12월" ]
        });
    }

    ycommon.setDatepicker2 = function() {
        var dates = $('.cal').datetimepicker({
            onSelect: function(selectedDate) {
                var trigger = $(this).attr('trigger');
                var f = eval;

                if (this.id.indexOf('from') !== -1  ||  this.id.indexOf('to') !== -1) {
                    var option = this.id.indexOf('from') !== -1 ? "from" : "to";
                    var instance = $( this ).data( "datepicker" );
                    var date = $.datepicker.parseDateTime( instance.settings.dateFormat || $.datepicker._defaults.dateFormat, instance.settings.timeFormat, selectedDate, instance.settings );
                    var target = '';
                    //프롬이 포함되어있으면..
                    if (option == "from") {
                        target = "#" + this.id.replace('from', 'to');
                    } else {
                        target = "#" + this.id.replace('to', 'from');
                    }
                    var targetDate = $.datepicker.parseDateTime(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, instance.settings.timeFormat, $(target).val(), instance.settings);

                    if (targetDate != null) {
                        if (option == "from") {
                            //to보다 뒤에 날자를 선택한거라면 to의 값을 비움.
                            if (date > targetDate) $(target).val("");
                        } else {
                            //form보다 이전 날자를 선택한거라면 from값을 비움.
                            if (date < targetDate) $(target).val("");
                        }
                    }
                }

                if ($(this).is('.chkNow')) {
                    try {
                        var dt = selectedDate.split(" ");
                        var dArr = dt[0].split("-");
                        var tArr = dt[1].split(":");
                        var selDateObj = new Date(parseInt(dArr[0]),parseInt(dArr[1])-1,parseInt(dArr[2]),parseInt(tArr[0]),parseInt(tArr[1]),0);
                        var nowDateObj = new Date();
                        if (selDateObj < nowDateObj) {
                            alert("시작 시간을 현재 시간 이전으로 설정 할 수 없습니다");
                        }
                    } catch (e) {
                        console.log(e);
                    }
                }

                if (trigger != undefined) {
                    f(trigger);
                }
                $(this).change();
            },
            changeMonth:true,
            changeYear:true,
            dateFormat:"yy-mm-dd",
            dayNames : ['일요일','월요일','화요일','수요일','목요일','금요일','토요일'],
            dayNamesMin : ['일','월','화','수','목','금','토'],
            monthNamesShort:  [ "1월", "2월", "3월", "4월", "5월", "6월","7월", "8월", "9월", "10월", "11월", "12월" ],
            // timepicker 설정
            timeFormat:'HH:mm',
            controlType:'select',
            oneLine:true,
        }).on('change',function(e){
            var selectedDate = $(this).val();
            //현재 시간 비교 클래스가 있으면..
            if ($(this).hasClass('chkNow')) {
                try {
                    var dt = selectedDate.split(" ");
                    var dArr = dt[0].split("-");
                    var tArr = dt[1].split(":");
                    var selDateObj = new Date(parseInt(dArr[0]),parseInt(dArr[1])-1,parseInt(dArr[2]),parseInt(tArr[0]),parseInt(tArr[1]),0);
                    var nowDateObj = new Date();
                    if (selDateObj < nowDateObj) {
                        var setNowDate = ycommon.getTimeStamp(nowDateObj, "Y-m-d H:i");
                        $(this).val(setNowDate);
                    }
                } catch (e) {
                    console.log(e);
                    $(this).val('');
                }
            }
        });
    }

    ycommon.getTimeStamp = function(dateObj, format) {
        if (format === undefined) format = "Y-m-d H:i:s"
        var y = ycommon.leadingZeros(dateObj.getFullYear(), 4);
        var m = ycommon.leadingZeros(dateObj.getMonth() + 1, 2);
        var d = ycommon.leadingZeros(dateObj.getDate(), 2);
        var h = ycommon.leadingZeros(dateObj.getHours(), 2);
        var i = ycommon.leadingZeros(dateObj.getMinutes(), 2);
        var s = ycommon.leadingZeros(dateObj.getSeconds(), 2);
        format = format.replace(/Y/g, y);
        format = format.replace(/m/g, m);
        format = format.replace(/d/g, d);
        format = format.replace(/H/g, h);
        format = format.replace(/i/g, i);
        format = format.replace(/s/g, s);
        return format;
    }

    ycommon.checkDateTime = function(value) {
        var pattern = /^(19|20)\d{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[0-1]) (0[0-9]|1[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/;
        return pattern.test(value);
    }

    ycommon.delConfirm = function(link) {
        if (confirm("삭제 하시겠습니까?")) {
            ycommon.goLink(link);
        }
    }

    ycommon.goLink = function(link){
        document.location.href=link;
    }

    //팝업 창
    ycommon.winOpen = function(url, name, option) {
        var popup = window.open(url, name, option);
        popup.focus();
        return popup;
    }

    ycommon.checkKey = function(e) {
        var keycode = '';
        if(window.event) keycode = window.event.keyCode;
        else if(e) keycode = e.which;
        else {
            event.returnValue = false;
            return false;
        }
        //48~57 키패드위 숫자키, 96~106 숫자패드 숫자키, 8 백스페이스, 46 delete키, 9 탭, 새로고침 116, 37 arrow left, 39 arrow right, 13 enter
        //17 ctrl,67 c, 86 v, 65 a
        // 109 오른쪽 -, 189 중간 -
        if ((keycode >= 48 && keycode <= 57) || (keycode >= 96 && keycode <= 106) || keycode == 8 || keycode == 46 || keycode == 9
            || keycode == 116 || keycode == 37 || keycode == 39 || keycode == 13 || keycode == 17 || keycode == 67 || keycode == 86 || keycode == 65
            || keycode == 109 || keycode == 189
        ) {
            event.returnValue = true;
        } else {
            event.returnValue = false;
        }
    }

    ycommon.replaceNumber = function(obj){
        obj.val(obj.val().replace(/[^0-9]/g,''));
    }

    ycommon.replaceInt = function(obj){
        obj.val(obj.val().replace(/[^0-9-]/g,''));
    }

    //1원 단위 반올림하여 10원 단위로 표현
    ycommon.setTenRound = function(pri) {
        pri = Math.round(Number(pri)/10) * 10;
        return pri;
    }

    // 지정된 자리 - 1 올림 처리(지정된 자리 이하 0)
    ycommon.calCeil = function(x, y) {
        return Math.ceil (x / y) * y;
    }

    // 지정된 자리 - 1 내림 처리(지정된 자리 이하 0)
    ycommon.calFloor = function(x, y) {
        return Math.floor (x / y) * y;
    }

    //천자리마다 콤마
    ycommon.setPriceInput = function(str) {
        if (typeof str !== 'string') str = str.toString();
        str = str.replace(/,/g,'');
        var negativeNumber = false;
        if (str.indexOf('-') !== -1) negativeNumber = true;
        str = str.replace(/-/g,'');
        if (str.replace(/^0*/, '') != '') str = str.replace(/^0*/, '');
        else str = "0";
        var retValue = "";
        for(i=1; i<=str.length; i++)
        {
            if (i > 1 && (i%3)==1)
                retValue = str.charAt(str.length - i) + "," + retValue;
            else
                retValue = str.charAt(str.length - i) + retValue;
        }
        if (negativeNumber) retValue = "-" + retValue;
        return retValue;
    }

    //천자리 마다 ,찍은거 중에 ,를 제거하고 타입을 number로 형변환 하여 넘긴다.
    ycommon.getPriceNumber = function(str) {
        //str이 정의되지 않으면 0을 반환한다.
        if (str === undefined) return 0;

        str = str.replace(/,/g,'');

        if (isNaN(Number(str))){
            return 0;
        } else {
            return Number(str);
        }
    }

    // Y-m-d 형태로 포매팅된 날짜 반환
    ycommon.formatStandardYmd = function(date) {
        var yyyy = date.getFullYear().toString();
        var mm = (date.getMonth() + 1).toString();
        var dd = date.getDate().toString();
        return yyyy + "-" + (mm[1] ? mm : '0'+mm[0]) + "-" + (dd[1] ? dd : '0'+dd[0]);
    }

    // Y년 m월 d일 형태로 포매팅된 날짜 반환
    ycommon.formatStandardYmd2 = function(date) {
        var yyyy = date.getFullYear().toString();
        var mm = (date.getMonth() + 1).toString();
        var dd = date.getDate().toString();
        return yyyy + "년 " + (mm[1] ? mm : '0'+mm[0]) + "월 " + (dd[1] ? dd : '0'+dd[0]) + "일";
    }

    //문자의 바이트를 계산하여 리턴한다.
    ycommon.getByte = function(str) {
        var strByte = 0;
        for(var i =0; i < str.length; i++) {
            var currentByte = str.charCodeAt(i);
            if(currentByte > 128) strByte += 2;
            else strByte++;
        }
        return strByte;
    }

    //글자를 앞에서부터 원하는 바이트만큼 잘라 리턴. 한글의 경우 2바이트로 계산하며, 글자 중간에서 잘리지 않는다.
    ycommon.cutByte = function(str,len) {
        var count = 0;
        for(var i = 0; i < str.length; i++) {
            if(escape(str.charAt(i)).length >= 4) count += 2;
            else if(escape(str.charAt(i)) != "%0D") count++;
            if(count >  len) {
                if(escape(str.charAt(i)) == "%0A") i--;
                break;
            }
        }
        return str.substring(0, i);
    }

    //휴대폰번호 체크
    ycommon.checkHpNum = function(hp) {
        var regExp = /^\d{3}-\d{3,4}-\d{4}$/;
        return regExp.test(hp.toString());
    }

    //자동하이픈
    ycommon.autoHypenPhone = function(str) {
        str = str.replace(/[^0-9]/g, '');
        var tmp = '';
        if (str.length < 4) {
            return str;
        } else if(str.length < 7) {
            tmp += str.substr(0, 3);
            tmp += '-';
            tmp += str.substr(3);
            return tmp;
        } else if(str.length < 11) {
            tmp += str.substr(0, 3);
            tmp += '-';
            tmp += str.substr(3, 3);
            tmp += '-';
            tmp += str.substr(6);
            return tmp;
        } else {
            tmp += str.substr(0, 3);
            tmp += '-';
            tmp += str.substr(3, 4);
            tmp += '-';
            tmp += str.substr(7);
            return tmp;
        }
        return str;
    }

    ycommon.alertMsg = function(msg) {
        alert(msg);
        // $(".designAlert .msg").html(msg.replace(/\n/g, "<br />"));
        // $(".designAlert").fadeIn().delay(3000).fadeOut();
        // $(".designAlert").show(0).delay(7000).hide(0);
    }

    /**
     * ajax json
     * @param action string url
     * @param data array
     * @param $el 엘리먼트 (jquery element obj)
     * @param successFn success callback
     * @param loading 엘리먼트 (jquery element obj)
     * @param errorFn error callback
     * @param timeout micro second
     * @param async bool //비동기여부 true 비동기, false 동기
     * @param etcConf object //기타콘피그
     */
    ycommon.ajaxJson = function(action,data,$el,successFn,loading,errorFn,timeout,async,etcConf) {
        if ( loading !== undefined ) {
            if ( loading == 1 ) {
                $(".loading").show();
            } else {
                loading.show();
            }
        }

        var ajaxTimeOut = 5000;
        if ( timeout !== undefined ) {
            ajaxTimeOut = timeout;
        }

        var asyncBool = true;
        if (async !== undefined) {
            asyncBool = async;
        }

        var setting = {
            url : action,
            type : 'post',
            async: asyncBool,
            timeout : ajaxTimeOut,
            dataType : 'json',
            data : data,
            success : function(returnData){
                if ( loading !== undefined ) {
                    if ( loading == 1 ) {
                        $(".loading").fadeOut();
                    } else {
                        loading.fadeOut();
                    }
                }
                //만약 메세지가 정의되었으면..
                if ( returnData.msg !== undefined && data.debug_jwt === undefined && action.indexOf('/api/') === -1 ) {
                    // ycommon.alertMsg(returnData.msg);
                    jalert_url(returnData.msg, 'none', '');
                }

                //만약 리턴된 html이 정의되었으면..
                if ( returnData.returnHtml !== undefined ) {
                    $el.html(returnData.returnHtml);
                }

                //만약 타입이 함수면...
                if ( typeof ( successFn ) == "function" ){
                    successFn(returnData);
                }
            },
            error : function(jqXHR, textStatus, errorThrown){
                if ( loading !== undefined ) {
                    if ( loading == 1 ) {
                        $(".loading").fadeOut();
                    } else {
                        loading.fadeOut();
                    }
                }
                if ( typeof ( errorFn ) == "function" ){
                    errorFn(jqXHR, textStatus, errorThrown);
                } else {
                    ycommon.alertMsg( ycommon.ajaxJsonError(jqXHR, textStatus, errorThrown) );
                }
            }
        };

        //기타 콘피가 있으면 for in문을 통해 세팅한다.
        if (etcConf !== undefined) {
            for (var key in etcConf) {
                setting[key] = etcConf[key];
            }
        }

        return $.ajax(setting);
    }

    ycommon.ajaxJsonError = function(jqXHR, textStatus, errorThrown) {
        var err_msg = '';
        if (jqXHR.status === 0) {
            err_msg = '네트워크가 오프라인입니다.\n네트워크를 확인하시기 바랍니다.';
        } else if (jqXHR.status == 404) {
            err_msg = '요청 된 페이지를 찾을 수 없습니다. [404]';
        } else if (jqXHR.status == 500) {
            err_msg = '내부 서버 오류. [500]';
        } else if (textStatus === 'parsererror') {
            err_msg = '요청 된 JSON 구문 분석에 실패했습니다.';
        } else if (textStatus === 'timeout') {
            err_msg = '시간 초과 오류가 발생했습니다.';
        } else if (textStatus === 'abort') {
            err_msg = 'Ajax 요청이 중단되었습니다.';
        } else {
            err_msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        return err_msg;
    }

    ycommon.ajaxTask = function(tasks) {
        var defer = new $.Deferred();
        var next = defer;
        $.each(tasks, function(k,v) {
            if (k == 0) {
                next = v;
            } else {
                next  = next.then(function(){
                    return v;
                });
            }
        });
        return next;
    }

    //시간을 체크 00:00~ 23:59
    ycommon.validTimeCheck = function(time) {
        var bool = false;
        if (/(2[0-3]|[01][0-9]):([0-5][0-9])/.test(time)) {
            bool = true;
        }
        return bool;
    }

    //자바스크립트 Date객체 Y-m-d로 변환
    ycommon.formatDate = function(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year, month, day].join('-');
    }

    //자바스크립트 time객체를 H:i로 변환
    ycommon.formatTime = function(date) {
        var d = new Date(date),
            H = '' + d.getHours(),
            i = '' + d.getMinutes();
        if (H.length < 2) H = '0' + H;
        if (i.length < 2) i = '0' + i;
        return [H, i].join(':');
    }

    //앞에 0채움
    ycommon.leadingZeros = function(n, digits) {
        var zero = '';
        n = n.toString();

        if (n.length < digits) {
            for (i = 0; i < digits - n.length; i++)
                zero += '0';
        }
        return zero + n;
    }

    ycommon.copyToClipboard = function(str, f='') {
        // var input = document.querySelector('input');
        try {
            // var tempElem = document.createElement('textarea');
            // tempElem.value = str;
            // document.body.appendChild(tempElem);
            //
            // tempElem.select();
            // // textarea.setSelectionRange(0, 9999);
            // var returnValue = document.execCommand("copy");
            // document.body.removeChild(tempElem);
            // console.debug(returnValue);
            // if (!returnValue) {
            //     throw new Error('copied nothing');
            // }
            // alert('복사 되었습니다.');

            navigator.clipboard.writeText(str).then(() => {
                alert('복사 되었습니다.');
                if ( typeof ( f ) == "function" ){
                    f();
                }
            });
        } catch (e) {
            prompt('Copy to clipboard: Ctrl+C, Enter', str);
        }
    }

    ycommon.chosung = function(str) {
        var res = "", // 초성으로 변환
            choArr = ["ㄱ","ㄲ","ㄴ","ㄷ","ㄸ","ㄹ","ㅁ","ㅂ","ㅃ","ㅅ","ㅆ","ㅇ","ㅈ","ㅉ","ㅊ","ㅋ","ㅌ","ㅍ","ㅎ"];
        for (var i in str) {
            code = Math.floor((str[i].charCodeAt() - 44032) / 588)
            res += code >= 0 ? choArr[code] : str[i];
        }
        return res;
    }

    ycommon.jwtDecode = function (token) {
        var base64Url = token.split('.')[1];
        var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));

        return JSON.parse(jsonPayload);
    };

    ycommon.jwtEncode = function (data,secret) {
        var header = {
            "alg": "HS256",
            "typ": "JWT"
        };

        var stringifiedHeader = CryptoJS.enc.Utf8.parse(JSON.stringify(header));
        var encodedHeader = ycommon.base64url(stringifiedHeader);

        var stringifiedData = CryptoJS.enc.Utf8.parse(JSON.stringify(data));
        var encodedData = ycommon.base64url(stringifiedData);

        var token = encodedHeader + "." + encodedData;

        var signature = CryptoJS.HmacSHA256(token, secret);
        signature = ycommon.base64url(signature);

        var signedToken = token + "." + signature;
        return signedToken;
    }

    // Jwt_Encode_Decode.php
    ycommon.base64url = function(source) {
        // Encode in classical base64
        var encodedSource = CryptoJS.enc.Base64.stringify(source);

        // Remove padding equal characters
        encodedSource = encodedSource.replace(/=+$/, '');

        // Replace characters according to base64url specifications
        encodedSource = encodedSource.replace(/\+/g, '-');
        encodedSource = encodedSource.replace(/\//g, '_');

        return encodedSource;
    }

    ycommon.openModal = function (url, params) {
        if (url === undefined) url = "";
        if (params === undefined) params = {};
        // $('#modal-default').modal('hide');
        $.post(url, params, function (data) {
            if(data) {
                $('#modal-default-content').html(data);
                $('#modal-default').modal();
            }
        });
    }

    ycommon.financial = function(x) {
        return Number.parseFloat(x).toFixed(2);
    }

    ycommon.replaceFloat = function (val) {
        val = val + "";
        var a = val.split('.')
        if (a.length == 1) {
            return ycommon.setPriceInput(val);
        } else {
            return ycommon.setPriceInput(a[0]) + '.' + a[1];
        }
    }

    ycommon.getDigit = function(num) {
        num = num.toString();
        var i=0;
        while(num[i]) { i++; };
        return i;
    }

    /**
     * cut_num_to_korean와 대응되는 js 메소드
     * @param num
     * @param decplace
     * @returns {[number,string,number]}
     */
    ycommon.numberToKorean = function (num, decplace=0) {
        var unitWords = ['', '만', '억', '조', '경'];
        var absNum = Math.abs(num);
        var length = ycommon.getDigit(absNum)-1;
        // console.log(num, length)
        var unitIdx = ((length - (length % 4)) / 4);
        var unit = unitWords[unitIdx];
        var unitLeng = 1;
        for (var i=0; i<unitIdx; i++) {
            unitLeng *= 10000;
        }
        // console.log('unitLeng', unitLeng)
        // console.log('unitIdx', unitIdx)
        // console.log('/', absNum / unitLeng)
        var r = Math.floor(absNum / unitLeng);
        if (unitIdx > 2) {
            r = Math.floor(absNum / unitLeng * 10) / 10;
        }
        if (decplace > 0) {
            var place = 1;
            for (var j=0; j<decplace; j++) {
                place *= 10;
            }
            r = Math.floor(absNum / unitLeng * place) / place;
        }
        if (num < 0) r *= -1;
        return [r,unit,unitIdx];
    }

    ycommon.cutNumberToKorean = function (num, unitIdx) {
        var absNum = Math.abs(num);
        var unitLeng = 1;
        for (var i=0; i<unitIdx; i++) {
            unitLeng *= 10000;
        }
        var r = Math.floor(absNum / unitLeng * 10) / 10;
        if (num < 0) r *= -1;
        return r;
    }

    $(document).ready(function() {
        //복사 버튼 클릭시 복사
        $(document).on('click','button.clip',function(e){
            $("body").append("<input type=\"text\" id=\"clipIpt\" value=\"\" />");

            var clip = $(this).data('clip');
            $('#clipIpt').val(clip);

            var inputClip = document.getElementById("clipIpt");
            inputClip.select();
            try {
                var successful = document.execCommand('copy');
                if (!successful) {
                    alert('이 브라우저는 지원하지 않습니다.');
                }
            } catch (err) {
                alert('이 브라우저는 지원하지 않습니다.');
            }
            $('#clipIpt').remove();

            // alert(clip)
            $('button.clip').each(function(i,ee){
                if ($(ee).hasClass('bg_YE')) {
                    $(ee).removeClass('bg_YE').addClass('bg_F9');
                }
                // $(ee).hasClass('bg_F9').removeClass('bg_F9').addClass('bg_Rt');
            });
            $(this).removeClass('bg_ER').removeClass('bg_F9').addClass('bg_YE');
            e.preventDefault();
            return false;
        });

        //정수만
        $(document).on('keyup','.onlyint',function(e){
            ycommon.checkKey(e);
            ycommon.replaceInt($(this));
        });

        //숫자만..
        $(document).on('keyup','.onlynum',function(e){
            ycommon.checkKey(e);
            ycommon.replaceNumber($(this));
        });


        //숫자만 + 넘버포멧
        $(document).on('keydown keyup','.numformat2',function(e){
            if(window.event) keycode = window.event.keyCode;
            else if(e) keycode = e.which;
            else {
                event.returnValue = false;
                return false;
            }
            if( e.type == 'keydown'){
                ycommon.checkKey(e);
            }
            if( e.type == 'keyup'){
                ycommon.replaceNumber($(this));
                $(this).val( ycommon.setPriceInput($(this).val()) );
                if(keycode == 9) {
                    $(this).select();
                }
            }
        });

        //정수만 + 넘버포멧
        $(document).on('keydown keyup','.numformat',function(e){
            if(window.event) keycode = window.event.keyCode;
            else if(e) keycode = e.which;
            else {
                event.returnValue = false;
                return false;
            }
            if( e.type == 'keydown'){
                ycommon.checkKey(e);
            }
            if( e.type == 'keyup'){
                ycommon.replaceInt($(this));
                $(this).val( ycommon.setPriceInput($(this).val()) );
                if(keycode == 9) {
                    $(this).select();
                }
            }
        });

        //휴대폰번호
        $(document).on('keydown keyup','.phoneHypen',function(e){
            var limitByte = 13;
            var keycode   = '';
            if(window.event) keycode = window.event.keyCode;
            else if(e) keycode = e.which;
            else {
                event.returnValue = false;
                return false;
            }
            if( e.type == 'keydown'){
                ycommon.checkKey(e);
            }
            if( e.type == 'keyup'){
                var str = $(this).val();
                if (str.length > 13) $(this).val(cutByte(str,limitByte));
                str = $(this).val();
                $(this).val(ycommon.autoHypenPhone(str));
                if(keycode == 9) {
                    $(this).select();
                }
            }
        });

        //기업코드검색
        $(document).on('click', '#ct_code_search', function(){
            var ct_name = $('#ct_name').val();
            ct_name = ct_name.trim();
            if (ct_name == "") {
                jalert_url('기업명을 입력해주세요.','none','기업선택검색');
                return false;
            }

            var modal_body = "";
            $('#ct_idx option').each(function(){
                var txt = $(this).text();
                if (txt.indexOf(ct_name) !== -1) {
                    modal_body += '<div class="form-group row">\
                                                <label class="col-sm-2 col-form-label text-center">기업명</label>\
                                            <div class="col-sm-6 col-form-text">\
                                                '+txt+'\
                                            </div>\
                                            <div class="col-sm-4">\
                                                <input type="button" class="btn btn-info select_customer22_btn" data-value="'+txt+'" data-key="'+this.value+'" value="선택">\
                                            </div>\
                                        </div>';
                }
            });

            var html = '<div class="modal-header">\
                                        <h5 class="modal-title" id="staticBackdropLabel">등록된 기업 검색</h5>\
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>\
                                    </button>\
                                </div>\
                                    <div class="modal-body company_form">\
                                        {modal_body}\
                                    </div>';

            html = html.replace(/{modal_body}/gi, modal_body);

            $('#modal-default-content').html(html);
            $('#modal-default').modal();

        });

        $(document).on('click', '.select_customer22_btn', function(){
            var value = $(this).data('value');
            var key = $(this).data('key');

            // $('#ct_code').val(ts_isin).attr('readonly','readonly');
            // $('#ct_name').val(ts_com_name).attr('readonly','readonly');
            // console.log(key,value)
            $('#ct_idx').val(key);
            $('#modal-default').modal('hide');
        });

        $(document).on('click', '.company_add', function(){
            window.open('/mng/company_form.php?act=input')
        });

        $(document).on('keyup','#ct_name',function (){
            if (event.keyCode === 13) {
                $('#ct_code_search').trigger('click');
            };
        });

        var order_cr_date_click_cnt = 0;
        $(document).on('click','#order_cr_date',function (e) {
            var param = ycommon.getUrlParams();
            var order_column = param.order_column;
            var order_type = param.order_type;
            if (order_column == 'cr_date' && order_type == 'asc') {
                order_cr_date_click_cnt = 1;
            } else if (order_column == 'cr_date' && order_type == 'desc') {
                order_cr_date_click_cnt = 2;
            } else {
                order_cr_date_click_cnt = 0;
            }
            var f = $('input[name=order_column]').parents('form');
            if (order_cr_date_click_cnt === 0) {
                $('input[name=order_column]').val("cr_date");
                $('input[name=order_type]').val("asc");
            } else if (order_cr_date_click_cnt === 1) {
                $('input[name=order_column]').val("cr_date");
                $('input[name=order_type]').val("desc");
            } else {
                $('input[name=order_column]').val("");
                $('input[name=order_type]').val("");
            }

            f.submit();
            e.preventDefault();
            return false;
        });

        var order_ct_name_click_cnt = 0;
        $(document).on('click','#order_ct_name',function (e) {
            var param = ycommon.getUrlParams();
            var order_column = param.order_column;
            var order_type = param.order_type;
            if (order_column == 'ct_name' && order_type == 'asc') {
                order_ct_name_click_cnt = 1;
            } else if (order_column == 'ct_name' && order_type == 'desc') {
                order_ct_name_click_cnt = 2;
            } else {
                order_ct_name_click_cnt = 0;
            }
            var f = $('input[name=order_column]').parents('form');
            if (order_ct_name_click_cnt === 0) {
                $('input[name=order_column]').val("ct_name");
                $('input[name=order_type]').val("asc");
            } else if (order_ct_name_click_cnt === 1) {
                $('input[name=order_column]').val("ct_name");
                $('input[name=order_type]').val("desc");
            } else {
                $('input[name=order_column]').val("");
                $('input[name=order_type]').val("");
            }

            f.submit();
            e.preventDefault();
            return false;
        });

    });

    return ycommon;
})(window.ycommon || {}, window.jQuery || $, window)
