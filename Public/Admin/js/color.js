var imageUrl='../images/color.png';
function iColorShow(id,id2){
    var eICP=jQuery("#"+id2).position();
    jQuery("#iColorPicker").css({
        'top':eICP.top+(jQuery("#"+id).outerHeight())+"px",
        'left':(eICP.left)+"px",
        'position':'absolute'
    }).fadeIn("fast");
    jQuery("#iColorPickerBg").css({
        'position':'fixed',
        'top':0,
        'left':0,
        'width':'100%',
        'height':'100%'
    }).fadeIn("fast");
    var def=jQuery("#"+id).val();
    jQuery('#colorPreview span').text(def);
    jQuery('#colorPreview').css('background',def);
    jQuery('#color').val(def);
    var hxs=jQuery('#iColorPicker');
    for(i=0;i<hxs.length;i++){
        var tbl=document.getElementById('hexSection'+i);
        var tblChilds=tbl.childNodes;
        for(j=0;j<tblChilds.length;j++){
            var tblCells=tblChilds[j].childNodes;
            for(k=0;k<tblCells.length;k++){
                jQuery(tblChilds[j].childNodes[k]).unbind().mouseover(function(a){
                    var aaa="#"+jQuery(this).attr('hx');
                    jQuery('#colorPreview').css('background',aaa);
                    jQuery('#colorPreview span').text(aaa)
                    }).click(function(){
                    var aaa="#"+jQuery(this).attr('hx');
                    jQuery("#"+id).val(aaa).css("background",aaa);
                    jQuery("#iColorPickerBg").hide();
                    jQuery("#iColorPicker").fadeOut();
                    jQuery(this)
                    })
                }
            }
        }
    }
this.iColorPicker=function(){
    jQuery("input.iColorPicker").each(function(i){
        if(i==0){
            jQuery(document.createElement("div")).attr("id","iColorPicker").css('display','none').html('<table class="pickerTable" id="pickerTable0"><thead id="hexSection0"><tr><td style="background:#FF0000" hx="FF0000"></td><td style="background:#FFFF00" hx="FFFF00"></td><td style="background:#00FF00" hx="00FF00"></td><td style="background:#00FFFF" hx="00FFFF"></td><td style="background:#0000FF" hx="0000FF"></td><td style="background:#FF00FF" hx="FF00FF"></td><td style="background:#FFFFFF" hx="FFFFFF"></td><td style="background:#EBEBEB" hx="EBEBEB"></td><td style="background:#E1E1E1" hx="E1E1E1"></td><td style="background:#D7D7D7" hx="D7D7D7"></td><td style="background:#CCCCCC" hx="CCCCCC"></td><td style="background:#C2C2C2" hx="C2C2C2"></td><td style="background:#B7B7B7" hx="B7B7B7"></td><td style="background:#ACACAC" hx="ACACAC"></td><td style="background:#A0A0A0" hx="A0A0A0"></td><td style="background:#959595" hx="959595"></td></tr><tr><td style="background:#EE1D24" hx="EE1D24"></td><td style="background:#FFF100" hx="FFF100"></td><td style="background:#00A650" hx="00A650"></td><td style="background:#00AEEF" hx="00AEEF"></td><td style="background:#2F3192" hx="2F3192"></td><td style="background:#ED008C" hx="ED008C"></td><td style="background:#898989" hx="898989"></td><td style="background:#7D7D7D" hx="7D7D7D"></td><td style="background:#707070" hx="707070"></td><td style="background:#626262" hx="626262"></td><td style="background:#555555" hx="555555"></td><td style="background:#464646" hx="464646"></td><td style="background:#363636" hx="363636"></td><td style="background:#262626" hx="262626"></td><td style="background:#111111" hx="111111"></td><td style="background:#000000" hx="000000"></td></tr><tr><td style="background:#F7977A" hx="F7977A"></td><td style="background:#FBAD82" hx="FBAD82"></td><td style="background:#FDC68C" hx="FDC68C"></td><td style="background:#FFF799" hx="FFF799"></td><td style="background:#C6DF9C" hx="C6DF9C"></td><td style="background:#A4D49D" hx="A4D49D"></td><td style="background:#81CA9D" hx="81CA9D"></td><td style="background:#7BCDC9" hx="7BCDC9"></td><td style="background:#6CCFF7" hx="6CCFF7"></td><td style="background:#7CA6D8" hx="7CA6D8"></td><td style="background:#8293CA" hx="8293CA"></td><td style="background:#8881BE" hx="8881BE"></td><td style="background:#A286BD" hx="A286BD"></td><td style="background:#BC8CBF" hx="BC8CBF"></td><td style="background:#F49BC1" hx="F49BC1"></td><td style="background:#F5999D" hx="F5999D"></td></tr><tr><td style="background:#F16C4D" hx="F16C4D"></td><td style="background:#F68E54" hx="F68E54"></td><td style="background:#FBAF5A" hx="FBAF5A"></td><td style="background:#FFF467" hx="FFF467"></td><td style="background:#ACD372" hx="ACD372"></td><td style="background:#7DC473" hx="7DC473"></td><td style="background:#39B778" hx="39B778"></td><td style="background:#16BCB4" hx="16BCB4"></td><td style="background:#00BFF3" hx="00BFF3"></td><td style="background:#438CCB" hx="438CCB"></td><td style="background:#5573B7" hx="5573B7"></td><td style="background:#5E5CA7" hx="5E5CA7"></td><td style="background:#855FA8" hx="855FA8"></td><td style="background:#A763A9" hx="A763A9"></td><td style="background:#EF6EA8" hx="EF6EA8"></td><td style="background:#F16D7E" hx="F16D7E"></td></tr><tr><td style="background:#EE1D24" hx="EE1D24"></td><td style="background:#F16522" hx="F16522"></td><td style="background:#F7941D" hx="F7941D"></td><td style="background:#FFF100" hx="FFF100"></td><td style="background:#8FC63D" hx="8FC63D"></td><td style="background:#37B44A" hx="37B44A"></td><td style="background:#00A650" hx="00A650"></td><td style="background:#00A99E" hx="00A99E"></td><td style="background:#00AEEF" hx="00AEEF"></td><td style="background:#0072BC" hx="0072BC"></td><td style="background:#0054A5" hx="0054A5"></td><td style="background:#2F3192" hx="2F3192"></td><td style="background:#652C91" hx="652C91"></td><td style="background:#91278F" hx="91278F"></td><td style="background:#ED008C" hx="ED008C"></td><td style="background:#EE105A" hx="EE105A"></td></tr><tr><td style="background:#9D0A0F" hx="9D0A0F"></td><td style="background:#A1410D" hx="A1410D"></td><td style="background:#A36209" hx="A36209"></td><td style="background:#ABA000" hx="ABA000"></td><td style="background:#588528" hx="588528"></td><td style="background:#197B30" hx="197B30"></td><td style="background:#007236" hx="007236"></td><td style="background:#00736A" hx="00736A"></td><td style="background:#0076A4" hx="0076A4"></td><td style="background:#004A80" hx="004A80"></td><td style="background:#003370" hx="003370"></td><td style="background:#1D1363" hx="1D1363"></td><td style="background:#450E61" hx="450E61"></td><td style="background:#62055F" hx="62055F"></td><td style="background:#9E005C" hx="9E005C"></td><td style="background:#9D0039" hx="9D0039"></td></tr><tr><td style="background:#790000" hx="790000"></td><td style="background:#7B3000" hx="7B3000"></td><td style="background:#7C4900" hx="7C4900"></td><td style="background:#827A00" hx="827A00"></td><td style="background:#3E6617" hx="3E6617"></td><td style="background:#045F20" hx="045F20"></td><td style="background:#005824" hx="005824"></td><td style="background:#005951" hx="005951"></td><td style="background:#005B7E" hx="005B7E"></td><td style="background:#003562" hx="003562"></td><td style="background:#002056" hx="002056"></td><td style="background:#0C004B" hx="0C004B"></td><td style="background:#30004A" hx="30004A"></td><td style="background:#4B0048" hx="4B0048"></td><td style="background:#7A0045" hx="7A0045"></td><td style="background:#7A0026" hx="7A0026"></td></tr></thead><tbody><tr><td style="border:1px solid #000;background:#fff;cursor:pointer;height:60px;-moz-background-clip:-moz-initial;-moz-background-origin:-moz-initial;-moz-background-inline-policy:-moz-initial;" colspan="16" align="center" id="colorPreview"><span style="color:#000;border:1px solid rgb(0, 0, 0);padding:5px;background-color:#fff;font:11px Arial, Helvetica, sans-serif;"></span></td></tr></tbody></table><style>#iColorPicker input{margin:2px}</style>').appendTo("body");
            jQuery(document.createElement("div")).attr("id","iColorPickerBg").click(function(){
                jQuery("#iColorPickerBg").hide();
                jQuery("#iColorPicker").fadeOut()
                }).appendTo("body");
            jQuery('table.pickerTable td').css({
                'width':'12px',
                'height':'14px',
                'border':'1px solid #000',
                'cursor':'pointer'
            });
            jQuery('#iColorPicker table.pickerTable').css({
                'border-collapse':'collapse'
            });
            jQuery('#iColorPicker').css({
                'border':'1px solid #ccc',
                'background':'#333',
                'padding':'5px',
                'color':'#fff',
                'z-index':9999
            })
            }
            jQuery('#colorPreview').css({
            'height':'50px'
        });
        
        })
    };
    
jQuery(function(){
    iColorPicker()
})