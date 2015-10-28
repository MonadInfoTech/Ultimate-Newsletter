UN = jQuery.noConflict();

UN(window).load(function() {
    UN("#unpageLoad").fadeOut(2e3);
});

UN(document).ready(function(e)
{
    /*Accordian*/
	UN("#un-accordion").accordion({
        collapsible:!0,
        active:!1,
        heightStyle:"content",
        event:"click",
        beforeActivate:function(s, i) {
            if (i.newHeader[0]) var e = i.newHeader, t = e.next(".ui-accordion-content"); else var e = i.oldHeader, t = e.next(".ui-accordion-content");
            var n = "true" == e.attr("aria-selected");
            return e.toggleClass("ui-corner-all", n).toggleClass("accordion-header-active ui-state-active ui-corner-top", !n).attr("aria-selected", (!n).toString()), 
            e.children(".ui-icon").toggleClass("ui-icon-triangle-1-e", n).toggleClass("ui-icon-triangle-1-s", !n), 
            t.toggleClass("accordion-content-active", !n), n ? t.slideUp() :t.slideDown(), !1;
        }
    });
	
	/*Subscriber form create on different event*/
	un_create_suscriber_form();
	
	UN('input[name="un_form_heading_text"], input[name="un_form_border_thickness"], input[name="un_form_height"], input[name="un_form_width"], input[name="un_form_heading_fontsize"], input[name="un_form_field_text"], input[name="un_form_field_fontsize"], input[name="un_form_button_text"], input[name="un_form_button_fontsize"]').on("keyup", un_create_suscriber_form);
	
	UN('input[name="un_form_border_color"], input[name="un_form_background"] ,input[name="un_form_heading_fontcolor"], input[name="un_form_field_fontcolor"] ,input[name="un_form_button_fontcolor"],input[name="un_form_button_background"]').on("focus", un_create_suscriber_form);
	
    UN("#un_form_heading_font, #un_form_heading_fontstyle, #un_form_heading_fontalign, #un_form_field_font, #un_form_field_fontstyle, #un_form_field_fontalign, #un_form_button_font, #un_form_button_fontstyle, #un_form_button_fontalign").on("change", un_create_suscriber_form );
	
	UN(".radio").live("click", function() {
        var s = UN(this).parent().find("input:radio:first");
		switch(s.attr("name")) {
			case 'un_form_adjustment':
				if(s.val() == 'no')
					s.parents(".row_tab").next(".row_tab").show("fast");
				else
					s.parents(".row_tab").next(".row_tab").hide("fast");
				un_create_suscriber_form()	
				break;
			case 'un_form_border':
				if(s.val() == 'yes')
					s.parents(".row_tab").next(".row_tab").show("fast");
				else
					s.parents(".row_tab").next(".row_tab").hide("fast");
				un_create_suscriber_form()
				break;
			default:
		}	
	});
	UN('#un_form_border_color').wpColorPicker({
		defaultColor: false,
		change: function(event, ui){un_create_suscriber_form()},
		clear: function() {un_create_suscriber_form()},
		hide: true,
		palettes: true
	}),
	UN('#un_form_background').wpColorPicker({
		defaultColor: false,
		change: function(event, ui){un_create_suscriber_form()},
		clear: function() {un_create_suscriber_form()},
		hide: true,
		palettes: true
	}),
	UN('#un_form_heading_fontcolor').wpColorPicker({
		defaultColor: false,
		change: function(event, ui){un_create_suscriber_form()},
		clear: function() {un_create_suscriber_form()},
		hide: true,
		palettes: true
	}),
	UN('#un_form_field_fontcolor').wpColorPicker({
		defaultColor: false,
		change: function(event, ui){un_create_suscriber_form()},
		clear: function() {un_create_suscriber_form()},
		hide: true,
		palettes: true
	}),
	UN('#un_form_button_fontcolor').wpColorPicker({
		defaultColor: false,
		change: function(event, ui){un_create_suscriber_form()},
		clear: function() {un_create_suscriber_form()},
		hide: true,
		palettes: true
	}),
	UN('#un_form_button_background').wpColorPicker({
		defaultColor: false,
		change: function(event, ui){un_create_suscriber_form()},
		clear: function() {un_create_suscriber_form()},
		hide: true,
		palettes: true
	});
	
	/*click bind for accordian collapse*/
	UN(".closeSec").live("click", function() {
		uncollapse(this);
	});
	
	/*Save section*/
	UN("#un_save1").live("click", function() {
		un_save1(this);
	});
	UN("#un_save2").live("click", function() {
		un_save2(this);
	});
});
/*Create subscription form*/
function un_create_suscriber_form()
{
	//Popbox customization
	"no" == UN('input[name="un_form_adjustment"]:checked').val() ? UN(".un_subscribe_Popinner").css({"width": parseInt(UN('input[name="un_form_width"]').val()),"height":parseInt(UN('input[name="un_form_height"]').val())}) : UN(".un_subscribe_Popinner").css({"width": '',"height": ''});
	
	"yes" == UN('input[name="un_form_adjustment"]:checked').val() ? UN(".un_html > .un_subscribe_Popinner").css({"width": "100%"}): '';
	
	"yes" == UN('input[name="un_form_border"]:checked').val() ? UN(".un_subscribe_Popinner").css({"border": UN('input[name="un_form_border_thickness"]').val()+"px solid "+UN('input[name="un_form_border_color"]').val()}) : UN(".un_subscribe_Popinner").css("border", "none");
	
	UN('input[name="un_form_background"]').val() != "" ? (UN(".un_subscribe_Popinner").css("background-color", UN('input[name="un_form_background"]').val())) : '';
	
	//Heading customization
	UN('input[name="un_form_heading_text"]').val() != "" ? (UN(".un_subscribe_Popinner > form > h5").html(UN('input[name="un_form_heading_text"]').val())) : UN(".un_subscribe_Popinner > form > h5").html('');
	
	UN('#un_form_heading_font').val() != "" ? (UN(".un_subscribe_Popinner > form > h5").css("font-family", UN("#un_form_heading_font").val())) : '';
	
	if(UN('#un_form_heading_fontstyle').val() != 'bold')
	{
		UN('#un_form_heading_fontstyle').val() != "" ? (UN(".un_subscribe_Popinner > form > h5").css("font-style", UN("#un_form_heading_fontstyle").val())) : '';
		UN(".un_subscribe_Popinner > form > h5").css("font-weight", '');
	}
	else
	{
		UN('#un_form_heading_fontstyle').val() != "" ? (UN(".un_subscribe_Popinner > form > h5").css("font-weight","bold")) : '';
		UN(".un_subscribe_Popinner > form > h5").css("font-style", '');
	}
	
	UN('input[name="un_form_heading_fontcolor"]').val() != "" ? (UN(".un_subscribe_Popinner > form > h5").css("color", UN('input[name="un_form_heading_fontcolor"]').val())) : '';
	
	UN('input[name="un_form_heading_fontsize"]').val() != "" ? (UN(".un_subscribe_Popinner > form > h5").css({"font-size": parseInt(UN('input[name="un_form_heading_fontsize"]').val())})) : '';
	
	UN('#un_form_heading_fontalign').val() != "" ? (UN(".un_subscribe_Popinner > form > h5").css("text-align", UN("#un_form_heading_fontalign").val())) : '';
	
	//Field customization
	UN('input[name="un_form_field_text"]').val() != "" ? (UN(".un_subscribe_Popinner").find('input[name="data[Widget][email]"]').attr("placeholder", UN('input[name="un_form_field_text"]').val())) : UN(".un_subscribe_Popinner").find('input[name="data[Widget][email]"]').attr("placeholder", '');
	
	UN('input[name="un_form_field_text"]').val() != "" ? (UN(".un_left_container > .un_subscribe_Popinner").find('input[name="data[Widget][email]"]').val(UN('input[name="un_form_field_text"]').val())) : UN(".un_left_container > .un_subscribe_Popinner").find('input[name="data[Widget][email]"]').val('');
	
	UN('input[name="un_form_field_text"]').val() != "" ? (UN(".like_pop_box > .un_subscribe_Popinner").find('input[name="data[Widget][email]"]').val(UN('input[name="un_form_field_text"]').val())) : UN(".like_pop_box > .un_subscribe_Popinner").find('input[name="data[Widget][email]"]').val('');
	
	UN('#un_form_field_font').val() != "" ? (UN(".un_subscribe_Popinner").find('input[name="data[Widget][email]"]').css("font-family", UN("#un_form_field_font").val())) : '';
	
	if(UN('#un_form_field_fontstyle').val() != "bold")
	{
		UN('#un_form_field_fontstyle').val() != "" ? (UN(".un_subscribe_Popinner").find('input[name="data[Widget][email]"]').css("font-style", UN("#un_form_field_fontstyle").val())) : '';
		UN(".un_subscribe_Popinner").find('input[name="data[Widget][email]"]').css("font-weight", '');
	}
	else
	{
		UN('#un_form_field_fontstyle').val() != "" ? (UN(".un_subscribe_Popinner").find('input[name="data[Widget][email]"]').css("font-weight", 'bold')) : '';
		UN(".un_subscribe_Popinner").find('input[name="data[Widget][email]"]').css("font-style", '');
	}
	
	UN('input[name="un_form_field_fontcolor"]').val() != "" ? (UN(".un_subscribe_Popinner").find('input[name="data[Widget][email]"]').css("color", UN('input[name="un_form_field_fontcolor"]').val())) : '';
	
	UN('input[name="un_form_field_fontsize"]').val() != "" ? (UN(".un_subscribe_Popinner").find('input[name="data[Widget][email]"]').css({"font-size": parseInt(UN('input[name="un_form_field_fontsize"]').val())})) : '';
	
	UN('#un_form_field_fontalign').val() != "" ? (UN(".un_subscribe_Popinner").find('input[name="data[Widget][email]"]').css("text-align", UN("#un_form_field_fontalign").val())) : '';
	
	//Button customization
	UN('input[name="un_form_button_text"]').val() != "" ? (UN(".un_subscribe_Popinner").find('input[name="subscribe"]').attr("value", UN('input[name="un_form_button_text"]').val())) : '';
	
	UN('#un_form_button_font').val() != "" ? (UN(".un_subscribe_Popinner").find('input[name="subscribe"]').css("font-family", UN("#un_form_button_font").val())) : '';
	
	if(UN('#un_form_button_fontstyle').val() != "bold")
	{
		UN('#un_form_button_fontstyle').val() != "" ? (UN(".un_subscribe_Popinner").find('input[name="subscribe"]').css("font-style", UN("#un_form_button_fontstyle").val())) : '';
		UN(".un_subscribe_Popinner").find('input[name="subscribe"]').css("font-weight", '');
	}
	else
	{
		UN('#un_form_button_fontstyle').val() != "" ? (UN(".un_subscribe_Popinner").find('input[name="subscribe"]').css("font-weight", 'bold')) : '';
		UN(".un_subscribe_Popinner").find('input[name="subscribe"]').css("font-style", '');
	}
	
	UN('input[name="un_form_button_fontcolor"]').val() != "" ? (UN(".un_subscribe_Popinner").find('input[name="subscribe"]').css("color", UN('input[name="un_form_button_fontcolor"]').val())) : '';
	
	UN('input[name="un_form_button_fontsize"]').val() != "" ? (UN(".un_subscribe_Popinner").find('input[name="subscribe"]').css({"font-size": parseInt(UN('input[name="un_form_button_fontsize"]').val())})) : '';
	
	UN('#un_form_button_fontalign').val() != "" ? (UN(".un_subscribe_Popinner").find('input[name="subscribe"]').css("text-align", UN("#un_form_button_fontalign").val())) : '';
	
	UN('input[name="un_form_button_background"]').val() != "" ? (UN(".un_subscribe_Popinner").find('input[name="subscribe"]').css("background-color", UN('input[name="un_form_button_background"]').val())) : '';
	
	var innerHTML = UN(".un_html > .un_subscribe_Popinner").html();
	var styleCss = UN(".un_html > .un_subscribe_Popinner").attr("style");
	innerHTML = '<div style="'+styleCss+'">'+innerHTML+'</div>';
	UN(".un_subscription_html > xmp").html(innerHTML);
}
/*Accordian collapse*/
function uncollapse(s)
{
    var i = !0, e = UN(s).closest("div.ui-accordion-content").prev("h3.ui-accordion-header"), t = UN(s).closest("div.ui-accordion-content").first();
    e.toggleClass("ui-corner-all", i).toggleClass("accordion-header-active ui-state-active ui-corner-top", !i).attr("aria-selected", (!i).toString()), 
    e.children(".ui-icon").toggleClass("ui-icon-triangle-1-e", i).toggleClass("ui-icon-triangle-1-s", !i), 
    t.toggleClass("accordion-content-active", !i), i ? t.slideUp() :t.slideDown();
}
/*save first section*/
function un_save1()
{
	var nonce = UN("#un_save1").attr("data-nonce");
	un_beForeLoad();
	var ie = UN("input[name='un_form_adjustment']:checked").val(),
	je = UN("input[name='un_form_height']").val(),
	ke = UN("input[name='un_form_width']").val(),
	le = UN("input[name='un_form_border']:checked").val(),
	me = UN("input[name='un_form_border_thickness']").val(),
	ne = UN("input[name='un_form_border_color']").val(),
	oe = UN("input[name='un_form_background']").val(),
	
	ae = UN("input[name='un_form_heading_text']").val(),
	be = UN("#un_form_heading_font option:selected").val(),
	ce = UN("#un_form_heading_fontstyle option:selected").val(),
	de = UN("input[name='un_form_heading_fontcolor']").val(),
	ee = UN("input[name='un_form_heading_fontsize']").val(),
	fe = UN("#un_form_heading_fontalign option:selected").val(),
	
	ue = UN("input[name='un_form_field_text']").val(),
	ve = UN("#un_form_field_font option:selected").val(),
	we = UN("#un_form_field_fontstyle option:selected").val(),
	xe = UN("input[name='un_form_field_fontcolor']").val(),
	ye = UN("input[name='un_form_field_fontsize']").val(),
	ze = UN("#un_form_field_fontalign option:selected").val(),
	
	i = UN("input[name='un_form_button_text']").val(),
	j = UN("#un_form_button_font option:selected").val(),
	k = UN("#un_form_button_fontstyle option:selected").val(),
	l = UN("input[name='un_form_button_fontcolor']").val(),
	m = UN("input[name='un_form_button_fontsize']").val(),
	n = UN("#un_form_button_fontalign option:selected").val(),
    o = UN("input[name='un_form_button_background']").val();
    
	var f = {
        action:"unsave1",
        un_form_adjustment:ie,
		un_form_height:je,
		un_form_width:ke,
        un_form_border:le,
        un_form_border_thickness:me,
		un_form_border_color: ne,
		un_form_background: oe,
		
        un_form_heading_text:ae,
        un_form_heading_font:be,
        un_form_heading_fontstyle:ce,
        un_form_heading_fontcolor:de,
        un_form_heading_fontsize:ee,
        un_form_heading_fontalign:fe,
		
		un_form_field_text:ue,
        un_form_field_font:ve,
        un_form_field_fontstyle:we,
        un_form_field_fontcolor:xe,
        un_form_field_fontsize:ye,
        un_form_field_fontalign:ze,
		
		un_form_button_text:i,
        un_form_button_font:j,
        un_form_button_fontstyle:k,
        un_form_button_fontcolor:l,
        un_form_button_fontsize:m,
        un_form_button_fontalign:n,
		un_form_button_background:o,
		
		nonce:nonce
    };
	UN.ajax({
        url:ajax_object.ajax_url,
        type:"post",
        data:f,
        dataType:"json",
        async:!0,
        success:function(s) {
			if(s == "wrong_nonce")
			{
				showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 1);
            	un_afterLoad();
			}
			else
			{
				"success" == s ? (showErrorSuc("success", "Saved !", 1), uncollapse("#un_save1"), un_create_suscriber_form()) :showErrorSuc("error", "Unkown error , please try again", 1), 
				un_afterLoad();
			}
		}
    });
}
function un_save2()
{
	var nonce = UN("#un_save2").attr("data-nonce");
	un_beForeLoad();
	var ie = UN("input[name='un_rectsub']:checked").val(),
	je = UN("input[name='un_rectfb']:checked").val(),
	ke = UN("input[name='un_rectgp']:checked").val(),
	le = UN("input[name='un_recttwtr']:checked").val(),
	me = UN("input[name='un_rectshr']:checked").val(),
	
	ae = UN("input[name='un_textBefor_icons']").val(),
	
	be = UN("#un_DisplayCounts option:selected").val(),
	ce = UN("#un_icons_alignment option:selected").val(),
	
	ze = UN("input[name='un_onpostBefore']:checked").val(),
	ye = UN("input[name='un_onpostAfter']:checked").val(),
	xe = UN("input[name='un_onhomeBefore']:checked").val(),
	we = UN("input[name='un_onhomeAfter']:checked").val();
    
	var f = {
        action:"unsave2",
        un_rectsub:ie,
		un_rectfb:je,
		un_rectgp:ke,
        un_recttwtr:le,
        un_rectshr:me,
		un_textBefor_icons:ae,
        un_DisplayCounts: be,
		un_icons_alignment: ce,
		
		un_onpostBefore:ze,
        un_onpostAfter:ye,
        un_onhomeBefore:xe,
        un_onhomeAfter:we,
		
		nonce:nonce
    };
	UN.ajax({
        url:ajax_object.ajax_url,
        type:"post",
        data:f,
        dataType:"json",
        async:!0,
        success:function(s) {
			if(s == "wrong_nonce")
			{
				showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 1);
            	un_afterLoad();
			}
			else
			{
				"success" == s ? (showErrorSuc("success", "Saved !", 2), uncollapse("#un_save2"), un_create_suscriber_form()) :showErrorSuc("error", "Unkown error , please try again", 2), 
				un_afterLoad();
			}
		}
    });
}
function un_beForeLoad()
{
    UN(".loader-img").show(), UN(".save_button >a").html("Saving..."), UN(".save_button >a").css("pointer-events", "none");
}
function un_afterLoad()
{
    UN("input").removeClass("inputError"), UN(".save_button >a").html("Save"), UN(".tab9>div.save_button >a").html("Save All Settings"), UN(".save_button >a").css("pointer-events", "auto"), UN(".save_button >a").removeAttr("onclick"), UN(".loader-img").hide();
}
function showErrorSuc(s, i, e)
{
    if ("error" == s) var t = "unerrorMsg"; else var t = "unsucMsg";
	return UN(".un-tab" + e + ">." + t).html(i), UN(".un-tab" + e + ">." + t).show(), 
    UN(".un-tab" + e + ">." + t).effect("highlight", {}, 5e3), setTimeout(function() {
        UN(".un-tab" + e + ">." + t).slideUp("slow");
    }, 5e3), !1;
}
