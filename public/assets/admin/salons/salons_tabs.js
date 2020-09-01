function set_query_para($key,$data)
{
  	var url_string = window.location.protocol+"://"+window.location.hostname+window.location.port+window.location.pathname;
  	var url_string = "";
  	var search = ltrim(window.location.search,"?")
  	var search_join = [];
  	var $target_found = false;
  	search_split = search.split("&");
	if(search!="")
	{
	  	$.each(search_split,function($index,$value)
	  	{
		  	$value_split = $value.split("=");
		  	if($value_split.length=2)
		  	{
				if($value_split[0]==$key)
				{
				  	$value_split[1] = $data
				  	$target_found = true;
				}
		  	}

		  	$value_join = $value_split.join("=");

		  	search_join.push($value_join);
	  });
	}

	if($target_found==false)
	{
	  search_join.push($key+"="+$data)
	}

	url_string  +=("?"+(search_join.join("&")));

	history.pushState(null,null,url_string);
}

function ltrim(str, characters) {
	var nativeTrimLeft = String.prototype.trimLeft;
	str = makeString(str);
	if (!characters && nativeTrimLeft) return nativeTrimLeft.call(str);
	characters = defaultToWhiteSpace(characters);
	return str.replace(new RegExp('^' + characters + '+'), '');
}

function makeString(object)
{
	if (object == null) return '';
	return String(object);
}

function defaultToWhiteSpace(characters) {
	if (characters == null)
	return '\\s';
	else if (characters.source)
	return characters.source;
	else
	return '[' + escapeRegExp(characters) + ']';
}
function escapeRegExp(str) {
	return makeString(str).replace(/([.*+?^=!:${}()|[\]\/\\])/g, '\\$1');
}
$('document').ready(function (){

    // $('ul.nav-tabs.main a[data-toggle="tab"]').click(function(){
    $('ul.nav a[data-toggle="tab"]').click(function(){

            var tab_id = $(this).attr('href');
            tab_id = tab_id.replace('#', '');
            set_query_para('active_tab', tab_id);
            var get_params = ltrim(window.location.search,"?")
            /*let generate_href = $("a.generate-pdf").attr('href');
            var query_para_index = generate_href.indexOf('?');
            var till_index = query_para_index >= 0 ? query_para_index : generate_href.length;
            //alert("href: "+generate_href+" query_para_index: "+query_para_index+" till_index: "+till_index);
            $(".generate-pdf").attr('href', generate_href.substr(0, till_index)+"?"+get_params);
            if(tab_id=='step2')
            {
                set_query_para('sub_active_tab', 'step2_1');
                $(".generate-pdf href").append(set_query_para('sub_active_tab', 'step2_1'));
                $('.step2_1').addClass('active');
                $('#step2_1').addClass('active');
                $('.step2_2').removeClass('active');
                $('.step2_3').removeClass('active');
                $('.step2_4').removeClass('active');
                $('.step2_5').removeClass('active');
                $('#step2_2').removeClass('active');
                $('#step2_3').removeClass('active');
                $('#step2_4').removeClass('active');
                $('#step2_5').removeClass('active');
            }*/
    });
    /*$('ul.nav-tabs.sub a[data-toggle="tab"]').click(function(){
            var tab_id = $(this).attr('href');
            tab_id = tab_id.replace('#', '');
            // set_query_para('active_tab', tab_id);
            set_query_para('sub_active_tab', tab_id);
            var get_params = ltrim(window.location.search,"?")
            let generate_href = $("a.generate-pdf").attr('href');
            var query_para_index = generate_href.indexOf('?');
            var till_index = query_para_index >= 0 ? query_para_index : generate_href.length;
            $(".generate-pdf").attr('href', generate_href.substr(0, till_index)+"?"+get_params);
            $(".generate-pdf href").append(set_query_para('sub_active_tab', tab_id));
            $('.step2_1').removeClass('active');
            $('.step2_2').removeClass('active');
            $('.step2_3').removeClass('active');
            $('.step2_4').removeClass('active');
            $('.step2_5').removeClass('active');
            $('#step2_1').removeClass('active');
            $('#step2_2').removeClass('active');
            $('#step2_3').removeClass('active');
            $('#step2_4').removeClass('active');
            $('#step2_5').removeClass('active');
            $('.'+tab_id).addClass('active');
            $('#'+tab_id).addClass('active');
    });*/
});
